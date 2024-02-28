<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataProdukExportView;
use App\Imports\ImportDataProdukClass;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::orderBy('id','desc')->paginate(10);
        return view('data_produk.index',compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ],
        [
            'nama_produk.required' => 'nama wajib diisi',
            'harga.required' => 'harga wajib diisi',
            'stok.required' => 'nomor telpon wajib diisi',
        ]
        );
        $produk = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ];

        Produk::create($produk);
        return redirect()->route('produk.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dt = Produk::find($id);
        return view('data_produk.edit', compact('dt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ],
        [
            'nama_produk.required' => 'nama wajib diisi',
            'harga.required' => 'harga wajib diisi',
            'stok.required' => 'nomor telpon wajib diisi',
        ]
        );
        $produk = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ];

        Produk::where('id', $id)->update($produk);
        return redirect()->route('produk.index')->with('success', 'Data Berhasil di Update');

    }

    public function export_pdf()
    {
        $produk= Produk::select('*');
        
        $produk = $produk->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('data_produk.exportPdf', ['produk'=>$produk]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data-produk_penjualan';

        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }

    public function export_excel()
    {
        $produk = Produk::select('*');
        
        $produk = $produk->get();

        //untuk mengexport class
        $export = new DataProdukExportView($produk);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data_produk_penjualan';

        // untuk mendownload file excel
        return Excel::download($export, $filename . '.xlsx');
    }

    public function import_excel(Request $request)
    {
        //DECLARE REQUEST
        $file = $request->file('file');

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportDataProdukClass;
                Excel::import($import, $file);
                
                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return back()
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }
            
		}
		catch(Exception $e){
			// ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }

    public function destroy($id)
    {
        $produk = Produk::findorfail($id);

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus');
    }
}

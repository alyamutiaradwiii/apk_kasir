<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPelangganExportView;
use App\Imports\ImportDataPelangganClass;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('data_pelanggan.index',compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_pelanggan.create');
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
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telpon' => 'required|max:13|min:11',
        ],
        [
            'nama_pelanggan.required' => 'nama wajib diisi',
            'alamat.required' => 'alamat wajib diisi',
            'nomor_telpon.required|max:13|min:11' => 'nomor telpon wajib diisi',
        ]
        );
        $pelanggan = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nomor_telpon' => $request->nomor_telpon,
        ];

        Pelanggan::create($pelanggan);
        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Disimpan');
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
        $dt = Pelanggan::find($id);
        return view('data_pelanggan.edit', compact('dt'));
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
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telpon' => 'required|max:13|min:11',
        ],
        [
            'nama_pelanggan.required' => 'nama wajib diisi',
            'alamat.required' => 'alamat wajib diisi',
            'nomor_telpon.required|max:13|min:11' => 'nomor telpon wajib diisi',
        ]
        );
        $pelanggan = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nomor_telpon' => $request->nomor_telpon,
        ];

        Pelanggan::where('id', $id)->update($pelanggan);
        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil di Update');

    }

    public function export_pdf()
    {
        $pelanggan = pelanggan::select('*');
        
        $pelanggan = $pelanggan->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('data_pelanggan.exportPdf', ['pelanggan'=>$pelanggan]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data-pelanggan';

        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }
    public function export_excel()
    {
        $pelanggan = Pelanggan::select('*');
        
        $pelanggan = $pelanggan->get();

        //untuk mengexport class
        $export = new DataPelangganExportView($pelanggan);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data_pelanggan';

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
                $import = new ImportDataPelangganClass;
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findorfail($id);

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}

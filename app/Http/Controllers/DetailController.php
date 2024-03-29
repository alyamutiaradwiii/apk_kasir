<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Detail_penjualan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataDetailExportView;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = Detail_penjualan::with('penjualan','produk')->get();
        return view('detail_penjualan.index',compact('detail'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk  =  Produk::all();
        $penjualan  =  Penjualan::with('pelanggan')->get();
        return view('detail_penjualan.create',compact('produk','penjualan'));
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
            'penjualan_id' => 'required',
            'produk_id' => 'required',
            'jumlah_produk' => 'required',
            'subtotal' => 'required',
        ],
        [
            'penjualan_id.required' => 'nama wajib diisi',
            'produk_id.required' => 'total harga wajib diisi',
            'jumlah_produk.required' => 'nama pelanggan wajib diisi',
            'subtotal.required' => 'nama pelanggan wajib diisi',
        ]
        );
        $detail = [
            'penjualan_id' => $request->penjualan_id,
            'produk_id' => $request->produk_id,
            'jumlah_produk' => $request->jumlah_produk,
            'subtotal' => $request->subtotal,
        ];

        Detail_penjualan::create($detail);
        return redirect()->route('detail.index')->with('success', 'Data Berhasil Disimpan');
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
        ///
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
       //
    }

    public function export_pdf()
    {
        $detail= Detail_penjualan::select('*');
        
        $detail = $detail->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('detail_penjualan.exportPdf', ['detail'=>$detail]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data-detail_penjualan';

        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }

    public function export_excel()
    {
        $detail = Detail_penjualan::select('*');
        
        $detail = $detail->get();

        //untuk mengexport class
        $export = new DataDetailExportView($detail);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data_detail';

        // untuk mendownload file excel
        return Excel::download($export, $filename . '.xlsx');
    }

    public function destroy($id)
    {
        $detail = Detail_penjualan::findorfail($id);

        $detail->delete();

        return redirect()->route('detail.index')->with('success', 'Data berhasil dihapus');
    }
}

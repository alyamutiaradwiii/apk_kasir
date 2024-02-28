<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPenjualanExportView;
use App\Imports\ImportDataPenjualanClass;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->get();
        return view('data_penjualan.index',compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan  =  Pelanggan::all();
        return view('data_penjualan.create',compact('pelanggan'));
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
            'tanggal_penjualan' => 'required',
            'Total_harga' => 'required',
            'pelanggan_id' => 'required',
        ],
        [
            'tanggal_penjualan.required' => 'nama wajib diisi',
            'Total_harga.required' => 'Total_harga wajib diisi',
            'pelanggan_id.required' => 'nama pelanggan wajib diisi',
        ]
        );
        $penjualan = [
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'Total_harga' => $request->Total_harga,
            'pelanggan_id' => $request->pelanggan_id,
        ];

        Penjualan::create($penjualan);
        return redirect()->route('penjualan.index')->with('success', 'Data Berhasil Disimpan');
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
        $penjualan = Penjualan::findorfail($id);
        return view('data_penjualan.edit', compact('penjualan'));
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
            'tanggal_penjualan' => 'required',
            'Total_harga' => 'required',
            'pelanggan_id' => 'required',
        ],
        [
            'tanggal_penjualan.required' => 'nama wajib diisi',
            'Total_harga.required' => 'Total_harga wajib diisi',
            'pelanggan_id.required' => 'nama pelanggan wajib diisi',
        ]
        );
        $penjualan = [
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'Total_harga' => $request->Total_harga,
            'pelanggan_id' => $request->pelanggan_id,
        ];
        $penjualan = Penjualan::findorfail($id);
        $penjualan->update($request->all());

        return redirect()->route('penjualan.index')->with('success', 'Data berhasil diupdate');

    }

    public function export_pdf()
    {
        $penjualan = Penjualan::select('*');
        
        $penjualan = $penjualan->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('data_penjualan.exportPdf', ['penjualan'=>$penjualan]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data-penjualan';

        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }
    public function export_excel()
    {
        $penjualan = Penjualan::select('*');
        
        $penjualan = $penjualan->get();

        //untuk mengexport class
        $export = new DataPenjualanExportView($penjualan);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data_penjualan';

        // untuk mendownload file excel
        return Excel::download($export, $filename . '.xlsx');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::findorfail($id);

        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data berhasil dihapus');
    }
}

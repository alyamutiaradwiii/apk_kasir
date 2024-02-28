<?php

namespace App\Exports;

use App\Models\Detail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataDetailExportView implements FromView, WithEvents
{
    protected $data;

public function __construct($data)
{
    $this->data = $data;
}

public function view(): View
{
    return view('detail_penjualan.exportExcel', [
        'data' => $this->data
    ]);
}

public function registerEvents(): array
{
    return[
        AfterSheet::class => function (AfterSheet $event) {
            //Auto-width each column
            foreach ($event->sheet->getColumnIterator() as $column){
                $column = $column->getColumnIndex();
                $event->sheet->getColumnDimension($column)->setAutoSize(true);
            }
        },
    ];
}
}

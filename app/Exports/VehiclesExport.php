<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VehiclesExport implements FromArray, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents
{
    protected $vehicles;

    public function __construct(array $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function array(): array
    {
        return $this->vehicles;
    }


    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,         
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' =>12]],            
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $lastColumn = $event->sheet->getHighestColumn();
                $lastRow = $event->sheet->getHighestRow();
        
                $range = 'A1:' . $lastColumn . $lastRow;
        
                $event->sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#000000'],
                        ],
                    ],
                ]);
            }
        ];
    }

}

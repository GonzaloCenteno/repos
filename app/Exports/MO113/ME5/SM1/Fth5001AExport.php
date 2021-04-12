<?php

namespace App\Exports\MO113\ME5\SM1;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Fth5001AExport implements FromView,WithTitle,WithEvents,ShouldAutoSize
{
	private $data;
	
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('reportes.excel.MO113.ME5.SM1.fth5001_1', [
            'datos' => $this->data
        ]);
    }

    public function title(): string
    {
        return 'DescuentosCredInterno';
    }

    public function registerEvents(): array
    {
		return 
		[
        	AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:N1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->getSheet()->getColumnDimension('A')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('B')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('C')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('D')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('E')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('F')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('G')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('H')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('I')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('J')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('K')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('L')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('M')->setAutoSize(true);
                $event->getSheet()->getColumnDimension('N')->setAutoSize(true);
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'family' => 'Calibri'
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '454545'],
                        ],
                    ],
                ]);
                $event->getSheet()->getDelegate()->getStyle('A1:N1')
                    ->getAlignment();
            },
            BeforeExport::class => function(BeforeExport $event) {
                $event->getWriter()->getDelegate()
                    ->getProperties()
                    ->setCreator("Fondesurco")
                    ->setLastModifiedBy("Fondesurco")
                    ->setTitle("COOPERATIVA FONDESURCO - CVN CAPITAL")
                    ->setSubject("COOPERATIVA FONDESURCO - CVN CAPITAL")
                    ->setDescription("COOPERATIVA FONDESURCO - CVN CAPITAL");
            }    
        ];
    }
}

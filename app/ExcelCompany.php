<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ExcelCompany implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithStyles
{
    public function __construct($data)
    {
        $this->company = $data;
    }
    public function headings(): array
    {
        return [
            'Mã nhà phân phối',
            'Tên nhà phân phối',
            'Tên liên hệ',
            'Số điện thoại',
            'Tỉnh thành',
            'Địa chỉ'
        ];
    }
    public function map($item): array
    {

        return [
            $item->company_code,
            $item->name,
            $item->contact_name,
            $item->phone,
            $item->getCity->name,
            $item->address,
        ];
    }

    public function collection()
    {
        return $this->company;
    }

    public function registerEvents():array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDefaultRowDimension()->setRowHeight(30);
                $workSheet = $event->sheet->getDelegate();
            },
        ];
    }

    public function styles(Worksheet $sheet) {
        $count = count($this->company);
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'CCCCCC'],
                ],
                'text-align'=>'center'
            ],

        ]);

        $sheet->getStyle('A1:E1')->getFill()->applyFromArray([
            'fillType' => 'solid',
            'rotation' => 0,
            'color' => ['rgb' => 'F5DEB3'],
        ]);
    }

}

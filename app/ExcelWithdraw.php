<?php

namespace App;

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
class ExcelWithdraw implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithStyles
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function headings(): array
    {
        return [
            'Ngày yêu cầu',
            'Mã nhà phân phối',
            'Tên nhà phân phối',
            'Tên liên hệ',
            'Số điện thoại',
            'Địa chỉ',
            'Số tài khoản',
            'Tên ngân hàng',
            'Số tiền chuyển'
        ];
    }

    public function map($item): array
    {

        return [
            format_date($item->created_at),
            $item->company->company_code,
            $item->company->name,
            $item->company->contact_name,
            $item->company->phone,
            $item->company->address,
            $item->company->bank_number,
            $item->company->bank_name,
            number_format($item->amount),
        ];
    }

    public function collection()
    {
        return $this->data;
    }

    public function registerEvents():array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDefaultRowDimension()->setRowHeight(20);
                $workSheet = $event->sheet->getDelegate();
            },
        ];
    }

    public function styles(Worksheet $sheet) {
        $count = count($this->data);
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'CCCCCC'],
                ],
                'text-align'=>'center'
            ],

        ]);

        $sheet->getStyle('A1:I1')->getFill()->applyFromArray([
            'fillType' => 'solid',
            'rotation' => 0,
            'color' => ['rgb' => 'F5DEB3'],
        ]);
    }

}

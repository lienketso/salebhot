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

class Exports implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithStyles {
    public function __construct($data)
    {
        $this->company = $data;
    }
    public function headings(): array
    {
        return [
            'Mã nhà phân phối',
            'Tên nhà phân phối',
            'Mã QR Code Nhà phân phối'
        ];
    }

    public function map($item): array
    {

        $img = base64_encode(QrCode::format('png')
                ->size(500)->errorCorrection('H')
                ->generate('http://sale.baohiemoto.vn?npp='.$item->company_code));
        $qrCode = QrCode::format('png')->size(1000)->generate('http://sale.baohiemoto.vn?npp='.$item->company_code);
        $path = '/img/qr-code/' . $item->company_code . '.png';
        Storage::disk('local')->put($path, $qrCode);
        return [
            $item->company_code,
            $item->name,
        ];
    }

    public function collection()
    {
        return $this->company;
    }

    public function setImage($workSheet) {
        $this->collection()->each(function($employee,$index) use($workSheet) {
            $drawing = new Drawing();
            $drawing->setName($employee->name);
            $drawing->setDescription($employee->name);
            $drawing->setPath(storage_path('app/img/qr-code/'.$employee->company_code.'.png'));
            $drawing->setHeight(200);
            $index+=2;
            $drawing->setCoordinates("C$index");
            $drawing->setWorksheet($workSheet);
        });
    }

    public function registerEvents():array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDefaultRowDimension()->setRowHeight(210);
                $workSheet = $event->sheet->getDelegate();
                $this->setImage($workSheet);
            },
        ];
    }
    public function styles(Worksheet $sheet) {
        $count = count($this->company);
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->getStyle('A1:C1')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'CCCCCC'],
                ],
                'text-align'=>'center'
            ],

        ]);

        $sheet->getStyle('A1:C1')->getFill()->applyFromArray([
            'fillType' => 'solid',
            'rotation' => 0,
            'color' => ['rgb' => 'F5DEB3'],
        ]);
    }
}

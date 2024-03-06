<?php

namespace App\Exports;

use App\Models\Ongoing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportOngoing implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Name',
            'NUMBER',
            'MF',
        ];
    }

    public function map($row): array
    {
        return [
            $row->Name,
            $row->NUMBER,
            $row->MF, // Assuming the image_url is the path to your image
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Add styles if needed
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

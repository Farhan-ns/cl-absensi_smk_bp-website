<?php

namespace App\Exports;

use App\Models\Teacher;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeachersExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithStyles
{
    private $no = 1;

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Mata Pelajaran',
            'Kelas',
            'Nomor Telepon',
            'Email',
            'Alamat',
            'Tanggal Lahir',
            'ID',
            // 'Deleted',
        ];
    }

    public function styles(Worksheet $worksheet)
    {
        return [
            1 => ['font' => ['bold' => true],],
        ];
    }

    /**
    * @var Teacher $teacher
    */
    public function map($teacher): array
    {
        return [
            $this->no++,
            $teacher->name,
            $teacher->subject ?? '-',
            $teacher->class_grade ?? '-',
            $teacher->phone ?? '-',
            $teacher->email ?? '-',
            $teacher->address ?? '-',
            Carbon::parse($teacher->birthdate)->format('d-m-Y') ?? '-',
            $teacher->id,
            // $teacher->deleted_at,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Teacher::orderBy('name')->get();
    }
}

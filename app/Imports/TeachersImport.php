<?php

namespace App\Imports;

use App\Models\Teacher;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithUpserts, WithHeadingRow
{
    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'id';
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Teacher([
            'id' => $row['id'],
            'name' => $row['nama'],
            'password' => $row['nama'],
            'birthdate' => Carbon::parse($row['tanggal_lahir']) ?? null,
            'phone' => $row['nomor_telepon'] ?? '-',
            'email' => $row['email'] ?? '-',
            'address' => $row['alamat'] ?? '-',
            'subject' => $row['mata_pelajaran'] ?? '-',
            'class_grade' => $row['kelas'] ?? '-',
            "deleted_at" => null,
        ]);
    }
}

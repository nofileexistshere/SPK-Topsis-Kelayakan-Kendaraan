<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Objek;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ObjekImport implements ToModel, WithStartRow, WithHeadingRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        return new Objek([
            'nama'           => $row['objek'],
            'kendaraan'      => $row['kendaraan'] ?? null,
            'nomor_polisi'   => $row['nomor_polisi'] ?? null,
            'nama_kendaraan' => $row['nama_kendaraan'] ?? null,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ]);
    }
}
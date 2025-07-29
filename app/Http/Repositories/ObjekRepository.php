<?php

namespace App\Http\Repositories;

use App\Models\Objek;
use App\Imports\ObjekImport;
use Maatwebsite\Excel\Facades\Excel;

class ObjekRepository
{
    protected $objek;

    public function __construct(Objek $objek)
    {
        $this->objek = $objek;
    }

    public function getAll()
    {
        return $this->objek->orderBy('created_at', 'asc')->get();
    }

    public function simpan($data)
    {
        return $this->objek->create($data);
    }

    public function getDataById($id)
    {
        return $this->objek->where('id', $id)->firstOrFail();
    }

    public function perbarui($id, $data)
    {
        return $this->objek->where('id', $id)->update([
            'nama'           => $data['nama'],
            'kendaraan'      => $data['kendaraan'] ?? null,
            'nomor_polisi'   => $data['nomor_polisi'] ?? null,
            'nama_kendaraan' => $data['nama_kendaraan'] ?? null,
        ]);
    }

    public function hapus($id)
    {
        return $this->objek->where('id', $id)->delete();
    }

    public function import($data)
    {
        $file = $data->file('import_data');
        return Excel::import(new ObjekImport, $file);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\KriteriaRequest;
use App\Http\Services\KriteriaService;
use App\Http\Services\PenilaianService;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    protected $kriteriaService, $penilaianService;

    public function __construct(KriteriaService $kriteriaService, PenilaianService $penilaianService)
    {
        $this->kriteriaService = $kriteriaService;
        $this->penilaianService = $penilaianService;
    }

    public function index()
{
    $judul = "Kriteria";

    $data = $this->kriteriaService->getAll();
    $sumBobot = $this->kriteriaService->getSumBobot()->total_bobot;

    if ($data->last()) {
        $lastNumber = (int) substr($data->last()->kode, 1);
        $kode = "K" . ($lastNumber + 1);
    } else {
        $kode = "K1";
    }

    return view('dashboard.kriteria.index', [
        "judul" => $judul,
        "data" => $data,
        "sumBobot" => $sumBobot,
        "kode" => $kode,
    ]);
}

    public function simpan(KriteriaRequest $request)
    {
        $data = $this->kriteriaService->simpanPostData($request);
        if (!$data[0]) {
            return redirect('dashboard/kriteria')->with('gagal', $data[1]);
        }
        return redirect('dashboard/kriteria')->with('berhasil', "Data berhasil disimpan!");
    }

    public function ubah(Request $request)
    {
        $data = $this->kriteriaService->ubahGetData($request);
        return $data;
    }

    public function perbarui(KriteriaRequest $request)
    {
        $data = $this->kriteriaService->perbaruiPostData($request);
        if (!$data[0]) {
            return redirect('dashboard/kriteria')->with('gagal', $data[1]);
        }
        return redirect('dashboard/kriteria')->with('berhasil', "Data berhasil diperbarui!");
    }

    public function hapus(Request $request)
    {
        $this->kriteriaService->hapusPostData($request->id);
        return redirect('dashboard/kriteria');
    }
}

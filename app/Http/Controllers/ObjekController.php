<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjekRequest;
use App\Http\Services\ObjekService;
use Illuminate\Http\Request;

class ObjekController extends Controller
{
    protected $objekService;

    public function __construct(ObjekService $objekService)
    {
        $this->objekService = $objekService;
    }

    public function index()
    {
        $judul = "Objek";
        $data = $this->objekService->getAll();

        return view('dashboard.objek.index', compact('judul', 'data'));
    }

    public function simpan(ObjekRequest $request)
    {
        $this->objekService->simpanPostData($request);
        return redirect('dashboard/objek')->with('berhasil', "Data berhasil disimpan!");
    }

    public function ubah(Request $request)
    {
        return $this->objekService->ubahGetData($request);
    }

    public function perbarui(ObjekRequest $request)
    {
        $this->objekService->perbaruiPostData($request);
        return redirect('dashboard/objek')->with('berhasil', "Data berhasil diperbarui!");
    }

    public function hapus(Request $request)
    {
        try {
            $this->objekService->hapusPostData($request->id);
            return redirect('dashboard/objek')->with('berhasil', "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return abort(400, "Gagal menghapus data.");
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_data' => 'required|mimes:xls,xlsx'
        ]);

        $this->objekService->import($request);
        return redirect('dashboard/objek')->with('berhasil', "Data berhasil diimport!");
    }
}

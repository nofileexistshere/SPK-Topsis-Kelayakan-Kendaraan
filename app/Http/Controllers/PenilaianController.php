<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\PenilaianRequest;
use App\Http\Services\PenilaianService;
use App\Http\Services\SubKriteriaService;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    protected $penilaianService, $subKriteriaService;

    public function __construct(PenilaianService $penilaianService, SubKriteriaService $subKriteriaService)
    {
        $this->penilaianService = $penilaianService;
        $this->subKriteriaService = $subKriteriaService;
    }

    public function index()
    {
        $judul = "Penilaian";

        $data = $this->penilaianService->getAll();
        $subKriteria = $this->subKriteriaService->getAll();

        return view('dashboard.penilaian.index', [
            "judul" => $judul,
            "data" => $data,
            "subKriteria" => $subKriteria,
        ]);
    }

    public function ubah(Request $request)
    {
        $judul = "Penilaian";

        $data = $this->penilaianService->ubahGetData($request)->first();
        $data2 = $this->penilaianService->ubahGetData($request);
        $subKriteria = $this->subKriteriaService->getAll();

        return view('dashboard.penilaian.edit', [
            "judul" => $judul,
            "data" => $data,
            "data2" => $data2,
            "subKriteria" => $subKriteria,
        ]);
    }

    public function perbarui(Request $request)
    {
        $data = $this->penilaianService->perbaruiPostData($request);
        return redirect('dashboard/penilaian')->with('berhasil', "Data berhasil diperbarui!");
    }

    public function exportPdf()
    {
        $judul = "Penilaian";
        $data = $this->penilaianService->getAll();
        $subKriteria = $this->subKriteriaService->getAll();

        // Tanggal dengan Carbon
        $tanggal = Carbon::now()->format('Y-m-d_H-i-s');

        // Encode logo ke base64 supaya bisa muncul di PDF
        $logo = base64_encode(file_get_contents(public_path('img/logo_telkom.png')));

        // Buat PDF
        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif'])
            ->loadView('dashboard.pdf.hasil_penilaian', [
                "judul" => $judul,
                "data" => $data,
                "subKriteria" => $subKriteria,
                "logo" => $logo,
            ]);

        // Nama file PDF
        $filename = "Laporan Penilaian - {$tanggal}.pdf";

        // Simpan file ke folder public/reports/pdf
        $savePath = public_path("reports/pdf/{$filename}");
        if (!file_exists(dirname($savePath))) {
            mkdir(dirname($savePath), 0777, true);
        }
        file_put_contents($savePath, $pdf->output());

        // Tampilkan PDF langsung di browser
        return $pdf->stream($filename);
    }
}

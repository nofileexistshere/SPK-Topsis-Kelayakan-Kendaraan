<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Services\TopsisService;
use App\Http\Services\KriteriaService;
use App\Http\Services\PenilaianService;

class TopsisController extends Controller
{
    protected $topsisServices, $penilaianService, $kriteriaService;

    public function __construct(TopsisService $topsisServices, PenilaianService $penilaianService, KriteriaService $kriteriaService)
    {
        $this->topsisServices = $topsisServices;
        $this->penilaianService = $penilaianService;
        $this->kriteriaService = $kriteriaService;
    }

    public function hasilAkhir()
    {
        $judul = "Hasil Akhir";
        $hasilTopsis = $this->topsisServices->getHasilTopsis();

        $target = 0.5;
        foreach ($hasilTopsis as $item) {
            if ($item->nilai < $target) {
                $item->keterangan = 'Tidak Layak';
            } else {
                $item->keterangan = 'Layak';
            }
        }

        return view('dashboard.hasil_akhir.index', [
            'judul' => $judul,
            'hasilTopsis' => $hasilTopsis,
        ]);
    }

    public function index()
    {
        $judul = "Perhitungan";

        $kriteria = $this->kriteriaService->getAll();
        $penilaian = $this->penilaianService->getAll();
        $matriksKeputusan = $this->topsisServices->getMatriksKeputusan();
        $matriksNormalisasi = $this->topsisServices->getMatriksNormalisasi();
        $matriksY = $this->topsisServices->getMatriksY();
        $solusiIdealPositif = $this->topsisServices->getSolusiIdealPositif();
        $solusiIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();
        $idealPositif = $this->topsisServices->getIdealPositif();
        $idealNegatif = $this->topsisServices->getIdealNegatif();
        $hasilTopsis = $this->topsisServices->getHasilTopsis();

        return view('dashboard.perhitungan.index', [
            'judul' => $judul,
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'matriksKeputusan' => $matriksKeputusan,
            'matriksNormalisasi' => $matriksNormalisasi,
            'matriksY' => $matriksY,
            'idealPositif' => $idealPositif,
            'idealNegatif' => $idealNegatif,
            'solusiIdealPositif' => $solusiIdealPositif,
            'solusiIdealNegatif' => $solusiIdealNegatif,
            'hasilTopsis' => $hasilTopsis,
        ]);
    }

    public function pdf_topsis()
    {
        $judul = 'Laporan Hasil TOPSIS';

        $kriteria = $this->kriteriaService->getAll();
        $penilaian = $this->penilaianService->getAll();
        $matriksKeputusan = $this->topsisServices->getMatriksKeputusan();
        $matriksNormalisasi = $this->topsisServices->getMatriksNormalisasi();
        $matriksY = $this->topsisServices->getMatriksY();
        $solusiIdealPositif = $this->topsisServices->getSolusiIdealPositif();
        $solusiIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();
        $idealPositif = $this->topsisServices->getIdealPositif();
        $idealNegatif = $this->topsisServices->getIdealNegatif();
        $hasilTopsis = $this->topsisServices->getHasilTopsis();

        $logo = base64_encode(file_get_contents(public_path('img/logo_telkom.png')));

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif'])
            ->loadview('dashboard.pdf.perhitungan', [
                'judul' => $judul,
                'kriteria' => $kriteria,
                'penilaian' => $penilaian,
                'matriksKeputusan' => $matriksKeputusan,
                'matriksNormalisasi' => $matriksNormalisasi,
                'matriksY' => $matriksY,
                'idealPositif' => $idealPositif,
                'idealNegatif' => $idealNegatif,
                'solusiIdealPositif' => $solusiIdealPositif,
                'solusiIdealNegatif' => $solusiIdealNegatif,
                'hasilTopsis' => $hasilTopsis,
                'logo' => $logo,
            ]);

        $tanggal = Carbon::now()->format('Y-m-d');
        $filename = 'Laporan Hasil TOPSIS-' . $tanggal . '.pdf';

        return $pdf->stream($filename);
    }

    public function pdf_hasil()
    {
        $judul = "Laporan Hasil Akhir";
        $hasilTopsis = $this->topsisServices->getHasilTopsis();

        $logo = base64_encode(file_get_contents(public_path('img/logo_telkom.png')));
        
        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif'])
            ->loadview('dashboard.pdf.hasil_akhir', [
                'judul' => $judul,
                'hasilTopsis' => $hasilTopsis,
                'logo' => $logo,
            ]);

        $tanggal = Carbon::now()->format('Y-m-d');
        $filename = 'Laporan Hasil Akhir Topsis-' . $tanggal . '.pdf';

        return $pdf->stream($filename);
    }

    public function hitungTopsis()
    {
        $this->hitungMatriksKeputusan();
        $this->hitungMatriksNormalisasi();
        $this->hitungMatriksY();
        $this->hitungIdeal();
        $this->hitungSolusiIdeal();
        $this->hitungHasil();
        return redirect('dashboard/perhitungan')->with('berhasil', "Perhitungan TOPSIS Selesai!");
    }

    public function hitungTopsisSetelahHapus()
    {
        $this->hitungMatriksKeputusan();
        $this->hitungMatriksNormalisasi();
        $this->hitungMatriksY();
        $this->hitungIdeal();
        $this->hitungSolusiIdeal();
        $this->hitungHasil();
    }

    public function hitungMatriksKeputusan()
    {
        $penilaian = $this->penilaianService->getAll();
        foreach ($penilaian->unique('kriteria_id') as $item) {
            $penilaianKriteria = $penilaian->where('kriteria_id', $item->kriteria_id);
            $hitungMatriks = 0;

            foreach ($penilaianKriteria as $value) {
                if ($value->sub_kriteria_id == null) {
                    abort(403, "Masukkan nilai alternatif ". $value->alternatif->objek->nama ."!");
                }
                $hitungMatriks += pow($value->subKriteria->nilai, 2);
            }

            $hitungMatriks = sqrt($hitungMatriks);
            $data = [
                'kriteria_id' => $item->kriteria_id,
                'nilai' => $hitungMatriks,
            ];

            $this->topsisServices->simpanMatriksKeputusan($data);
        }
    }

    public function hitungMatriksNormalisasi()
    {
        $penilaian = $this->penilaianService->getAll();
        foreach ($penilaian->unique('kriteria_id') as $item) {
            $penilaianKriteria = $penilaian->where('kriteria_id', $item->kriteria_id);
            $matriksKeputusan = $this->topsisServices->getMatriksKeputusanKriteria($item->kriteria_id);

            foreach ($penilaianKriteria as $value) {
                $matriksNormalisasi = $value->subKriteria->nilai / $matriksKeputusan->nilai;
                $data = [
                    'nilai' => $matriksNormalisasi,
                    'kriteria_id' => $value->kriteria_id,
                    'alternatif_id' => $value->alternatif_id,
                ];
                $this->topsisServices->simpanMatriksNormalisasi($data);
            }
        }
    }

    public function hitungMatriksY()
    {
        $matriksNormalisasi = $this->topsisServices->getMatriksNormalisasi();
        foreach ($matriksNormalisasi->unique('kriteria_id') as $item) {
            $matriksNormalisasiKriteria = $matriksNormalisasi->where('kriteria_id', $item->kriteria_id);
            $bobotKriteria = $this->kriteriaService->getDataById($item->kriteria_id);

            foreach ($matriksNormalisasiKriteria as $value) {
                $matriksY = $value->nilai * $bobotKriteria->bobot;
                $data = [
                    'nilai' => $matriksY,
                    'kriteria_id' => $value->kriteria_id,
                    'alternatif_id' => $value->alternatif_id,
                ];
                $this->topsisServices->simpanMatriksY($data);
            }
        }
    }

    public function hitungIdeal()
{
    $solusiIdeal = $this->topsisServices->getMatriksY();

    foreach ($solusiIdeal->unique('kriteria_id') as $item) {
        $solusiIdealKriteria = $solusiIdeal->where('kriteria_id', $item->kriteria_id);

        // Dapatkan nilai maksimum dan minimum beserta alternatif_id-nya
        $maxItem = $solusiIdealKriteria->sortByDesc('nilai')->first();
        $minItem = $solusiIdealKriteria->sortBy('nilai')->first();

        // Simpan satu baris Ideal Positif (nilai maksimum)
        $dataPositif = [
            'nilai' => $maxItem->nilai,
            'kriteria_id' => $maxItem->kriteria_id,
            'alternatif_id' => $maxItem->alternatif_id,
        ];
        $this->topsisServices->simpanIdealPositif($dataPositif);

        // Simpan satu baris Ideal Negatif (nilai minimum)
        $dataNegatif = [
            'nilai' => $minItem->nilai,
            'kriteria_id' => $minItem->kriteria_id,
            'alternatif_id' => $minItem->alternatif_id,
        ];
        $this->topsisServices->simpanIdealNegatif($dataNegatif);
    }
}

    public function hitungSolusiIdeal()
    {
        $matriksY = $this->topsisServices->getMatriksY();
        $idealPositif = $this->topsisServices->getIdealPositif();
        $idealNegatif = $this->topsisServices->getIdealNegatif();

        // Dapatkan daftar alternatif unik
        $alternatifs = $matriksY->unique('alternatif_id');
        $kriterias = $matriksY->unique('kriteria_id');

        foreach ($alternatifs as $alt) {
            $jarakPositifSi = 0;
            $jarakNegatifSi = 0;

            foreach ($kriterias as $krit) {
                // Ambil nilai Yij untuk alternatif ini dan kriteria ini
                $nilaiY = $matriksY->where('alternatif_id', $alt->alternatif_id)
                                ->where('kriteria_id', $krit->kriteria_id)
                                ->first();

                if (!$nilaiY) {
                    abort(500, "Data matriks Y tidak lengkap untuk alternatif ID {$alt->alternatif_id} pada kriteria ID {$krit->kriteria_id}.");
                }

                // Ambil nilai ideal positif & negatif untuk kriteria ini
                $idealP = $idealPositif->where('kriteria_id', $krit->kriteria_id)->first();
                $idealN = $idealNegatif->where('kriteria_id', $krit->kriteria_id)->first();

                if (!$idealP || !$idealN) {
                    abort(500, "Data ideal positif/negatif tidak ditemukan untuk kriteria ID {$krit->kriteria_id}.");
                }

                // Hitung selisih jarak kuadrat ke ideal positif & negatif
                $jarakPositifSi += pow($nilaiY->nilai - $idealP->nilai, 2);
                $jarakNegatifSi += pow($nilaiY->nilai - $idealN->nilai, 2);
            }

            // Hitung akar jarak
            $sqrtPositif = sqrt($jarakPositifSi);
            $sqrtNegatif = sqrt($jarakNegatifSi);

            // Simpan jarak ideal positif
            $this->topsisServices->simpanSolusiIdealPositif([
                'nilai' => $sqrtPositif,
                'alternatif_id' => $alt->alternatif_id,
            ]);

            // Simpan jarak ideal negatif
            $this->topsisServices->simpanSolusiIdealNegatif([
                'nilai' => $sqrtNegatif,
                'alternatif_id' => $alt->alternatif_id,
            ]);
        }
    }


    public function hitungHasil()
    {
        $solusiIdealPositif = $this->topsisServices->getSolusiIdealPositif();
        $solusiIdealNegatif = $this->topsisServices->getSolusiIdealNegatif();

        $dataPositif = [];
        $dataNegatif = [];
        $hitung = [];

        foreach ($solusiIdealPositif as $item) {
            $dataPositif[] = [
                'alternatif_id' => $item->alternatif_id,
                'nilai' => $item->nilai,
            ];
        }

        foreach ($solusiIdealNegatif as $item) {
            $dataNegatif[] = [
                'alternatif_id' => $item->alternatif_id,
                'nilai' => $item->nilai,
            ];
        }

        foreach ($dataPositif as $item) {
            foreach ($dataNegatif as $value) {
                if ($value['alternatif_id'] == $item['alternatif_id']) {
                    $hitung = [
                        'alternatif_id' => $item['alternatif_id'],
                        'nilai' => $value['nilai'] / ($item['nilai'] + $value['nilai']),
                    ];
                }
            }
            $this->topsisServices->simpanHasilTopsis($hitung);
            $hitung = [];
        }
    }
}

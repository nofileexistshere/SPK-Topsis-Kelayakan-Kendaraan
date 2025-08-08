@extends("dashboard.pdf.layouts.app")

@section("container")
    <div style="display: flex; align-items: center; gap: 1em; margin-bottom: 1.5em;">
        <div style="flex: 0 0 80px;">
            <img src="data:image/png;base64,{{ $logo }}" style="width: 80px;" alt="Logo">
        </div>
        <div style="flex: 1; text-align: center;">
            <h2 style="margin: 0; font-size: 18px;">PT. Telkom Akses</h2>
            <p style="margin: 2px 0; font-size: 12px;">Jalan Kaliabang Tengah No. 1, RT.6/RW.4, Kaliabang Tengah, Bekasi Utara</p>
            <p style="margin: 2px 0; font-size: 12px;">Telepon: (021) 89190800 | Email: info@telkomakses.co.id</p>
        </div>
    </div>
    <hr style="border: 1px solid black; margin-bottom: 2em;">
    <div class="-mx-3 flex flex-wrap">
        <div class="w-full max-w-full flex-none px-3 table-pdf">
            <div class="mb-5 judul-laporan">
                <h1>{{ $judul }}</h1>
            </div>

            {{-- Tabel Bobot Kriteria --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Bobot Kriteria <span class="text-greenPrimary">(W)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                @foreach ($kriteria as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($kriteria as $item)
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->bobot }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Penilaian --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Penilaian</h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($penilaian->unique("kriteria_id") as $item)
                                    <th>{{ $item->kriteria->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->unique("alternatif_id") as $item)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->alternatif->objek->nama }}</td>
                                    @foreach ($penilaian->where("alternatif_id", $item->alternatif_id) as $value)
                                        <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                            @if ($value->subKriteria != null)
                                                {{ $value->subKriteria->nilai }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Matriks Keputusan --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Matriks Keputusan <span class="text-greenPrimary">(X)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                @foreach ($matriksKeputusan as $item)
                                    <th>{{ $item->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($matriksKeputusan as $item)
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ round($item->nilai, 2) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Matriks Normalisasi --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Matriks Normalisasi <span class="text-greenPrimary">(R)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($matriksNormalisasi->unique("kriteria_id") as $item)
                                    <th>{{ $item->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriksNormalisasi->unique("alternatif_id") as $item)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nama_objek }}</td>
                                    @foreach ($matriksNormalisasi->where("alternatif_id", $item->alternatif_id) as $value)
                                        <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                            {{ round($value->nilai, 2) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Matriks Y --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Matriks Y</h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($matriksY->unique("kriteria_id") as $item)
                                    <th>{{ $item->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriksY->unique("alternatif_id") as $item)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nama_objek }}</td>
                                    @foreach ($matriksY->where("alternatif_id", $item->alternatif_id) as $value)
                                        <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                            {{ round($value->nilai, 3) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Ideal Positif --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Ideal Positif <span class="text-greenPrimary">(A<sup>+</sup>)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($idealPositif->unique("kriteria_id") as $item)
                                    <th>{{ $item->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($idealPositif->groupBy('alternatif_id') as $alternatifId => $items)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $items->first()->nama_objek }}</td>
                                    @foreach ($idealPositif->unique('kriteria_id') as $kriteria)
                                        @php
                                            $value = $items->firstWhere(function($v) use ($kriteria) {
                                                return (string)$v->kriteria_id === (string)$kriteria->kriteria_id;
                                            });
                                        @endphp
                                        <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                            {{ $value ? number_format($value->nilai, 6) : '' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Ideal Negatif --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Ideal Negatif <span class="text-greenPrimary">(A<sup>-</sup>)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($idealNegatif->unique("kriteria_id") as $item)
                                    <th>{{ $item->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($idealNegatif->groupBy('alternatif_id') as $alternatifId => $items)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $items->first()->nama_objek }}</td>
                                    @foreach ($idealNegatif->unique('kriteria_id') as $kriteria)
                                        @php
                                            $value = $items->firstWhere(function($v) use ($kriteria) {
                                                return (string)$v->kriteria_id === (string)$kriteria->kriteria_id;
                                            });
                                        @endphp
                                        <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                            {{ $value ? number_format($value->nilai, 6) : '' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Solusi Ideal Positif --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Solusi Ideal Positif <span class="text-greenPrimary">(Si<sup>+</sup>)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solusiIdealPositif as $item)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nama_objek }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ round($item->nilai, 3) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Solusi Ideal Negatif --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Solusi Ideal Negatif <span class="text-greenPrimary">(Si<sup>-</sup>)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solusiIdealNegatif as $item)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nama_objek }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ round($item->nilai, 3) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel Kedekatan Relatif terhadap Solusi Ideal --}}
            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Kedekatan Relatif terhadap Solusi Ideal <span class="text-greenPrimary">(Ci)</span></h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilTopsis as $item)
                                <tr>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nama_objek }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ round($item->nilai, 3) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Bagian tanda tangan --}}
                    <div style="width: 100%; margin-top: 3em; text-align: right;">
                        <p>Bekasi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <p style="margin-top: 4em; font-weight: bold; text-decoration: underline;">
                            Guntur Sahadi
                        </p>
                        <p><em>Supervisor Technician</em</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

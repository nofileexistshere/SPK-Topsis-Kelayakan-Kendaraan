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

            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Data Penilaian</h2>
                </div>
                <div id="recipients" class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #CD5656; color: white;">
                                <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">Nama</th>
                                @foreach ($data->unique('kriteria_id') as $item)
                                    <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">{{ $item->kriteria->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->unique('alternatif_id') as $item)
                                <tr style="background-color: {{ $loop->even ? '#f2f2f2' : 'white' }};">
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                        {{ $item->alternatif->objek->nama }}
                                    </td>
                                    @foreach ($data->where('alternatif_id', $item->alternatif_id) as $value)
                                        <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">
                                            @if ($value->subKriteria)
                                                {{ $value->subKriteria->nilai }}
                                            @endif
                                        </td>
                                    @endforeach
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
                        <p><em>Supervisor Technician</em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

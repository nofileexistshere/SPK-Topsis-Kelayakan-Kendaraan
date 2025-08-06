@extends("dashboard.pdf.layouts.app")

@section("container")
    <div class="-mx-3 flex flex-wrap">
        <div class="w-full max-w-full flex-none px-3 table-pdf">
            <div class="mb-5 judul-laporan">
                <h1>{{ $judul }}</h1>
            </div>

            <div class="shadow-soft-xl relative mb-5 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
                <div class="border-b-solid flex flex-row items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
                    <h2>Hasil Perhitungan TOPSIS</h2>
                </div>
                <div id='recipients' class="rounded bg-white p-8 shadow">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; padding-top: 1em; padding-bottom: 1em; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #4CAF50; color: white;">
                                <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">Nama</th>
                                <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">Nomor Polisi</th>
                                <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">Nilai</th>
                                <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">Target</th>
                                <th style="border-bottom:1px solid #ddd; text-align:center; padding:8px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $target = 0.5;
                                $layak = 0;
                                $tidakLayak = 0;
                            @endphp
                            @foreach ($hasilTopsis as $item)
                                @php
                                    $keterangan = $item->nilai >= $target ? 'Layak' : 'Tidak Layak';
                                    if ($keterangan === 'Layak') $layak++;
                                    else $tidakLayak++;
                                @endphp
                                <tr style="background-color: {{ $loop->even ? '#f2f2f2' : 'white' }};">
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nama_objek }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $item->nomor_polisi }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ round($item->nilai, 3) }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $target }}</td>
                                    <td style="border-bottom:1px solid #ddd; padding:8px; text-align:center;">{{ $keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

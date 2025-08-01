@extends('dashboard.layouts.app')

@section('container')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">

        <div class="mb-5 flex gap-x-1">
            <form action="{{ 'hitung_topsis' }}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="cursor-pointer inline-block px-3 py-2 font-bold text-center text-white rounded-lg text-sm ease-soft-in shadow-soft-md bg-gradient-to-br bg-black bg-black shadow-soft-md hover:shadow-soft-xs active:opacity-85 hover:scale-102 transition-all">
                    <i class="ri-file-pdf-line"></i>
                    Hitung Topsis
                </button>
            </form>
            <form action="{{ 'pdf_topsis' }}" method="post" enctype="multipart/form-data" target="_blank">
                @csrf
                <button type="submit" class="cursor-pointer inline-block px-3 py-2 font-bold text-center text-white rounded-lg text-sm ease-soft-in shadow-soft-md bg-gradient-to-br bg-black bg-black shadow-soft-md hover:shadow-soft-xs active:opacity-85 hover:scale-102 transition-all">
                    <i class="ri-file-pdf-line"></i>
                    Export PDF
                </button>
            </form>
        </div>

        {{-- Tabel Bobot Kriteria --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Bobot Kriteria <span class="text-greenPrimary">(W)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_bobot" class="stripe hover" style="width:100%; padding-bottom: 1em;">
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
                            <td>{{ $item->bobot }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Penilaian --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Penilaian</h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_penilaian" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach ($penilaian->unique('kriteria_id') as $item)
                            <th>{{ $item->kriteria->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penilaian->unique('alternatif_id') as $item)
                        <tr>
                            <td>{{ $item->alternatif->objek->nama }}</td>
                            @foreach ($penilaian->where('alternatif_id', $item->alternatif_id) as $value)
                            <td>
                                @if ($value->subKriteria != null) {{ $value->subKriteria->nilai }} @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- {{-- Tabel Matriks Keputusan --}}
            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Matriks Keputusan <span class="text-greenPrimary">(X)</span></h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_matriks_keputusan" class="stripe hover" style="width:100%; padding-bottom: 1em;">
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
                                    <td>{{ round($item->nilai, 10) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->

        {{-- Tabel Matriks Normalisasi --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Matriks Normalisasi <span class="text-greenPrimary">(R)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_matriks_normalisasi" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach ($matriksNormalisasi->unique('kriteria_id') as $item)
                            <th>{{ $item->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matriksNormalisasi->unique('alternatif_id') as $item)
                        <tr>
                            <td>{{ $item->nama_objek }}</td>
                            @foreach ($matriksNormalisasi->where('alternatif_id', $item->alternatif_id) as $value)
                            <td>
                                {{ round($value->nilai, 10) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Matriks Y --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Matriks Normalisasi Y</h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_matriks_y" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach ($matriksY->unique('kriteria_id') as $item)
                            <th>{{ $item->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matriksY->unique('alternatif_id') as $item)
                        <tr>
                            <td>{{ $item->nama_objek }}</td>
                            @foreach ($matriksY->where('alternatif_id', $item->alternatif_id) as $value)
                            <td>
                                {{ round($value->nilai, 10) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Ideal Positif --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Ideal Positif <span class="text-greenPrimary">(A<sup>+</sup>)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_ideal_positif" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach ($idealPositif->unique('kriteria_id') as $item)
                            <th>{{ $item->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A⁺</td>
                            @foreach ($idealPositif->unique('kriteria_id') as $item)
                            <td>
                                {{ number_format($idealPositif->where('kriteria_id', $item->kriteria_id)->first()->nilai, 10) }}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        {{-- Tabel Ideal Negatif --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Ideal Negatif <span class="text-greenPrimary">(A<sup>-</sup>)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_ideal_negatif" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach ($idealNegatif->unique('kriteria_id') as $item)
                            <th>{{ $item->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A⁻</td>
                            @foreach ($idealNegatif->unique('kriteria_id') as $item)
                            <td>
                                {{ number_format($idealNegatif->where('kriteria_id', $item->kriteria_id)->first()->nilai, 10) }}
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Solusi Ideal Positif --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Menghitung jarak ke solusi ideal <span class="text-greenPrimary">(D<sup>+</sup>)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_solusi_ideal_positif" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solusiIdealPositif as $index => $item)
                        <tr>
                            <td>D{{$index + 1}}+</td>
                            <td>{{ round($item->nilai, 10) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Solusi Ideal Negatif --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Menghitung jarak ke solusi ideal <span class="text-greenPrimary">(D<sup>-</sup>)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_solusi_ideal_negatif" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solusiIdealNegatif as $index => $item)
                        <tr>
                            <td>D{{$index + 1}}-</td>
                            <td>{{ round($item->nilai, 10) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Kedekatan Relatif terhadap Solusi Ideal --}}
        <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Nilai Prefrensi <span class="text-greenPrimary">(Vi)</span></h6>
            </div>
            <div id='recipients' class="p-8 rounded shadow bg-white">
                <table id="tabel_data_hasil" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasilTopsis as $item)
                        <tr>
                            <td>{{ $item->nama_objek }}</td>
                            <td>{{ round($item->nilai, 10) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
    // Tabel
    $(document).ready(function() {
        $('#tabel_data_bobot').DataTable({
                responsive: true,
                order: [],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_penilaian').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_matriks_keputusan').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_matriks_y').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_matriks_normalisasi').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_ideal_positif').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_ideal_negatif').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_solusi_ideal_positif').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_solusi_ideal_negatif').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();

        $('#tabel_data_hasil').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();
    });

    @if(session()->has('berhasil'))
    Swal.fire({
        title: 'Berhasil',
        text: '{{ session('berhasil') }}',
        icon: 'success',
        confirmButtonColor: '#6419E6',
        confirmButtonText: 'OK',
    });
    @endif

    @if(session()->has('gagal'))
    Swal.fire({
        title: 'Gagal',
        text: '{{ session('gagal') }}',
        icon: 'error',
        confirmButtonColor: '#6419E6',
        confirmButtonText: 'OK',
    });
    @endif

    @if($errors->any())
    Swal.fire({
        title: 'Gagal',
        text: '{!! implode(", ", $errors->all()) !!}',
        icon: 'error',
        confirmButtonColor: '#6419E6',
        confirmButtonText: 'OK',
    });
    @endif
</script>
@endsection
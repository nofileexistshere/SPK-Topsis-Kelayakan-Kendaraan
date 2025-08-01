@extends('dashboard.layouts.app')

@section('container')
<div class="mb-5 flex gap-x-1">
    <form action="{{ 'pdf_hasil' }}" method="post" enctype="multipart/form-data" target="_blank">
        @csrf
        <button type="submit" class="cursor-pointer inline-block px-3 py-2 font-bold text-center text-white rounded-lg text-sm ease-soft-in shadow-soft-md bg-gradient-to-br bg-black bg-black shadow-soft-md hover:shadow-soft-xs active:opacity-85 hover:scale-102 transition-all">
            <i class="ri-file-pdf-line"></i>
                Export PDF
        </button>
    </form>
</div>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-5 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Hasil Perhitungan TOPSIS</h6>
                </div>
                <div id='recipients' class="p-8 rounded shadow bg-white">
                    <table id="tabel_data_hasil" class="stripe hover" style="width:100%; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Target</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilTopsis as $item)
                                <tr>
                                    <td>{{ $item->nama_objek }}</td>
                                    <td>{{ round($item->nilai, 3) }}</td>
                                    <td>0.5</td> 
                                    <td>{{ $item->keterangan }}</td>
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
            $('#tabel_data_hasil').DataTable({
                responsive: true,
                order: [[ 1, 'desc' ]],
            })
            .columns.adjust()
            .responsive.recalc();
        });
    </script>
@endsection

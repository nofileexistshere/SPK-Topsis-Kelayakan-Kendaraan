@extends('dashboard.layouts.app')

@section('container')
    <div class="flex justify-center flex-wrap min-h-screen">
        <div class="flex-none w-full max-w-4xl px-12">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl p-6">
                <form action="{{ route('penilaian.perbarui', $data->alternatif_id) }}" method="post" enctype="multipart/form-data">
                    <h3 class="font-bold text-lg mb-4">Ubah {{ $judul }}:
                        <span class="text-greenPrimary" id="title_form">{{ $data->alternatif->objek->nama }}</span>
                    </h3>
                    @csrf
                    <input type="hidden" name="alternatif_id" value="{{ $data->alternatif_id }}" />
                    
                    @foreach ($subKriteria->unique('kriteria_id') as $item)
                        <div class="w-full mb-4">
                            <label class="label">
                                <span class="label-text">Sub Kriteria: 
                                    <span class="text-greenPrimary">{{ $item->kriteria->nama }}</span>
                                </span>
                            </label>
                            <div class="w-full flex justify-center">
                                <select class="select select-bordered text-dark w-64" name="kriteria_id[]" id="kriteria_id[]">
                                    <option disabled selected>--Pilih--</option>
                                    @foreach ($subKriteria->where('kriteria_id', $item->kriteria_id) as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $data2->where('kriteria_id', $item->kriteria_id)->first()->sub_kriteria_id ? 'selected' : '' }}>
                                            {{ $value->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('sub_kriteria_id')
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="submit" class="btn btn-success">Perbarui</button>
                        <a href="{{ route('penilaian') }}" class="btn">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

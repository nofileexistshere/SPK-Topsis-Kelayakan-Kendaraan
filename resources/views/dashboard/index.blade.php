@extends('dashboard.layouts.app')

@section('container')
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Kriteria</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $jml_kriteria }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-table-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Sub Kriteria</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $subKriteria }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-collage-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Objek</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $objek }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-brackets-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Alternatif</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $alternatif }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-braces-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cards row 2
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full px-3 mb-6 lg:mb-0 lg:w-4/12 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3  lg:flex-none">
                            <div class="flex flex-col h-full">
                                <p class="pt-2 mb-1 font-semibold">Sistem Pendukung Keputusan</p>
                                <h5 class="font-bold">TOPSIS</h5>
                                <p class="mb-12 text-justify">Topsis adalah metode pengambilan keputusan multi kriteria dengan dasar alternatif yang dipilih memiliki jarak terdekat dengan solusi ideal positif dan memiliki jarak terjauh dari solusi ideal negatif.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 lg:w-8/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
                <div class="relative h-full overflow-hidden bg-cover rounded-xl">
                    <span class="absolute top-0 left-0 w-full h-full"></span>
                    <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                        <h5 class="pt-2 mb-6 font-bold text-black">Kegunaan TOPSIS</h5>
                        <ul class="ml-3 text-black" style="list-style-type: square;">
                            <li>Konsepnya yang sederhana dan mudahdipahami.</li>
                            <li>Komputasinya efisien.</li>
                            <li>Memiliki kemampuan yang jarang dimiliki metode lain contohnya mengukur kinerja relatif dari alternatif-alternatif keputusan dalam bentuk yang sederhana. Dapat digunakan metode pengambil keputusan yang lebih cepat.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- cards row 3 -->
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="py-4 pr-1 mb-4 bg-black rounded-xl">
                        <div>
                            <canvas id="chart-bars" height="170"></canvas>
                        </div>
                    </div>
                    <h6 class="mt-6 mb-0 ml-2">Kriteria</h6>
                    <p class="ml-2 leading-normal text-sm flex flex-col">
                        <span class="font-semibold">
                            X <i class="ri-arrow-right-line"></i> Kriteria,
                            Y <i class="ri-arrow-right-line"></i> Bobot
                        </span>
                    </p>
                    {{-- <p class="ml-2 leading-normal text-sm">(<span class="font-bold">+23%</span>) than last week</p> --}}
                    <div class="w-full px-6 mx-auto max-w-screen-2xl rounded-xl">
                        <div class="flex flex-wrap mt-0 -mx-3">
                            @foreach ($kriteria as $item)
                                <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                                    <div class="flex mb-2">
                                        <div class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl from-red-700 to-pink-500 text-neutral-900">
                                            <i class="ri-table-fill text-white text-sm"></i>
                                        </div>
                                        <p class="mt-1 mb-0 leading-tight text-xs">Kriteria {{ $item->id }}: <span class="font-semibold">{{ $item->nama }}</span></p>
                                    </div>
                                    <h4 class="font-bold">{{ $item->bobot }}</h4>
                                    <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                                        <progress class="progress progress-secondary w-56" value="{{ $item->bobot }}" max="1"></progress>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <h6 class="text-black">Hasil Perhitungan TOPSIS</h6>
                    <p class="leading-normal text-sm flex flex-col">
                        <span class="font-semibold">
                            X <i class="ri-arrow-right-line"></i> Alternatif
                        </span>
                        <span class="font-semibold">
                            Y <i class="ri-arrow-right-line"></i> Nilai
                        </span>
                    </p>
                </div>
                <div class="flex-auto p-4">
                    <div>
                        <canvas id="chart-line" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        let kriteriaId = [];
        let kriteriaBobot = [];
        @foreach ($kriteria as $item)
            kriteriaId.push(' {{ $item->id }} ');
            kriteriaBobot.push(' {{ $item->bobot }} ');
        @endforeach

        new Chart(ctx, {
        type: "bar",
        data: {
            labels: kriteriaId,
            datasets: [
            {
                label: "Bobot",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#E55050",
                data: kriteriaBobot,
                maxBarThickness: 6,
            },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
            legend: {
                display: false,
            },
            },
            interaction: {
            intersect: false,
            mode: "index",
            },
            scales: {
            y: {
                grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                },
                ticks: {
                suggestedMin: 0,
                suggestedMax: 600,
                beginAtZero: true,
                padding: 15,
                font: {
                    size: 14,
                    family: "Open Sans",
                    style: "normal",
                    lineHeight: 2,
                },
                color: "#fff",
                },
            },
            x: {
                grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                },
                ticks: {
                display: false,
                },
            },
            },
        },
        });

    </script>

    <script>
        var ctx2 = document.getElementById("chart-line").getContext("2d");

        // Ubah warna gradasi utama ke E55050
        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, "rgba(229, 80, 80, 1)");
        gradientStroke1.addColorStop(0.2, "rgba(229, 80, 80, 0.1)");
        gradientStroke1.addColorStop(0, "rgba(229, 80, 80, 0)");

        // Optional: gradientStroke2 kalau tidak dipakai bisa dihapus
        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke2.addColorStop(1, "rgba(20,23,39,0.2)");
        gradientStroke2.addColorStop(0.2, "rgba(72,72,176,0.0)");
        gradientStroke2.addColorStop(0, "rgba(20,23,39,0)");

        let alternatif = [];
        let nilai = [];
        @foreach ($hasilTopsis as $item)
            alternatif.push(' {{ $item->nama_objek }} ');
            nilai.push(' {{ $item->nilai }} ');
        @endforeach

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: alternatif,
                datasets: [{
                    label: "Nilai",
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                    borderColor: "#E55050", 
                    backgroundColor: gradientStroke1, 
                    fill: true,
                    data: nilai,
                    maxBarThickness: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: "#000000",
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: "normal",
                                lineHeight: 2,
                            },
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5],
                        },
                        ticks: {
                            display: true,
                            color: "#000000", 
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: "normal",
                                lineHeight: 2,
                            },
                        },
                    },
                },
            },
        });
    </script>

@endsection

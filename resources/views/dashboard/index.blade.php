@extends('layouts.main')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

@section('container')
@section('title')
    Beranda
@endsection

@include('partials.sidebar')

<section class="bg-gray-100 min-h-screen sm:sm:ml-[78px]">
    <div class="max-w-screen-xl py-5 px-4 text-center lg:text-start mx-auto">
        <div class="flex justify-between  flex-col sm:flex-row mx-0">
            <div>
                <h2 class="text-2xl font-normal text-black">Dashboard</h2>
            </div>
            <div class="">
                <!-- <label for="intervalSelect" class="text-sm font-medium text-gray-700">Update Interval :</label> -->
                <select id="intervalSelect"
                    class="w-56 mt-1 p-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="100">100 milidetik</option>
                    <option value="500">500 milidetik</option>
                    <option value="1000">1 detik</option>
                    <option value="3000">3 detik</option>
                    <option value="5000">5 detik</option>
                    <option value="10000" selected>10 detik</option>
                    <option value="60000">1 Menit</option>
                    <option value="600000">10 Menit</option>
                    <option value="600000">30 Menit</option>
                    <option value="1200000">1 Jam</option>
                    <option value="2400000">2 Jam</option>
                </select>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-around gap-4 sm:gap-8 max-w-full py-6 relative overflow-hidden">
            <div class="flex flex-row items-center px-4 sm:p-4 sm:w-72 h-28 gap-3 bg-white rounded-lg"
                onclick="window.location.href='{{ route('dashboard.users') }}'">
                <div
                    class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 bg-primary-10 rounded-full">
                    <i class="fas fa-users text-primary-20"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight" id="allusers">{{ $allusers }}</h5>
                    <p class="font-normal text-gray-500">Pengguna Terdaftar</p>
                </div>
            </div>
            <div class="flex flex-row items-center px-4 sm:p-4 sm:w-72 h-28 gap-3 bg-white rounded-lg"
                onclick="window.location.href='{{ route('dashboard.kandidat') }}'">
                <div
                    class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 bg-yellow-100 rounded-full">
                    <i class="fas fa-user-tie text-yellow-600"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight" id="kandidats">{{ $kandidats }}</h5>
                    <p class="font-normal text-gray-500">Calon Kandidat</p>
                </div>
            </div>
            <div class="flex flex-row items-center px-4 sm:p-4 sm:w-72 h-28 gap-3 bg-white rounded-lg"
                onclick="window.location.href='{{ route('dashboard.voted') }}'">
                <div
                    class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 bg-green-100 rounded-full">
                    <i class="fas fa-user-pen text-green-600"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight" id="voted">{{ $voted }}</h5>
                    <p class="font-normal text-gray-500">Sudah Vote</p>
                </div>
            </div>
            <div class="flex flex-row items-center px-4 sm:p-4 sm:w-72 h-28 gap-3 bg-white rounded-lg"
                onclick="window.location.href='{{ route('dashboard.notvoted') }}'">
                <div class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 bg-red-100 rounded-full">
                    <i class="fas fa-user-slash text-red-600"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight" id="notvoted">{{ $notvoted }}</h5>
                    <p class="font-normal text-gray-500">Belum Vote</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 w-full">
            <div class="max-w-sm lg:max-w-3xl sm:w-[50%] h-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-lg bg-primary-10 flex items-center justify-center mr-3">
                            <i class="fa-solid fa-chart-simple text-xl text-primary-20"></i>
                        </div>
                        <div>
                            <h5 class="leading-none text-2xl font-semibold text-gray-900 dark:text-white pb-1">Grafik
                                Suara</h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Hasil Penghitungan Suara</p>
                        </div>
                    </div>
                </div>

                <div id="column-chart"></div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <!-- Indicators -->
                        <div class="flex flex-row gap-3">
                            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                    class="flex w-2.5 h-2.5 bg-[#1A56DB] rounded-full mr-1.5 flex-shrink-0"></span>OSIS</span>
                            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                    class="flex w-2.5 h-2.5 bg-[#FDBA8C] rounded-full mr-1.5 flex-shrink-0"></span>MPK</span>
                        </div>
                        <a href="/dashboard/result"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Lihat Hasil
                            <i class="fa fa-arrow-right text-sm font-semibold ml-1.5"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:w-[50%] gap-4">
                <div class="w-full h-[50%] bg-white rounded-lg shadow dark:bg-gray-800 p-4">
                    <!-- Line Chart -->
                    <div class="py-2" id="pie-chart"></div>
                </div>
                <div class="flex flex-col sm:flex-row w-[100%] gap-4" id="leaderboard_container">
                    <div class="overflow-x-auto w-full h-[299px] py-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <table class="w-full text-sm text-left     text-black    ">
                            <thead class="text-sm     text-black     uppercase">
                                <tr class="border-b">
                                    <th scope="col" class="px-4 py-1">NO</th>
                                    {{-- <th scope="col" class="px-4 py-1">Foto</th> --}}
                                    <th scope="col" class="px-1 py-1">OSIS</th>
                                    <th scope="col" class="px-4 py-1">VOTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($osis as $os)
                                    <tr>
                                        <td class="px-1 py-1 text-center">{{ $os->nomor_urut }}.</td>
                                        <td class="py-1 max-w-[12rem]">{{ $os->name }}</td>
                                        <td class="px-1 py-1 text-center">{{ $os->vote->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="overflow-x-auto w-full h-[299px] py-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <table class="w-full text-sm text-left     text-black    ">
                            <thead class="text-sm     text-black     uppercase">
                                <tr class="border-b">
                                    <th scope="col" class="px-4 py-1">NO</th>
                                    {{-- <th scope="col" class="px-4 py-1">Foto</th> --}}
                                    <th scope="col" class="px-1 py-1">MPK</th>
                                    <th scope="col" class="px-4 py-1">VOTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($mpk as $m)
                                    <tr>
                                        <td class="px-1 py-1 text-center">{{ $i++ }}.</td>
                                        {{-- <td class="px-4 py-1"><img class="flex justify-center items-center max-w-[28px] rounded-full" src="{{ asset('img/hafiz.webp') }}"></td> --}}
                                        <td class="py-1 max-w-[12rem]">{{ $m->name }}</td>
                                        <td class="px-1 py-1 text-center">{{ $m->vote->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <script>
            let pieChart;
            let chart;
            window.addEventListener("load", function() {
                const options = {
                    colors: ["#1A56DB", "#FDBA8C"],
                    series: [{
                            name: "OSIS",
                            color: "#1A56DB",
                            sort: false,
                            data: [
                                @foreach ($unsorted_osis as $o)
                                    {
                                        x: "NO {{ $o->nomor_urut }}",
                                        y: {{ $o->vote_count }}
                                    },
                                @endforeach
                            ],
                        },
                        {
                            name: "MPK",
                            sort: false,
                            color: "#FDBA8C",
                            data: [
                                @foreach ($unsorted_mpk as $m)
                                    {
                                        x: "NO {{ $m->nomor_urut }}",
                                        y: {{ $m->vote_count }}
                                    },
                                @endforeach
                            ],
                        },
                    ],
                    chart: {
                        type: "bar",
                        width: "100%",
                        height: "350px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "70%",
                            borderRadiusApplication: "end",
                            borderRadius: 8,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    states: {
                        hover: {
                            filter: {
                                type: "darken",
                                value: 1,
                            },
                        },
                    },
                    stroke: {
                        show: true,
                        width: 0,
                        colors: ["transparent"],
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        show: false,
                    },
                    xaxis: {
                        floating: false,
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                }

                if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                    chart = new ApexCharts(document.getElementById("column-chart"), options);
                    chart.render();
                }
                const getChartOptions = () => {
                    return {
                        series: [{!! $voted !!}, {!! $notvoted !!}],
                        colors: ["#1C64F2", "#16BDCA"],
                        chart: {
                            height: 220,
                            width: "100%",
                            type: "pie",
                        },
                        stroke: {
                            colors: ["white"],
                            lineCap: "",
                        },
                        plotOptions: {
                            pie: {
                                labels: {
                                    show: true,
                                },
                                size: "100%",
                                dataLabels: {
                                    offset: -25
                                }
                            },
                        },
                        labels: ["Sudah Vote", "Belum Vote"],
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                            },
                        },
                        legend: {
                            position: "bottom",
                            fontFamily: "Inter, sans-serif",
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return value
                                },
                            },
                        },
                        xaxis: {
                            labels: {
                                formatter: function(value) {
                                    return value
                                },
                            },
                            axisTicks: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                        },
                    }
                }
                if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                    pieChart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                    pieChart.render();
                }
            });
        </script>
        <script>
            const intervalSelect = document.getElementById('intervalSelect');
            let fetchDataInterval = parseInt(intervalSelect.value);

            intervalSelect.addEventListener('change', function() {
                fetchDataInterval = parseInt(intervalSelect.value);
                clearInterval(fetchDataIntervalId);
                fetchDataIntervalId = setInterval(fetchData, fetchDataInterval);
            });

            function fetchData() {
                axios.get('/dashboard/data_source')
                    .then(response => {
                        data = response.data;
                        document.getElementById('voted').innerText = data.voted;
                        document.getElementById('allusers').innerText = data.allusers;
                        document.getElementById('kandidats').innerText = data.kandidats;
                        document.getElementById('notvoted').innerText = data.notvoted;
                        document.getElementById('leaderboard_container').innerHTML = '';
                        document.getElementById('leaderboard_container').innerHTML = data.leaderboard;
                        pieChart.updateSeries([data.voted, data.notvoted]);
                        const newSeries = [{
                                name: "OSIS",
                                data: data.unsorted_osis.map(os => ({
                                    x: `NO ${os.nomor_urut}`,
                                    y: os.vote_count
                                })),
                            },
                            {
                                name: "MPK",
                                data: data.unsorted_mpk.map(mpk => ({
                                    x: `NO ${mpk.nomor_urut}`,
                                    y: mpk.vote_count
                                })),
                            }
                        ];

                        chart.updateSeries(newSeries);
                    })
                    .catch(error => {
                        if (!navigator.onLine) {
                            // Display toastr error for no internet
                            toastr.error('No internet connection');
                        } else {
                            toastr.error('Error fetching data:', error);
                        }
                    });
            }

            let fetchDataIntervalId = setInterval(fetchData, fetchDataInterval);
        </script>

</section>
<x-bottom-nav/>

@endsection

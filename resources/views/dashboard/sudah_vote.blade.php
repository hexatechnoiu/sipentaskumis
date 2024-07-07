@extends('layouts.main')

@section('title')
    Sudah vote
@endsection

@section('head')
    <link href="https://cdn.datatables.net/v/zf/dt-1.13.8/b-2.4.2/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/zf/dt-1.13.8/b-2.4.2/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "Tidak ada data dalam tabel",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Tidak ada entri ditemukan",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing": "",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada catatan yang sesuai",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "orderable": "Urutkan menurut kolom ini",
                        "orderableReverse": "Urutkan terbalik menurut kolom ini"
                    }
                }

            });
        });
    </script>
@endsection
@section('container')
    @include('partials.sidebar')

    <!-- Start block -->
    <section class="bg-gray-50 p-3 sm:p-5 antialiased sm:ml-[78px]">
        <div class="mx-auto px-4">
            <div class="flex flex-col justify-center text-center mb-10">
                <h1 class="font-semibold text-xl text-primary-20">Pengguna yang sudah vote</h1>
            </div>
            <!-- Start coding here -->
            <div class="bg-white relative shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto px-10 py-4">
                    <table class="w-full text-sm text-left     text-black    " id="userTable">
                        <thead class="text-sm     text-black     uppercase bg-white">
                            <tr>
                                {{-- <th scope="col" class="px-4 py-4">Profile Picture</th> --}}
                                <th scope="col" class="px-4 py-3">NIS / NIK</th>
                                <th scope="col" class="px-4 py-3">Nama Lengkap</th>
                                <th scope="col" class="px-4 py-3">Kelas</th>
                                <th scope="col" class="px-4 py-3 text-center">Status</th>
                                @if (request('show') === 'true')
                                    <th scope="col" class="px-4 py-3 text-center">OSIS</th>
                                    <th scope="col" class="px-4 py-3 text-center">MPK</th>
                                @endif
                                <th scope="col" class="px-4 py-3 text-center">Vote</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voted as $sudah_vote)
                                <tr class="border-b">
                                    <td class="px-4 py-3">{{ $sudah_vote->email }}</td>
                                    <td class="px-4 py-3 max-w-[10rem]">{{ $sudah_vote->name }}</td>
                                    <td class="px-4 py-3">{{ $sudah_vote->kelas }}</td>
                                    <td class="px-4 py-3 text-center">{{ $sudah_vote->role }}</td>
                                    <td class="px-4 py-3 text-center text-green-600 font-semibold uppercase">Sudah</td>
                                    @if (request('show') === 'true')
                                        @foreach ($sudah_vote->votes as $v)
                                            <td class="px-4 py-3 text-center">
                                                <div class="bg-primary-10 text-primary-20 p-2 rounded-lg">
                                                    {{ $v->nomor_urut . ' ' . $v->name }}
                                                </div>
                                            </td>
                                        @endforeach
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav
                        class="flex flex-col md:flex-row overflow-auto will-change-scroll justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
                        <form method="GET">
                            @if (!request('show') || request('show') == 'false')
                                <input type="hidden" name="show" value="true">
                                <button class=" rounded-md py-1 px-2 bg-primary-10 text-primary-20" type="submit"><i
                                        class="fa-solid fa-person-circle-xmark fa-sm"></i></button>
                            @elseif(request('show') == 'true')
                                <input type="hidden" name="show" value="false">
                                <button class=" rounded-md py-1 px-2 bg-primary-20 text-primary-10" type="submit">
                                    <i class="fa-solid fa-person-circle-check fa-sm"></i></button>
                            @endif

                        </form>
                    </nav>
                    {{-- <nav class="flex flex-col md:flex-row overflow-auto will-change-scroll justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal     text-black    ">
                        Showing
                        <span class="font-semibold text-black">
                            {{ $voted->firstItem() }}-{{ $voted->lastItem() }}
                        </span>
                        of
                        <span class="font-semibold text-black">{{ $voted->total() }}</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li
                            class="flex items-center justify-center h-full py-1.5 px-3 mr-1     text-black     bg-white rounded-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms]">
                        </li>
                        <li>
                            <a href="{{ $voted->withQueryString()->previousPageUrl() }}"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0     text-black     bg-white rounded-l-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $voted->onFirstPage() ? 'cursor-not-allowed' : '' }}">
                                <span class="sr-only">Previous</span>
                                <i class="fa-solid fa-chevron-left fa-sm"></i>
                            </a>
                        </li>
                        @foreach ($voted->getUrlRange(1, $voted->withQueryString()->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight {{ $page == $voted->currentPage() ? 'text-black bg-gray-20' : '    text-black     bg-white' }} border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $page == $voted->currentPage() ? 'z-10' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ $voted->withQueryString()->nextPageUrl() }}"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight     text-black     bg-white rounded-r-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $voted->hasMorePages() ? '' : 'cursor-not-allowed' }}">
                                <span class="sr-only">Next</span>
                                <i class="fa-solid fa-chevron-right fa-sm"></i>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                </div>

            </div>

        </div>
    </section>
    <!-- End block -->
    <x-bottom-nav />
@endsection

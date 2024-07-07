@extends('layouts.main')

@section('title')
Belum vote
@endsection

@section('head')
<link href="https://cdn.datatables.net/v/zf/dt-1.13.8/b-2.4.2/datatables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/v/zf/dt-1.13.8/b-2.4.2/datatables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#userTable').DataTable();
} );
</script>
@endsection

@section('container')
@include('partials.sidebar')

<!-- Start block -->
<section class="bg-gray-50 p-3 sm:p-5 antialiased sm:ml-[78px]">
    <div class="mx-auto">
        <div class="flex flex-col justify-center text-center mb-10">
            <h1 class="font-semibold text-xl text-primary-20">Pengguna yang belum vote</h1>
        </div>
        <!-- Start coding here -->
        <div class="bg-white relative shadow-sm print:shadow-none print:border sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto p-10">
                <table class="w-full text-sm text-left     text-black    " id="userTable">
                    <thead class="text-sm     text-black     uppercase bg-white">
                        <tr>
                            {{-- <th scope="col" class="px-4 py-4">Profile Picture</th> --}}
                            <th scope="col" class="px-4 py-3">NIS / NIK</th>
                            <th scope="col" class="px-4 py-3">Nama Lengkap</th>
                            <th scope="col" class="px-4 py-3">Kelas</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3 text-center">Vote</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notvoted as $hehe)
                        <tr class="border-b">
                            {{-- <td class="px-4 py-3"><img class="max-w-[5rem]" src="{{ asset('img/hafiz.webp') }}"></td> --}}
                            <td class="px-4 py-3">{{ $hehe->email }}</td>
                            <td class="px-4 py-3 max-w-[10rem]">{{ $hehe->name }}</td>
                            <td class="px-4 py-3">{{ $hehe->kelas }}</td>
                            <td class="px-4 py-3">{{ $hehe->role }}</td>
                            <td class="px-4 py-3 text-center text-red-600 font-semibold uppercase">Belum</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <nav class="flex flex-col md:flex-row overflow-auto will-change-scroll justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal     text-black    ">
                        Showing
                        <span class="font-semibold text-black">
                            {{ $notvoted->firstItem() }}-{{ $notvoted->lastItem() }}
                        </span>
                        of
                        <span class="font-semibold text-black">{{ $notvoted->total() }}</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="{{ $notvoted->withQueryString()->previousPageUrl() }}"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0     text-black     bg-white rounded-l-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $notvoted->onFirstPage() ? 'cursor-not-allowed' : '' }}">
                                <span class="sr-only">Previous</span>
                                <i class="fa-solid fa-chevron-left fa-sm"></i>
                            </a>
                        </li>
                        @foreach ($notvoted->getUrlRange(1, $notvoted->withQueryString()->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight {{ $page == $notvoted->currentPage() ? 'text-black bg-gray-20' : '    text-black     bg-white' }} border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $page == $notvoted->currentPage() ? 'z-10' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ $notvoted->withQueryString()->nextPageUrl() }}"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight     text-black     bg-white rounded-r-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $notvoted->hasMorePages() ? '' : 'cursor-not-allowed' }}">
                                <span class="sr-only">Next</span>
                                <i class="fa-solid fa-chevron-right fa-sm"></i>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                {{-- <nav class="flex flex-col md:flex-row overflow-auto will-change-scroll justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal     text-black    ">
                        Showing
                        <span class="font-semibold text-black">
                            {{ $users->firstItem() }}-{{ $users->lastItem() }}
                        </span>
                        of
                        <span class="font-semibold text-black">{{ $users->total() }}</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="{{ $users->withQueryString()->previousPageUrl() }}"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0     text-black     bg-white rounded-l-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $users->onFirstPage() ? 'cursor-not-allowed' : '' }}">
                                <span class="sr-only">Previous</span>
                                <i class="fa-solid fa-chevron-left fa-sm"></i>
                            </a>
                        </li>
                        @foreach ($users->getUrlRange(1, $users->withQueryString()->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight {{ $page == $users->currentPage() ? 'text-black bg-gray-20' : '    text-black     bg-white' }} border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $page == $users->currentPage() ? 'z-10' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ $users->withQueryString()->nextPageUrl() }}"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight     text-black     bg-white rounded-r-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $users->hasMorePages() ? '' : 'cursor-not-allowed' }}">
                                <span class="sr-only">Next</span>
                                <i class="fa-solid fa-chevron-right fa-sm"></i>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
            {{-- <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal     text-black    ">
                        Showing
                        <span class="font-semibold text-black">
                            {{ $users->firstItem() }}-{{ $users->lastItem() }}
            </span>
            of
            <span class="font-semibold text-black">{{ $users->total() }}</span>
            </span>
            <ul class="inline-flex items-stretch -space-x-px">
                <li>
                    <a href="{{ $users->withQueryString()->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0     text-black     bg-white rounded-l-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $users->onFirstPage() ? 'cursor-not-allowed' : '' }}">
                        <span class="sr-only">Previous</span>
                        <i class="fa-solid fa-chevron-left fa-sm"></i>
                    </a>
                </li>
                @foreach ($users->getUrlRange(1, $users->withQueryString()->lastPage()) as $page => $url)
                <li>
                    <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight {{ $page == $users->currentPage() ? 'text-black bg-gray-20' : '    text-black     bg-white' }} border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $page == $users->currentPage() ? 'z-10' : '' }}">
                        {{ $page }}
                    </a>
                </li>
                @endforeach
                <li>
                    <a href="{{ $users->withQueryString()->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight     text-black     bg-white rounded-r-lg border border-gray-30 hover:bg-gray-20 hover:text-black duration-[400ms] {{ $users->hasMorePages() ? '' : 'cursor-not-allowed' }}">
                        <span class="sr-only">Next</span>
                        <i class="fa-solid fa-chevron-right fa-sm"></i>
                    </a>
                </li>
            </ul>
            </nav> --}}
        </div>

    </div>
</section>
<x-bottom-nav/>

<!-- End block -->

@endsection

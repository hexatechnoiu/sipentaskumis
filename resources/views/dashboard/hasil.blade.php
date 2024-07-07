@extends('layouts.main')

@section('container')
@section('title')
    Hasil voting
@endsection
@include('partials.sidebar')

<!-- Start block -->
<section class="bg-gray-50 pt-3 sm:pt-5 px-3 sm:px-5 antialiased sm:ml-[78px] print:m-0 min-h-screen">
    <div class="mx-auto pb-28 px-4">
        <a href="{{ route('dashboard.print_result') }}" class="hover:rotate-[370deg] hover:rounded-lg hover:scale-150 absolute top-8 right-10 py-2 px-4 text-white bg-blue-700 hover:bg-blue-500 duration-1000 rounded">
            <i class="fas fa-print text-xl hover:shadow-2xl shadow-white"></i>
        </a>
        <div class="flex flex-col justify-center text-center mb-10">
            <h1 class="font-semibold text-2xl text-primary-20">Hasil Pemilihan Umum Ketua OSIS & MPK SMKN 2
                Sumedang<br>Tahun Periode {{cache('settings')['voting_angkatan']['value']}}</h1>
        </div>

        <!-- Start coding here -->
        <div class="flex justify-around mb-6">
            <h1
                class="flex items-center justify-center font-semibold text-xl w-28 h-10 text-white bg-[#1A56DB] rounded-ss-lg rounded-ee-lg">
                OSIS</h1>
            <h1
                class="flex items-center justify-center font-semibold text-xl w-28 h-10 text-black bg-[#FDBA8C] rounded-ss-lg rounded-ee-lg">
                MPK</h1>
        </div>
        <div class="flex justify-center gap-4">
            <div class="bg-white w-[50%] relative shadow-xl sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left     text-black    ">
                        <thead class="text-sm     text-black     uppercase bg-white">
                            <tr>
                                {{-- <th scope="col" class="px-4 py-4">Profile Picture</th> --}}
                                <th scope="col" class="px-2 py-3 text-center w-20">No Urut</th>
                                <th scope="col" class="px-2 py-3">Nama</th>
                                <th scope="col" class="px-2 py-3">Sebagai</th>
                                <th scope="col" class="px-2 py-3 text-center">Jumlah Vote</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $os = 0;
                        @endphp
                        @foreach ($osis as $o)
                        <tr class="border-b">
                            <td class="px-2 py-3 font-semibold text-lg text-center">{{ $o->nomor_urut }}</td>
                            <td class="px-2 py-3 w-[16rem]">{{ $o->name }}</td>
                            <td class="px-2 py-3">{{ $new_role[$os] ?? "-" }}</td>
                            <td class="px-2 py-3 font-semibold text-lg text-center">{{ $o->vote_count }}</td>
                        </tr>
                        @php
                            $os++;
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white w-[50%] relative shadow-xl sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left     text-black    ">
                        <thead class="text-sm     text-black     uppercase bg-white">
                            <tr>
                                {{-- <th scope="col" class="px-4 py-4">Profile Picture</th> --}}
                                <th scope="col" class="px-2 py-3 text-center w-20">No Urut</th>
                                <th scope="col" class="px-2 py-3">Nama</th>
                                <th scope="col" class="px-2 py-3">Sebagai</th>
                                <th scope="col" class="px-2 py-3 text-center">Jumlah Vote</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $mp = 0;
                        @endphp
                        @foreach ($mpk as $m)
                        <tr class="border-b">
                            <td class="px-2 py-3 font-semibold text-lg text-center">{{ $m->nomor_urut }}</td>
                            <td class="px-2 py-3 w-[16rem]">{{ $m->name }}</td>
                            <td class="px-2 py-3">{{ $new_role[$mp] ?? "-" }}</td>
                            <td class="px-2 py-3 font-semibold text-lg text-center">{{ $m->vote_count }}</td>
                        </tr>
                        @php
                            $mp++;
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<x-bottom-nav/>

<!-- End block -->

@endsection

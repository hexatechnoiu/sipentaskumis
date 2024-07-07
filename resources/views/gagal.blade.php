@extends('layouts.main')


@section('title')
    Anda sudah vote
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="flex flex-col justify-center text-center">
            <a href="/" class="absolute top-8 left-5 text-gray-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span class="sr-only">Back</span>
            </a>
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('img/mark.webp') }}" alt="berhasil">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-2 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-secondary-30 dark:text-white">
                    Anda telah melakukan vote!</h1>
                <p class="max-w-2xl mb-8 font-normal text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Terima
                    Kasih telah berpartisipasi dalam pemilihan Ketua OSIS & MPK SMKN 2 Sumedang Tahun Periode {{cache('settings')['voting_angkatan']['value']}}</p>
                <div
                    class="inline-flex items-center justify-center w-full px-2 py-3 mr-3 text-center text-white rounded-lg bg-secondary-30">
                    @if (auth()->user()->role == 'Siswa')
                    {{ auth()->user()->email }} | {{ auth()->user()->name }} | {{ auth()->user()->kelas }}
                    @else
                    {{ auth()->user()->role }} | {{ auth()->user()->name }}
                    @endif
                </div>
                <a href="{{ route('berhasil') }}"
                    class="inline-flex items-center justify-center w-full px-2 py-2.5 mr-3 mt-2 text-center font-medium text-secondary-30 rounded-lg bg-transparent hover:text-white hover:bg-secondary-30 border-2 border-secondary-30 duration-300">
                    <i class="fas fa-check text-lg mr-2"></i>Tampilkan halaman sukses
                </a>
            </div>
        </div>
    </section>
@endsection

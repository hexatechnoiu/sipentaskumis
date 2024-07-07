@extends('layouts.main')

@section('title')
    Berhasil vote!
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900 py-5">
        <div class="flex items-center p-2 sm:p-4 mx-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium text-xs sm:text-lg">Screenshot halaman ini sebagai bukti telah melakukan vote!</span>
            </div>
        </div>
        <div class="grid max-w-screen-xl px-4 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5 lg:flex">
                <img src="{{ asset('img/check.webp') }}" alt="berhasil">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-2 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-primary-20 dark:text-white">
                    Vote berhasil!</h1>
                <p class="max-w-2xl mb-8 font-normal text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Terima
                    Kasih telah berpartisipasi dalam Pemilihan Umum Ketua OSIS & MPK SMKN 2 Sumedang Tahun Periode {{cache('settings')['voting_angkatan']['value']}}</p>
                <div
                    class="inline-flex items-center justify-center w-full px-2 py-3 mr-3 text-center text-white rounded-lg bg-primary-20 border-2 border-primary-20">
                    @if(auth()->user()->role == 'Siswa')
                    {{ auth()->user()->email ?? 'NIS' }} |
                    @endif
                    {{ auth()->user()->name ?? 'NAMA LENGKAP' }}

                    @if(auth()->user()->role == 'Siswa')
                    | {{ auth()->user()->kelas ?? 'KELAS' }}
                    @endif
                </div>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center w-full px-2 py-2.5 mr-3 mt-2 text-center font-medium text-primary-20 rounded-lg bg-transparent hover:text-white hover:bg-primary-20 border-2 border-primary-20 duration-300">
                    <i class="fas fa-home text-lg mr-2"></i>Back to Home
                </a>
            </div>
        </div>
    </section>
    <script defer>
        $(document).ready(function() {
            $.post('{{ route('logout') }}', {
                _token: '{{ csrf_token() }}'
            }, function() {
                toastr.info('Jangan refresh halaman ini bila anda tetap ingin di halaman ini','Berhasil log out')
                // window.location.href = '/';
            });
        });
    </script>
@endsection

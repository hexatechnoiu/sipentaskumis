

@extends('layouts.main')


@section('title')
    Welcome
@endsection


@section('container')
    @include('partials.header')
    <div x-data="{ modal: false }">
        <section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="{{ asset('img/welcome.webp') }}" alt="welcome" loading="lazy">
                </div>
                <div class="mt-16 mr-auto place-self-center lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-2 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-primary-20 dark:text-white">
                        Selamat Datang</h1>
                    <p class="max-w-2xl mb-8 font-normal text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                        Pemilihan Umum Ketua OSIS & MPK SMKN 2 Sumedang Tahun Periode {{cache('settings')['voting_angkatan']['value']}}</p>
                    @guest
                        <button type="button" x-on:click="modal= !modal"

                            class="inline-flex items-center justify-center w-full sm:w-32 px-auto sm:px-5 py-3 mr-3 text-center text-white rounded-lg bg-primary-20 hover:text-primary-20 hover:bg-primary-10 duration-300">
                            Login
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    @endguest
                    @auth
                        @if (auth()->user()->role === 'Admin')
                            <a href="{{ route('dashboard.home') }}"
                                class="inline-flex items-center justify-center w-full sm:w-36 px-auto sm:px-5 py-3 mr-3 text-center text-white rounded-lg bg-primary-20 hover:text-primary-20 hover:bg-primary-10 duration-300">
                                Dashboard
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        @else
                            @if (auth()->user()->vote->where('organisasi', 'OSIS')->count() > 0 &&
                                    auth()->user()->vote->where('organisasi', 'MPK')->count() > 0)
                                <a href="{{ route('gagal') }}"
                                    class="inline-flex items-center justify-center w-full px-2 py-3 mr-3 text-center text-white rounded-lg bg-primary-20 hover:text-primary-20 hover:bg-primary-10 duration-300">
                                    Anda telah melakukan vote
                                </a>
                            @else
                                <a href="{{ route('vote.osis') }}"
                                    class="inline-flex items-center justify-center w-full sm:w-32 px-auto sm:px-5 py-3 mr-3 text-center text-white rounded-lg bg-primary-20 hover:text-primary-20 hover:bg-primary-10 duration-300">
                                    Vote
                                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            @endif
                        @endif

                    @endauth
                </div>
            </div>
        </section>


        <div x-show="modal" id="popup-modal"  tabindex="-1"
            class="fixed right-0 flex justify-center bg-gray-700 bg-opacity-20 items-center top-0 left-0 bottom-0 z-50 p-4 transition-transform overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div x-on:click.outside="modal=!modal" x-show="modal" x-transition.duration.300ms class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <p
                        class="inline-flex items-center justify-center w-full px-auto sm:px-5 mt-4 text-xl font-semibold text-center text-primary-20">
                        Pilih login sebagai</p>
                    <button type="button" x-on:click="modal=!modal"
                        class="absolute top-4 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                        <svg  class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="flex flex-row pt-8 pb-6 px-6 text-center justify-around gap-2">
                        <a href="{{ route('login.siswa') }}"
                            class="flex flex-col justify-center gap-0 w-28 py-3 px-4 text-center text-primary-20 rounded-lg bg-primary-10 hover:text-white hover:bg-primary-20 duration-300">
                            <img src="{{ asset('img/siswa.webp') }}" alt=""
                                class="inline-flex justify-center mx-auto w-20 ">
                            <p class="text-center">Siswa</p>
                        </a>
                        <a href="{{ route('login.guru') }}"
                            class="flex flex-col justify-center gap-0 w-28 py-3 px-4 text-center text-primary-20 rounded-lg bg-primary-10 hover:text-white hover:bg-primary-20 duration-300">
                            <img src="{{ asset('img/guru.webp') }}" alt=""
                                class="inline-flex justify-center mx-auto w-20">
                            <p class="text-center">Guru/TU</p>
                        </a>
                        <a href="{{ route('login.admin') }}"
                            class="flex flex-col justify-center gap-0 w-28 py-3 px-4 text-center text-primary-20 rounded-lg bg-primary-10 hover:text-white hover:bg-primary-20 duration-300">
                            <img src="{{ asset('img/tendik.webp') }}" alt=""
                                class="inline-flex justify-center mx-auto w-20">
                            <p class="text-center">Admin</p>
                        </a>
                    </div>
                    {{-- <div class="p-6 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
            </div> --}}
                </div>
            </div>
        </div>

        {{-- <div>
    <button type="button" data-tooltip-target="tooltip-call" data-modal-target="call" data-modal-toggle="call" class="fixed bottom-5 right-5 w-14 h-14 sm:bottom-10 sm:right-10 z-30 flex justify-center items-center gap-2 bg-primary-20 text-white font-medium text-2xl rounded-full shadow-md hover:scale-110 transition-all duration-[400ms] cursor-pointer">
        <i class="fa-solid fa-headset"></i>
    </button>
    <div id="tooltip-call" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-black rounded-lg shadow-sm opacity-0 transition-opacity duration-[400ms] tooltip">
        Hubungi Kami
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div> --}}
    </div>
@endsection

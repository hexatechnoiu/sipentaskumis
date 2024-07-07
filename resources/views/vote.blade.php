@extends('layouts.main')
@section('title')
    Vote {{ $org_name }}
@endsection
@section('container')

    <div x-data="{ vote: false, info: false, kandidat: {} }">
        <section class="bg-white dark:bg-gray-900 py-10">
            <div class="flex flex-row justify-center text-center">
                <a href="{{ $org_name === 'OSIS' ? route('home') : (isset($_GET['osis']) && isset($_GET['mpk']) ? route('vote.osis') . '?osis=' . $_GET['osis'] . '&mpk=' . $_GET['mpk'] : route('vote.osis') . '?osis=' . $_GET['osis']) }}"
                    class="absolute top-10 sm:top-9 left-5 text-gray-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    <span class="sr-only">Back</span>
                </a>
                <h1 class="font-semibold text-2xl text-primary-20">Pilih Calon Ketua {{ $org_name }}</h1>
            </div>
            {{-- <div class="flex"> --}}
            <div class="flex flex-wrap justify-center gap-8 py-8 px-8 sm:px-0 lg:py-10">
                @foreach ($kandidat as $org)
                    <div
                        class="w-[400px] sm:w-[270px] p-4 mb-2 bg-white shadow-lg rounded-lg {{ isset($_GET[strtolower($org_name)]) && $_GET[strtolower($org_name)] == $org->id ? 'bg-gray-200 rounded-xl' : '' }}">
                        <img class="object-cover rounded-lg w-full h-[280px] sm:h-[200px]"
                            src="{{ Storage::url($org->photo) }}" draggable="false" loading="lazy" />
                        <div
                            class="flex absolute items-center justify-center w-14 h-14 bg-white rounded-full -translate-y-[70px] translate-x-[230px] sm:translate-x-[170px]">
                            <h1 class="text-center text-md font-semibold">No. {{ $org->nomor_urut }}</h1>
                        </div>
                        <div class="mb-2">
                            @csrf
                            <input type="hidden" name="no_kandidat" value="{{ $org->id }}" disabled>
                            <h5 class="text-lg font-semibold mt-2 tracking-tight text-gray-900 dark:text-white">
                                {{ $org->name }}
                            </h5>
                            {{-- <p class="font-normal text-gray-700 dark:text-gray-400">{{ $org->motto }}</p> --}}
                            <div class="flex justify-center gap-2 bottom-2">
                                <div>
                                    <button type="button" id="btn-vote{{ $org->id }}"
                                        x-on:click="kandidat={ {{ $org_name }}: {{ $org }} }, vote=!vote"

                                        class="mt-4 w-28 text-white bg-primary-20 hover:text-primary-20 hover:bg-primary-10 border-2 border-primary-20 hover:border-2 hover:border-primary-10 duration-[400ms] rounded-lg p-1.5 text-center">
                                        Vote
                                    </button>
                                </div>
                                <div>
                                    <button type="button" id="show_detail_button{{ $org->id }}"
                                        x-on:click="kandidat={ {{ $org_name }}: {{ $org }} },info=!info"
                                        class="mt-4 w-28 text-primary-20 bg-transparent hover:text-white hover:bg-primary-20 border-2 border-primary-20 duration-[400ms] rounded-lg p-1.5 text-center">
                                        Visi & Misi
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>


        </section>

        <div x-transition.duration.300ms  id="VisiMisi" tabindex="-1" aria-hidden="true" x-show="info"
            class="flex bg-black bg-opacity-60 fixed top-0 left-0 right-0 z-50 justify-center items-center min-h-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-2xl">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" x-on:click.outside="info=!info">
                    <!-- Modal header -->
                    <div class="flex items-center justify-center p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Motto, Visi & Misi nomor urut <span id="nomor_urut_span"></span>
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 leading-relaxed">

                        {{-- MOTTO --}}
                        <div class="my-3">
                            <h2 class="text-xl font-semibold mb-2">MOTTO</h2>
                            <div class="list-decimal">
                                <p id="motto_detail" x-html="kandidat.{{ $org_name }}.motto">
                                    Data motto gagal didapatkan
                                </p>
                            </div>
                        </div>

                        <!-- VISI -->
                        <div class="my-3">
                            <h2 class="text-xl font-semibold mb-2">VISI</h2>
                            <div class="list-decimal">
                                <p id="visi_detail" x-html="kandidat.{{ $org_name }}.visi">
                                    Data visi gagal didapatkan
                                </p>
                            </div>
                        </div>

                        <!-- MISI -->
                        <div class="my-3">
                            <h2 class="text-xl font-semibold mb-2">MISI</h2>
                            <div class="list-decimal">
                                <pre id="misi_detail" class="font-['Poppins'] text-wrap" x-html="kandidat.{{ $org_name }}.misi">
                                    Data misi gagal didapatkan
                                </pre>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end pt-3 px-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="button" x-on:click="info=!info"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div x-transition.duration.300ms   x-show="vote" aria-hidden="true"
            class="flex bg-black bg-opacity-60 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 min-h-full max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative py-10 shadow-xl px-4 text-center bg-white rounded-lg" x-on:click.outside="vote=!vote">
                    <h1 class="font-medium text-xl mb-1 text-primary-20">Apakah Anda yakin ingin memilih nomor urut <span
                            id="no_urut_modal" x-text="kandidat.{{ $org_name }}.nomor_urut"></span>?</h1>
                    {{-- <h1 class="font-medium text-xl mb-1 text-primary-20">Apakah Anda yakin?</h1> --}}
                    {{-- <p class="text-center text-sm mb-4 text-red-400">Jika Anda menekan "Ya", Anda tidak dapat mengubah pilihan Anda!<br>
                </p> --}}
                    <div class="flex justify-center items-center">
                        <form action="{{ $org_name === 'OSIS' ? route('vote.mpk') : route('vote.confirm_vote') }}"
                            method="GET" id="confirm_vote">
                            {{-- Halaman osis --}}
                            @if ($org_name === 'OSIS')
                                <input type="hidden" name="osis" id="kandidat_osis"
                                    x-model="kandidat.{{ $org_name }}.id">
                                @if (isset($_GET['mpk']))
                                    <input type="hidden" name="mpk" id="kandidat_mpk" value="{{ $_GET['mpk'] }}">
                                @endif
                            @endif

                            @if ($org_name === 'MPK')
                                <input type="hidden" name="osis" id="kandidat_osis" value="{{ $_GET['osis'] }}">
                                <input type="hidden" name="mpk" id="kandidat_mpk"
                                    x-model="kandidat.{{ $org_name }}.id">
                            @endif
                            <button type="button" x-on:click.stop="vote=!vote"
                                class="mt-4 w-28 text-primary-20 bg-transparent hover:text-white hover:bg-primary-20 border-2 border-primary-20 duration-[400ms] text-lg rounded-lg p-1 text-center">Tidak</button>
                            <button type="submit"
                                class="mt-4 ml-2 w-28 text-white bg-primary-20 hover:text-primary-20 hover:bg-primary-10 border-2 border-primary-20 hover:border-2 hover:border-primary-10 duration-[400ms] text-lg rounded-lg p-1 text-center">Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

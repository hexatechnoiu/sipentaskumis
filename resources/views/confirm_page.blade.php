@extends('layouts.main')


@section('title')
    Konfirmasi
@endsection

@section('container')
    <div class="relative p-4 text-center gap-8 pb-24 py-8 px-8 sm:px-0 lg:py-10 min-h-screen">
        <h1 class="font-semibold text-2xl mb-1 text-primary-20">Apakah yakin dengan pilihan Anda?</h1>
        <p class="text-center mb-4 text-secondary-30">Jika Anda menekan "Ya", Pilihan Anda tidak dapat diubah!<br>
        </p>

        <div class="flex flex-wrap items-center justify-center gap-8">
            <div class="w-[400px] sm:w-[270px] h-full p-4 mb-2 bg-primary-10 shadow-lg rounded-lg">
                <div class="flex items-center justify-center absolute w-28 h-10 text-white bg-[#1A56DB] rounded-ss-lg rounded-ee-lg">
                    <h1 class="text-lg font-semibold">OSIS</h1>
                </div>
                <img class="object-cover rounded-lg w-full h-[280px] sm:h-[200px]" src="{{ Storage::url($osis->photo) }}" draggable="false" />
                <div class="flex absolute items-center justify-center w-14 h-14 bg-white rounded-full -translate-y-[70px] translate-x-[230px] sm:translate-x-[170px]">
                    <h1 class="text-center text-md font-semibold">No. {{ $osis->nomor_urut }}</h1>
                </div>
                <div class="mt-6 mb-2">
                    <input type="hidden" name="no_kandidat" value="{{ $osis->nomor_urut }}" disabled>
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $osis->name }}
                    </h5>
                </div>
            </div>
            <div class="w-[400px] sm:w-[270px] h-full p-4 mb-2 bg-primary-10 shadow-lg rounded-lg">
                <div class="flex items-center justify-center absolute w-28 h-10 text-black bg-[#FDBA8C] rounded-ss-lg rounded-ee-lg">
                    <h1 class="text-lg font-semibold">MPK</h1>
                </div>
                <img class="object-cover rounded-lg w-full h-[280px] sm:h-[200px]" src="{{ Storage::url($mpk->photo) }}" draggable="false" />
                <div class="flex items-center justify-center absolute w-14 h-14 bg-white rounded-full -translate-y-[70px] translate-x-[230px] sm:translate-x-[170px]">
                    <h1 class="text-center text-lg font-semibold">No. {{ $mpk->nomor_urut }}</h1>
                </div>
                <div class="mt-6 mb-2">
                    <input type="hidden" name="no_kandidat" value="{{ $mpk->nomor_urut }}" disabled>
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $mpk->name }}
                    </h5>
                </div>
            </div>
        </div>

    </div>
    <div class="bg-white w-full p-1 pb-4 flex justify-center items-center fixed bottom-0">
        <form action="/vote/submit" method="POST" id="confirm_vote">
            @csrf
            <input type="hidden" name="osis" id="kandidat_osis" value="{{ $_GET['osis'] }}">
            <input type="hidden" name="mpk" id="kandidat_mpk" value="{{ $_GET['mpk'] }}">
            <button
                onclick="window.location.assign('{{ route('vote.mpk') . '?osis=' . $_GET['osis'] . '&mpk=' . $_GET['mpk'] }}')"
                type="button"
                class="mt-4 w-28 text-primary-20 bg-transparent hover:text-white hover:bg-primary-20 border-2 border-primary-20 duration-[400ms] rounded-lg p-1.5 text-center">Tidak</button>
            <button type="submit"
                class="mt-4 ml-2 w-28 text-white bg-primary-20 hover:text-primary-20 hover:bg-primary-10 border-2 border-primary-20 hover:border-2 hover:border-primary-10 duration-[400ms] rounded-lg p-1.5 text-center">Ya</button>
        </form>
    </div>
@endsection

@extends('layouts.main')


@section('title')
    Vote telah berakhir
@endsection

@section('container')
<div class="container flex justify-center items-center h-screen font-[Helvetica]">
  
  <article class=" block text-start m-0 w-[650px]">
    <h1 class="font-bold text-4xl leading-normal "><span class="text-primary-20">Voting Telah berakhir</span> <br>Selamat Kepada Calon yang sudah terpilih! </h1>
    <div class="mt-6">
        <p>Semoga bisa amanah dalam mengemban tugas yang mulia ini, wujudkan visi misi kedalam langkah nyata, buatlah
            gebrakan perubahan yang luar biasa !</p>
            <p class="mt-6">&mdash; DIVISI <c class="text-[#dc8100]">IT</c> | Gridas Developer</p>
    </div>
</article>

<a class=" text-sm font-normal appearance-none top-2 right-3 absolute" href="{{ route('login.admin') }}">
  Admin? Klik disini
</a>
</div>
@endsection

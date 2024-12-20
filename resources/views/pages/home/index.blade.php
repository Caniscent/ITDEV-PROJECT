@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="hero min-h-screen" style="background-image: url('{{ asset('img/flat-lay-batch-cooking-composition.jpg') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md text-white">
                <h1 class="mb-5 text-5xl font-bold">Selamat Datang di <b>Sano Care!</b></h1>
                <p class="mb-5">
                    Disini kami menyediakan penjadwalan makan untuk memenuhi kebutuhan diri anda agar dapat melakukan pencegahan dari penyakit diabetes.
                </p>
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white" href="{{route('meal-plan.index')}}">Mulai Sekarang</a>
            </div>
        </div>
    </div>

    {{-- Section di bawah Hero --}}
    <div class="w-full min-h-screen bg-white flex justify-center items-center px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center w-full max-w-7xl">
            <div class="p-8 shadow-lg rounded-lg animate-fade-in-up delay-100">
                <a href="{{route('meal-plan.index')}}">
                    <h2 class="text-2xl font-bold text-blue-600">Penjadwalan yang Personal</h2>
                    <p class="mt-4 text-gray-600">Kami menyediakan jadwal makan yang disesuaikan dengan kebutuhan gizi individu untuk mencegah komplikasi diabetes.</p>
                </a>
            </div>

            <div class="p-8 shadow-lg rounded-lg animate-fade-in-up delay-200">
                <a href="https://repository.kemkes.go.id/book/668" target="__blank">
                    <h2 class="text-2xl font-bold text-blue-600">Rekomendasi Kemenkes</h2>
                    <p class="mt-4 text-gray-600">Menu makanan yang dibuat oleh kementerian kesehatan RI berdasarkan tabel komposisi pangan untuk memastikan gizi pangan yang ada.</p>
                </a>
            </div>

            <div class="p-8 shadow-lg rounded-lg animate-fade-in-up delay-300">
                <a href="{{route('article.index')}}">
                    <h2 class="text-2xl font-bold text-blue-600">Artikel yang Terupdate</h2>
                    <p class="mt-4 text-gray-600">"Temukan berita kesehatan terkini yang menarik dan mudah dijangkau.</p>
                </a>
            </div>
        </div>
    </div>
@endsection


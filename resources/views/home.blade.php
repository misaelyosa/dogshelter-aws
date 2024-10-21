@extends('base.base')

@section('parallax')
    <div class="bg">
        <div class="w-full h-110 bg-black absolute z-10 opacity-45 top-0 left-0"></div>    
        <img class="object-cover absolute z-0" src=" {{asset('assets/images/bg_hz.jpg')}} " alt="bg">
        <h1 class="quote">Changing the world one set of paws at a time</h1>
        <div class="doge">
            <img src=" {{asset('assets/images/doge.png')}} " alt="doge">
        </div>
        <img class="bridge" src="{{asset('assets/images/aaa.png')}}" alt="bridge">
    </div>
@endsection

@section('content')
    <!-- page 2 -->
    <div class="about">
        <h2 class="w-full absolute z-20 font-dmsans text-6xl top-24 left-32 font-extrabold text-black">About Us</h2>
        <h3 class="w-full absolute z-20 font-dmsans tracking-wide italic text-5xl top-48 left-32 font-extrabold text-black">Surabaya Paw Warriors</h3>
        <p class="w-2/5 h-1/2 font-dmsans tracking-wide text-justify leading-relaxed text-xl absolute top-64 left-32">"Supaw Warriors" adalah sebuah komunitas atau shelter yang berfokus pada penyelamatan anjing, terutama yang membutuhkan perhatian khusus, seperti anjing yang terlantar, sakit, atau terluka. Mereka aktif di Instagram, membagikan kisah penyelamatan anjing-anjing tersebut, serta menggalang dukungan dan donasi untuk membantu operasional dan kebutuhan medis anjing-anjing tersebut.</p>
    </div>
@endsection
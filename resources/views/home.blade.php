@extends('base.base')

@section('parallax')
    <div class="bg">
        <div class="w-full h-full md:h-110 bg-black absolute z-10 opacity-45 top-0 left-0"></div>    
        <!-- bg md up -->
        <img class="bg_hz" src=" {{asset('assets/images/bg_hz.jpg')}} " alt="bg"> 
        <!-- bg md down -->
         <img class="bg_vert" src="{{asset('assets/images/bg_vert.jpg')}}" alt="bgvert">
        <h1 class="quote">Changing the world one set of paws at a time.</h1>
        <div class="doge">
            <img src=" {{asset('assets/images/doge.png')}} " alt="doge">
        </div>
        <img class="bridge" src="{{asset('assets/images/aaa.png')}}" alt="bridge">
    </div>
@endsection

@section('content')
<div class="wrapper">
<div class="containerscrollx">
    <!-- page 2 -->
    <section class="about">
        <h2 class="title1">About Us</h2>
        <h3 class="font-dmsans tracking-wide px-6 text-left text-2xl mt-6 lg:text-4xl font-extrabold text-black">Surabaya Paw Warriors</h3>
        <p class="font-dmsans tracking-wide text-left px-6 py-4 leading-relaxed text-xl">"Supaw Warriors" adalah sebuah komunitas atau shelter yang berfokus pada penyelamatan anjing, terutama yang membutuhkan perhatian khusus, seperti anjing yang terlantar, sakit, atau terluka. Kami aktif di Instagram, membagikan kisah penyelamatan anjing-anjing tersebut, serta menggalang dukungan dan donasi untuk membantu operasional dan kebutuhan medis anjing-anjing tersebut.</p>
    </section>

    <!-- page 3 -->
    <section class="faq">
    </section>

    <!-- page 4 -->
     <section class="programs">

     </section>
</div>
</div>
@endsection
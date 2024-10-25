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
        <div class="lg:col-span-2">
            <h3 class="font-dmsans tracking-wide px-6 text-left text-2xl mt-6 lg:text-4xl font-extrabold text-black">Surabaya Paw Warriors</h3>
        </div>
        <p class="font-dmsans tracking-wide text-left px-6 py-4 leading-relaxed text-lg">"Supaw Warriors" adalah sebuah komunitas atau shelter yang berfokus pada penyelamatan anjing, terutama yang membutuhkan perhatian khusus, seperti anjing yang terlantar, sakit, atau terluka. Kami aktif di Instagram, membagikan kisah penyelamatan anjing-anjing tersebut, serta menggalang dukungan dan donasi untuk membantu operasional kebutuhan medis anjing-anjing.</p>
        <img class="object-cover w-full h-1/5 my-4" src="{{asset('assets/images/splash_about.jpg')}}" alt="splash-about">
    </section>

    <!-- page 3 -->
    <section class="faq">
        <h1 class="title2">Frequently Asked Question</h1>
        <div id="accordion-collapse" class="mb-4 relative z-20" data-accordion="collapse">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="accordion-head-top" data-accordion-target="#accordion-collapse-body-1" aria-expanded="false" aria-controls="accordion-collapse-body-1">
            <span>Dimana alamat shelter supaw? </span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="accordion-glass hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class="p-5  ">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Mohon maaf tapi kami sengaja nggak membuka lokasi dan alamat supaya nggak disalahgunakan berbagai oknum. Disalahgunakan gimana? Ya macem-macem, orang bisa makin mudah buang anjing atau kucing di shelter kami atau bahkan ada yang jahat dan nggak suka mungkin berniat
            ngeracun.Kita cuma bisa hati-hati. Semoga bisa dipahami yaa</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-2">
            <button type="button" class="accordion-head" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
            <span>Bolehkah kalau ingin visit shelter? Mungkin bisa bantu bantu disana.</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-2" class="accordion-glass hidden" aria-labelledby="accordion-collapse-heading-2">
            <div class="p-5  ">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Bukannya tidak boleh, namun karena kami tidak disclose alamat maka akan cukup sulit. Kedepannya mungkin bisa direncanakan, ditunggu ya.</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-3">
            <button type="button" class="accordion-head" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
            <span>Dimana alamat shelter supaw? </span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-3" class="accordion-glass hidden" aria-labelledby="accordion-collapse-heading-3">
            <div class="p-5 ">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Mohon maaf tapi kami sengaja nggak membuka lokasi dan alamat supaya nggak disalahgunakan berbagai oknum. Disalahgunakan gimana? Ya macem-macem, orang bisa makin mudah buang anjing atau kucing di shelter kami atau bahkan ada yang jahat dan nggak suka mungkin berniat
ngeracun.Kita cuma bisa hati-hati. Semoga bisa dipahami yaa</p>
            </div>
        </div>

        <h2 id="accordion-collapse-heading-4">
            <button type="button" class="accordion-head-bt" data-accordion-target="#accordion-collapse-body-4" aria-expanded="true" aria-controls="accordion-collapse-body-4">
            <span>Apakah bisa menitipkan anjing di sini?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-4" class="accordion-glass hidden rounded-b-lg" aria-labelledby="accordion-collapse-heading-4">
            <div class="p-5 ">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Supaw warriors bukan tempat penitipan anjing atau kucing. Kami memiliki kapasitas yang terbatas dan tidak bersedia bertanggung jawab atas anjing dan kucing teman-teman ya. Sebaiknya dititipkan di pet hotel saja yang lebih profesional dan aman. "Gapapa, saya bayar kok." Maaf tetap tidak bisa.</p>
            </div>
        </div>
        </div>

        <h1 class="font-dmsans text-black italic font-black text-[10rem] absolute z-0 -rotate-12 -bottom-5 right-2 drop-shadow-xl">QNA</h1>
    </section>

    <!-- page 4 -->
     <section class="programs">
        <h1 class="font-dmsans text-left text-2xl font-bold">Our Programs</h1>
        <p class="font-dmsans text-left text-lg font-semibold mt-4">T&C Adoption</p>
        <ul class="font-dmsans text-left text-md">
            <li>1. Untuk disayang</li>
            <li>2. Ditaruh dalam rumah</li>
            <li>3. Tidak dikandang dan/atau dirantai</li>
            <li>4. Tidak untuk dijualbelikan atau dihibahkan lagi</li>
            <li>5. Wajib steril dan bersedia vaksin rutin</li>
            <li>6. Seluruh anggota keluarga di rumah suka anjing dan setuju pelihara</li>
            <li>7. Siap dengan segala biayanya</li>
            <li>8. Siap merawat hingga tua dan meninggal</li>
            <li>9. Rumah bersedia disurvey</li>
            <li>10. Area Surabaya dan sekitarnya diutamakan</li>
            <li>11. Rumah berpagar diutamakan</li>
            <li>12. Bersedia melalui trial adopsi selama sebulan</li>
            <li>13. Memberi kabar rutin setelah adopsi dan tidak putus komunikasi dengan pihak Supaw Warrior</li>
            <li>14. Kita yang akan antar anabulnya ke rumah calon pawrent karena tidak menerima visitor</li>
        </ul>

        <h1 class="font-dmsans text-xl text-left font-bold mt-8">To be announced, Program OTA (Orang Tua Asuh)</h1>
     </section>
</div>
</div>

<div class="container-listDoge">
    <div class="card"></div>
    <div class="card"></div>
</div>

@endsection
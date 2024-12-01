@extends('base.base')
@include('includes.navbar')

@section('parallax')
<div class="container" id="container">
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
</div>
@endsection

@section('content')

<div class="wrapper">
    <div class="containerscrollx">

    <div class="scrollnotice absolute z-50">
        <div class="fixed top-7 left-[35vw] md:[55vw] lg:top-[50vh] lg:start-[90vw] flex items-center justify-center">
            <img src="{{asset('assets/icons/mouse-cursor.png')}}"></img>
            <p class="font-dmsans font-light text-center">Scroll Once</p>
        </div>
    </div>

    <!-- page 2 -->
    <section class="about" id="about">
        <h2 class="title1">About Us</h2>
        <div class="lg:col-span-2">
            <h3 class="font-dmsans tracking-wide px-6 text-left text-2xl mt-6 lg:text-4xl font-extrabold text-black">Surabaya Paw Warriors</h3>
        </div>
        <div class="lg:col-span-1">
            <p class="lg:col-span-1 lg:text-xl font-dmsans tracking-wide text-left md:text-justify px-6 py-4 leading-relaxed text-lg">"Supaw Warriors" adalah sebuah komunitas atau shelter yang berfokus pada penyelamatan anjing, terutama yang membutuhkan perhatian khusus, seperti anjing yang terlantar, sakit, atau terluka. Kami aktif di Instagram, membagikan kisah penyelamatan anjing-anjing tersebut, serta menggalang dukungan dan donasi untuk membantu operasional kebutuhan medis anjing-anjing.</p>
        </div>
            <img class="md:px-6 object-cover w-full h-1/5 my-4 md:h-[55%]" src="{{asset('assets/images/splash_about.jpg')}}" alt="splash-about">
    </section>

    <!-- page 3 -->
    <section class="faq" id="faq">
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
            <p class="mb-2 text-white">Mohon maaf tapi kami sengaja nggak membuka lokasi dan alamat supaya nggak disalahgunakan berbagai oknum. Disalahgunakan gimana? Ya macem-macem, orang bisa makin mudah buang anjing atau kucing di shelter kami atau bahkan ada yang jahat dan nggak suka mungkin berniat
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
            <p class="mb-2 text-white">Bukannya tidak boleh, namun karena kami tidak disclose alamat maka akan cukup sulit. Kedepannya mungkin bisa direncanakan, ditunggu ya.</p>
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
            <p class="mb-2 text-white">Mohon maaf tapi kami sengaja nggak membuka lokasi dan alamat supaya nggak disalahgunakan berbagai oknum. Disalahgunakan gimana? Ya macem-macem, orang bisa makin mudah buang anjing atau kucing di shelter kami atau bahkan ada yang jahat dan nggak suka mungkin berniat
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
            <p class="mb-2 text-white">Supaw warriors bukan tempat penitipan anjing atau kucing. Kami memiliki kapasitas yang terbatas dan tidak bersedia bertanggung jawab atas anjing dan kucing teman-teman ya. Sebaiknya dititipkan di pet hotel saja yang lebih profesional dan aman. "Gapapa, saya bayar kok." Maaf tetap tidak bisa.</p>
            </div>
        </div>
        </div>

        <h3 class="xl:hidden font-dmsans text-black italic font-black text-[10rem] absolute z-0 -rotate-12 -bottom-5 right-2 drop-shadow-xl">QNA</h3>
        <h3 class="hidden xl:block font-dmsans text-black italic font-black text-[13rem] fixed z-0 -rotate-12 bottom-64 right-36 drop-shadow-xl">QUESTIONS</h3>
        <h3 class="hidden xl:block font-dmsans text-black italic font-black text-[13rem] fixed z-0 -rotate-12 bottom-24 -right-16 drop-shadow-xl">&ANSWERS</h3>
    </section>

    <!-- page 4 -->
     <section class="programs" id="programs">
        <h1 class="font-dmsans text-left text-3xl font-bold md:text-4xl xl:mt-5">Our Programs</h1>
        <div>
            <p class="font-dmsans text-left text-lg font-semibold mt-4 md:text-2xl">Terms and Conditions for Adoption</p>
            <ul class="font-dmsans text-left text-md ps-2 md:text-xl md:leading-relaxed">
                <li>1. Hewan yang diadopsi memiliki tujuan untuk disayang, bukan untuk disakiti dan ditelantarkan.</li>
                <li>2. Hewan diletakkan di dalam rumah, tidak diletakkan di dalam kandang atau dirantai.</li>
                <li>3. Tidak untuk dijualbelikan kembali dan tidak untuk dihibahkan kepada orang lain.</li>
                <li>4. Hewan wajib disteril dan vaksin secara rutin.</li>
                <li>5. Seluruh anggota keluarga yang akan tinggal bersama hewan adopsi harus menyukai anjing dan setuju untuk mengadopsi anjing.</li>
                <li>6. Adopter harus bersedia dan siap dengan segala biaya yang ada.</li>
                <li>7. Siap merawat hingga hewan tua dan meninggal.</li>
                <li>8. Rumah adopter siap untuk disurvei.</li>
                <li>9. Rumah berpagar diutamakan.</li>
                <li>10. Bersedia melalui trial adopsi selama sebulan.</li>
                <li>11. Memberi kabar rutin setelah adopsi.</li>
            </ul>

            <h1 class="font-dmsans text-xl text-left font-semibold mt-8 italic">To be announced, Program OTA (Orang Tua Asuh)</h1>
        </div>
     </section>
    </div>
    <section class="container-listDoge" id="adoptionlist">
        <h1 class="font-dmsans text-3xl font-bold col-span-2 italic ps-1 lg:col-span-4 lg:text-5xl">Adopt Me!</h1>
        @foreach ($doges as $doge)
        <div class="card">
            <div class="card-overlay">
                <div class="card-content">
                    <h1 class="nama-doge">{{ $doge->nama }}</h1>
                    <h1 class="dob-doge">{{ $doge->dob }}</h1>
                    <h1 class="trait">{{ $doge->trait }}</h1>
                    <button data-modal-target="modal-{{ $doge->id }}" data-modal-toggle="modal-{{ $doge->id }}" class="btn-moreinfo">more info...</button>
                </div>
            </div>
        </div>
       

        <!-- Main modal -->
        <div id="modal-{{ $doge->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $doge->nama }}
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-{{ $doge->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Date of Birth : {{ $doge->dob }}
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Traits : {{ $doge->trait }}
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Jenis Kelamin : {{ $doge->jenis_kelamin }}
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Vaccin Status : {{ $doge->vaccin_status }}
                        </p>
                        <p class="text-base font-bold leading-relaxed text-black dark:text-white">
                            Adoption Status : {{ $doge->adoption_status }}
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Keterangan : {{ $doge->keterangan }}
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        @if ($doge->adoption_status != 'adopted' && $doge->adoption_status != 'pending')
                            <a href="{{ route('fetchadoptform' , ['id' => $doge->id])}}">
                                <button data-modal-hide="modal-{{ $doge->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Request Adoption</button>
                            </a>
                        @endif
                        <button data-modal-hide="modal-{{ $doge->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    @include('includes.footer')
</div>
@endsection

@section('script2')
        <!-- SWAL -->
        @if (session('success'))  
        <script>
            // console.log('ballz');
            document.addEventListener('DOMContentLoaded', function (){
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                });
            });      
        </script>   
        @elseif (session('error'))
        
        <script>
            document.addEventListener('DOMContentLoaded', function (){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{session('error')}}",
                    });
            });
        </script>

        @endif
    <!-- END SWAL -->


    <script>
        function loadRandomDogImages() {
            var inc = 0;
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const randomImage = `https://placedog.net/400/800?id=${inc+=1}`;
                card.style.backgroundImage = `url(${randomImage})`;
            });
        }

        document.addEventListener('DOMContentLoaded', loadRandomDogImages);

        // Parallax effect animations
        function parallaxAnimations() {
            gsap.to(".quote", {
                y: 700, 
                scrollTrigger: {
                    trigger: ".bg", 
                    start: "15% top", 
                    end: "bottom top", 
                    scrub: 3,
                }
            });

            gsap.to(".doge", {
                y: 500, 
                scrollTrigger: {
                    trigger: ".bg", 
                    start: "20% top",
                    end: "bottom top",
                    scrub: 3, 
                }
            });

            gsap.to(".bg_hz", {
                y: 200, 
                scrollTrigger: {
                    trigger: ".bg", 
                    start: "10% top",
                    end: "bottom top",
                    scrub: 0.01 
                }
            });

            gsap.to(".bg_vert", {
                y: 200, 
                scrollTrigger: {
                    trigger: ".bg", 
                    start: "10% top",
                    end: "bottom top",
                    scrub: 0.01 
                }
            });
        }

        // Horizontal Scroll Animation
        function horizontalScroll() {
            const containerscrollx = document.querySelector('.containerscrollx');
            const sections = gsap.utils.toArray('.containerscrollx section');

            let scrollTween = gsap.to(sections, {
                xPercent: -100 * (sections.length - 1),
                ease: "none",
                scrollTrigger: {
                    trigger: containerscrollx,
                    pin: true,
                    scrub: 1,
                    end: () => "+=" + containerscrollx.offsetWidth,
                    snap: {
                        snapTo: 1 / (sections.length - 1), 
                        duration: 0.05, 
                        ease: "power1.inOut" 
                    }
                }
            });
        
            const text = gsap.utils.toArray(".about h2, .about h3, .about p, .about img");

            gsap.from(text, {
                y: -120,
                opacity: 0,
                duration: 2,
                ease: "elastic",
                stagger: 0.1,
                scrollTrigger: {
                    trigger: ".about",
                    start: "top 70%",
                    end: "right top",
                    toggleActions: "play none replay reset",
                }
            });

            const faq = gsap.utils.toArray(".faq h1, .faq h2, .faq p, .faq div");

            gsap.from(faq, { 
                y: -50,
                opacity: 0,
                duration: 1,
                ease: "elastic",
                stagger: 0.1,
                scrollTrigger: {
                    trigger: ".faq",
                    containerAnimation: scrollTween,
                    start: "left center",
                }
            });

            const textPrograms = gsap.utils.toArray(".programs h1, .programs p, .programs ul");

            gsap.from(textPrograms, {
                y: -50,
                opacity: 0,
                duration: 2,
                ease: "elastic",
                stagger: 0.1,
                scrollTrigger: {
                    trigger: ".programs",
                    containerAnimation: scrollTween,
                    start: "left center",
                    // markers: true,
                }
            });
        }

        function scrollNoticeBlink(){
            const notice = document.querySelector('.scrollNotice');

            gsap.to(notice, {
                opacity: 0, 
                duration: 0.8,
                repeat: -1, 
                yoyo: true, 
                ease: "power1.inOut"
            });
        }
    
        // Call all animation functions
        document.addEventListener('DOMContentLoaded', function () {
            parallaxAnimations();
            horizontalScroll();
            scrollNoticeBlink();
        });
    </script>
@endsection
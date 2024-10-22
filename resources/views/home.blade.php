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
        <p class="font-dmsans tracking-wide text-left px-6 py-4 leading-relaxed text-lg">"Supaw Warriors" adalah sebuah komunitas atau shelter yang berfokus pada penyelamatan anjing, terutama yang membutuhkan perhatian khusus, seperti anjing yang terlantar, sakit, atau terluka. Kami aktif di Instagram, membagikan kisah penyelamatan anjing-anjing tersebut, serta menggalang dukungan dan donasi untuk membantu operasional kebutuhan medis anjing-anjing.</p>
        <!-- <img class="object-fit w-full h-2/5" src="{{asset('assets/images/splash_about.jpg')}}" alt="splash-about"> -->
    </section>

    <!-- page 3 -->
    <section class="faq">
        <h1 class="title2">Frequently Asked Question</h1>
        <div id="accordion-collapse" data-accordion="collapse">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
            <span>What is Flowbite?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of interactive components built on top of Tailwind CSS including buttons, dropdowns, modals, navbars, and more.</p>
            <p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a href="/docs/getting-started/introduction/" class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start developing websites even faster with components on top of Tailwind CSS.</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-2">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
            <span>Is there a Figma file available?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed using the Figma software so everything you see in the library has a design equivalent in our Figma file.</p>
            <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/" class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility classes from Tailwind CSS and components from Flowbite.</p>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-3">
            <button type="button" class="flex items-center justify-between text-left w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 rounded-b-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
            <span>What are the differences between Flowbite and Tailwind UI?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
            <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
            <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core components from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
            <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason stopping you from using the best of two worlds.</p>
            <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
            <ul class="ps-5 text-gray-500 list-disc dark:text-gray-400">
                <li><a href="https://flowbite.com/pro/" class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a></li>
                <li><a href="https://tailwindui.com/" rel="nofollow" class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a></li>
            </ul>
            </div>
        </div>
        </div>
    </section>

    <!-- page 4 -->
     <section class="programs">

     </section>
</div>
</div>
@endsection
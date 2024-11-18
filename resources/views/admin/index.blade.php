@extends('base.base')
@include('includes.sidebar')

@section('content')
<section class="w-full min-h-screen flex flex-col items-center dark:bg-gray-800">  
    <div class="w-full grid gap-2 mb-4 sm:gap-6">
        <h1 class="justify-start font-dmsans text-black text-lg dark:text-white md:text-3xl font-black mt-5  ps-8">Welcome, {{Auth::user()->name}}</h1>
        @yield('judul')        
    </div>
    @yield('dataTable')
</section>
@endsection
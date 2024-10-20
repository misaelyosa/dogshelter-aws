@extends('base.base')

@section('section')
    <div class="bg">
        <div class="w-full h-full bg-black absolute z-10 opacity-45 top-0 left-0"></div>    
        <img class="object-cover absolute z-0" src=" {{asset('assets/images/bg_hz.jpg')}} " alt="bg">
        <h1 class="quote">Changing the world one set of paws at a time</h1>
        <div class="doge">
            <img src=" {{asset('assets/images/doge.png')}} " alt="doge">
        </div>
    </div>
@endsection
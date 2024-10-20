@extends('base.base')

@section('section')
    <div class="bg">    
        <img class="object-fill w-full absolute z-0" src=" {{asset('assets/images/layer2.jpg')}} " alt="bg">
        <div class="quote">
            <h1 class="text-3xl text-bold absolute z-20">“Changing the world one set of paws at a time”</h1>
        </div>
        <div class="doge">
            <img src=" {{asset('assets/images/layer1.png')}} " alt="doge">
        </div>
    </div>
@endsection
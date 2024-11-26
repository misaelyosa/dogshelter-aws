@extends('base.base')

@section('content')
<h1>Selamat!</h1>
<p>Request adopsi anda untuk {{ $doge->nama }} sudah kami setujui.</p>
<p>Details:</p>
<ul>
    <li>Name: {{ $doge->nama }}</li>
    <li>Date of Birth: {{ $doge->dob }}</li>
</ul>
<p>Semoga {{ $doge->nama }} dapat hidup layak dan kami berharap agar anda dapat menjalin hubungan baik dengannya.</p>
<p>Jangan lupa untuk memberikan informasi berkala kepada admin. Terimakasih!</p>
@endsection
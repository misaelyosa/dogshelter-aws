@extends('admin.index')

@section('judul')
<h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Shelter Verification Detail</h1>
@endsection

@section('dataTable')
<div class="mx-8">
    <div class="bg-white dark:bg-gray-800 rounded shadow p-6">
        <h2 class="text-xl font-semibold">{{ $shelter->name }}</h2>
        <p class="text-sm text-gray-500">Owner: {{ $shelter->owner }}</p>
        <p class="mt-2">Contact: {{ $shelter->contact }}</p>
        <p>Location: {{ $shelter->location }}</p>
        <div id="shelter-map" class="mt-3" style="height:300px;"></div>
        <p>Capacity: {{ $shelter->capacity }}</p>
        <p class="mt-2">Description: {{ $shelter->description }}</p>
        @if($shelter->image)
            <img src="{{ Storage::disk('s3')->url($shelter->image) }}"
                class="w-64 h-48 object-cover rounded">
        @endif

        <div class="mt-4">
            <form action="{{ route('admin.shelter_verifications.accept', $shelter->id) }}" method="POST" class="inline-block">
                @csrf
                <button class="px-4 py-2 bg-green-600 text-white rounded">Accept</button>
            </form>
            <form action="{{ route('admin.shelter_verifications.decline', $shelter->id) }}" method="POST" class="inline-block ml-2">
                @csrf
                <button class="px-4 py-2 bg-red-600 text-white rounded">Decline</button>
            </form>
            <a href="{{ route('admin.shelter_verifications') }}" class="ml-4 text-gray-600">Back</a>
        </div>
    </div>
</div>
@endsection

@section('script')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var container = document.getElementById('shelter-map');
        if (!container) return; // avoid "container not found" errors

        var lat = {{ $shelter->latitude ?? 'null' }};
        var lon = {{ $shelter->longitude ?? 'null' }};

        var map = L.map('shelter-map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
        if (lat && lon) {
            map.setView([lat, lon], 15);
            L.marker([lat, lon]).addTo(map).bindPopup("{{ addslashes($shelter->name) }}");
        } else {
            map.setView([0,0], 2);
        }
    });
</script>
@endsection

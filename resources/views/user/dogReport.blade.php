@extends('base.base')

@section('content')
@if (session('success'))
<div class="p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
@endif

@if (session('error'))
<div class="p-3 bg-red-50 text-red-700 rounded">{{ session('error') }}</div>
@endif
@if ($errors->any())
<div class="mb-4 p-3 bg-red-50 border border-red-200 rounded">
    <strong class="block mb-2">Terjadi kesalahan:</strong>
    <ul class="list-disc pl-5 text-sm text-red-700">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- Map picker will be shown below; browser geolocation on HTTP is unreliable so we provide a manual picker. --}}
<!-- Hidden location -->
<section class="min-h-screen bg-white dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Report A Dog</h2>
        <form action="{{route('reportSubmit')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            @csrf
            <input type="hidden" name="id" value="{{ $doge->id }}">
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reporter Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ Auth::user()->name}}" placeholder="Type your name" required="">
                </div>
                @error('reporter_name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="sm:col-span-2">
                    <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon/Contact Reporter</label>
                    @if (Auth::user()->no_telp != NULL)
                    <input type="text" name="no_telp" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{Auth::user()->no_telp}}" placeholder="Type your phone number" required="">
                    @else
                    <input type="text" name="no_telp" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{old('no_telp')}}" placeholder="Type your phone number" required="">
                    @endif
                </div>
                @error('no_telp')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <!-- Time Found -->
                <div class="w-full sm:col-span-2">
                    <label for="time_found" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Found</label>
                    <input type="datetime-local" name="time_found" id="time_found"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                </div>

                <div class="sm:col-span-2">
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
                    <div id="report-map" class="mt-2 mb-2" style="height:300px;"></div>
                    <p class="text-sm text-gray-500 mb-2">Click on the map to pick the location (will populate the hidden lat/lon and the location field).</p>
                    <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Lokasi (click map)" required="">
                </div>
                <!-- Description -->
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">description Tambahan (Opsional, bisa ditambah detail lokasi)</label>
                    <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write more message to admin"></textarea>
                </div>
                <!-- Upload Photo -->
                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Dog Photo</label>
                    <input type="file" name="doge_pic" id="doge_pic"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-white"
                        required>
                </div>
                <div class="sm:col-span-2 mt-3">
                    <img id="preview-image" class="hidden w-auto  h-48 object-fit rounded-lg border" />
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Submit Form
                </button>
                <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <a href="{{ route('home') }}">
                        Cancel
                    </a>
                </button>
            </div>
        </form>
        <p id="location-status" class="mt-2 text-sm text-red-600"></p>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewImage = document.getElementById("preview-image");
        const fileInput = document.getElementById("doge_pic");

        if (!previewImage || !fileInput) return; // safety

        // ketika ada perubahan file
        fileInput.addEventListener("change", function() {
            const file = fileInput.files[0];

            if (!file) {
                // kalau tidak ada file, sembunyikan preview
                previewImage.src = '';
                previewImage.classList.add('hidden');
                return;
            }

            // opsi 1: FileReader (compatible)
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImage.src = reader.result;
                previewImage.classList.remove('hidden');
            });
            reader.readAsDataURL(file);

            // --- atau alternatif lebih cepat:
            // const url = URL.createObjectURL(file);
            // previewImage.src = url;
            // previewImage.classList.remove('hidden');
            // // revoke ketika tidak diperlukan lagi
            // previewImage.onload = () => URL.revokeObjectURL(url);
        });
    });
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Map picker for report location
        var mapContainer = document.getElementById('report-map');
        if (!mapContainer) return;

        var map = L.map('report-map').setView([0,0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap contributors' }).addTo(map);

        var marker = null;
        function setMarker(lat, lon) {
            if (marker) {
                marker.setLatLng([lat, lon]);
            } else {
                marker = L.marker([lat, lon]).addTo(map);
            }
            map.setView([lat, lon], 15);
        }

        var latInput = document.getElementById('latitude');
        var lonInput = document.getElementById('longitude');
        var locInput = document.getElementById('location');
        var status = document.getElementById('location-status');

        // If values exist (old form) show marker
        if (latInput.value && lonInput.value) {
            setMarker(latInput.value, lonInput.value);
        }

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;
            latInput.value = lat;
            lonInput.value = lon;
            locInput.value = lat.toFixed(6) + ', ' + lon.toFixed(6);
            setMarker(lat, lon);
            if (status) { status.textContent = 'Location selected on map'; status.classList.remove('text-red-600'); status.classList.add('text-green-600'); }
        });

        // Optional "Use my location" button (may be blocked on HTTP)
        var useBtn = document.createElement('button');
        useBtn.type = 'button';
        useBtn.textContent = 'Use my location';
        useBtn.className = 'mt-2 px-3 py-2 bg-gray-200 rounded';
        mapContainer.parentNode.insertBefore(useBtn, mapContainer.nextSibling);
        useBtn.addEventListener('click', function() {
            if (!navigator.geolocation) { alert('Browser does not support geolocation'); return; }
            useBtn.disabled = true; useBtn.textContent = 'Locating...';
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude; var lon = position.coords.longitude;
                latInput.value = lat; lonInput.value = lon;
                locInput.value = lat.toFixed(6) + ', ' + lon.toFixed(6);
                setMarker(lat, lon);
                if (status) { status.textContent = 'Location acquired'; status.classList.remove('text-red-600'); status.classList.add('text-green-600'); }
                useBtn.textContent = 'Location set';
            }, function(err) {
                alert('Unable to retrieve location: ' + err.message);
                useBtn.disabled = false; useBtn.textContent = 'Use my location';
            }, { enableHighAccuracy: true, timeout: 10000 });
        });
    });
</script>
@endsection
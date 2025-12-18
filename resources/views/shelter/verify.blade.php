@extends('admin.index')

@section('judul')
<h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Shelter Verification</h1>
@endsection

@section('dataTable')
<div class="w-full mx-auto bg-white dark:bg-gray-800 px-12 py-6 rounded-lg shadow">
    @if(isset($shelter) && $shelter->verification_status === 'pending')
        <div class="p-6 text-center">
            <h2 class="text-xl font-semibold">Verification Submitted</h2>
            <p class="mt-3 text-gray-600">Your shelter verification request has been submitted. Please wait for an administrator to review and approve your account. Check your email for updates.</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">Go to Home</a>
        </div>
    @elseif(isset($shelter) && $shelter->verification_status === 'declined')
        <div class="p-6 text-center">
            <h2 class="text-xl font-semibold text-red-600">Verification Declined</h2>
            <p class="mt-3 text-gray-600">Your shelter verification request was declined by the administrator. Please review your submission and try again later.</p>
            <a href="{{ route('shelter.verify.form') }}" class="inline-block mt-4 px-4 py-2 bg-gray-600 text-white rounded">Try Again</a>
        </div>
    @else
    <form action="{{ route('shelter.verify.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-4">
            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Shelter Name</span>
                <input type="text" name="name" value="{{ old('name', $shelter->name ?? '') }}" class="mt-1 block w-full" required>
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Owner Name</span>
                <input type="text" name="owner" value="{{ old('owner', $shelter->owner ?? auth()->user()->name) }}" class="mt-1 block w-full" required>
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Contact</span>
                <input type="text" name="contact" value="{{ old('contact', $shelter->contact ?? '') }}" class="mt-1 block w-full" required>
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Select Location on Map</span>
                <div id="map" class="mt-2" style="height: 320px;"></div>
                <input type="hidden" id="location" name="location" value="{{ old('location', $shelter->location ?? '') }}">
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $shelter->latitude ?? '') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $shelter->longitude ?? '') }}">
                <input type="text" id="location_readable" class="mt-2 block w-full bg-gray-100 dark:bg-gray-700" value="{{ old('location', $shelter->location ?? '') }}" placeholder="Selected location" readonly>
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Capacity</span>
                <input type="number" min="0" required name="capacity" value="{{ old('capacity', $shelter->capacity ?? '') }}" class="mt-1 block w-full">
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Email</span>
                <input type="email" name="email" value="{{ old('email', $shelter->email ?? auth()->user()->email) }}" class="mt-1 block w-full">
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Website</span>
                <input type="url" name="website" value="{{ old('website', $shelter->website ?? '') }}" class="mt-1 block w-full">
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Description</span>
                <textarea name="description" class="mt-1 block w-full">{{ old('description', $shelter->description ?? '') }}</textarea>
            </label>

            <label class="block">
                <span class="text-gray-700 dark:text-gray-200">Image</span>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full">
            </label>

            <div class="pt-4">
                <button type="button" id="useLocationBtn" class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded">Use my location</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit for Review</button>
                <a href="{{ route('home') }}" class="ml-4 text-gray-600">Cancel</a>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection

@section('script')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Map init
    var map = L.map('map').setView([{{ $shelter->latitude ?? '0' }}, {{ $shelter->longitude ?? '0' }}], {{ $shelter && $shelter->latitude ? 13 : 2 }});
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker = null;
    function setMarker(lat, lon) {
        if (marker) {
            marker.setLatLng([lat, lon]);
        } else {
            marker = L.marker([lat, lon]).addTo(map);
        }
        map.setView([lat, lon], 15);
    }

    // If existing values present, set marker
    var existingLat = document.getElementById('latitude').value;
    var existingLon = document.getElementById('longitude').value;
    if (existingLat && existingLon) {
        setMarker(existingLat, existingLon);
    }

    // After window load (when loading screen is hidden), invalidate map size and default to user's location if none set
    window.addEventListener('load', function() {
        setTimeout(function() {
            try { map.invalidateSize(); } catch(e) {}
            // If no existing coords, try to get user's current location and set marker
            if (!(existingLat && existingLon) && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lon;
                    setMarker(lat, lon);
                    // reverse geocode to fill readable location
                    fetch('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lon)
                        .then(res => res.json())
                        .then(data => {
                            var display = data.display_name || (lat+", "+lon);
                            document.getElementById('location').value = display;
                            document.getElementById('location_readable').value = display;
                        }).catch(err => {
                            document.getElementById('location_readable').value = lat+", "+lon;
                            document.getElementById('location').value = lat+", "+lon;
                        });
                }, function(err) {
                    // ignore if user denies
                    console.warn('Geolocation unavailable at load:', err && err.message);
                }, { enableHighAccuracy: true, timeout: 8000 });
            }
        }, 600);
    });

    // On map click, set lat/lon and reverse geocode to fill location
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lon = e.latlng.lng;
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;
        setMarker(lat, lon);
        // reverse geocode using Nominatim
        fetch('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lon)
            .then(res => res.json())
            .then(data => {
                var display = data.display_name || (lat+", "+lon);
                document.getElementById('location').value = display;
                document.getElementById('location_readable').value = display;
            }).catch(err => {
                document.getElementById('location_readable').value = lat+", "+lon;
                document.getElementById('location').value = lat+", "+lon;
            });
    });

    document.getElementById('useLocationBtn').addEventListener('click', function() {
        if (!navigator.geolocation) {
            alert('Geolocation is not supported by your browser');
            return;
        }
        this.disabled = true;
        this.textContent = 'Locating...';
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
            setMarker(lat, lon);
            // reverse geocode
            fetch('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lon)
                .then(res => res.json())
                .then(data => {
                    var display = data.display_name || (lat+", "+lon);
                    document.getElementById('location').value = display;
                    document.getElementById('location_readable').value = display;
                    document.getElementById('useLocationBtn').textContent = 'Location set';
                }).catch(err => {
                    document.getElementById('location_readable').value = lat+", "+lon;
                    document.getElementById('location').value = lat+", "+lon;
                    document.getElementById('useLocationBtn').textContent = 'Location set';
                });
        }, function(err) {
            alert('Unable to retrieve your location: ' + err.message);
            document.getElementById('useLocationBtn').disabled = false;
            document.getElementById('useLocationBtn').textContent = 'Use my location';
        }, { enableHighAccuracy: true, timeout: 10000 });
    });

    // Text search input (Nominatim) - search and center map
    function doSearch(query) {
        if (!query || query.length < 2) return;
        fetch('https://nominatim.openstreetmap.org/search?format=jsonv2&q=' + encodeURIComponent(query))
            .then(res => res.json())
            .then(results => {
                if (!results || results.length === 0) {
                    alert('No results found');
                    return;
                }
                var r = results[0];
                var lat = parseFloat(r.lat);
                var lon = parseFloat(r.lon);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;
                var display = r.display_name || (lat+", "+lon);
                document.getElementById('location').value = display;
                document.getElementById('location_readable').value = display;
                setMarker(lat, lon);
            }).catch(err => {
                console.error(err);
                alert('Search failed');
            });
    }

    // attach search
    var searchInput = document.createElement('input');
    searchInput.type = 'search';
    searchInput.placeholder = 'Search for address or place';
    searchInput.id = 'location_search';
    searchInput.className = 'mt-2 block w-full p-2 border rounded';
    var mapParent = document.getElementById('map').parentNode;
    mapParent.insertBefore(searchInput, document.getElementById('map'));

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            doSearch(this.value);
        }
    });

    // simple search button
    var searchBtn = document.createElement('button');
    searchBtn.type = 'button';
    searchBtn.textContent = 'Search';
    searchBtn.className = 'mt-2 ml-2 px-3 py-2 bg-gray-200 rounded';
    mapParent.insertBefore(searchBtn, document.getElementById('map'));
    searchBtn.addEventListener('click', function() { doSearch(searchInput.value); });
</script>
@endsection

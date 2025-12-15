<p>A user has requested to adopt <strong>{{ $doge->nama }}</strong>.</p>
<p>Adopter name: {{ $doge->user->name ?? 'N/A' }}</p>
<p>Message: {{ $doge->pesan_adopsi ?? '-' }}</p>
<p><a href="{{ route('admin.fetchadoptionrequest') }}">Review adoption requests</a></p>

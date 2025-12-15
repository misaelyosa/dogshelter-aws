<p>New shelter verification request submitted.</p>
<p>Shelter: {{ $shelter->name }}</p>
<p>Owner: {{ $shelter->owner }}</p>
<p>Contact: {{ $shelter->contact }}</p>
<p>Location: {{ $shelter->location }}</p>
<p><a href="{{ route('admin.shelter_verifications.show', $shelter->id) }}">Review request</a></p>

@if($accepted)
    <p>Congratulations — your shelter "{{ $shelter->name }}" has been approved by the admin.</p>
@else
    <p>We're sorry — your shelter "{{ $shelter->name }}" was declined by the admin.</p>
@endif
<p>Contact: {{ $shelter->contact }}</p>
<p>Location: {{ $shelter->location }}</p>

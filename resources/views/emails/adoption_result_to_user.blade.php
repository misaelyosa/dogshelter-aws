@if($accepted)
    <p>Good news — your adoption request for <strong>{{ $doge->nama }}</strong> was accepted.</p>
@else
    <p>We're sorry — your adoption request for <strong>{{ $doge->nama }}</strong> was declined.</p>
@endif
<p>Contact the shelter owner for next steps.</p>

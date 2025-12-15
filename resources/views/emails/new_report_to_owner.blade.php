<p>A new report was submitted near your shelter.</p>
<p>Reporter: {{ $report->reporter_name }}</p>
<p>Location: {{ $report->location }}</p>
<p>Time Found: {{ $report->time_found }}</p>
<p><a href="{{ route('shelter.reports.show', $report->id) }}">View report details</a></p>

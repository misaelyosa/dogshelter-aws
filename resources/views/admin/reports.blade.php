@extends('base.base')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Reports</h1>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Reporter</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Doge</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Time Found</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Location</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Photo</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($reports as $report)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $report->id }}</td>
                    <td class="px-4 py-3 text-sm">{{ $report->reporter_name }}</td>
                    <td class="px-4 py-3 text-sm">{{ $report->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $report->time_found ? \Carbon\Carbon::parse($report->time_found)->format('d M Y H:i') : '-' }}</td>
                    <td class="px-4 py-3 text-sm">
                        @if($report->latitude && $report->longitude)
                        <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $report->latitude }}, {{ $report->longitude }}
                        </a>
                        @elseif($report->address)
                        {{ Str::limit($report->address, 40) }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($report->doge_pic)
                        <img src="{{ asset('storage/' . $report->doge_pic) }}" alt="photo" class="w-20 h-20 object-cover rounded">
                        @else
                        <span class="text-gray-500">No photo</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($report->status === 'pending')
                        <span class="px-2 py-1 rounded-full text-xs bg-yellow-400 text-yellow-800">Pending</span>
                        @elseif($report->status === 'accepted')
                        <span class="px-2 py-1 rounded-full text-xs bg-green-400 text-green-800">Accepted</span>
                        @elseif($report->status === 'declined')
                        <span class="px-2 py-1 rounded-full text-xs bg-red-400 text-red-800">Declined</span>
                        @else
                        <span class="px-2 py-1 rounded-full text-xs bg-gray-400 text-gray-800">{{ $report->status }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-right space-x-2">
                        <a href="{{ route('admin.reports.show', $report->id) }}" class="inline-block px-3 py-1 bg-blue text-black rounded text-sm">View</a>

                        <form action="{{ route('admin.reports.accept', $report->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" onclick="return confirm('Accept report #{{ $report->id }}?')" class="px-3 py-1 bg-supaw_green text-black rounded text-sm">Accept</button>
                        </form>

                        <form action="{{ route('admin.reports.decline', $report->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" onclick="return confirm('Decline report #{{ $report->id }}?')" class="px-3 py-1 bg-red-500 text-black rounded text-sm">Decline</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-6 text-center text-sm text-gray-500">No reports found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
@endsection
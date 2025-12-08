@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.index')

@section('judul')
<h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Reports</h1>
@endsection

@section('dataTable')
<!-- SWAL (sama seperti di Doge) -->
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
        });
    });
</script>
@endif
<!-- END SWAL -->
<!-- Modal Background -->
<div id="reportModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <!-- Modal Box -->
    <div class="bg-white w-full max-w-lg rounded-lg p-6 relative">

        <!-- Close Button -->
        <button onclick="closeReportModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            ✕
        </button>

        <h2 class="text-2xl font-bold mb-4">Detail Report</h2>

        <div id="modalContent" class="space-y-3">
            <!-- ISI AKAN DIISI DARI JAVASCRIPT -->
        </div>

        <div class="mt-5 text-right">
            <button onclick="closeReportModal()"
                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Close
            </button>
        </div>
    </div>
</div>
<div class="mb-8 w-full h-full">
    <div class="relative overflow-x-auto mx-10 bg-white shadow rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 min-w-full divide-y divide-gray-200">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="ps-3 px-4 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Reporter</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Time Found</th>
                    <th scope="col" class="px-6 py-3">Location</th>
                    <th scope="col" class="px-6 py-3">Photo</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($reports as $report)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50">
                    <td class="ps-3 px-4 py-4 text-sm text-gray-900">{{ $report->id }}</td>
                    <td class="px-6 py-4 text-sm">{{ $report->reporter_name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $report->description }}</td>
                    <td class="px-6 py-4 text-sm">{{ $report->time_found ? \Carbon\Carbon::parse($report->time_found)->format('d M Y H:i') : '-' }}</td>
                    <td class="px-6 py-4 text-sm">
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
                    <td class="px-6 py-4 text-sm">
                        @if($report->doge_pic && Storage::disk('public')->exists($report->doge_pic))
                        <img src="{{ Storage::url($report->doge_pic) }}" alt="report photo" class="w-20 h-20 object-cover rounded" loading="lazy">
                        @else
                        <span class="text-gray-500">No photo</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
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
                    <td class="pe-2 py-4 text-right">

                        <button type="button" onclick='openReportModal(@json($report))' class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            View
                        </button>


                        <!-- Hanya tampilkan Accept / Decline jika status = pending -->
                        @if($report->status === 'pending')
                        <form action="{{ route('admin.reports.accept', $report->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" onclick="return confirm('Accept report #{{ $report->id }}?')"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                Accept
                            </button>
                        </form>

                        <form action="{{ route('admin.reports.decline', $report->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" onclick="return confirm('Decline report #{{ $report->id }}?')"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-900">
                                Decline
                            </button>
                        </form>
                        @endif
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

    <div class="mt-4 ps-6">
        {{ $reports->links() }}
    </div>
</div>
@endsection

<script>
    function openReportModal(report) {
        console.log(report)
        let modal = document.getElementById('reportModal');
        let content = document.getElementById('modalContent');

        let foto = report.foto ?
            `<img src="/storage/${report.foto}" class="w-full rounded-lg mb-3">` :
            '';

        content.innerHTML = `
        ${foto}
        <div>
            <p class="text-sm text-gray-600">Nama Pelapor</p>
            <p class="font-semibold">${report.reporter_name}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Nomor Telepon</p>
            <p class="font-semibold">${report.notelp}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Status</p>
            <p class="font-semibold">${report.status}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Lokasi</p>
            <p class="font-semibold">${report.latitude}, ${report.longitude}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Deskripsi</p>
            <p class="font-semibold">${report.description}</p>
        </div>
    `;

        modal.classList.remove('hidden');
    }

    function closeReportModal() {
        document.getElementById('reportModal').classList.add('hidden');
    }
</script>
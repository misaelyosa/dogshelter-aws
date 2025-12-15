@extends('admin.index')

@section('judul')
<h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Shelter Verifications</h1>
@endsection

@section('dataTable')
<div class="mx-8 ">
    @if(session('success'))
    <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="mt-4 bg-white dark:bg-gray-800 rounded shadow p-4">
        @if($pending->isEmpty())
            <p class="text-gray-500">No pending shelter verifications.</p>
        @else
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Contact</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $shelter)
                    <tr class="border-t">
                        <td class="px-2 py-2">{{ $shelter->id }}</td>
                        <td class="px-2 py-2">{{ $shelter->name }}</td>
                        <td class="px-2 py-2">{{ $shelter->owner }}</td>
                        <td class="px-2 py-2">{{ $shelter->contact }}</td>
                        <td class="px-2 py-2">{{ $shelter->created_at->diffForHumans() }}</td>
                        <td class="px-2 py-2">
                            <a href="{{ route('admin.shelter_verifications.show', $shelter->id) }}" class="text-blue-600">View</a>
                            <form action="{{ route('admin.shelter_verifications.accept', $shelter->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                <button class="text-green-600">Accept</button>
                            </form>
                            <form action="{{ route('admin.shelter_verifications.decline', $shelter->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                <button class="text-red-600">Decline</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

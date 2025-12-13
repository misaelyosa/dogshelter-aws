@extends('admin.index')

@section('judul')
    <h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Admin Dashboard</h1>
@endsection

@section('dataTable')

<div class="w-full grid gap-4 px-8">
    <div>
        <h2 class="font-bold text-lg dark:text-white">Doge by Shelter</h2>
    </div>

    @foreach($shelters as $shelter)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <h3 class="font-semibold dark:text-white">{{ $shelter->name }} <span class="text-sm text-gray-500 dark:text-white">(ID: {{ $shelter->id }})</span></h3>
        <p class="text-sm text-gray-500 dark:text-white">Location: {{ $shelter->location }}</p>
        <div class="overflow-x-auto mt-3">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-3 py-2 dark:text-white">No.</th>
                        <th class="px-3 py-2 dark:text-white">Name</th>
                        <th class="px-3 py-2 dark:text-white">Gender</th>
                        <th class="px-3 py-2 dark:text-white">Trait</th>
                        <th class="px-3 py-2 dark:text-white">Dob</th>
                        <th class="px-3 py-2 dark:text-white">Vaccin</th>
                        <th class="px-3 py-2 dark:text-white">Adoption Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shelter->dogs as $doge)
                    <tr class="border-b">
                        <td class="px-3 py-2 dark:text-white">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2 dark:text-white">{{ $doge->nama }}</td>
                        <td class="px-3 py-2 dark:text-white">{{ $doge->jenis_kelamin }}</td>
                        <td class="px-3 py-2 dark:text-white">{{ $doge->trait }}</td>
                        <td class="px-3 py-2 dark:text-white">{{ $doge->dob }}</td>
                        <td class="px-3 py-2 dark:text-white">{{ $doge->vaccin_status }}</td>
                        <td class="px-3 py-2 dark:text-white">{{ $doge->adoption_status ?? 'available' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach

</div>

@endsection

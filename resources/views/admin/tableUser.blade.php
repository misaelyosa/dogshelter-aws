@extends('admin.index')

@section('judul')
    <h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Users list</h1>
@endsection

@section('dataTable')
    <!-- SWAL -->
    @if (session('success'))  
    <script>
        // console.log('ballz');
        document.addEventListener('DOMContentLoaded', function (){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
            });
        });      
    </script>   
    @elseif (session('error'))
    
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: "{{session('error')}}",
            });
        });
    </script>

    @endif
<!-- END SWAL -->

<div class="mb-8 w-full h-full">
        <div class="relative overflow-x-auto  mx-10">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="ps-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                             Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ban Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Adopted Doge
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="ps-3 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->ban_status }}
                        </td>
                        <td class="px-6 py-0">
                            {{ $user->adoptedDoge->pluck('nama')->join(', ') ?: 'No adoptions' }}
                        </td>
                        <td class=" pe-2 py-4">
                        @if ($user->ban_status === 0)    
                            <button type="button" class="btnBan focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                <a href="{{ route('banuser' , ['id'=> $user->id])}}">Ban</a>
                            </button>
                        @else
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <a href="{{ route('banuser' , ['id'=> $user->id])}}">Unban</a>
                            </button>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-full grid mb-5">
        <h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Shelter Owners</h1>
    </div>
    <div class="mb-8 w-full h-full">
        <div class="relative overflow-x-auto  mx-10">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="ps-3">No.</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Linked Shelter</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shelterOwners as $owner )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="ps-3 py-4">{{ $loop->iteration }}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $owner->name }}</th>
                        <td class="px-6 py-4">{{ $owner->email }}</td>
                        <td class="px-6 py-4">
                            @php
                                $s = \App\Models\Shelter::where('user_id', $owner->id)->first();
                            @endphp
                            {{ $s ? $s->name : 'No shelter linked' }}
                        </td>
                        <td class=" pe-2 py-4">
                            @if ($owner->ban_status === 0)
                                <button type="button" class="btnBan focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    <a href="{{ route('banuser' , ['id'=> $owner->id])}}">Ban</a>
                                </button>
                            @else
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <a href="{{ route('banuser' , ['id'=> $owner->id])}}">Unban</a>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-full grid mb-5">
        <h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Admins list</h1>
    </div>
    <div class="mb-8 w-full h-full">
        <div class="relative overflow-x-auto  mx-10">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="ps-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                             Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Adopted Doge [test]
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="ps-3 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $admin->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $admin->email }}
                        </td>
                        <td class="px-6 py-0">
                            {{ $admin->adoptedDoge->pluck('nama')->join(', ') ?: 'No adoptions' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
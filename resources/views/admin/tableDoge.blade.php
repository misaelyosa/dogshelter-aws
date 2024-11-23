@extends('admin.index')

@section('judul')
    <h1 class="font-dmsans text-black dark:text-white text-lg md:text-2xl font-bold ps-8">Tabel Doge</h1>
    <button type="button"  class="h-[40px] ms-8 place-self-start text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
        <a href="{{route('formCreateDoge')}}"> 
            Add Doge
        </a>
    </button>
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
    @endif
    
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            const _btnDelete = document.querySelectorAll('.btnDelete');

            _btnDelete.forEach(button => {
                button.addEventListener('click', function (){
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                            const deleteForm = this.nextElementSibling;
                            if (deleteForm) {
                                window.location.href = deleteForm.getAttribute('href');
                            } else {
                                console.error('Delete form not found!');
                            }
                        }              
                    });
                });
            });
        });
    </script>
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
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Trait
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dob
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Vaccin Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Adoption Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doges as $doge )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="ps-3 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $doge->nama }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $doge->jenis_kelamin }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $doge->trait }}
                        </td>
                        <td class="px-6 py-4">
                             {{ $doge->dob }}
                        </td>
                        <td class="px-6 py-0">
                             {{ $doge->vaccin_status }}
                        </td>
                        <td class="px-6 py-0">
                             {{ $doge->adoption_status }}
                        </td>
                        <td class="px-6 py-0">
                             {{ $doge->keterangan }}
                        </td>
                        <td class=" pe-2 py-4">
                            <a href="{{ route('fetchedit' , ['id' => $doge->id])}}">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Edit
                                </button>
                            </a>
                            <button type="button" class="btnDelete focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                            <a class="deleteForm" href="{{ route('deletedoge' , ['id' => $doge->id])}}"> </a>
                            <!-- ojok dipindah pindah wak -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
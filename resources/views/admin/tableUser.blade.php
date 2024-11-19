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
    @endif
    
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            const _btnDelete = document.querySelectorAll('.btnDelete');

            _btnDelete.forEach(button => {
                button.addEventListener('click', function (){
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "User will be banned until you unbanned them",
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
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ban Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Adoption Status
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
                        <td class="px-6 py-4">
                             <!-- {{ $user->dob }} -->
                        </td>
                        <td class="px-6 py-0">
                             <!-- {{ $user->vaccin_status }} -->
                        </td>
                        <td class=" pe-2 py-4">
                            <button type="button" class="btnDelete focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Ban
                            </button>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
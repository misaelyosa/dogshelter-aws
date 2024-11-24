@extends('base.base')
@include('includes.sidebar')

@section('content')
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
                    icon: "error",
                    title: "Oops...",
                    text: "{{session('error')}}",
                    });
            });
        </script>
    @endif

<section class="bg-white dark:bg-gray-800 min-h-screen">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">
            <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2">Review Adoption Request</h1>
            <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-6">Pastikan kelengkapan data calon adopter dan juga kontak calon adopter lebih lagi untuk perjanjian.</p>
            <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Terms and Service
            </button>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            @foreach($doges as $doge)
            @php
                $adopter = $adopters->firstWhere('id', $doge->user_id);
            @endphp
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                <h2 class="text-gray-900 dark:text-white text-3xl font-extrabold mb-3">Request Adopsi {{$doge->nama}}</h2>
                <p class="text-lg font-bold text-gray-500 dark:text-gray-400 mb-1">Data Calon Adopter</p>
                <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-1">Nama : {{$adopter->name}}</p>
                <a href=""  class=" hover:text-white hover:bg-black text-lg font-normal text-gray-500 dark:text-gray-400 mb-1"><p>Email : {{$adopter->email}}</p></a>
                <a href=""  class=" hover:text-white hover:bg-black text-lg font-normal text-gray-500 dark:text-gray-400 mb-4"><p>No Telepon : {{$adopter->no_telp}}</p></a>
                <button data-modal-target="modal_verify" data-modal-toggle="modal_verify"  class="text-white hover:underline bg-blue-700 hover:bg-blue-800  inline-flex items-center font-medium rounded-lg text-md mt-4 px-5 py-2.5 text-center focus:ring-4 focus:outline-none focus:ring-blue-300 ">Read more
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </div>
            @endforeach
        </div>

        <!-- MODAL -->
        <!-- Main modal -->
        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Reminder Terms and Service Adoption
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <ul class="text-base leading-relaxed text-gray-500 dark:text-gray-400 text-md ps-2">
                            <li>1. Untuk disayang</li>
                            <li>2. Ditaruh dalam rumah</li>
                            <li>3. Tidak dikandang dan/atau dirantai</li>
                            <li>4. Tidak untuk dijualbelikan atau dihibahkan lagi</li>
                            <li>5. Wajib steril dan bersedia vaksin rutin</li>
                            <li>6. Seluruh anggota keluarga di rumah suka anjing dan setuju pelihara</li>
                            <li>7. Siap dengan segala biayanya</li>
                            <li>8. Siap merawat hingga tua dan meninggal</li>
                            <li>9. Rumah bersedia disurvey</li>
                            <li>10. Area Surabaya dan sekitarnya diutamakan</li>
                            <li>11. Rumah berpagar diutamakan</li>
                            <li>12. Bersedia melalui trial adopsi selama sebulan</li>
                            <li>13. Memberi kabar rutin setelah adopsi dan tidak putus komunikasi dengan pihak Supaw Warrior</li>
                            <li>14. Kita yang akan antar anabulnya ke rumah calon pawrent karena tidak menerima visitor</li>
                        </ul>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ok</button>
                    </div>
                </div>
            </div>
        </div>

        @foreach($doges as $doge)
            @php
                $adopter = $adopters->firstWhere('id', $doge->user_id);
            @endphp
        <!-- Data modal -->
        <div id="modal_verify" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Approve Adoption?
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal_verify">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <ul class="text-base leading-relaxed text-gray-500 dark:text-gray-400 text-md ps-2"> Data Anjing
                            <li>1. Nama : {{ $doge->nama }} </li>
                            <li>2. Date of Birth : {{ $doge->dob }} </li>
                            <li>3. Vaccin Status : {{ $doge->vaccin_status }} </li>
                            <li>4. Jenis Kelamin : {{ $doge->jenis_kelamin }} </li>
                        </ul>
                        <ul class="text-base leading-relaxed text-gray-500 dark:text-gray-400 text-md ps-2"> Data Calon Adopter
                            <li>1. Nama : {{ $adopter->name }} </li>
                            <li>2. No Telepon : {{ $adopter->no_telp }} </li>
                            <li>3. Email : {{ $adopter->email }} </li>
                            <li>4. Pesan tambahan : {{ $doge->pesan_adopsi }} </li>
                        </ul>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex  p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <div class="me-2 sm:me-auto">
                            <form id="approveForm-{{ $doge->id }}" action="{{ route('acceptadopt') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $doge->id }}">
                                <button type="button" onclick="confirmAction('{{ $doge->id }}', 'approve')" class="w-full h-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Approve Adoption?</button>
                            </form>
                        </div>
                        <div class="sm:mx-auto">
                            <form id="declineForm-{{ $doge->id }}" action="{{ route('declineadopt') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $doge->id }}">
                                <button type="button" onclick="confirmAction('{{ $doge->id }}', 'decline')" class="w-full h-full focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Decline Adoption Request</button>
                            </form>
                        </div>
                        <div class="ms-2 sm:ms-auto">
                            <button data-modal-hide="modal_verify" type="button" class="w-full h-full text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>

<!-- Swal confirmation -->
<script>
function confirmAction(id, action) {
    let actionText = action === 'approve' ? 'Approve' : 'Decline';
    let formId = action === 'approve' ? `approveForm-${id}` : `declineForm-${id}`;

    Swal.fire({
        title: `Are you sure you want to ${actionText}?`,
        text: "This action cannot be undone!",
        icon: action === 'approve' ? 'success' : 'warning',
        showCancelButton: true,
        confirmButtonColor: action === 'approve' ? '#385df8' : '#e11d48',
        cancelButtonColor: '#6b7280',
        confirmButtonText: `Yes, ${actionText.toLowerCase()} it!`
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
</script>
@endsection
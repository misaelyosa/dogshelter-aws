@extends('base.base')

@section('content')
<section class="bg-white dark:bg-gray-900">
  <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update Doge Info</h2>
        <form action="{{route('updatedoge')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $doge->id }}">
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doge Name</label>
                    <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $doge->nama}}" placeholder="Type product name" required="">
                </div>
                <div class="w-full">
                    <label for="trait" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trait</label>
                    <input type="text" name="trait" id="trait" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $doge->trait}}" placeholder="Product brand" required="">
                </div>
                <div class="w-full">
                    <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $doge->dob}}" placeholder="yyyy-mm-dd" required="">
                </div>
                <div class="w-full">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $doge->jenis_kelamin}}" placeholder="yyyy-mm-dd" required="">
                </div>
                <div class="w-full">
                    <label for="vaccin_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaccin Status</label>
                    <input type="text" name="vaccin_status" id="vaccin_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $doge->vaccin_status}}" placeholder="yyyy-mm-dd" required="">
                </div>
                <!-- <div>
                    <label for="vaccin_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaccin Status</label>
                    <select id="vaccin_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Electronics</option>
                        <option value="TV">TV/Monitors</option>
                        <option value="PC">PC</option>
                        <option value="GA">Gaming/Console</option>
                        <option value="PH">Phones</option>
                    </select>
                </div> -->
                <div class="sm:col-span-2">
                    <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a product description here..." >{{$doge->keterangan}}</textarea>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Update Info
                </button>
                <a href="{{route('admin')}}">
                    <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </a>
            </div>
        </form>
  </div>
</section>
@endsection
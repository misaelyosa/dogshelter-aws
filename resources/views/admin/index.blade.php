@extends('base.base')

<section class="w-full h-full flex flex-col items-center">
    <h1 class="font-dmsans text-black text-xl font-bold my-5">Tabel Doge</h1>
    <div class="mb-8 w-full h-full">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
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
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doges as $doge )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                        <td class="px-6 py-4">
                             {{ $doge->keterangan }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
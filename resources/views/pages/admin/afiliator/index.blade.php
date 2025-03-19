@extends('layouts.default')

@section('content')
    <x-title judul="Afiliator" />
    <main class="mt-10 space-y-5">
        <form action="afiliator-list" class="max-w-xl" method="GET" autocomplete="off">
            <x-input-field type="search" id="search" :value="session('search') ?? ''" name="search" placeholder="Cari data"
                label="Cari data" />
            @if (session('search'))
                <div class="mt-2.5 flex justify-end">
                    <x-hyper-link-red href="afiliator-list" label="Reset" id="reset" />
                </div>
            @endif
        </form>
        <div class="relative overflow-x-auto rounded-lg @if (session('search')) mt-8 @endif">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#307487] dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bank Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bank Account
                        </th>
                        <th scope="col" class="px-6 py-3">
                            e-Wallet
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($afiliators->count() < 1)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" colspan="5"
                                class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Tidak ada data
                            </th>
                        </tr>
                    @else
                        @foreach ($afiliators as $index => $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $afiliators->firstItem() + $index }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->user_information->phone ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->user_information->address ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->user_information->bank_name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->user_information->bank_account ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->user_information->e_wallet ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $afiliators->appends(request()->input())->links() }}
        </div>
    </main>
@endsection

@extends('layouts.default')

@section('content')
    <x-title judul="Riwayat Pembayaran"/>
    <main class="mt-10">
        <section class="max-w-sm mb-5">
            <form action="riwayat-pembayaran" autocomplete="off" method="GET" class="max-w-xl space-y-4">
                <x-input-field
                    id="from"
                    label="Dari"
                    type="date"
                    name="from"
                    :value="session('from') ?? ''"
                    placeholder="Masukan tanggal awal"
                />
                <x-input-field
                    id="to"
                    label="Sampai"
                    type="date"
                    name="to"
                    :value="session('to') ?? ''"
                    placeholder="Masukan tanggal awal"
                />
                <div class="flex justify-end gap-3">
                    <x-green-button id="filter-btn" label="Filter" type="submit"/>
                    @if (session('from') && session('to'))
                        <x-hyper-link-red href="riwayat-pembayaran" label="Reset" id="reset"/>
                    @endif
                </div>
            </form>
        </section>
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#307487] dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bukti Pembayaran
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() < 1)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" colspan="5" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Tidak ada data
                            </th>
                        </tr>
                    @else
                        @foreach ($data as $index => $item)
                            <tr class="bg-white text-black dark:text-gray-300 border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $item->created_at->locale('id')->isoFormat('D MMMM YYYY') }} <br>
                                    {{ $item->created_at->locale('id')->formatLocalized('%H:%M') }} WIB
                                </td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/payment/' . $item->image) }}" alt="bukti pembayaran" class="image max-w-24 aspect-square cursor-pointer" srcset="">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $data->appends(request()->input())->links() }}
        </div>
    </main>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".image").click(function() {
                    const imgUrl = $(this).attr('src');

                    window.open(imgUrl, "", "fullscreen");
                })
            })
        </script>
    @endpush
@endsection

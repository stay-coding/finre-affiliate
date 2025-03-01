@extends('layouts.default')

@section('content')
    <x-title judul="Dashboard"/>
    <main class="mt-10">
        <section class="grid 2xl:grid-cols-10 lg:grid-cols-6 grid-cols-1 gap-3">
            <div class="2xl:col-span-2 xl:col-span-2 lg:col-span-3 col-span-1">
                <x-indicator-card
                    :jumlah="$data['referal_access']"
                    judul="Klik"
                    ikon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                        </svg>
                        '
                />
            </div>
            <div class="2xl:col-span-2 xl:col-span-2 lg:col-span-3 col-span-1">
                <x-indicator-card
                    :jumlah="$data['referal_registered']"
                    judul="Register"
                    ikon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 text-red-500">
                            <path fill-rule="evenodd" d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                            </svg>
                        '
                />
            </div>
            <div class="2xl:col-span-2 xl:col-span-2 lg:col-span-3 col-span-1">
                <x-indicator-card
                    :jumlah="$data['sales']"
                    judul="Sales"
                    ikon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                        </svg>
                        '
                />
            </div>
            <div class="2xl:col-span-2 xl:col-span-2 lg:col-span-3 col-span-1">
                <x-indicator-card
                    :jumlah="'Rp ' . number_format($data['comission'] ?? 0,0,',','.')"
                    judul="Total Komisi"
                    ikon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-yellow-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        '
                />
            </div>
            <div class="2xl:col-span-2 xl:col-span-2 lg:col-span-3 col-span-1">
                <x-indicator-card
                    :jumlah="'Rp ' . number_format($data['payment'],0,',','.')"
                    judul="Total Dibayar"
                    ikon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-emerald-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                        '
                />
            </div>
        </section>
        <section class="mt-10 bg-white p-5 rounded-md dark:bg-slate-900">
            <form action="admin" autocomplete="off" method="GET" class="mb-5 max-w-xl space-y-4">
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
                    <x-blue-button id="filter-btn" label="Filter" type="submit"/>
                    @if (session('from') && session('to'))
                        <x-hyper-link-red href="admin" label="Reset" id="reset"/>
                    @endif
                </div>
            </form>
            {!! $chart->container() !!}
        </section>
    </main>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection

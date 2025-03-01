@extends('layouts.default')

@section('content')
    <x-title judul="Pengaturan"/>

    <main class="mt-10 space-y-10">
        <section>
            <p class="text-lg mb-2 dark:text-gray-300">Mode Gelap</p>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" id="theme-toggle" value="" class="sr-only peer">
                <div class="relative w-11 h-6 bg-slate-50 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#307487] dark:peer-focus:ring-emerald-900 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#307487]"></div>
                <span id="theme-toggle-dark-icon" class="hidden ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8 text-purple-500">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span id="theme-toggle-light-icon" class="hidden ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8 text-yellow-300">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                    </svg>
                </span>
            </label>
        </section>
        <section>
            <form action="update-profile" method="POST" autocomplete="off" class="p-5 shadow space-y-5 dark:bg-slate-900 bg-white rounded-lg border dark:border-gray-700">
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="grid grid-cols-12 lg:gap-5">
                    <div class="@if(auth()->user()->hasRole('afiliator')) lg:col-span-6 @endif col-span-12 space-y-5">
                        <x-input-field id="name" value="{{ Auth::user()->name }}" name="name" label="Nama" placeholder="Nama lengkap" type="text" isRequired="1" />
                        <x-input-field id="email" value="{{ Auth::user()->email }}" name="email" label="Email" type="email" placeholder="Email yang valid" isRequired="1"/>
                        <x-input-field id="password" name="password" label="Password" placeholder="Panjang minimal 6 karakter" type="password"/>
                        @if (auth()->user()->hasRole('afiliator'))
                            <x-input-field id="phone" value="{{ $userInfo->phone }}" name="phone" label="No. Handphone" placeholder="Panjang minimal 12 karakter" type="text"/>
                        @endif
                    </div>
                    @if (auth()->user()->hasRole('afiliator'))
                        <div class="lg:col-span-6 col-span-12 space-y-5">
                            <x-input-field id="alamat" value="{{ $userInfo->address }}" name="address" placeholder="Isi alamat domisili" label="Alamat" type="text"/>
                            <div>
                                <label for="bank-name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pilih Bank</label>
                                <select id="bank-name" name="bank_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </select>
                            </div>
                            <div id="alt-bank" class="hidden">
                                <x-input-field id="alt-bank-name" name="" placeholder="Masukan Nama Bank" label="Nama Bank" type="text" />
                            </div>
                            <x-input-field id="bank-account" value="{{ $userInfo->bank_account }}" name="bank_account" placeholder="Masukan nomor rekening" label="No. Rekening" type="text" />
                            <x-input-field id="ewallet" value="{{ $userInfo->e_wallet }}" name="e_wallet" placeholder="Masukan nomor dompet digital anda" label="E-Wallet" type="text" />
                            <input type="text" value="{{ $userInfo->id }}" hidden name="user_info_id" id="user_info_id">
                        </div>
                    @endif
                </div>
                <div class="flex justify-end">
                    <x-green-button id="btn-save" type="submit" label="Simpan" />
                </div>
            </form>
        </section>
    </main>
    @push('scripts')
        <script>
            $(document).ready(function () {
                var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
                var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

                // Fetch bank list from json file
                fetch('/list-bank.json')
                    .then(response => response.json())
                    .then(data => {
                        const bankName = document.getElementById('bank-name');
                        data.forEach(bank => {
                            const option = document.createElement('option');
                            option.value = bank.name;
                            option.text = bank.name;
                            bankName.appendChild(option);
                            if (bank.name === @json($userInfo->bank_name ?? '')) {
                                option.selected = true;
                            }
                        });

                        const option = document.createElement('option');
                        option.value = "0";
                        option.text = "Lainnya";

                        if (!data.find(bank => bank.name === @json($userInfo->bank_name ?? '')) && @json($userInfo->bank_name ?? '')) {
                            option.selected = true;
                            $("#alt-bank").removeClass('hidden');
                            $("#alt-bank-name").attr('name', 'bank_name');
                            $("#alt-bank-name").val(@json($userInfo->bank_name ?? ''));
                            $(this).removeAttr('name');
                            $(this).removeAttr('id');
                        }
                        bankName.appendChild(option);
                    });

                // Change the icons inside the button based on previous settings
                if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    $("#theme-toggle").attr('checked', true);
                    document.documentElement.classList.add('dark');
                    themeToggleDarkIcon.classList.remove('hidden');
                } else {
                    $("#theme-toggle").attr('checked', false);
                    themeToggleLightIcon.classList.remove('hidden');
                }

                $("#bank-name").change(function () {
                    if ($(this).val() === "0") {
                        $("#alt-bank").removeClass('hidden');
                        $("#alt-bank-name").attr('name', 'bank_name');
                        $(this).removeAttr('name');
                        $(this).removeAttr('id');
                    } else {
                        $("#alt-bank").addClass('hidden');
                        $("#alt-bank-name").attr('name', '');
                        $(this).attr('name', 'bank_name');
                        $(this).attr('id', 'bank-name');
                    }
                })

                $("#theme-toggle").change(function () {
                    // toggle icons inside button
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');

                    // if set via local storage previously
                    if (localStorage.getItem('color-theme')) {
                        if (localStorage.getItem('color-theme') === 'light') {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        }

                    // if NOT set via local storage previously
                    } else {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        }
                    }

                });
            })
        </script>
    @endpush
@endsection

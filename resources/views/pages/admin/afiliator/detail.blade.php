@extends('layouts.default')

@section('content')
    <x-title judul="Detail Pembayaran"/>
    <main class="mt-10 space-y-6">
        <section class="grid grid-cols-12 gap-4 dark:text-gray-300 dark:bg-gray-900 p-4 rounded-md border dark:border-gray-600 shadow-md">
            <div class="lg:col-span-6 col-span-12 space-y-4">
                <div>
                    <h2 class="font-bold text-lg tracking-wide">Nama:</h2>
                    <p>{{ $user->name }}</p>
                </div>
                <div>
                    <h2 class="font-bold text-lg tracking-wide">Email:</h2>
                    <p>{{ $user->email }}</p>
                </div>
                <div>
                    <h2 class="font-bold text-lg tracking-wide">No. Handphone:</h2>
                    <p>{{ $user->user_information->phone ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="font-bold text-lg tracking-wide">Alamat:</h2>
                    <p>{{ $user->user_information->address ?? '-' }}</p>
                </div>
            </div>
            <div class="lg:col-span-6 col-span-12 space-y-4">
                <div>
                    <h2 class="font-bold text-lg tracking-wide">Nama Bank:</h2>
                    <p>{{ $user->user_information->bank_name ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="font-bold text-lg tracking-wide">No. Rekening:</h2>
                    <div class="flex gap-2 items-start">
                        <p id="bank-account">{{ $user->user_information->bank_account ?? '-' }}</p>
                        @if ($user->user_information->bank_account)
                            <button type="button" class="copy-button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
                <div>
                    <h2 class="font-bold text-lg tracking-wide">E-Wallet:</h2>
                    <div class="flex gap-2 items-start">
                        <p id="e-wallet">{{ $user->user_information->e_wallet ?? '-' }}</p>
                        @if ($user->user_information->e_wallet)
                            <button type="button" class="copy-button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
                <div>
                    <h2 class="font-bold text-lg tracking-wide">Total Pembayaran:</h2>
                    <p>@currency($user->total_comission->total_balance)</p>
                </div>
            </div>
        </section>
        <section class="max-w-3xl mx-auto dark:bg-gray-900 p-5 rounded-md border dark:border-gray-600 shadow-md">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/dashboard/payment" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="total_comission_id" value="{{ $user->total_comission->id }}" autocomplete="off">
                <div class="space-y-6">
                    <x-input-field label="Input Pembayaran" id="nominal-bayar" placeholder="Masukkan nominal" type="number" name="nominal_bayar" isRequired="1"/>
                    <div>
                        <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bukti Pembayaran</label>
                        <input type="file" hidden accept="image/*" id="file" name="file" required>
                        <button id="upload-btn" type="button" class="max-w-sm p-4 border border-dashed flex flex-wrap items-center justify-center gap-2 bg-slate-600 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-white dark:text-gray-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="dark:text-gray-300 text-white md:text-base text-sm">Upload Bukti Pembayaran</span>
                        </button>
                        <div id="img-preview"></div>
                    </div>
                    <div class="flex justify-end">
                        <x-blue-button id="btn-save" label="Bayar Tagihan" type="submit" />
                    </div>
                </div>
            </form>
        </section>
    </main>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#nominal-bayar").attr('min', 0);

                $(".copy-button").click(function() {
                    const text = $(this).prev().text();
                    navigator.clipboard.writeText(text);
                    alert('Text berhasil disalin!');
                });

                $("#nominal-bayar").on('input', function() {
                    const nominal = $(this).val();
                    const total = @json($user->total_comission->total_balance);
                    if (nominal > total) {
                        $(this).val(total);
                    }
                });

                $("#upload-btn").click(function() {
                    $("#file").click();
                });

                $("#file").change(function() {
                    const file = $(this).prop('files')[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = e.target.result;
                        $("#img-preview").html(`<img src="${img}" class="mt-2 max-w-full h-auto mx-auto object-cover rounded-md">`);
                    }
                    reader.readAsDataURL(file);
                });
            });

        </script>
    @endpush
@endsection

@extends('layouts.default')

@section('content')
    <x-title judul="Kode Referal Anda"/>
    <main class="mt-10 max-w-4xl mx-auto space-y-5">
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="referal-link" method="POST" autocomplete="off">
            @csrf
            <div class="flex items-center mb-6">
                <input type="text" @readonly($linkReferal) value="{{ $linkReferal->referal ?? '' }}" id="referal-code" name="referal_code" class="border border-gray-300 dark:border-none bg-gray-50 text-gray-900 rounded-s-lg focus:ring-[#307487] focus:border-[#307487] block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#307487] dark:focus:border-[#307487]">
                <button type="button" id="generate-btn" class="bg-emerald-600 text-white p-2.5 rounded-e-lg w-28">Generate</button>
            </div>
            @if (!$linkReferal)
                <div>
                    <div class="flex justify-center">
                        <x-green-button id="save-btn" label="Simpan" type="submit"/>
                    </div>
                </div>
            @endif
        </form>
        <div class="flex justify-center items-center gap-4">
            <p class="dark:text-white text-xl" id="link-referal"></p>
            <button id="copy-btn" class="hidden bg-gray-500 p-2 rounded-md shadow border border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
            </button>
        </div>
    </main>
    @push('scripts')
        <script>
            const linkReferal = {{ Js::from($linkReferal) }}
            const linkMainApps = {{ Js::from(env('APP_MAIN_URL')) }}

            if (linkReferal) {
                $("#link-referal").html(`${linkMainApps}join?ref=${linkReferal.referal}`);
                $("#copy-btn").removeClass("hidden");
                $("#generate-btn").attr("disabled", true);
            }

            $("#copy-btn").click(function () {
                // Copy the text inside the text field
                navigator.clipboard.writeText($("#link-referal").html());

                // Alert the copied text
                alert("Link berhasil disalin");
            })

            $("#referal-code").on("input", function(){
                let split = $(this).val().split(" ");
                let unite = split.join("")
                $(this).val(unite)
            })

            $("#generate-btn").click(function () {
                let referalCode = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                $("#referal-code").val(referalCode);
                $("#link-referal").html(`${linkMainApps}join?ref=${referalCode}`);
                $("#copy-btn").removeClass("hidden");
            })
        </script>
    @endpush
@endsection

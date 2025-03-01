@extends('layouts.default')

@section('content')
    <x-title judul="Buat Materi"/>
    <main class="mt-10">
        <section>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-[#307487] hover:bg-[#307487] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#307487] dark:hover:bg-[#307487]" type="button">
                Tambah Materi
            </button>

            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Upload Materi
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="/dashboard/materi" id="upload-form" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 max-w-lg mx-auto">
                                <input type="file" name="file" id="file" accept="image/*, video/*, application/pdf" hidden>
                                <div id="file-preview"></div>
                                <div class="progress w-full bg-gray-200 rounded-full dark:bg-gray-700 hidden mb-3">
                                    <div class="progress-bar bg-green-600 h-2.5 rounded-full" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                                <div id="upload-alert" class="hidden flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="text-base" id="upload-alert-text"></div>
                                </div>
                                <div id="click-file-area" class="aspect-square border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-600 cursor-pointer">
                                    <figure class="flex flex-col h-full justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-14 dark:text-gray-300">
                                            <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06l-3.22-3.22V16.5a.75.75 0 0 1-1.5 0V4.81L8.03 8.03a.75.75 0 0 1-1.06-1.06l4.5-4.5ZM3 15.75a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="block text-center dark:text-gray-300 text-lg">Klik untuk upload</span>
                                        <span class="block text-center dark:text-gray-300 text-lg">*ukuran file maksimal 500 MB</span>
                                    </figure>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <div id="upload-handle">
                                    <button type="submit" value="Upload File" class="text-white bg-[#307487] hover:bg-[#307487] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#307487] dark:hover:bg-[#307487]">Upload</button>
                                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#307487] focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali</button>
                                </div>
                                <a href="/dashboard/buat-materi" id="cancel-upload" class="hidden text-white bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:ring-rose-300 font-medium rounded text-sm px-5 py-2.5 dark:bg-rose-600 dark:hover:bg-rose-700 focus:outline-none dark:focus:ring-rose-800">
                                    Batalkan
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-5">
            <div class="grid grid-cols-12 gap-2">
                @foreach ($data as $item)
                    <div class="xl:col-span-3 lg:col-span-6 sm:col-span-12 col-span-6">
                        <x-materi-card :file="$item->content" :id="$item->id" />
                    </div>
                @endforeach
            </div>
            <div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <form id="delete-form" method="POST">
                                @method('DELETE')
                                @csrf
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                <button data-modal-hide="delete-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2 text-center">
                                    Ya, saya yakin
                                </button>
                                <button data-modal-hide="delete-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                {{ $data->appends(request()->input())->links() }}
            </div>
        </section>
    </main>
    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        <script>
            $(function () {
                $(document).ready(function () {
                    $("#click-file-area").click(function() {
                        $("#file").click();
                    })

                    $("#file").change(function() {
                        const file = $(this).prop('files')[0];
                        let icon

                        if(file.type == 'image/png' || file.type == 'image/jpeg' || file.type == 'image/jpg') {
                            icon = @json(asset('assets/picture.png'))

                        } else if(file.type == 'application/pdf') {
                            icon = @json(asset('assets/pdf.png'))

                        } else {
                            icon = @json(asset('assets/video.png'))
                        }

                        $("#file-preview").addClass('mb-2')
                        $("#file-preview").html(`<div class="flex items-center gap-3 p-3 dark:bg-gray-800 border dark:border-gray-600 rounded-md">
                                                    <img src="${icon}" alt="icon" class="w-8">
                                                    <p class="dark:text-gray-300 line-clamp-1">${file.name}</p>
                                                </div>`)
                    })

                    $('#upload-form').ajaxForm({
                        beforeSend: function () {
                            var percentage = '0';
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            var percentage = percentComplete;
                            $('.progress').removeClass('hidden');
                            $('#file-preview').removeClass('mb-2');
                            $('#upload-alert').removeClass('hidden');
                            $('#upload-alert-text').html(`
                                <span class="font-medium">Perhatian!</span> Jangan tinggalkan halaman ini ketika proses upload.
                            `);
                            $('#cancel-upload').removeClass('hidden');
                            $('#upload-handle').addClass('hidden');
                            $('#click-file-area').addClass('hidden');
                            $('.progress .progress-bar').css("width", percentage+'%', function() {
                                return $(this).attr("aria-valuenow", percentage) + "%";
                            })
                        },
                        complete: function (xhr) {
                            const { message } = xhr.responseJSON
                            if(xhr.status == 200) {
                                setTimeout(function () {
                                    $('#cancel-upload').addClass('hidden');
                                    window.location.reload();
                                }, 500);
                                return
                            }

                            $('#upload-alert-text').empty()
                            $('#upload-alert-text').html(`
                                <span class="font-medium">Upload Gagal!</span> ${message}.
                            `);
                            $('#click-file-area').removeClass('hidden');
                            $('#cancel-upload').addClass('hidden');
                            $('#upload-handle').removeClass('hidden');
                        }
                    });

                    $(".content").click(function() {
                        let url

                        if($(this).attr('data-video')){
                            url = $(this).attr('data-video');
                        } else {
                            url = $(this).attr('src');
                        }

                        window.open(url, "", "fullscreen");
                    })

                    $(".delete-data").click(function() {
                        $("#delete-form").attr('action', `/dashboard/materi/${$(this).attr('data-id')}`);
                    })
                })
            })
        </script>
    @endpush
@endsection

<figure class="w-full">
    <div class="max-w-sm h-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if (str_contains($file, 'pdf'))
            <embed src="{{ asset('storage/marketing_materi/pdf/' . $file ) }}#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" class="w-full h-full aspect-square">
        @elseif(str_contains($file, 'mp4'))
            <div class="content relative bg-black cursor-pointer" data-video="{{ asset('storage/marketing_materi/video/' . $file ) }}">
                <div class="absolute flex flex-col justify-center items-center h-full w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="md:size-14 size-10 z-30 text-white">
                        <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <video src="{{ asset('storage/marketing_materi/video/' . $file ) }}" class="opacity-65 aspect-square" playsinline></video>
            </div>
        @else
            <a href="#">
                <img class="content rounded-t-lg aspect-square" src="{{ asset('storage/marketing_materi/image/' . $file ) }}" alt="" />
            </a>
        @endif
        <div class="p-5 flex justify-end">
            @if (auth()->user()->hasRole('afiliator'))
                <a href="/dashboard/download-materi/{{ $id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#307487] rounded hover:bg-[#307487] focus:ring-4 focus:outline-none focus:ring-[#307487]-300 dark:bg-[#307487] dark:hover:bg-[#307487] dark:focus:ring-[#307487]">
                    Download
                </a>
            @endif
            @if (auth()->user()->hasRole('admin'))
                <button data-modal-target="delete-modal" data-id="{{ $id }}" data-modal-toggle="delete-modal" class="delete-data block text-white bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded text-sm px-5 py-2 text-center dark:bg-rose-600 dark:hover:bg-rose-700 dark:focus:ring-rose-800" type="button">
                    Hapus
                </button>
            @endif
        </div>
    </div>
</figure>

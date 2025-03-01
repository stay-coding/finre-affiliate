@extends('layouts.default')

@section('content')
    <x-title judul="Buat Materi"/>
    <main class="mt-10">
        <section class="mt-5">
            <div class="grid grid-cols-12 gap-2">
                @foreach ($data as $item)
                    <div class="xl:col-span-3 lg:col-span-6 sm:col-span-12 col-span-6">
                        <x-materi-card :file="$item->content" :id="$item->id" />
                    </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $data->appends(request()->input())->links() }}
            </div>
        </section>
    </main>
    @push('scripts')
        <script>
            $(function () {
                $(document).ready(function () {
                    $(".content").click(function() {
                        let url

                        if($(this).attr('data-video')){
                            url = $(this).attr('data-video');
                        } else {
                            url = $(this).attr('src');
                        }

                        window.open(url, "", "fullscreen");
                    })
                })
            })
        </script>
    @endpush
@endsection

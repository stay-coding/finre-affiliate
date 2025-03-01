<?php

namespace App\Http\Controllers;

use App\Models\MarketingMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MarketingMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berupa file dengan format: jpg, jpeg, png, pdf, mp4, mov',
            'file.max' => 'Ukuran file maksimal 500 MB',
        ];

        $validation = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,jpeg,png,pdf,mp4,mov|max:524288',
        ], $message);

        if ($validation->fails()) {
            return response()->json([
                'message' => $validation->errors()->first(),
            ], 400);
        }

        if ($request->file->getClientMimeType() == 'application/pdf') {
            $folder = 'pdf';
        } else if ($request->file->getClientMimeType() == 'video/mp4' || $request->file->getClientMimeType() == 'video/quicktime') {
            $folder = 'video';
        } else {
            $folder = 'image';
        }

        $request->file->storeAs('public/marketing_materi/' . $folder, $request->file->getClientOriginalName());

        MarketingMateri::create([
            'content' => $request->file->getClientOriginalName()
        ]);

        return response()->json([
            'message' => 'Upload berhasil',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(MarketingMateri $marketingMateri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MarketingMateri $marketingMateri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MarketingMateri $marketingMateri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarketingMateri $marketingMateri, $id)
    {
        $find = $marketingMateri->find($id);

        if (!$find) {
            sweetalert()->addError('Data tidak ditemukan');

            return redirect()->back();
        }

        if (str_contains($find->content, 'pdf')) {
            $path = ('public/marketing_materi/pdf/' . basename($find->content));
        } else if (str_contains($find->content, 'mp4')) {
            $path = ('public/marketing_materi/video/' . basename($find->content));
        } else {
            $path = ('public/marketing_materi/image/' . basename($find->content));
        }

        if ($marketingMateri->where('content', 'LIKE', '%' . $find->content . '%')->count() == 1) {
            Storage::delete($path);
        }

        $find->delete();

        sweetalert()->addSuccess('Data berhasil dihapus');

        return redirect()->back();
    }

    public function download_materi(MarketingMateri $marketingMateri, $id)
    {
        $find = $marketingMateri->find($id);

        if (!$find) {
            sweetalert()->addError('Data tidak ditemukan');

            return redirect()->back();
        }

        if (str_contains($find->content, 'pdf')) {
            $path = ('public/marketing_materi/pdf/' . basename($find->content));
        } else if (str_contains($find->content, 'mp4')) {
            $path = ('public/marketing_materi/video/' . basename($find->content));
        } else {
            $path = ('public/marketing_materi/image/' . basename($find->content));
        }

        return Storage::download($path);
    }
}

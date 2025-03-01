<?php

namespace App\Http\Controllers;

use App\Models\Referal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferalController extends Controller
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
            'referal_code.required' => 'Kode referal tidak boleh kosong',
            'referal_code.unique' => 'Kode referal sudah ada',
        ];

        $request->validate([
            'referal_code' => 'required|unique:referals,referal',
        ], $message);

        try {
            Referal::create([
                'user_id' => Auth::user()->id,
                'referal' => $request->referal_code,
            ]);
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

        sweetalert()->addSuccess('Link referal berhasil dibuat');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Referal $referal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Referal $referal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Referal $referal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Referal $referal)
    {
        //
    }
}

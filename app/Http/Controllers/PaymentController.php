<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
            'nominal_bayar.required' => 'Nominal bayar tidak boleh kosong',
            'nominal_bayar.numeric' => 'Nominal bayar harus berupa angka',
            'file.required' => 'File tidak boleh kosong',
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berupa file dengan format: jpg, jpeg, png',
        ];

        $request->validate([
            'nominal_bayar' => 'required|numeric',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], $message);

        $request->file('file')->storeAs('public/payment', $request->file('file')->hashName());

        DB::table('total_comissions')
            ->where('id', $request->total_comission_id)
            ->decrement('total_balance', $request->nominal_bayar);

        Payment::create([
            'total_comission_id' => $request->total_comission_id,
            'balance_pay' => $request->nominal_bayar,
            'image' => $request->file->hashName()
        ]);

        sweetAlert()->addSuccess('Pembayaran berhasil diupload');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

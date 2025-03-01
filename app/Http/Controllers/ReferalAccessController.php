<?php

namespace App\Http\Controllers;

use App\Models\ReferalAccess;
use App\Models\Referal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferalAccessController extends Controller
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

    public function referalCheck($referal)
    {
        return Referal::where('referal', 'LIKE', '%' . $referal . '%')->first();
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'referal_code' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json($request->errors(), 400);
        }

        $referal_link = $this->referalCheck($request->referal_code);

        if ($referal_link) {
            ReferalAccess::create([
                'referal_id' => $referal_link->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            return response()->json([
                'message' => 'Referal link is valid',
            ], 200);
        }

        return response()->json([
            'message' => 'Referal link not valid',
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReferalAccess $referalAccess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferalAccess $referalAccess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferalAccess $referalAccess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReferalAccess $referalAccess)
    {
        //
    }
}

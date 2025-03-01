<?php

namespace App\Http\Controllers;

use App\Models\Referal;
use App\Models\RegisteredReferal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisteredReferalController extends Controller
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
        $validation = Validator::make($request->all(), [
            'referal_code' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json($request->errors(), 400);
        }

        $referalCodeReference = Referal::where('referal', 'LIKE', '%' . $request->referal_code . '%')->first();

        if ($referalCodeReference) {
            RegisteredReferal::create([
                'referal_id' => $referalCodeReference->id,
            ]);

            return response()->json([
                'message' => 'Referal has been registered',
            ], 200);
        }

        return response()->json([
            'message' => 'Referal code is not valid',
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(RegisteredReferal $registeredReferal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegisteredReferal $registeredReferal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegisteredReferal $registeredReferal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisteredReferal $registeredReferal)
    {
        //
    }
}

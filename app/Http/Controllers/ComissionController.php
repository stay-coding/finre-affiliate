<?php

namespace App\Http\Controllers;

use App\Models\Comission;
use App\Models\Referal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComissionController extends Controller
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
            'comission' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return response()->json($request->errors(), 400);
        }

        $referalCodeReference = Referal::where('referal', 'LIKE', '%' . $request->referal_code . '%')->first();

        if ($referalCodeReference) {
            Comission::create([
                'user_id' => $referalCodeReference->user_id,
                'balance' => $request->comission,
            ]);

            DB::table('total_comissions')
                ->where('user_id', $referalCodeReference->user_id)
                ->increment('total_balance', $request->comission);

            return response()->json([
                'message' => 'Comission has been added',
            ], 200);
        }

        return response()->json([
            'message' => 'Referal code is not valid',
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comission $comission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comission $comission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comission $comission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comission $comission)
    {
        //
    }
}

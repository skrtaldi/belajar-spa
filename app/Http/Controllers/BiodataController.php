<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'umur' => 'required|integer',
            'gender' => 'required'
        ]);

        $biodata = Biodata::create($request->all());

        return response()->json([
            'message' => 'Biodata berhasil disimpan',
            'data' => $biodata
        ], 201);
    }
}


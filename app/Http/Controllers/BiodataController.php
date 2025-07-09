<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        return Biodata::all();
    }
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
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'umur' => 'required|integer',
        'gender' => 'required'
    ]);

    $biodata = Biodata::findOrFail($id);
    $biodata->update($request->all()); //

        return response()->json([
            'message' => 'Biodata berhasil update',
            'data' => $biodata
        ], 201);
}
 public function destroy($id)
    {
        Biodata::destroy($id);
        return response()->json(['message' => 'Produk dihapus']);
    }
}


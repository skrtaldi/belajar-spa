<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return Produk::all();
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'harga' => 'required|numeric',
    ]);

    return Produk::create([
        'nama' => $request->nama,
        'harga' => $request->harga,
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'harga' => 'required|numeric',
    ]);

    $produk = Produk::findOrFail($id);
    $produk->update([
        'nama' => $request->nama,
        'harga' => $request->harga,
    ]);

    return $produk;
}
    public function destroy($id)
    {
        Produk::destroy($id);
        return response()->json(['message' => 'Produk dihapus']);
    }
}


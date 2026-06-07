<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemohon;
use Illuminate\Http\Request;

class PemohonController extends Controller
{
    public function index()
    {
        $pemohons = Pemohon::latest()->get();
        return response()->json([
            'message' => 'Daftar pemohon berhasil diambil',
            'data' => $pemohons
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:pemohons,nik',
        ]);

        $pemohonExist = Pemohon::where('user_id', $request->user()->id)->first();
        if ($pemohonExist) {
            return response()->json(['message' => 'Kamu sudah mengisi profil pemohon sebelumnya!'], 400);
        }

        $pemohon = Pemohon::create([
            'user_id' => $request->user()->id, 
            'nama' => $request->nama,
            'nik' => $request->nik,
        ]);

        return response()->json([
            'message' => 'Profil pemohon berhasil disimpan',
            'data' => $pemohon
        ], 201);
    }
}
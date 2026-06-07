<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisIzin;
use Illuminate\Http\Request;
use App\Models\Pemohon;

class JenisIzinController extends Controller
{
    public function index()
    {
        $jenisIzin = JenisIzin::latest()->get();
        return response()->json([
            'message' => 'Daftar jenis izin berhasil diambil',
            'data' => $jenisIzin
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_izin' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jenisIzin = JenisIzin::create([
            'user_id' => $request->user()->id, 
            'nama_izin' => $request->nama_izin,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'message' => 'Jenis izin berhasil ditambahkan',
            'data' => $jenisIzin
        ], 201);
    }
}
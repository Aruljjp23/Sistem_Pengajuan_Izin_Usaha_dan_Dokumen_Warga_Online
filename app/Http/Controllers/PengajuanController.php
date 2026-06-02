<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Dokumen;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanController extends Controller
{
    public function show($id)
    {
        $pengajuan = Pengajuan::with(['pemohon', 'jenisIzin', 'dokumens'])->find($id);

        if (!$pengajuan) {
            return response()->json([
                'message' => 'Data pengajuan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail pengajuan berhasil diambil',
            'data' => $pengajuan
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Draft,Diproses,Disetujui,Ditolak'
        ]);

        $pengajuan = Pengajuan::find($id);

        if (!$pengajuan) {
            return response()->json([
                'message' => 'Data pengajuan tidak ditemukan'
            ], 404);
        }

        $pengajuan->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Status pengajuan berhasil diperbarui menjadi ' . $request->status,
            'data' => $pengajuan
        ], 200);
    }

    public function index(Request $request)
    {
        $query = Pengajuan::with(['pemohon', 'jenisIzin'])->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('nomor_registrasi', 'like', '%' . $request->search . '%');
        }

        $pengajuans = $query->paginate(10);

        return response()->json([
            'message' => 'Daftar pengajuan berhasil diambil',
            'data' => $pengajuans 
        ], 200);
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);

        if (!$pengajuan) {
            return response()->json([
                'message' => 'Data pengajuan tidak ditemukan'
            ], 404);
        }

        $pengajuan->delete();

        return response()->json([
            'message' => 'Data pengajuan berhasil dihapus'
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemohon_id' => 'required|integer|exists:pemohons,id', 
            'jenis_izin_id' => 'required|integer|exists:jenis_izins,id', 
        ]);

        $nomor_registrasi = 'PERMIT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        
        $pengajuan = Pengajuan::create([
            'pemohon_id' => $request->pemohon_id,
            'jenis_izin_id' => $request->jenis_izin_id,
            'nomor_registrasi' => $nomor_registrasi,
            'status' => 'Draft'
        ]);

        return response()->json([
            'message' => 'Pengajuan berhasil dibuat',
            'data' => $pengajuan
        ], 201);
    }

    public function uploadDokumen(Request $request, $id)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'berkas' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);

        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $path = $file->store('persyaratan', 'public'); 

            $dokumen = Dokumen::create([
                'pengajuan_id' => $id,
                'nama_dokumen' => $request->nama_dokumen,
                'file_path' => $path,
            ]);

            return response()->json([
                'message' => 'Dokumen berhasil diupload',
                'data' => $dokumen
            ], 201);
        }
    }

    public function cetakPdf($id)
    {
        $pengajuan = Pengajuan::with(['pemohon', 'jenisIzin'])->find($id);

        if (!$pengajuan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($pengajuan->status !== 'Disetujui') {
            return response()->json(['message' => 'Surat izin belum disetujui, tidak bisa dicetak'], 400);
        }

        $pdf = Pdf::loadView('pdf.surat_izin', ['pengajuan' => $pengajuan]);

        return $pdf->download('surat-izin-' . $pengajuan->nomor_registrasi . '.pdf');
    }
}

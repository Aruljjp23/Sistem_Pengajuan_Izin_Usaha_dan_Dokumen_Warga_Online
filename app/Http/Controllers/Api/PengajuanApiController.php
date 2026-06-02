<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Dokumen;
use App\Models\Pemohon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengajuanApiController extends Controller
{
    public function verifikasiNik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|digits:16',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $nik = $request->nik;

        if (str_starts_with($nik, '12') || str_starts_with($nik, '35')) {
            return response()->json([
                'status' => 'success',
                'message' => 'NIK Berhasil Diverifikasi di Dukcapil',
                'data' => [
                    'nik' => $nik,
                    'nama_lengkap' => 'Warga Simulasi UTS',
                    'jenis_kelamin' => 'Laki-laki',
                    'alamat' => 'Jl. Informatika No. 404, Kelurahan Kelurahan Digital'
                ]
            ], 200);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'NIK tidak ditemukan atau tidak padan di database Dukcapil.'
        ], 404);
    }

    public function buatPengajuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pemohon_id' => 'required|exists:pemohons,id',
            'jenis_izin_id' => 'required|exists:jenis_izins,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $nomorRegistrasi = 'PERMIT-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $pengajuan = Pengajuan::create([
            'pemohon_id' => $request->pemohon_id,
            'jenis_izin_id' => $request->jenis_izin_id,
            'nomor_registrasi' => $nomorRegistrasi,
            'status' => 'Draft', 
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Draft pengajuan berhasil dibuat.',
            'data' => $pengajuan
        ], 201);
    }

    public function uploadDokumen(Request $request, $id)
    {
        $pengajuan = Pengajuan::find($id);
        if (!$pengajuan) {
            return response()->json(['message' => 'Data pengajuan tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:100',
            'berkas' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            
            $path = $file->store('persyaratan', 'public');

            $dokumen = Dokumen::create([
                'pengajuan_id' => $pengajuan->id,
                'nama_dokumen' => $request->nama_dokumen,
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => round($file->getSize() / 1024), 
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen persyaratan berhasil diunggah.',
                'data' => [
                    'id' => $dokumen->id,
                    'nama_dokumen' => $dokumen->nama_dokumen,
                    'file_url' => asset('storage/' . $dokumen->file_path),
                    'ukuran' => $dokumen->file_size . ' KB'
                ]
            ], 200);
        }
    }

    public function trackStatus($nomor_registrasi)
    {
        $pengajuan = Pengajuan::with(['jenisIzin', 'dokumens'])
            ->where('nomor_registrasi', $nomor_registrasi)
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Nomor registrasi tidak ditemukan. Silakan periksa kembali kode Anda.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data pelacakan ditemukan.',
            'tracking' => [
                'nomor_registrasi' => $pengajuan->nomor_registrasi,
                'jenis_layanan' => $pengajuan->jenisIzin->nama_izin ?? 'Tidak Diketahui',
                'status_saat_ini' => $pengajuan->status, 
                'terakhir_diperbarui' => $pengajuan->updated_at->isoFormat('D MMMM YYYY, HH:mm') . ' WIB',
                'berkas_terlampir' => $pengajuan->dokumens->count() . ' Berkas'
            ]
        ], 200);
    }
}
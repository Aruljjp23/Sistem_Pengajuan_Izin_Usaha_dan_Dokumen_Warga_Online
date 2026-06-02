<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $guarded = [];

    public function jenisIzin()
    {
        return $this->belongsTo(JenisIzin::class, 'jenis_izin_id'); 
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'pengajuan_id'); 
    }

    public function pemohon()
    {        
        return $this->belongsTo(Pemohon::class, 'pemohon_id'); 
    }
}

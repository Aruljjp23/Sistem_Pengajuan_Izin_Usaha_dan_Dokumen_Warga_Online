<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    protected $fillable = [
        'user_id', 
        'nama',
        'nik',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

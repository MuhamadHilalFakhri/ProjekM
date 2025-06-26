<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPd extends Model
{
    use HasFactory;

    protected $table = 'pds';
    protected $fillable = [
        'id_satker',
        'jenis_layanan',
        'keterangan',
        'file_path',
    ];
}

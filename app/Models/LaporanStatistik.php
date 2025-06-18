<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanStatistik extends Model
{
    protected $table = 'laporan_statistik';

    protected $primaryKey = 'id_laporan';

    public $incrementing = true;     
    protected $keyType = 'int';     

    protected $fillable = [
        'tanggal_laporan',
        'judul_laporan',
        'deskripsi',
        'file_laporan',
    ];

    public $timestamps = false;
}

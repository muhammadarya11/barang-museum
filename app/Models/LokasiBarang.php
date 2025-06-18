<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBarang extends Model 
{
    use HasFactory;
    
    protected $table = 'lokasi_barang';

    protected $primaryKey = 'id_lokasi';

    protected $fillable = [
        'nama_lokasi',
        'deskripsi'
    ];

    public $timestamps = false;
}

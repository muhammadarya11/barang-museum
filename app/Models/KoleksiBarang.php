<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiBarang extends Model
{
    use HasFactory;

    protected $table = 'koleksi_barang';

    protected $primaryKey = 'id_koleksi';

    protected $keyType = 'int'; 

    public $incrementing = true; 

    protected $fillable = [
        'nama_koleksi',
        'asal_koleksi',
        'tahun_perolehan',
        'deskripsi',
        'kategori',
        'id_lokasi',
        'gambar',
    ];


    public $timestamps = false;

    public function lokasi()
    {
        return $this->belongsTo(LokasiBarang::class, 'id_lokasi', 'id_lokasi');
    }
}


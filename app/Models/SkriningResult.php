<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningResult extends Model
{
    use HasFactory;

    // Tambahkan kode ini agar kolom bisa diisi
    protected $fillable = [
        'evaluation_id',
        'usia',
        'jenis_kelamin',
        'tinggi',
        'berat',
        'bmi',
        'riwayat_diabetes',
        'hipertensi',
        'aktivitas',
        'konsumsi',
        'skor_risiko',
        'kategori',
        'confidence',
    ];
}
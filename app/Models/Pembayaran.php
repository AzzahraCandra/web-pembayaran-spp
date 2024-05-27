<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = "pembayaran";
    protected $fillable =["petugas", "nisn", "tgl_byr", "bulan_awal", "bulan_akhir", "tahun_dibayar", "jumlah_bayar"];

    public function siswa()
    {
        // return $this->belongsTo(Kelas::class, 'id');
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }
    
    public function user()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    protected $table ="Spp";
    protected $primaryKey = 'id_spp';
    protected $fillable =['id_spp','tahun', 'nominal'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_spp');
    }
}

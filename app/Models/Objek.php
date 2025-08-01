<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objek extends Model
{
    use HasFactory;

    protected $table = "objek";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'kendaraan',
        'nomor_polisi',
        'nama_kendaraan',
    ];

    public function alternatif()
    {
        return $this->hasMany(Alternatif::class);
    }
}

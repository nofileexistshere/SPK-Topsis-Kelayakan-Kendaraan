<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = "alternatif";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "objek_id",
        "nama",             // <- Tambahkan ini
        "kendaraan",        // <- Tambahkan ini
        "nomor_polisi",     // <- Tambahkan ini
        "nama_kendaraan",   // <- Tambahkan ini
    ];

    public function objek()
    {
        return $this->belongsTo(Objek::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    public $incrementing = true;
    public $timestamps = false;

    protected $dates = [
        'tgl_check_in',
        'tgl_check_out',
        'tgl_pemesanan',
    ];

    protected $fillable = [
        'kode_pemesanan',
        'id_user',
        'id_kamar',
        'tgl_check_in',
        'tgl_check_out',
        'total_malam',
        'total_harga',
        'pilihan_pembayaran',
        'status_pemesanan',
        'tgl_pemesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }
}

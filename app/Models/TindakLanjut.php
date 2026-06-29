<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TindakLanjut extends Model {
    protected $fillable = ['rekomendasi_id','status','tanggal','keterangan'];
    protected $casts = ['tanggal'=>'date'];
    public function rekomendasi(){ return $this->belongsTo(Rekomendasi::class); }
}

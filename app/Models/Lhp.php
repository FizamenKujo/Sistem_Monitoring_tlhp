<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lhp extends Model {
    protected $fillable = ['no_lhp','tanggal','jenis_pemeriksaan','auditi_id','periode','batas_tindak_lanjut','file_pdf'];
    protected $casts = ['tanggal'=>'date','batas_tindak_lanjut'=>'date'];
    public function auditi(){ return $this->belongsTo(Auditi::class); }
    public function temuans(){ return $this->hasMany(Temuan::class)->orderBy('id', 'asc'); }
    public function rekomendasis(){ return $this->hasMany(Rekomendasi::class)->orderBy('id', 'asc'); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Temuan extends Model {
    protected $fillable = ['lhp_id','uraian','kategori','nilai','kondisi','sebab','akibat','kriteria'];
    public function lhp(){ return $this->belongsTo(Lhp::class); }
    public function rekomendasis(){ return $this->hasMany(Rekomendasi::class)->orderBy('id', 'asc'); }
}

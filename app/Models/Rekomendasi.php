<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Rekomendasi extends Model {
    protected $fillable = ['temuan_id', 'lhp_id', 'ditujukan_kepada', 'uraian_rekomendasi', 'target_waktu'];
    protected $casts = ['target_waktu'=>'date'];
    public function temuan(){ return $this->belongsTo(Temuan::class); }
    public function lhp(){ return $this->belongsTo(Lhp::class); }
    public function tindakLanjuts(){ return $this->hasMany(TindakLanjut::class)->orderBy('id', 'asc'); }
    public function getStatusTerkiniAttribute(): string {
        $tl = $this->tindakLanjuts()->latest('id')->first();
        return $tl ? $tl->status : 'Belum';
    }
}

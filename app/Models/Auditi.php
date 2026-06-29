<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Auditi extends Model {
    protected $fillable = ['nama','kecamatan','penanggung_jawab'];
    public function lhps(){ return $this->hasMany(Lhp::class); }
}

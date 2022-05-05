<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'bangcap_id');
    }

    public function phongBan()
    {
        return $this->belongsTo(PhongBan::class, 'phongban_id');
    }
}

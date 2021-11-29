<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'package_transit',
        'package_pickup',
        'total_packages'
    ];

    
    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}

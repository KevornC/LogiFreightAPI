<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'package_name',
        'package_desc'
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

    public function packagedetails(){
        return $this->hasMany(PackageDetail::Class,'package_id');
    }

}

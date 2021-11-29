<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'User_id',
        'fname',
        'lname',
        'email',
        'trn',
        'address',
        'telephone',
        'dateJoined',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'User_id');
    }

    public function packages(){
        return $this->hasMany(Package::Class,'package_id');
    }

    public function Memberpackages(){
        return $this->hasMany(MemberPackage::Class,'member_id');
    }
    public function MailBoxs(){
        return $this->hasOne(MailBox::class,'member_id');
    }

    public function quickalerts(){
        return $this->hasMany(QuickAlert::class,'member_id');
    }
}

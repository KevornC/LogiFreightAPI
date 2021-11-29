<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'purchase_receipt',
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'mailbox_addr'
    ];
    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}

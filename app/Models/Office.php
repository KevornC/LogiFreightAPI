<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'location',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::Class,'user_id');
    }
}

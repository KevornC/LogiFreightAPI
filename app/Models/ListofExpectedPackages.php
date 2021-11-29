<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListofExpectedPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'date_created'
    ];

    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
}

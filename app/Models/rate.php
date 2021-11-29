<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_fees',
        'rate_per_pound'
    ];

    public function invoicedetails(){
        return $this->hasMany(InvoiceDetail::class,'rate_id');
    }
}

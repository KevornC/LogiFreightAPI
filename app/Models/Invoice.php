<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
    public function invoicedetails(){
        return $this->hasMany(InvoiceDetail::class,'invoice_id');
    }
}

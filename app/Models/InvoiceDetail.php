<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'packagedetails_id',
        'rate_id',
        'custom_fee',
        'handling_fee',
        'Total_price',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function rate(){
        return $this->belongsTo(rate::Class,'rate_id');
    }
    public function packagedetail(){
        return $this->belongsTo(PackageDetail::Class,'packagedetails_id');
    }
}

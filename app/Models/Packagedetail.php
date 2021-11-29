<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packagedetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'quantity',
        'weight',
        'shipper',
        'shipper_address',
        'shipper_TN',
        'Package_TN',
        'est_cost',
        'status',
        'InvoiceStatus',
        'Uploaded_by',
        'date_uploaded',
    ];

    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
    public function invoices(){
        return $this->hasMany(Invoice::class,'packagedetails_id');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Models\Employee;
use PDF;
use App\Models\User;
use App\Models\Member;
use App\Models\MemberPackage;
use App\Models\Mailbox;
use App\Models\QuickAlert;
use App\Models\Package;
use App\Models\Packagedetail;
use App\Models\Office;
use App\Models\Rate;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Storage;

use App\Mail\InvoiceMail;
use App\Mail\TransitMail;
use App\Mail\WarehouseMail;
use Mail;

class PDFController extends Controller {

    function testpdf(Request $request,$id){
    $mid=$id;
    $pd=Packagedetail::with('package','package.member')->where('status','pickup')->where('InvoiceStatus','Invoice Not Generated')->get();
    //     $member=Member::where('User_id',$user_id)->get();
    // foreach ($member as $key) {
    //     # code...
    //     $mid=$key->id;
    // }
    $Iid=Invoice::create([
        'member_id'=>$mid
    ])->id;

    // $pd=Packagedetail::with('package','package.member')->where('status','pickup')->get();
        $rate=Rate::all();
        foreach ($rate as $key) {
            # code...
            $rate=$key->rate_per_pound;
        }
        
    foreach ($pd as $key) {
        if($key->package->member->id==$mid){  
        $sub=$key->quantity*$key->est_cost;
        $rate_per_pound=$rate*$key->weight;
        $total_price=$sub+$request['custom_fee']+$request['handling_fee']+$rate_per_pound;
            InvoiceDetail::create([
                'invoice_id'=>$Iid,
                'packagedetails_id'=>$key->id,
                'rate_id'=>1,
                'custom_fee'=>$request['custom_fee'],
                'handling_fee'=>$request['handling_fee'],
                'Total_price'=>$total_price,
            ]);
        }
    }
    $invoice=Invoice::where('member_id',$mid)->get();
    foreach ($invoice as $key) {
        # code...
        $invoice_id=$key->id;
    }
    $data = InvoiceDetail::with('packagedetail','packagedetail.package','rate')->where('invoice_id',$invoice_id)->get();

    $member=Member::find($mid);

    $pdfname=$member->fname.' '.$member->lname.' invoiceM#'.$mid;
    // share data to view
    view()->share('data',$data);
    $pdf = PDF::loadView('LogiFreightMemberInvoice', $data);
    
    $email=$member->email;
    mail::to($email)->send(new InvoiceMail($pdfname,$pdf));
        
    // download PDF file with download method

    Packagedetail::find($id)->update([
        'InvoiceStatus'=>'Invoice Generated'
    ]);
    // mail::to($email)->send(new InvoiceMail($pdfname));

    return $mid;
    }

    function mailInvoice(Request $request){

        mail::to($request['email'])->send(new InvoiceMail($request['pdf']));
        // mail::to($request['email'])->send(new InvoiceMail($request['pdf']));

        return 1;
    }

    function warehouse(Request $request){
        $pid=Package::create([
            'member_id'=>$request['member_id'],
            'package_name'=>$request['package_name'],
            'package_desc'=>$request['package_desc'],
        ])->id;
        $user=User::Where('id',$request['user_id'])->get();
  
        foreach ($user as $key) {
            # code...
            $user=$key->name;
        }
  
        Packagedetail::create([
          'package_id'=>$pid,
          'quantity'=>$request['quantity'],
          'weight'=>$request['weight'],
          'shipper'=>$request['shipper'],
          'shipper_address'=>$request['shipper_address'],
          'shipper_TN'=>$request['shipper_TN'],
          'Package_TN'=>$request['Package_TN'],
          'est_cost'=>$request['est_cost'],
          'status'=>$request['status'],
          'Uploaded_by'=>$user,
          'date_uploaded'=>date('Y-m-d'),
        ]);
        $res=1;
        // mail::to($request['email'])->send(new WarehouseMail($request['Package_TN']));
        mail::to($request['email'])->send(new WarehouseMail($request['Package_TN']));

        return $res;
    }

    function ship($id){
        
    $package=Packagedetail::find($id)->update([
        'status'=>'transit'
    ]);
    if($package!=1){
    Packagedetail::find($id)->update([
          'status'=>'transit'
      ]);
    }
    $p=Packagedetail::with('package','package.member')->find($id);
    $ptn=$p->Package_TN;
    $email=$p->package->member->email;
    // mail::to($email)->send(new TransitMail());
    mail::to($email)->send(new TransitMail($ptn));
    return $package;
    }




    function memberInvoice($id){
        $data=InvoiceDetail::with('packagedetail','packagedetail.package','packagedetail.package.member','rate')->find($id);
        return $data;
    }
}

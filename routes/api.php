<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Member;
use App\Models\MemberPackage;
use App\Models\Mailbox;
use App\Models\QuickAlert;
use App\Models\Package;
use App\Models\Packagedetail;
use App\Models\Office;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
// use PDF;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',function(Request $request){
    $email=$request['email'];
    $password=$request['password'];
    $result=0;
    if(Auth::attempt(['email'=>$email,'password'=>$password])){
        $result=1;
        $user=User::where('email',$email)->get();
        foreach($user as $info){
            $user_id=$info->id;
        }
        $res=$user_id;
        $office=Office::where('user_id',$user_id)->get();
        if(sizeof($office)!=0){
            foreach($office as $info){
                $office_status=$info->status;
            }
            $res=$user_id.','.$office_status;
        }
        // Session()->put('user_id',$user_id);
        return $res;
    }
    return $result;
});

Route::post('/register',function(Request $request){
    $name=$request['fname'].' '.$request['lname'];
    $username=User::where('name',$name)->count();
    $useremail=User::where('email',$request['email'])->count();
    $trn=Member::where('trn',$request['trn'])->count();
    $tel=Member::where('telephone',$request['telephone'])->count();
    $result=0   ;

    if($username!=1 || $useremail!=1 || $trn!=1 || $tel!=1){
        $uid=User::Create([
            'name'=>$name,
            'email'=>$request['email'],
            'password'=>$request['password'],
        ])->id;

        $id=Member::create([
            'User_id'=>$uid,
            'fname'=>$request['fname'],
            'lname'=>$request['lname'],
            'email'=>$request['email'],
            'address'=>$request['address'],
            'trn'=>$request['trn'],
            'telephone'=>$request['telephone'],
            'dateJoined'=>date('Y-m-d'),
            'status'=>'Active'
        ])->id;

        Mailbox::create([
            'member_id'=>$id,
            'mailbox_addr'=>'FL'.$request['trn'],
        ]);
        MemberPackage::create([
            'member_id'=>$id,
            'package_transit'=>0,
            'package_pickup'=>0,
            'total_packages'=>0
        ]);

        $result=1;
    }
    return $result;
});

Route::post('/LogiField/member/QuickAlert/{id}',function(Request $request,$id){
    $result=1;
    $user_id=$id;
    $member=Member::where('User_id',$user_id)->get();
    foreach ($member as $key) {
        # code...
        $member_id=$key->id;
    }
    $quid=QuickAlert::create([
        'member_id'=>$member_id,
        'purchase_receipt'=>$request['pr'],
    ])->id;
    $result=1;
        // $user_id=1;
    return $result;

});

Route::get('/LogiField/member/warehouse',function(){
    $wPackages=Packagedetail::where('status','warehouse')->get();
    return $wPackages;
});
Route::get('/LogiField/member/transit',function(){
    $tPackages=Packagedetail::where('status','transit')->get();
    return $tPackages;
});
Route::get('/LogiField/member/pickup',function(){
    $pPackages=Packagedetail::where('status','pickup')->get();
    return $pPackages;
});
Route::post('/LogiFreight/member/track/{id}',function($id){
  $package=Packagedetail::with('package')->where('Package_TN',$id)->get();
  if(sizeof($package)==0){
    $package=Packagedetail::with('package')->where('shipper_TN',$id)->get();
  }
  return $package;
});

// Route::get('/LogiField/member/numbers',function(){
//     $total=MemberTotalPackage::all();
//     return $total;
// });


Route::post('/LogiFreight/member/search/{id}',function($id){
    $member=User::where('name','like','%'.$id.'%')->get();
    // if($member==null){
    //     $member=User::where('name',$id)->get();
    // }
    if($member!=null){
    foreach ($member as $key) {
        # code...
        $user_id=$key->id;
    }
    $member=Member::where('User_id',$user_id)->get();
    }
    return $member;
  });

  Route::get('/LogiFreight/members',function(){
      $members=Member::all();

      return $members;
  });
  Route::post('/LogiFreight/package',[App\Http\Controllers\PDFController::class,'warehouse']);

Route::get('/Logifreight/Package/Ship/{id}',[App\Http\Controllers\PDFController::class,'ship']);
Route::get('/Logifreight/Package/Pickup/{id}',function($id){

    $package=Packagedetail::find($id)->update([
        'status'=>'pickup'
    ]);
    if($package!=1){
    Packagedetail::find($id)->update([
          'status'=>'pickup'
      ]);
    }
    return $package;

});

//dashboard

Route::get('/LogiFreight/Member/Total/{id}',function($id){

    $member=Member::where('User_id',$id)->get();
    foreach ($member as $key) {
        # code...
        $id=$key->id;
    }
    $count=Package::where('member_id',$id)->count();
    $countt=0;
    $countp=0;
    $packages=Packagedetail::with('package')->get();

    foreach ($packages as $key) {
        # code...
        if($key->package->member_id==$id){
            if($key->status=='transit'){
                $countt+=1;
            }
            if($key->status=='pickup'){
                $countp+=1;
            }
        }
    }

    MemberPackage::where('member_id',$id)->update([
        'package_transit'=>$countt,
        'package_pickup'=>$countp,
        'total_packages'=>$count
    ]);
    $total=MemberPackage::where('member_id',$id)->get();

    return $total;
});

Route::get('/LogiFreight/MainOffice',function(){
    $packages=Packagedetail::with('package')->where('status','pickup')->orderBy('updated_at','desc')->get();
    $totalware=Packagedetail::where('status','warehouse')->count();
    $totaltransit=Packagedetail::where('status','transit')->count();
    $totalshipped=Packagedetail::where('status','pickup')->count();

    $result=array(
        'packages'=>$packages,
        'totalware'=>$totalware,
        'totaltransit'=>$totaltransit,
        'totalshipped'=>$totalshipped
    );

    return $result;
});

Route::get('/LogiFreight/LocalOffice/list',function(){
    $packages=Packagedetail::with('package')->where('status','pickup')->get();
    return $packages;
});

Route::get('/LogiFreight/LocalOffice/QuickAlerts',function(){
    $qa=QuickAlert::with('member')->get();
    return $qa;
});
Route::post('/LogiFreight/LocalOffice/list/Invoice',function(Request $request){

    $package=Packagedetail::with('package','package.member')->where('status','pickup')->where('InvoiceStatus','Invoice Not Generated')->get();
    $data=array(
        'member_id'=>$request['member'],
        'package'=>$package
    );
    return $data;
});

Route::post('/LogiFreight/Generate/Invoice/{id}',[\App\Http\Controllers\PDFController::class,'testpdf']);

Route::post('/Logifreight/Custom/{id}',function($id){
    $p=PackageDetail::find($id);
    return $p;
});


Route::post('/LogiFreight/Mail/Member/Invoice/{id}',[\App\Http\Controllers\PDFController::class,'memberInvoice']);


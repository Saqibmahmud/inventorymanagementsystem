<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Purchases extends Model
{ 
    public const STATUS_PENDING = 'pending';
    public const STATUS_PARTIALLY_RECEIVED = 'partially_received'; 
    public const STATUS_COMPLETE = 'complete';
    public const STATUS_CANCELLED = 'cancelled';



    protected $fillable=['supplier_id','purchase_date','total_amount','status','paid_with','created_by','updated_by','branch_id'];
public function supplier(){
    return $this->belongsTo(Supplier::class)  ;
}
public function user(){
    return $this->belongsTo(User::class,'created_by','id');
}
public function updated_user(){
    return $this->belongsTo(User::class,'updated_by','id');
}
public function purchase_items(){
    return $this->hasMany(Purchases_Items::class,'purchase_id','id') ;
} 
public function stock_transactions(){
    return $this->morphMany(Stock_Transactions::class,'reference_id') ;
}

public function branches(){
    return $this->belongsTo(Branches::class,'branch_id') ;
}
}

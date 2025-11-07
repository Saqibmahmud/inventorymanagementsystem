<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sales extends Model
{ 
    PUBLIC const SALES_PENDING_STATUS='pending';
    PUBLIC  const SALES_COMPLETE_STATUS='complete';
    PUBLIC Const SALES_CANCELLED_STATUS='cancelled';

    protected $fillable=['customer_id','sale_date','total_amount','due_amount','status','paid_with','created_by','updated_by','branch_id'];
    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
     public function updating_user(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function sales_item(){
        return $this->hasMany(Sales_item::class,'sale_id','id') ;
    }
    public function stock_transactions(){
        return $this->morphMany(Stock_Transactions::class,'reference_id') ;
    }

}

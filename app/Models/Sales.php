<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sales extends Model
{
    protected static function booted()
{
    static::addGlobalScope('branch', function ($builder) {
        if(Auth::check() && Auth::user()->branch_id) {
            $builder->where('branch_id', Auth::user()->branch_id);
        }
    });
}

    protected $fillable=['customer_id','sale_date','total_amount','status','created_by'];
    public function User(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function Customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function Sales_item(){
        return $this->belongsTo(Sales_item::class,'sale_id','id') ;
    }
    public function stock_transactions(){
        return $this->morphMany(Stock_Transactions::class,'reference_id') ;
    }

}

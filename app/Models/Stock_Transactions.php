<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Stock_Transactions extends Model

{
    protected $table = 'stock_transactions';
    
    public const TRANSACTION_TYPE_PURCHASE='purchase';
    public const TRANSACTION_TYPE_SALE='sale';
    public const TRANSACTION_TYPE_ADJUSTMENT ='adjustment';

protected static function booted()
{
    static::addGlobalScope('branch', function ($builder) {
        if(Auth::check() && Auth::user()->branch_id) {
            $builder->where('branch_id', Auth::user()->branch_id);
        }
    });
}


    protected $fillable=['product_id','transaction_type','quantity','transaction_date','reference_id','reference_type'];

public function products(){
    return $this->belongsTo(Products::class,'product_id','id') ;
}
public function reference(){
    return $this->morphTo() ;
}

}


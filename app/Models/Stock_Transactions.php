<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock_Transactions extends Model
{
    protected $fillable=['product_id','transaction_type','quantity','transaction_date','reference_id','reference_type'];

public function products(){
    return $this->belongsTo(Products::class,'product_id','id') ;
}
public function reference(){
    return $this->morphTo() ;
}

}


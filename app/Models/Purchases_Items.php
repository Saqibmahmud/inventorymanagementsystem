<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Purchases_Items extends Model
{ protected $table='purchases_items';

    protected static function booted()
{
    static::addGlobalScope('branch', function ($builder) {
        if(Auth::check() && Auth::user()->branch_id) {
            $builder->where('branch_id', Auth::user()->branch_id);
        }
    });
}

    protected $fillable=['purchase_id','product_id','quantity','purchase_price','total_price','received_quantity'];

public function purchase(){
    return $this->belongsTo(Purchases::class,'purchase_id','id') ;
}

public function product(){
return $this->belongsTo(Products::class,'product_id','id') ;

}





}

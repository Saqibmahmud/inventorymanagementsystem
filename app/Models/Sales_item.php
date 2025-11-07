<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sales_item extends Model
{
    protected static function booted()
{
    static::addGlobalScope('branch', function ($builder) {
        if(Auth::check() && Auth::user()->branch_id) {
            $builder->where('branch_id', Auth::user()->branch_id);
        }
    });
}

    protected $fillable=['sale_id','product_id','quantity','selling_price','total_price'];

public function sale(){
    return $this->belongsTo(Sales_item::class,'sale_id','id') ;
}



}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases_Items extends Model
{
    protected $fillable=['purchase_id','product_id','quantity','purchase_price','total_price'];

public function purchase(){
    return $this->belongsTo(Purchases::class,'purchase_id','id') ;
}

}

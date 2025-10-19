<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $fillable=['supplier_id','purchase_date','total_amount','status','created_by'];
public function Supplier(){
    return $this->belongsTo(Supplier::class)  ;
}
public function user(){
    return $this->belongsTo(User::class,'created_by','id');
}
public function Purchase_items(){
    return $this->hasMany(Purchases_Items::class);
} 
public function stock_transactions(){
    return $this->morphMany(Stock_Transactions::class,'reference_id') ;
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable=['supplier_name','contact_name','email','phone','address'];
    public function Purchases(){
        return $this->hasMany(Purchases::class,'supplier_id','id') ;
    }
}

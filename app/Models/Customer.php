<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =['customer_name','customer_email','customer_phone'];
    public function Sales(){
        return $this->hasMany(Sales::class);
    }
}

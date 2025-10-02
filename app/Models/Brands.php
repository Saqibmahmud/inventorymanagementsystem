<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $fillable=['brand_name','brand_code','status'] ;

    public function products(){
        return $this->hasMany(Products::class) ;
    }
}

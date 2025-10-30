<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    protected static function booted()
{
    static::addGlobalScope('branch', function ($builder) {
        if(Auth::check() && Auth::user()->branch_id) {
            $builder->where('branch_id', Auth::user()->branch_id);
        }
    });
}

    protected $fillable=['supplier_name','contact_name','email','phone','address'];
    public function purchases(){
        return $this->hasMany(Purchases::class,'supplier_id','id') ;
    }
    public function products(){
        return $this->hasMany(Products::class);
    }
}

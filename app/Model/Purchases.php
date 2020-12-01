<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    public function supplier(){
    	return $this->belongsTo(Suppliers::class,'supplier_id','id');
    }
    public function unit(){
    	return $this->belongsTo(Units::class,'unit_id','id');
    }
    public function category(){
    	return $this->belongsTo(Categorys::class,'category_id','id');
    }

    public function product(){
    	return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}

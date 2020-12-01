<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    public function category(){
    	return $this->belongsTo(Categorys::class,'category_id','id');
    }

    public function product(){
    	return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}

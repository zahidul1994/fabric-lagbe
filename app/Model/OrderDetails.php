<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','seller_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Model\Product','product_id');
    }
}

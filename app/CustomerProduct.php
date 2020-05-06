<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{

    protected $table = 'customer_product';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}

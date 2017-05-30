<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = array('id', 'name', 'price');

    public $timestamps = false;
}

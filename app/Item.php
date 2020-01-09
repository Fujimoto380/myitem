<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'itemname' => 'required',
        'code' => 'required|min:7|max:7',
    );
}

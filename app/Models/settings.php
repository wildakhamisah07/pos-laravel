<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    //
    //elequent: Objeck Relaction Mapping
    //Query Builder:

    // protected $table = "settings";// select * from settings
    //insert into settings (phone_number,address)values()
    protected $fillable = [
        'app_name',
        'phone_number',
        'address',
    ];
}

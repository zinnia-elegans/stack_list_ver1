<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';

    protected $fillable = ['name','day'];
}

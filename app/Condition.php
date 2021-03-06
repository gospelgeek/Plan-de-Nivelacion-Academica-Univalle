<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table = 'conditions';

    protected $primarykey = 'id';

    protected $fillable = [
        'id', 
        'name', 
    ];
}

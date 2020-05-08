<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    protected $table = 'entrances';

    protected $primaryKey = "id";

    protected $fillable = [
        'id','hostname', 'name', 'location', 'created_at', 'updated_at'
    ];
}

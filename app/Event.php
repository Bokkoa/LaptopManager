<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $primaryKey = "id";

    protected $fillable = [
        'employee', 'uid', 'asset', 'entrance_id',
        'created_at', 'updated_at'
    ];

    public function entrance(){
        
        return $this->belongsTo('App\Entrance','entrance_id', 'id');
    }
}

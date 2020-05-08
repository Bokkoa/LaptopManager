<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $table = 'laptops';

    protected $primaryKey = "id";

    protected $fillable = [
        'id','asset', 'creation_user', 'owner',
        'created_at', 'updated_at'
    ];
  
    public function asignation(){
      return $this->hasOne('App\Asignation');
    }
}

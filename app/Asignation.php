<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignation extends Model
{
    protected $table = 'asignations';

    protected $primaryKey = "id";

    protected $fillable = [
        'employee_number', 'employee', 'uid', 'laptop_id', 'user_id',
        'created_at', 'updated_at', 'id'
    ];
    public function laptop()
    {                                       //FK            //PK
      return $this->belongsTo('App\Laptop','laptop_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}

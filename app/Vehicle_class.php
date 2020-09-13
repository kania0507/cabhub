<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_class extends Model
{
    //

    protected $fillable = [
        'name'
    ]; 

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle_class');
    }
}

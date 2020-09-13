<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = [ 
        'mark', 'prod_year'];

    public function vehicle_class()
    {
        return $this->hasOne('App\Vehicle_class');
    }
}

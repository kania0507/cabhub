<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'name', 'phone', 'date', 'time', 'startplace', 'endplace', 'vehicle_class_id'//, 'payementmethod', 'email', 'desc', 'numofpassengers'
    ]; 
    protected $primaryKey = 'id';
    protected $table = 'bookings';

    public function vehicle_class()
    {
        return $this->hasOne('App\Vehicle_class');
    }

}

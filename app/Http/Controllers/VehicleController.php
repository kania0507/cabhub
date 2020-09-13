<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

use Validator;

class VehicleController extends Controller
{
    //

    

    public function index(){
		$vehicles = \App\Vehicle::whereNotNull('id');

		//if(request()->has('mark'))
        //    $vehicles->where('mark','like','%'.request('mark').'%');

        //if(request()->has('status'))
        //    $tasks->whereStatus(request('status'));

        //$tasks->orderBy(request('sortBy'),request('order'));

		return $vehicles->paginate(request('pageLength'));
	}

}

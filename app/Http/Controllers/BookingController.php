<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class BookingController extends Controller
{
    //
    
	public function index(){
		$bookings = \App\Booking::whereNotNull('id');
        /*
		if(request()->has('title'))
			$tasks->where('title','like','%'.request('title').'%');

        if(request()->has('status'))
            $tasks->whereStatus(request('status'));

        $tasks->orderBy(request('sortBy'),request('order'));
        */
		return $bookings->paginate(request('pageLength'));
	}

    public function store(Request $request){

        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:tasks',
            'phone' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required',
            'start' => 'required',
            'end' => '',
            'vehicle_class_id' => '1'
        ]);

        //if($validation->fails())
        //	return response()->json(['message' => $validation->messages()->first()],422);

        //$user = \JWTAuth::parseToken()->authenticate();
        $booking = new \App\Bookings;
        $booking->fill(request()->all());
        //$booking->uuid = generateUuid();
        //$booking->user_id = $user->id;
        $booking->save();
        
        return response()->json(['message' => 'Booking added!', 'data' => $booking]);
    }
}

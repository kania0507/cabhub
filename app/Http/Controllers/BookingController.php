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
            'name' => 'required',
            'phone' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required',
            'startplace' => 'required',
            'endplace' => 'required',
            'vehicle_class_id' => 'required'
        ]);
        

       // if($validation->fails())
        //	return response()->json(['message' => $validation->messages()->first()],422);

        try {
        //$user = \JWTAuth::parseToken()->authenticate();
        $booking = new \App\Booking;
///        $booking->name = $request->name;

   //     Booking::create($request->all());
        $booking->fill(request()->all());
        //$booking->uuid = generateUuid();
        //$booking->user_id = $user->id;
       
        $booking->save();
        //print_r($booking);
        } 
        catch(\Exception $e){ 
           echo $e->getMessage();   // insert query
        }
//        return response()->json([$request->all()]);
        return response()->json(['message' => 'Booking added!', 'data' => $booking]);
    }
}

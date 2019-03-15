<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;
use App\Mail\RSVPEmail;
use Illuminate\Support\Facades\Mail;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//validate data
		$request->validate([
			'name_first'=>'required',
			'name_last'=> 'required',
			'name_title' => 'required',
			'email' => 'required',
			'attending' => 'required|integer|between:0,1'
		]);
		
		
		//check if email is already registered
		$get = Attendee::select()->where('email', $request->get("email"))->get();
		if($get->count() > 0){
			return redirect('/')->with('error', 'You have already registered!');
		}
		
		
		$attendee = new Attendee([
			'name_first' => $request->get('name_first'),
			'name_last'=> $request->get('name_last'),
			'name_title'=> $request->get('name_title'),
			'email'=> $request->get('email'),
			'country'=> $request->get('country'),
			'attending'=> $request->get('attending')
		]);
		$success = $attendee->save();
		
		$objRSVP = new \stdClass();
        $objRSVP->sender = 'Host';
		$objRSVP->receiver = $request->get('name_first');
		
        Mail::to($request->get('email'))->send(new RSVPEmail($objRSVP));
		
		return redirect('/')->with('success', 'Thank you for your reply!');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

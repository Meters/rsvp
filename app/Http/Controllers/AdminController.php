<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;

class AdminController extends Controller
{
    //
	public function index(){
		
		$attendees = Attendee::all();

        return view('admin', compact('attendees'));
	}
	
	public function export()
	{
		$headers = array(
			"Content-type" => "text/csv",
			"Content-Disposition" => "attachment; filename=file.csv",
			"Pragma" => "no-cache",
			"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
			"Expires" => "0"
		);

		$attendees = Attendee::all();
		$columns = array('ID', 'First Name', 'Last Name', 'Title', 'Email', 'country', 'attending', 'checked_in_at', 'created_at', 'updated_at');

		$callback = function() use ($attendees, $columns)
		{
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);

			foreach($attendees as $attendee) {
				fputcsv($file, array(
					$attendee->id,
					$attendee->name_first,
					$attendee->name_last,
					$attendee->name_title,
					$attendee->email,
					$attendee->country,
					$attendee->attending,
					$attendee->checked_in_at ? $attendee->checked_in_at : "null",
					$attendee->created_at,
					$attendee->updated_at,
				));
			}
			fclose($file);
		};
		return response()->stream($callback, 200, $headers);
	}
	
}

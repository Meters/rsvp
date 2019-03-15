<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = [
	'name_first',
	'name_last',
	'name_title',
	'email',
	'country',
	'attending',
	'checked_in_at'
  ];
}

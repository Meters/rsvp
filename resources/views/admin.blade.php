@extends('layout.mainlayout')
@section('content')
	<table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>First Name</td>
          <td>Last Price</td>
          <td>Email</td>
          <td>Country</td>
          <td>Attending</td>
          <td>Registered</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
	
	<tbody>
        @foreach($attendees as $attendee)
        <tr>
            <td>{{$attendee->id}}</td>
            <td>{{$attendee->name_first}}</td>
            <td>{{$attendee->name_last}}</td>
            <td>{{$attendee->email}}</td>
            <td>{{$attendee->country}}</td>
            <td>{{$attendee->attending}}</td>
            <td>{{$attendee->created_at}}</td>
            <td>
				
				@if ($attendee->checked_in_at != null)
					{{$attendee->checked_in_at}}
				@else
					
				
                <form action="{{ route('attendees.checkin' )}}" method="post">
                  @csrf
				  <input type="hidden" name="id" value="{{ $attendee->id }}" />
				  <input type="hidden" name="bool" value="1" />
                  <button class="btn btn-danger" type="submit">Checkin</button>
                </form>
				@endif
            </td>
        </tr>
        @endforeach
    </tbody>
	
	</table>
@endsection
<b></b>
@extends('layout.default')

@section('title')
    <title>Dashboard</title>
@endsection

@section('script')
    <style type="text/css">
		.vcenter {
		    display: inline-block;
		    vertical-align: middle;
		    float: none;
		}
    </style>
@endsection

<!-- Use corresponding dashboard for specified role -->
@section('content')
	@if(isset($id))
		@if($role == 'patient')
			@include('home.dashboardForPatient', ['id'=>$id, 'name'=>$name, 'role'=>$role])			
		@elseif($role == 'doctor')
			@include('home.dashboardForDoctor', ['id'=>$id, 'name'=>$name, 'role'=>$role])
		@elseif($role == 'nurse')
			@include('home.dashboardForNurse', ['id'=>$id, 'name'=>$name, 'role'=>$role])
		@elseif($role == 'pharmacist')
			@include('home.dashboardForPharmacist', ['id'=>$id, 'name'=>$name, 'role'=>$role])
		@endif
	@else
		<h2>You are not authorised for this action.</h2>		
	@endif
@endsection



@stop
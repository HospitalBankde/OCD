@extends('layout.default')

@section('title')
    <title>กำลังตรวจ</title>
@endsection

@section('script')

@endsection

@section('content')
        <div class="container-fluid">  
	        <div class="row">
		        <a href="/dashboard/todayAppointmentList"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ รายการนัดแพทย์วันนี้ </a>       
		        	<h2 >กำลังตรวจ: {{$firstname . ' ' . $lastname}}</h2>	        		        
	        </div>          
       		<hr>
       		@if(isset($pat_id) && isset($weight))
	        <div class="row">
	        	<div class="panel panel-default">
	  				<div class="panel-body">
			        	<h3>ข้อมูลผู้ป่วยเบื้องต้น</h3>
				        	<br>
					        @include('officer.subHTML_PatientInfo', [
					            'firstname' => $firstname,
					            'lastname' => $lastname,
					            'weight' => $weight,
					            'height' => $height,
					            'temperature' => $temperature,
					            'bloodpressure' => $bloodpressure,
					            'heartrate' => $heartrate,
					            'allergys' => $allergys
					      		  ])  
		      		  </div>
		      	</div>
	        </div>	        
	    	<hr>
	        <div class="row" align="center">
	        	<h4>&emsp;&emsp;ตรวจเสร็จสิ้น ?&emsp;&emsp; <a href="/dashboard/createPrescription/{{$pat_id}}/{{$app_id}}" class="btn btn-warning">จ่ายยา</a>  </h4>	        	       	 
	        </div>
	        @else
	        <div class="row">
		        <div class="alert alert-danger" role="alert">
	                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	                <span class="sr-only">Error:</span>
	                ผู้ป่วย {{$firstname . ' '. $lastname}} ยังไม่มีข้อมูลเบื้องต้น                  
	        	</div>
	        </div>
	        @endif
        </div>
        
@endsection

@stop
@extends('layout.default')

@section('title')
	<title>รายการนัดแพทย์</title>
@endsection

@section('script')
	<script type="text/javascript">
		function clickHello(pat_id) {
			alert(pat_id);
		}
	</script>	
@endsection

@section('content')
	
	<div class="container">
		<div class="row">
			@if($role == 'nurse')
				<a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>				
				หรือ <a href="/dashboard/searchAppointment">    ค้นหาใหม่</a>
			@else
				<a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>
			@endif
			@if($role == 'patient')
				<h2>รายการนัดแพทย์</h2>
			@elseif($role == 'doctor')
				@if(isset($today))
					<h2>รายการนัดแพทย์ผู้ป่วยวันนี้ ({{$today}})</h2>
				@else
					<h2>รายการนัดแพทย์ผู้ป่วย</h2>
				@endif
			@elseif($role == 'nurse')
				<h2>รายการนัดแพทย์</h2>
				@if(isset($pat_search_name))
					<h4>ผลการค้นหาชื่อผู้ป่วย: {{$pat_search_name}}</h4>
				@endif
				@if(isset($doc_search_name))
					<h4>ผลการค้นหาชื่อแพทย์: {{$doc_search_name}}
				@endif
			@endif
			<br>
            <br>
			@if(!empty($appointments))
				@if($role == 'patient')
					<table class="table table-bordered table-hover" id="appointments">
						<thead>
							<tr bgcolor="#4879CC">
								<th>#</th>		
								<th>วัน</th>						
								<th>เวลา</th>
								<th>แพทย์</th>
								<th>สาขา</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($appointments as $index => $app)
							<tr>
								<td>{{$index+1}}.</td>																							
								<td>{{$app->app_date}}</td>
								<td>{{$app->app_time}}</td>
								<td>{{$app->doc_name}}</td>
								<td>{{$app->dep_name}}</td>
								<td>
									<form  action="/appointment/cancel" id="doc_cancel_form" method="post">
									    <input name="app_id" id="app_id" type="hidden" value="{{$app->app_id}}"/>
									    <a href="javascript:;" onclick="parentNode.submit();">ยกเลิก</a>
									</form>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>		
				@elseif($role == 'doctor')		

					@if(isset($today))
						<table class="table table-bordered table-hover" id="appointments">
						<thead>
							<tr bgcolor="#4879CC">
								<th>#</th>								
								<th>เวลา</th>
								<th>ชื่อผู้ป่วย</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($appointments as $index => $app)
							<tr onclick="window.location = 'todayAppointmentList/patientDiagnosis/{{$app->pat_id}}/{{$app->app_id}}' " style="cursor: pointer;">
								<td>{{$index+1}}.</td>																							
								<td>{{$app->app_time}}</td>
								<td>{{$app->pat_name}}</td>								
							</tr>
							@endforeach
							
						</tbody>
					</table>
					@else
						<table class="table table-bordered table-hover" id="appointments">
						<thead>
							<tr bgcolor="#4879CC">
								<th>#</th>
								<th>วัน</th>
								<th>เวลา</th>
								<th>ชื่อผู้ป่วย</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($appointments as $index => $app)
							<tr>
								<td>{{$index+1}}.</td>															
								<td>{{$app->app_date}}</td>
								<td>{{$app->app_time}}</td>
								<td>{{$app->pat_name}}</td>	
								<td>
									<form  action="/appointment/cancel" id="doc_cancel_form" method="post">
									    <input name="app_id" id="app_id" type="hidden" value="{{$app->app_id}}"/>
									    <a href="javascript:;" onclick="parentNode.submit();">ยกเลิก</a>
									</form>
								</td>							
							</tr>
							@endforeach
							
						</tbody>
					</table>
					@endif					
				@elseif($role == 'nurse') 
					<!-- Searching for appointments to cancel -->
					<table class="table table-bordered table-hover" id="appointments">
						<thead>
							<tr bgcolor="#4879CC">
								<th>#</th>		
								<th>ผู้ป่วย</th>						
								<th>แพทย์</th>
								<th>แผนก</th>
								<th>วันที่จอง</th>
								<th>เวลาที่จอง</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($appointments as $index => $app)
							<tr>
								<td>{{$index+1}}.</td>	
								<!-- <td>{{$app->pat_name}}</td> -->
								@if(isset($pat_search_name))
									<td>{!!str_ireplace($pat_search_name, '<span class="highlight">' . $pat_search_name . '</span>', $app->pat_name)!!}
								@else
									<td>{{$app->pat_name}}</td>
								@endif
								@if(isset($doc_search_name))
									<td>{!!str_ireplace($doc_search_name, '<span class="highlight">' . $doc_search_name . '</span>', $app->doc_name)!!}
								@else
									<td>{{$app->doc_name}}</td>
								@endif
								<td>{{$app->dep_name}}</td>																														
								<td>{{$app->app_date}}</td>
								<td>{{$app->app_time}}</td>														
								<td>
									<form  action="/appointment/cancel" id="doc_cancel_form" method="post">
									    <input name="app_id" id="app_id" type="hidden" value="{{$app->app_id}}"/>
									    <a href="javascript:;" onclick="parentNode.submit();">ยกเลิก</a>
									</form>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				@endif
			@elseif('role' == 'patient')
				<h2>ท่านไม่มีรายการนัดแพทย์ในขณะนี้</h2>
				<h3>ท่านสามารถนัดแพทย์ได้<a href="/appointment">ที่นี่</a></h3>
			@endif
		</div>
	</div>


@endsection

@section('bottom-script')
	<style type="text/css">
		.highlight { background-color: yellow; }
	</style>
@endsection
@stop
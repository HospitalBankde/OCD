@extends('layout.default')

@section('title')
	<title>รายการนัดแพทย์</title>
@endsection

@section('content')
	
	<div class="container">
		<div class="row">
			<a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>
			<h2>รายการนัดแพทย์</h2>
            <br>
			@if(!empty($appointments))
				<table class="table" id="appointments">
					<thead>
						<tr>
							<th>#</th>
							<th>วัน</th>
							<th>เวลา</th>
							<th>แพทย์</th>
							<th>สาขา</th>
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
						</tr>
						@endforeach
						
					</tbody>
				</table>				
			@else
				<h2>ท่านไม่มีรายการนัดแพทย์ในขณะนี้</h2>
				<h3>ท่านสามารถนัดแพทย์ได้<a href="/appointment">ที่นี่</a></h3>
			@endif
		</div>
	</div>


@endsection

@stop
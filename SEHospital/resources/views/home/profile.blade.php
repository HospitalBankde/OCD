@extends('layout.default')

@section('title')
    <title>Profile</title>
@endsection

@section('script')    
@endsection

@section('content')
<div class="container">
        <div class="row">
        <a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>
        <br>
        <br>
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>โปรไฟล์ของฉัน</h2>
                    <br>
                </div>
                <div class="panel-body">
                @if(isset($name))
	                <h4>ชื่อ : {{$name}}</h4>
	                <h4>นามสกุล : {{$surname}}</h4>
	                <h4>รหัสประชาชน : {{$ssn}}</h4>
                @if(isset($dep))
                	<h4>แผนก : {{$dep}}</h4>
                @endif
                	<h4>เบอร์โทรศัพท์ : {{$tel}}</h4>
                	<h4>email : {{$email}}</h4>
                @endif
                </div>
                </div>
            </div>
        </div>
</div>
@endsection

@stop
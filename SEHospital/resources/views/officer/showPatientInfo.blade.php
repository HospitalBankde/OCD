@extends('layout.default')

@section('title')
    <title>Patient Info</title>
@endsection

@section('script')
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-1" align='center'>
                <h2><u>ข้อมูลเบื้องต้นของผู้ป่วย</u></h2>
                <br>
                <label class="control-label">                
                    ชื่อ : {{$firstname}}  {{$lastname}}<br><br>
                    น้ำหนัก : {{$weight}}<br><br>
                    ส่วนสูง : {{$height}}<br><br>
                    อุณหภูมิ : {{$temperature}}<br><br>
                    ความดันโลหิต : {{$bloodpressure}}<br><br>
                    อัตราการเต้นของหัวใจ : {{$heartrate}}<br>
                </label>
            </div>
        </div>
@endsection

@stop
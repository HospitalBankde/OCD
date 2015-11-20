@extends('layout.default')

@section('title')
    <title>Patient Info</title>
@endsection

@section('script')
    {!! Html::script('js/showPatientInfo.js') !!}
    {!! Html::script('bootstrap-typeahead/bootstrap3-typeahead.js') !!}
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

        <table class="table" id="allergy_table">
        <br>
            <label class="lead"><b>รายการยาที่แพ้</b></label>&nbsp&nbsp<a href="#">แก้ไข</a>
            <thead>
            <tr>
                <th>id</th>
                <th>ชื่อยา</th>
                <th>อาการที่แพ้</th>
            </tr>            
            </thead>
            <tbody>
                @foreach($allergys as $allergy)
                    <tr>
                        <th>{{$allergy['id']}}</th>
                        <th>{{$allergy['name']}}</th>
                        <th>{{$allergy['description']}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection

@stop
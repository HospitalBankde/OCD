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
    <div class="col-md-8 col-md-offset-1" align='left'>
        <h2><u>ข้อมูลเบื้องต้นของผู้ป่วย</u></h2>
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
@endsection

@stop
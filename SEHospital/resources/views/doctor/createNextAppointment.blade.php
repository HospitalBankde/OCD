/**
* Created by PhpStorm.
* User: AunN
* Date: 9/18/15 AD
* Time: 1:40 AM
*/

@extends('layout.default')

@section('title')
    <title>นัดแพทย์</title>
@endsection

@section('script')
    {!! Html::script('js/time_appointment.js') !!}
    {!! Html::style('jquery-ui/jquery-ui.min.css') !!}
    {!! Html::script('jquery-ui/jquery-ui.min.js') !!}
    <style type="text/css">
        .ui-datepicker {
            background: #ffffff;
            border: 1px solid #555;
        }
        .ui-widget-header {
            background: none;
            background-color: #000000;
        }
    </style>
@endsection

@section('content')

    <form  action="/appointment/complete" id="app_submit" onsubmit="return isTimeSelect()" method="post">

    <!-- Fix doctor -->
    <input name="select_doc" id="select_doc" type="hidden" value="{{ $doc_id }}"/>
    <input name="select_date" id="select_date" type="hidden" value=""/>
    <input name="pat_id" id="pat_id" type="hidden" value="{{$pat_id}}">
    <input name="pat_name" id="pat_name" type="hidden" value="{{$pat_name}}">

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>เลือกเวลาพบแพทย์</h2>
            <br>
            <h4 class="lead" style="color:cornflowerblue;">แพทย์ : {{$doc_name . " " . $doc_surname}}</h4>
            <h4 class="lead" style="color:cornflowerblue;">ผู้ป่วย : {{$pat_name . " " . $pat_surname}}</h4>
            <div id="date" aria-describedby="helpBlock" ></div>
            <span id="helpBlock" class="help-block">กรุณาเลือกวัน</span>
            <label class="radio-inline">
                <input type="radio" name="select_time" id="timeRadio1" value="1" disabled> เช้า
            </label>
            <label class="radio-inline">
                <input type="radio" name="select_time" id="timeRadio2" value="2" disabled> บ่าย
            </label>
            <br><br>
            <button type="submit" class="btn btn-warning">
                นัดแพทย์
            </button>
        </div>
    </div>

    </form>
@endsection


@stop
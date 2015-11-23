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
<!-- <meta http-equiv="refresh" content="2;url=/dashboard" /> -->
    <div class="row">
        <div class="col-md-8 col-md-offset-1">            
            <div class="alert alert-success" role="alert"><h3 class="lead"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  คุณได้ทำการแจ้งการลาพักเรียบร้อย</h3></div>
            <!-- <h4>กำลังนำท่านไปหน้า Dashboard...</h4> -->
        </div>
    </div>
    <div class="row">
        <table class="table" id="cancelList_table">
            <br>
            <label class="lead"><b>รายการนัดที่ถูกยกเลิกในวันที่ {{$cancel_date}}</b></label>
            <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อผู้ป่วย</th>
                <th>เวลาออกตรวจ</th>
                <th>วันที่ทำการนัด</th>
                <th>เบอร์โทร</th>
            </tr>            
            </thead>
            <tbody>
                @foreach($cancelList as $index => $cancelDate)
                    <tr>
                        <th>{{$index+1}}</th>
                        <th>{{$cancelDate['pat_name'] . " " . $cancelDate['pat_surname']}}</th>
                        <th>{{$cancelDate['app_time']}}</th>
                        <th>{{$cancelDate['date_of_record']}}</th>
                        <th>{{$cancelDate['pat_tel']}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@stop
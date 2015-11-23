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
<!-- <meta http-equiv="refresh" content="5;url=/dashboard" /> -->
    <div class="row">
        <div class="col-md-8 col-md-offset-1">            
            <div class="alert alert-success" role="alert"><h3 class="lead"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  คุณได้ทำการยกเลิกนัดหมายเรียบร้อย</h3></div>
            <!-- <h4>กำลังนำท่านไปหน้า Dashboard...</h4> --> 
            <table class="table" id="app_complete_table">
                <tr>
                    <th>Patient Name</th>
                    <th>{{$pat_name}}</th>
                </tr>
                <tr>
                    <th>Doctor Name</th>
                    <th>{{$doc_name}}</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>{{$app_date}}</th>
                </tr>
                <tr>
                    <th>Time</th>
                    <th>{{$app_time}}</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection


@stop
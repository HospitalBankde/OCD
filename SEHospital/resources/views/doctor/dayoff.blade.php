/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 11/3/15 AD
 * Time: 5:34 PM
 */

@extends('layout.default_officer')

@section('title')
    <title>doctor day-off</title>
@endsection

@section('script')
    {!! Html::script('js/dayoff.js') !!}
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
<div class="container">
    <div class="row">
        <a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>        
            <h2>แจ้งการลาพัก</h2>
            <br>
            <input name="select_doc" id="select_doc" type="hidden" value="{{ e($doc_id) }}"/>
            <form class="form-inline" onsubmit="return validate_dayoff_form(this)" method="POST" action="dayoff/postDayOff">
                <div class="form-group">
                    <label>วันที่: <input type="text" id="date" name="date"></label>
                    <!-- <div id="date"></div> -->
                    <!-- <span id="helpBlock" class="help-block">กรุณาเลือกวัน</span> -->
                    <input type="text" placeholder="หมายเหตุ" name="description">
                    <input type="hidden" value="{{e($doc_id)}}" name="doc_id">
                    <br>
                    <br>
                    <button type="submit" class="btn btn-warning">
                        แจ้งลาพัก
                    </button>
                </div>
            </form>
            <br><br><br>
            <label class="lead">
                รายการลาพักปัจจุบัน
            </label>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>วันที่</th>
                    <th>หมายเหตุ</th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                @foreach($cancels as $index => $cancel)
                    <tr>
                        <th>{{$index}}</th>
                        <th>{{$cancel->cancel_date}}</th>
                        <th>{{$cancel->cancel_desc}}</th>
                    </tr>
                @endforeach
                </tbody>
                </tbody>
            </table>        
    </div>
</div>
@endsection


@stop
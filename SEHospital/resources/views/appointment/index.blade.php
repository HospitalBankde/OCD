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
    {!! Html::script('js/appointment.js') !!}
    {!! Html::script('bootstrap-select/js/bootstrap-select.js') !!}
    {!! Html::style('bootstrap-select/css/bootstrap-select.css') !!}
    {{--{!! Html::style('external/jquery/jquery.js') !!}--}}
    {!! Html::style('jquery-ui/jquery-ui.min.css') !!}
    {!! Html::script('jquery-ui/jquery-ui.min.js') !!}
@endsection

@section('content')

    <script>
        $(function() {
            $( "#date" ).datepicker();
        });
    </script>

    <div class="container">

        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation"><a href="appointment"><span class="fa fa-user-md" aria-hidden="true"></span> นัดแพทย์</a></li>
                    <li role="presentation"><a href="about"><span class="fa fa-info" aria-hidden="true"></span> เกี่ยวกับเรา</a></li>
                    <li role="presentation"><a href="contact"><span class="fa fa-envelope-o" aria-hidden="true"></span> ติดต่อ</a></li>
                </ul>
            </nav>
            <h3 class="text-muted"><a href="/" style="text-underline: none;">iHospital</a></h3>
        </div>

        <h1 class="page-header">ค้นหารายชื่อแพทย์</h1>
        <div class="col-md-8 col-md-offset-1">

            <h2 style="color: #666666">1.เลือกจากสาขาวิชาที่เชี่ยวชาญ</h2>

            <select class="selectpicker" name="select_dept" id="select_dept" >
                @foreach($depts as $dept)
                    <option value="{{$dept->dep_id}}">{{$dept->dep_name}}</option>
                @endforeach
            </select>

            <br><br><br>

            <h2 style="color: #666666">2.เลือกรายชื่อแพทย์ในสาขา <h4 id="dept_label" style="color: #31b0d5"></h4></h2>

            <select class="selectpicker" name="select_doc" id="select_doc" disabled="true" >
                <option value="">Any Doctor</option>

            </select>
            <br>
            <br>
            <button type="button" class="btn btn-default" style="background-color: #265a88; color: lightgray">
                ต่อไป
            </button>

            <br><br>
            <input type="text" name="date" id="date" value="กรุณาเลือกวันนัดแพทย์" style="color: #B0BEC5;" readonly>



        </div>



    </div>
@endsection


@stop
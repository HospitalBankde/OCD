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
            <h3 class="text-muted">iHospital</h3>
        </div>

        <h1 class="page-header">ค้นหารายชื่อแพทย์</h1>
        <div class="col-md-6 col-md-offset-1">
            <h2>1.เลือกจากสาขาวิชาที่เชี่ยวชาญ</h2>
            <!-- Single button -->
            {{--<div class="btn-group">--}}
                {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--<span class="selection"> กรุณาเลือกสาขาวิชาที่เชี่ยวชาญ </span> <span class="caret"></span>--}}
                    {{--<span class="selection"> test </span>--}}
                {{--</button>--}}
                {{--<ul class="dropdown-menu" role="menu">--}}
                    {{--<li><a href="#">กรุณาเลือกสาขาวิชาที่เชี่ยวชาญ</a></li>--}}
                    {{--<li><a href="#">กุมารเวชศาสตร์</a></li>--}}
                    {{--<li><a href="#">จักษุวิทยา</a></li>--}}
                    {{--<li role="separator" class="divider"></li>--}}
                    {{--<li><a href="#">จิตเวชศาสตร์</a></li>--}}
                    {{--<li><a href="#">ทันตกรรม</a></li>--}}
                    {{--<li><a href="#">ประสาทวิทยา</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div class="checkbox">--}}
                {{--<label>--}}
                    {{--<input type="checkbox"> ระบุชื่อแพทย์ด้วยตนเอง--}}
                {{--</label>--}}
            {{--</div>--}}
            <select class="selectpicker">
                <optgroup label="Picnic">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </optgroup>
                <optgroup label="Camping">
                    <option>Tent</option>
                    <option>Flashlight</option>
                    <option>Toilet Paper</option>
                </optgroup>
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
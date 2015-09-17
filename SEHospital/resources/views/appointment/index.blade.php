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
@endsection

@section('content')

    <div class="container">
        <h1 class="page-header">ค้นหารายชื่อแพทย์</h1>
        <div class="col-md-6 col-md-offset-1">
            <h2>1.เลือกจากสาขาวิชาที่เชี่ยวชาญ</h2>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="selection"> กรุณาเลือกสาขาวิชาที่เชี่ยวชาญ </span> <span class="caret"></span>
                    {{--<span class="selection"> test </span>--}}
                </button>
                <ul class="dropdown-menu" role="menu">
                    {{--<li><a href="#">กรุณาเลือกสาขาวิชาที่เชี่ยวชาญ</a></li>--}}
                    <li><a href="#">กุมารเวชศาสตร์</a></li>
                    <li><a href="#">จักษุวิทยา</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">จิตเวชศาสตร์</a></li>
                    <li><a href="#">ทันตกรรม</a></li>
                    <li><a href="#">ประสาทวิทยา</a></li>
                </ul>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> ระบุชื่อแพทย์ด้วยตนเอง
                </label>
            </div>
            <br>
            <button type="button" class="btn btn-default" style="background-color: #265a88; color: lightgray">
                ต่อไป
            </button>
        </div>
    </div>
@endsection


@stop
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
    <script>
        $(function() {
            $( "#date" ).datepicker();
        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>ค้นหารายชื่อแพทย์</h2>
            <br>
            <form  action="appointment/time" id="doc_select_form" onsubmit="return validate_doctor_search()" method="get">
                <h3 style="color: #666666">1.เลือกจากสาขาวิชาที่เชี่ยวชาญ</h3>
                <select class="selectpicker" name="select_dep" id="select_dep">
                    <option value="-1">Select Department</option>
                    @foreach($deps as $dep)
                        <option value="{{$dep->dep_id}}">{{$dep->dep_name}}</option>
                    @endforeach
                </select>

                <br><br><br>

                <h3 style="color: #666666">2.เลือกรายชื่อแพทย์ในสาขา <h4 id="dep_label" style="color: #31b0d5"></h4></h3>

                <select class="selectpicker" name="select_doc" id="select_doc" disabled="true" >
                    <option value="-1">Any Doctor</option>

                </select>
                <br>
                <br>
                <button type="submit" class="btn btn-default" style="background-color: #265a88; color: lightgray">
                    เลือกเวลาพบแพทย์
                </button>
            </form>
            <br><br>
        </div>
    </div>


    {{--</div>--}}



@endsection


@stop
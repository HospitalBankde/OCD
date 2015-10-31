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
    <script>
        $(function() {
            $( "#date" ).datepicker({
                minDate:"+2D",
                maxDate:"+1M +2D",
                numberOfMonths:2,
                onSelect: function(dateText) {
                    document.getElementById('helpBlock').innerHTML = "วันที่เลือก : " + dateText ;
                }
            });
            $( "#date" ).datepicker('option','beforeShowDay',function(date){
                var td = date.getDay();
                var ret = [(date.getDay() != 0 && date.getDay() != 6 && date.getDay() != 2 && date.getDay() != 4),'',
                    (td != 'Sat' && td != 'Sun' && td != 'Tue' && td != 'Thu')?'':'only on workday'];
                return ret;
            });
        });
        function updateSelectedDate(date) {
            document.getElementById('helpBlock').innerHTML = date ;
        }
    </script>
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

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>เลือกเวลาพบแพทย์</h2>
            <br>
            <h4 class="lead" style="color:cornflowerblue;">แพทย์ : {{$doc_name . " " . $doc_surname}}</h4>
            <div id="date" aria-describedby="helpBlock" ></div>
            <span id="helpBlock" class="help-block">กรุณาเลือกวัน</span>
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> เช้า
            </label>
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" disabled> บ่าย
            </label>
            <br><br>
            <button type="submit" class="btn btn-warning">
                นัดแพทย์
            </button>
        </div>
    </div>
@endsection


@stop
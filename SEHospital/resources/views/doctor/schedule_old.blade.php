
/**
* Created by PhpStorm.
* User: AunN
* Date: 11/1/15 AD
* Time: 12:00 AM
*/


@extends('layout.default_officer')

@section('title')
    <title>Schedule</title>
@endsection

@section('script')
    {!! Html::script('day-scheduler/day-scheduler.js') !!}

    {!! Html::style('day-scheduler/day-scheduler.css') !!}
    <script>
        function editSchedule() {
            if(document.getElementById('day-schedule').style.pointerEvents == 'none'){
                document.getElementById('edit-button').innerHTML = 'บันทึก';
                document.getElementById('day-schedule').style.pointerEvents = 'auto';
            }else{
                document.getElementById('edit-button').innerHTML = 'แก้ไข';
                document.getElementById('day-schedule').style.pointerEvents = 'none';
            }
        }
    </script>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">

            <h2>ตารางออกตรวจ</h2>
            <button id="edit-button" class="btn btn-link" onclick="editSchedule()">แก้ไข</button>
            <button class="btn btn-warning" style="float:right">แจ้งวันลางาน</button>
            <div class="clearfix">
            </div>
            <span class="row"><div id="day-schedule" style="pointer-events: none"></div></span>
        </div>

        <br>
    </div>
    </div>
@endsection

@section('bottom-script')
    <script>
        (function ($) {
            $("#day-schedule").dayScheduleSelector({
                days: [0, 1, 2, 3, 4, 5, 6],
                interval: 30,
                startTime: '08:00',
                endTime: '16:30'


            });
            $("#day-schedule").on('selected.artsy.dayScheduleSelector', function (e, selected) {
                console.log(selected);
            })
            // $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
            //     '1': [['09:30', '11:00'], ['13:00', '16:30']],
            //     '2': [['08:00', '10:00'], ['13:00', '16:00']],
            //     '4': [['10:00', '12:00'], ['13:00', '15:00']],
            //     '6': [['10:00', '13:00']]
            // });
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '1': [['09:30', '11:00'], ['13:00', '16:30']],
                    '2': [['08:00', '10:00'], ['13:00', '16:00']],
                    '4': [['10:00', '12:00'], ['13:00', '15:00']],
                    '6': [['10:00', '13:00']]
                });
        })($);
    </script>
    <style type="text/css">

        .schedule-rows td {
            width: 80px;
            height: 30px;
            margin: 3px;
            padding: 5px;
            background-color: lightgray;
            border-right: #000000;
            cursor: pointer;
        }

        .schedule-rows td:first-child {
            background-color: #eeeeee;
            border-color: #000000;
            text-align: center;
            position: relative;
            top: 0px;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            cursor: default;
        }

        .schedule-rows td[data-selected],
        .schedule-rows td[data-selecting] { background-color: cornflowerblue; }

        .schedule-rows td[data-disabled] { opacity: 0.55; }

        .schedule-header th {
            background-color: #000000;
            color: #ffffff;
            text-align: center;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
        }

        table.schedule-table td {
            /*border: 1px solid #000000;*/
            /*margin: 2px 2px 2px 2px;*/
            /*padding: 2px 2px 0px 0px;*/
        }

        table.schedule-table {
            border-collapse: separate;
            border-spacing: 1px;
            *border-collapse: expression('separate', cellSpacing = '1px');
        }

    </style>
@endsection
@stop
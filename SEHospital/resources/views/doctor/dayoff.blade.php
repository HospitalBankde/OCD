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
    {!! Html::style('jquery-ui/jquery-ui.min.css') !!}
    {!! Html::script('jquery-ui/jquery-ui.min.js') !!}
    <script>
        $(function() {
            $( "#date" ).datepicker()
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
            <h2>แจ้งการลาพัก</h2>
            <br>
            <form class="form-inline">
                <div class="form-group">
                    <label>วันที่: <input type="text" id="date"></label>
                    <button type="submit" class="btn btn-warning">
                        ลาพัก
                    </button>
                </div>
            </form>
            <br><br><br>
            <label class="lead">
                ประวัติการลาพัก
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
                <tr>
                    <th scope="row">1</th>
                    <td>10/09/2015</td>
                    <td>ลาป่วย</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>06/12/2015</td>
                    <td>สัมนาต่างจังหวัด</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>01/23/2014</td>
                    <td>ลากิจ</td>
                </tr>
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection


@stop
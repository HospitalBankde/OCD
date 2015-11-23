/**
* Created by PhpStorm.
* User: AunN
* Date: 9/18/15 AD
* Time: 1:40 AM
*/

@extends('layout.default')

@section('title')
    <title>ติดต่อ</title>
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
<br>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">            
            <!-- <h4>กำลังนำท่านไปหน้า Dashboard...</h4> --> 
            <table class="table" id="Contact">
                <tr>
                    <th>Email: </th>
                    <th>bankde.ihospital@gmail.com</th>
                </tr>
                <tr>
                    <th>Telephone</th>
                    <th>012-345-6789</th>
                </tr>
                <tr>
                    <th>Address</th>
                    <th>34/5 Chulalongkorn Road, Bangkok 12300</th>
                </tr>
            </table>
        </div>
    </div>
@endsection


@stop
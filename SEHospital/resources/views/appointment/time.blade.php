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




    </div>
@endsection


@stop
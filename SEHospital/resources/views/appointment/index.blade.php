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
            <select class="selectpicker" name="select_dept" id="select_dept">
                <?php
                    $depts = DB::select('SELECT dep_name, dep_id FROM department');
                    foreach ($depts as $dept) {
                        echo "<option value=" . $dept->dep_id . ">" . $dept->dep_name . "</option>";
                    }
                ?>
            </select>
            <br><br><br>
            <h2>2.เลือกรายชื่อแพทย์ในสาขา <?php echo "test"; ?></h2>
            <select class="selectpicker" name="select_doc" id="select_doc">
                <option>Any Doctor</option>
                <?php
                    //if 
                    $doctors = DB::select('SELECT doc_name, doc_surname FROM doctor');
                    foreach ($doctors as $doctor) {
                        echo "<option>" . $doctor->doc_name . "</option>";
                    }
                ?>
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
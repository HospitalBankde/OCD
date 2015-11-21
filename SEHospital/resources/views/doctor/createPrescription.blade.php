
/**
* Created by PhpStorm.
* User: AunN
* Date: 11/4/15 AD
* Time: 11:28 AM
*/

@extends('layout.default')

@section('title')
    <title>Create Prescription</title>
@endsection

@section('script')
    {!! Html::script('js/createPrescription.js') !!}
    {!! Html::script('bootstrap-typeahead/bootstrap3-typeahead.js') !!}
    <style type="text/css">
        .top5 { margin-top:5px; }
        .top7 { margin-top:7px; }
        .top10 { margin-top:10px; }
        .top15 { margin-top:15px; }
        .top17 { margin-top:17px; }
        .top30 { margin-top:30px; }
    </style>
    <script>
        $(document).ready(function() {
             showResult();
       });
        // $.get('test_medicine.json', function(data){
        //     $('#typeahead').typeahead({ source:data });
        // },'json');
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>ใบสั่งยา</h2>
            <br>
            @if(isset($pat_id) && isset($pat_name) && isset($pat_surname))
                <div class="row 30">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">ข้อมูลผู้ป่วย</h3>
                        </div>
                        <div class="panel-body">
                            <h4>id: {{$pat_id}} </h4>
                            <input type="hidden" id="pat_id" value="{{$pat_id}}">
                            <h4 class="control-label" for="firstname" id="patientname">ชื่อ สกุล: {{$pat_name . ' ' . $pat_surname}}</h4>  
                        </div>
                    </div>
                </div>
            @else
                <div class="control-group">
                    <label class="control-label" for="pat_id">รหัสผู้ป่วย</label>
                    <div class="controls">
                        <input type="text" id="pat_id" name="pat_id" placeholder="" class="form-control input-lg" autocomplete="off" onkeyup="">
                    </div>
                </div>
                <br>    
                <button class="btn btn-primary" onclick="checkPatientID()" >ตรวจสอบ</button><br><br>

                <div class="row 30">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">ข้อมูลผู้ป่วย</h3>
                        </div>
                        <div class="panel-body">
                            <p class="control-label" for="firstname" id="patientname">ชื่อ สกุล</p>                            
                        </div>
                    </div>
                </div>
            @endif
                
                   <!--  <div class="control-group">
                        <label class="control-label" for="firstname">ชื่อผู้ป่วย</label>
                        <div class="controls">
                            <input type="text" id="firstname" name="firstname" placeholder="" class="form-control input-lg" autocomplete="off">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="lastname">นามสกุล</label>
                        <div class="controls">
                            <input type="text" id="lastname" name="lastname" placeholder="" class="form-control input-lg" autocomplete="off">
                        </div>
                    </div> -->
                <div class="control-group">
                    <label class="control-label" for="symtom">อาการ</label>
                    <div class="controls">
                        <input type="text" id="symtom" name="symtom" placeholder="" class="form-control input-lg" autocomplete="off">
                    </div>
                </div>
            <div class="row top30">
                <!-- <form class="form-horizontal top10" > -->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">รายการยา</h3>
                        </div>
                        <!-- <label class="control-label" for="tel">ค้นหายา</label> -->
                        

                        <div class="panel-body">
                            <label>ค้นหายา</label>
                            <input id="typeahead" class="form-control input-sm" autocomplete="off" type="text" data-provide="typeahead" placeholder="ชื่อยา หรือ id" name="medname" >
                            <br>
                            <label>จำนวน(เม็ด)</label>
                            <input type="text" class="form-control input-sm" id="med_amount" name="med_amount" placeholder="number">
                            <br>
                            <label>วิธีการใช้</label>
                            <input type="text" class="form-control input-sm" id="description" name="description" placeholder="description">
                            <br>
                            <button type="button" class="btn btn-success top10" onclick="add_med()">
                                เพิ่ม
                            </button>
                        </div>
                    </div>
                <!-- </form> -->



                <table class="table" id="prescription_table">
                    <!-- <col width="50px" />
                    <col width="50px" />
                    <col width="100px" /> -->
                    <br>
                    <label class="lead">รายการยา</label>&nbsp&nbsp<a href="#">แก้ไข</a>
                    <!-- <caption>Prescription</caption> -->
                    <thead>
                    <!-- <tr>
                        <th>ลำดับ</th>
                        <th>id</th>
                        <th>ชื่อยา</th>
                        <th>จำนวน(เม็ด)</th>
                        <th>วิธีการใช้</th>
                    </tr> -->
                    <tr>
                        <th>id</th>
                        <th>ชื่อยา</th>
                        <th>จำนวน(เม็ด)</th>
                        <th>วิธีการใช้</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>


            <form id="sendform" class="form-horizontal" action="/dashboard/postPrescription" method="POST" onsubmit="return createPrescription()" >
            <div class="row">
                <input type="hidden" name="app_id" id="app_id" value="{{$app_id}}">
                <input type="hidden" name="senddata" id="senddata" value="">
                <!-- Button -->
                <div class="controls">
                    <button class="btn btn-warning" >สร้างใบสั่งยา</button>
                </div>
            </div>
            </form>


        </div>
    </div>
@endsection

@stop
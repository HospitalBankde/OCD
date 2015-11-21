@extends('layout.default')

@section('title')
    <title>Patient Information</title>
@endsection

@section('script')
    {!! Html::script('js/patientInfo.js') !!}
    {!! Html::script('bootstrap-typeahead/bootstrap3-typeahead.js') !!}
    <script>
        $(document).ready(function() {
             showResult();
       });
    </script>
@endsection

@section('content')
        <div class="row">        
            <div class="col-md-8 col-md-offset-1">
                <h2>ข้อมูลเบื้องต้นของผู้ป่วย</h2>
                <br>
                <form class="form-horizontal" action="postPatientInfo" method="POST" onsubmit="return validate_patientInfo_form(this);">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="firstname">ชื่อ</label>
                            <div class="controls">
                                <input type="text" id="firstname" name="firstname" placeholder="" class="form-control input-lg">
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <label class="control-label" for="lastname">นามสกุล</label>
                            <div class="controls">
                                <input type="text" id="lastname" name="lastname" placeholder="" class="form-control input-lg">
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <label class="control-label" for="weight">น้ำหนัก (kg.)</label>                 
                            <div class="controls">
                                <input type="text" id="weight" name="weight" placeholder="" class="form-control input-lg">

                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <label class="control-label" for="height">ส่วนสูง (cm.)</label>
                            <div class="controls">
                                <input type="text" id="height" name="height" placeholder="" class="form-control input-lg">
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <label class="control-label" for="temperature">อุณหภูมิ</label>
                            <div class="controls">
                                <input type="text" id="temperature" name="temperature" placeholder="" class="form-control input-lg">
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <label class="control-label" for="bloodpressure">ความดันโลหิต</label>
                            <div class="controls">
                                <input type="text" id="bloodpressure" name="bloodpressure" placeholder="" class="form-control input-lg">                                
                            </div>
                        </div>
                        <br>
                        <div class="control-group">
                            <label class="control-label" for="heartrate">อัตรการเต้นของหัวใจ</label>
                            <div class="controls">
                                <input type="text" id="heartrate" name="heartrate" placeholder="" class="form-control input-lg">
                            </div>
                        </div>
                        <br>
                        <div id="showhide"></div>
                        <div id="hide_show">
                            <br>
                            <form class="form-horizontal top10" >
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">รายการยา</h3>
                                    </div>
                        

                                    <div class="panel-body">
                                        <label>ค้นหายา</label>
                                        <input id="typeahead" class="form-control input-sm" autocomplete="off" type="text" data-provide="typeahead" placeholder="ชื่อยา หรือ id" name="medname" >
                                        <br>
                                        <label>อาการที่แพ้</label>
                                        <input type="text" class="form-control input-sm" id="allergyDescription" name="allergyDescription" placeholder="อาการที่แพ้">
                                        <br>
                                        <button type="button" class="btn btn-success top10" onclick="add_med()">เพิ่ม</button>
                                    </div>
                                </div>
                            </form>

                            <table class="table" id="allergy_table">
                                <br>
                                <label class="lead">รายการยา</label>&nbsp&nbsp<a href="#">แก้ไข</a>
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>ชื่อยา</th>
                                    <th>อาการที่แพ้</th>
                                </tr>
                                </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="control-group">
                            <input type="hidden" name="senddata" id="senddata" value="">    
                            <!-- Button -->
                            <div class="controls">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
@endsection

@stop
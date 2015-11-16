@extends('layout.default')

@section('title')
    <title>Patient Information</title>
@endsection

@section('script')
    {!! Html::script('js/patientInfo.js') !!}
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <h2>ข้อมูลเบื้องต้นของผู้ป่วย</h2>
                <br>
                <form class="form-horizontal" action="showPatientInfo" method="POST" onsubmit="return validate_patientInfo_form(this);">
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
                        <div class="control-group">
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
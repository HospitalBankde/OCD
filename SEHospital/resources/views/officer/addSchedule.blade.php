@extends('layout.default')

@section('title')
    <title>Schedule</title>
@endsection

@section('script')
    {!! Html::script('js/addSchedule.js') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h2>ลงตารางออกตรวจ</h2>
            <br>
            <form class="form-horizontal" action="actionAddSchedule" method="POST";>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="doc_id">ค้นหาจากรหัสแพทย์:  
                            <button id="edit-button" class="btn btn-link">บันทึก</button>
                        </label>
                        <div class="controls">
                            <input type="text" id="doc_id" name="doc_id" placeholder="Doctor ID" class="form-control input-lg" autocomplete="off" onkeyup="">
                        </div>
                    </div>    
                </fieldset><br>  
                <button class="btn btn-primary" onclick="checkDoctorID()" form="">ตรวจสอบ</button><br><br>

                <div class="row 30">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">ชื่อแพทย์</h3>
                        </div>
                        <div class="panel-body">
                            <p class="form-label" for="firstname" id="doctorname" >ชื่อ-สกุล</p>                    
                        </div>
                    </div>
                </div>
               



                <table class="table ">
                    <thead>
                    <tr>
                        <th>วัน</th>
                        <th>เช้า</th>
                        <th>บ่าย</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>อาทิตย์</td>
                            <td>
                                <input type="hidden" name="sun_morn" value="0" />
                                <input type="checkbox" name="sun_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="sun_after" value="0" />
                                <input type="checkbox" name="sun_after" value="1">
                            </td>                     
                        </tr>
                        <tr>
                            <td>จันทร์</td>
                            <td>
                                <input type="hidden" name="mon_morn" value="0" />
                                <input type="checkbox" name="mon_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="mon_after" value="0" />
                                <input type="checkbox" name="mon_after" value="1">
                            </td>  
                        </tr>
                        <tr>
                            <td>อังคาร</td>
                            <td>
                                <input type="hidden" name="tue_morn" value="0" />
                                <input type="checkbox" name="tue_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="tue_after" value="0" />
                                <input type="checkbox" name="tue_after" value="1">
                            </td>  
                        </tr>
                        <tr>
                            <td>พุธ</td>
                            <td>
                                <input type="hidden" name="wed_morn" value="0" />
                                <input type="checkbox" name="wed_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="wed_after" value="0" />
                                <input type="checkbox" name="wed_after" value="1">
                            </td>  
                        </tr>
                        <tr>
                            <td>พฤหัสบดี</td>
                            <td>
                                <input type="hidden" name="thu_morn" value="0" />
                                <input type="checkbox" name="thu_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="thu_after" value="0" />
                                <input type="checkbox" name="thu_after" value="1">
                            </td>  
                        </tr>
                        <tr>
                            <td>ศุกร์</td>
                            <td>
                                <input type="hidden" name="fri_morn" value="0" />
                                <input type="checkbox" name="fri_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="fri_after" value="0" />
                                <input type="checkbox" name="fri_after" value="1">
                            </td>  
                        </tr>
                        <tr>
                            <td>เสาร์</td>
                            <td>
                                <input type="hidden" name="sat_morn" value="0" />
                                <input type="checkbox" name="sat_morn" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="sat_after" value="0" />
                                <input type="checkbox" name="sat_after" value="1">
                            </td>  
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    </div>

    <br>
    </div>
    </div>
@endsection
@stop
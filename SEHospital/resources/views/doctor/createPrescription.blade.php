
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
        $.get('test_medicine.json', function(data){
            $('#typeahead').typeahead({ source:data });
        },'json');
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>ใบสั่งยา</h2>
            <br>
            <form class="form-horizontal" action="/appointment" method="POST" onsubmit="return validate_register_form(this);">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="firstname">รหัสผู้ป่วย</label>
                        <div class="controls">
                            <input type="text" id="firstname" name="firstname" placeholder="" class="form-control input-lg">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="lastname">ชื่อผู้ป่วย</label>
                        <div class="controls">
                            <input type="text" id="lastname" name="lastname" placeholder="" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="ssn">นามสกุล</label>
                        <div class="controls">
                            <input type="text" id="ssn" name="ssn" placeholder="" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="tel">อาการ</label>
                        <div class="controls">
                            <input type="text" id="tel" name="tel" placeholder="" class="form-control input-lg">
                        </div>
                    </div>
                </fieldset>
            </form>

            <div class="row top30">
                <form class="form-inline">

                    <label class="control-label" for="tel">ค้นหายา</label>
                    <input id="typeahead" type="text" data-provide="typeahead" placeholder="ชื่อยา หรือ id">
                </form>
                <form class="form-horizontal top10">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">id : 1  ชื่อยา : med1</h3>
                        </div>
                        <div class="panel-body">
                            <label>จำนวน(เม็ด)</label>
                            <input type="text" class="form-control input-sm">
                            <label>วิธีการใช้</label>
                            <input type="text" class="form-control input-sm">
                            <button type="button" class="btn btn-success top10">
                                เพิ่ม
                            </button>
                        </div>
                    </div>
                </form>


                <table class="table">
                    <br>
                    <label class="lead">รายการยา</label>&nbsp&nbsp<a href="#">แก้ไข</a>
                    <!-- <caption>Prescription</caption> -->
                    <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>id</th>
                        <th>ชื่อยา</th>
                        <th>จำนวน(เม็ด)</th>
                        <th>วิธีการใช้</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>12</td>
                        <td>med1</td>
                        <td>2</td>
                        <td>ทานหลังอาหารทุกมื้อ</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>26</td>
                        <td>medimedi</td>
                        <td>20</td>
                        <td>ทานทุก 1 ชั่วโมง</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>233</td>
                        <td>abcdemedicine</td>
                        <td>8</td>
                        <td>ทานก่อนนอนจนกว่าจะหาย</td>
                    </tr>
                    </tbody>
                </table>
                </form>
            </div>

            <div class="row">
                <!-- Button -->
                <div class="controls">
                    <button class="btn btn-warning">สร้างใบสั่งยา</button>
                </div>
            </div>


        </div>
    </div>
@endsection

@stop
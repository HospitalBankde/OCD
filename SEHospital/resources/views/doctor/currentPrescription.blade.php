
/**
* Created by PhpStorm.
* User: AunN
* Date: 11/4/15 AD
* Time: 11:28 AM
*/


@extends('layout.default')

@section('title')
    <title>Get Prescription</title>
@endsection

@section('script')
    {!! Html::script('js/currentPrescription.js') !!}
    <script>
        $('#showPrescriptions').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
        
        $(document).ready(function() {
            // updatePrescription(), and delay 3s then call again.
            timedRefresh();

        })
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>รายการใบสั่งยาปัจจุบัน</h2>                   
            <h4 style="color:orange"><span id="spanDate"></span></h4>
            <br>
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#current" data-toggle="tab">ใบสั่งยาปัจจุบัน</a></li>
                <li><a href="#finished" data-toggle="tab">เสร็จสิ้น</a></li>
                <li><a href="#cancelled" data-toggle="tab">ยกเลิก</a></li>
            </ul>

            <!-- <div class="row top30" id="all_content">
                <form class="form-inline">

                    <label class="control-label" for="tel">ค้นหารายการยา</label>
                    <input id="typeahead" type="text" data-provide="typeahead" placeholder="ชื่อผู้ป่วย หรือ id">
                </form>
            </div> -->
            <div class="panel panel-default">
            <div class="panel-body">
            <section class="tab-content">
                <article class="tab-pane active" id="current">
                    <div class="row top30">
                        <table class="table" id='current_table' name='current_table'>
                            <br>
                            <!-- <caption>Prescription</caption> -->
                            <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>id</th>
                                <th>ชื่อผู้ป่วย</th>
                                <th>เพิ่มที่เวลา</th>
                                <th>หมายเหตุ</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>                  
                    </div>
                </article>

                <article class="tab-pane" id="finished">
                    <div class="row top30">
                        <!-- <h3 style="color: gray">รายการใบสั่งยาเสร็จสิ้น</h3> -->
                        <table class="table" id='finished_table' name='finished_table'>
                            <br>
                            <!-- <caption>Prescription</caption> -->
                            <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>id</th>
                                <th>ชื่อผู้ป่วย</th>
                                <th>เพิ่มที่เวลา</th>
                                <th>หมายเหตุ</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>                        
                    </div>
                 </article>

                 <article class="tab-pane" id="cancelled">
                    <div class="row top30">
                        <!-- <h3 style="color: gray">รายการใบสั่งยาถูกยกเลิก</h3> -->
                        <table class="table" id='cancelled_table' name='cancelled_table'>
                            <br>
                            <!-- <caption>Prescription</caption> -->
                            <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>id</th>
                                <th>ชื่อผู้ป่วย</th>
                                <th>เพิ่มที่เวลา</th>
                                <th>หมายเหตุ</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </article>
            </section>   
            </div>
            </div>              

        <!-- Modal -->
        <div class="modal fade" id="showPrescriptions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ID : NAME</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-offset-1">
                            <div class="row">
                                <table class="table" id="med_List_Table"name="med_List_Table">
                                    <br>
                                    <label class="lead">รายการยา</label>
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


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('bottom-script')
    <script type="text/javascript">
        var months = ['January','February','March','April','May','June','July',
            'August','September','October','November','December'];       
        var tomorrow = new Date();
        tomorrow.setTime(tomorrow.getTime() + (1000*3600*24));       
        document.getElementById("spanDate").innerHTML = months[tomorrow.getMonth()] + " " + tomorrow.getDate()+ ", " + tomorrow.getFullYear();
    </script>
@endsection

@stop
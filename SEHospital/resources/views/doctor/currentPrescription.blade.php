
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
    <script>
        $('#showPrescriptions').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>รายการใบสั่งยาปัจจุบัน</h2>
            <br>

            <div class="row top30">
                <form class="form-inline">

                    <label class="control-label" for="tel">ค้นหารายการยา</label>
                    <input id="typeahead" type="text" data-provide="typeahead" placeholder="ชื่อผู้ป่วย หรือ id">
                </form>
            </div>

            <div class="row top30">
                <table class="table">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>12</td>
                        <td>John Smith</td>
                        <td>1:30 PM</td>
                        <td></td>
                        <td><a type="button" data-toggle="modal" data-target="#showPrescriptions">แสดง</a> <a href="#">เสร็จสิ้น</a> <a>ยกเลิก</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>26</td>
                        <td>Albert Einstein</td>
                        <td>9:12 AM</td>
                        <td></td>
                        <td><a>แสดง</a> <a href="#">เสร็จสิ้น</a> <a>ยกเลิก</a></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>233</td>
                        <td>John Doe</td>
                        <td>8:55 AM</td>
                        <td>แนะนำวิธีการใช้อีกครั้ง</td>
                        <td><a>แสดง</a> <a href="#">เสร็จสิ้น</a> <a>ยกเลิก</a></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>31</td>
                        <td>Bobby Joey</td>
                        <td>8:32 AM</td>
                        <td></td>
                        <td><a>แสดง</a> <a href="#">เสร็จสิ้น</a> <a>ยกเลิก</a></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>123</td>
                        <td>Mary Bobby</td>
                        <td>8:15 AM</td>
                        <td>ถามจำนวนยาที่เหลือในครั้งที่แล้ว</td>
                        <td><a>แสดง</a> <a href="#">เสร็จสิ้น</a> <a>ยกเลิก</a></td>
                    </tr>
                    </tbody>
                </table>
                </form>
            </div>


            <hr>

            <div class="row top30">
                <h3 style="color: gray">รายการใบสั่งยาเสร็จสิ้น</h3>
                <table class="table">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>12</td>
                        <td>John Smith</td>
                        <td>1:30 PM</td>
                        <td></td>
                        <td><a href="#">Undo</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>26</td>
                        <td>Albert Einstein</td>
                        <td>9:12 AM</td>
                        <td></td>
                        <td><a href="#">Undo</a></td>
                    </tr>
                    </tbody>
                </table>
                </form>
            </div>


            <div class="row top30">
                <h3 style="color: gray">รายการใบสั่งยาถูกยกเลิก</h3>
                <table class="table">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>13</td>
                        <td>Adam Smith</td>
                        <td>1:30 PM</td>
                        <td></td>
                        <td><a href="#">Undo</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>236</td>
                        <td>Albert Smith</td>
                        <td>9:12 AM</td>
                        <td></td>
                        <td><a href="#">Undo</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="showPrescriptions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">12 : John Smith</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-offset-1">
                            <div class="row">
                                <table class="table">
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
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@stop
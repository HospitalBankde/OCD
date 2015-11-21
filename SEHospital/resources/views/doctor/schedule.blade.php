/**
* Created by PhpStorm.
* User: AunN
* Date: 11/3/15 AD
* Time: 12:15 PM
*/


@extends('layout.default')

@section('title')
    <title>Schedule</title>
@endsection

@section('script')
    <script>
        function editSchedule() {

        }
    </script>
<!--     <?php
    // $value = rand(0,1) == 1;
    // $days = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์"];
    ?> -->
@endsection

@section('content')
    <div class="row">
    <a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>
        <!-- <div class="col-md-11 col-md-offset-1"> -->            
            @if(isset($forDoctorID))
                <h2>บันทึกตารางออกตรวจเสร็จสิ้น</h2>
                <h4>( doc_id = {{$forDoctorID}} )</h4>
            @else
                <h2>ตารางออกตรวจ</h2>
            @endif
            <br>

            <!-- <div class="row">
                <div class="form-group col-md-8">
                    <label for="doc_name">ค้นหาชื่อแพทย์ : John Doe
                        <button id="edit-button" class="btn btn-link" onclick="editSchedule()">บันทึก</button>
                    </label>
                    <div class="form-group">
                        <input class="form-control" id="doc_name" type="text" placeholder="ชื่อแพทย์">
                    </div>
                </div>
            </div> -->           
            {{--<button class="btn btn-warning" style="float:right">แจ้งวันลางาน</button>--}}
            {{--<div class="clearfix">--}}
            @if(isset($schedule) && !empty($schedule))
            <table class="table table-bordered table-hover">
                <thead>
                <tr bgcolor="#4879CC">
                    <th>วัน</th>
                    <th>เช้า</th>
                    <th>บ่าย</th>
                </tr>
                </thead>
                <tbody>
                @foreach($schedule as $day)
                    <tr>
                        <td>{{$day->weekday_id}}</td>
                        <td>
                            @if($day->morning)
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>                            
                            @endif
                            <!-- <input type="checkbox" > -->
                        </td>
                        <td>
                            @if($day->afternoon)
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            @endif
                            <!-- <input type="checkbox" > -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        <!-- </div> -->
    </div>
    </div>

    <br>
    </div>
    </div>
@endsection
@stop
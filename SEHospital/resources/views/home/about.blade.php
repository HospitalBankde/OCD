/**
* Created by PhpStorm.
* User: AunN
* Date: 9/18/15 AD
* Time: 1:40 AM
*/

@extends('layout.default')

@section('title')
    <title>เกี่ยวกับเรา</title>
@endsection

@section('script')
    {!! Html::style('jquery-ui/jquery-ui.min.css') !!}
    {!! Html::script('jquery-ui/jquery-ui.min.js') !!}
    <style type="text/css">
        .ui-datepicker {
            background: #ffffff;
            border: 1px solid #555;
        }
        .ui-widget-header {
            background: none;
            background-color: #000000;
        }
    </style>
@endsection

@section('content')
<!-- <meta http-equiv="refresh" content="2;url=/dashboard" /> -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">            
        <!-- <h4>กำลังนำท่านไปหน้า Dashboard...</h4> --> 
        <table class="table" id="About">
            <tr>iHospital เป็นเว็ปขององค์กร Spectre ถูกสร้างขึ้นมาเพื่อเป็นระบบจัดการผู้ป่วย<br></tr>
            <tr>เป้าหมายหลักของเว็ปนี้คือ การลดระยะเวลาที่เสียไปในการปฎิบัติภารกิจ<br></tr>
            <tr>อีกทั้งยังเป็นการจัดเก็บข้อมูลจากทั่วโลกเพื่อความปลอดภัยในชีวิตของผู้คน<br></tr>
            <tr>นอกจากนี้ เมื่อใกล้ถึงวันนัดหมายแพทย์ ระบบนี้ยังสามารถส่งเอกสารลับเสมือนจริงเพื่อเตือนสติคุณที่สามารถทำลายตัวเองได้เพียงกด delete ได้อีกด้วย<br></tr>
            <tr><br></tr>
            <tr>ลงชื่อ 007</tr>
        </table>
    </div>
 </div>

@endsection


@stop
/**
* Created by PhpStorm.
* User: AunN
* Date: 9/18/15 AD
* Time: 1:40 AM
*/

@extends('layout.default')

@section('title')
    <title>ค้นหาการนัดหมาย</title>
@endsection

@section('content')
    <div class="container">
    <a href="/dashboard"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กลับ dashboard </a>
        <div class="row">
            <h2>ยกเลิกการนัดหมายแพทย์</h2>
            <br>
            <br>
            <label>ค้นหาการนัดหมาย:</label>
            <form method="POST" action="postSearchAppointment">
                <input type="text" placeholder="ชื่อผู้ป่วย" name="pat_search_name" value="">
                <input type="text" placeholder="ชื่อแพทย์" name="doc_search_name" value="">
                <button class="btn btn-primary">ค้นหา</button>
            </form>            
        </div>
    </div>

@endsection


@stop
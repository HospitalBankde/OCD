@extends('layout.default')

@section('title')
    <title>ใบสั่งยา</title>
@endsection

@section('script')
@endsection

@section('content')
    <div class="row">
        <div class="alert alert-success" role="alert">
            <h3 class="lead">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  
                คุณได้ทำการออกใบสั่งยาเรียบร้อย         
                @if(isset($pat_id))       
                    <a href="/dashboard/postPrescription/nextAppointment/{{$pat_id}}">นัดผู้ป่วยในครั้งถัดไป ?</a>                
                @endif
            </h3>
            
            <h5>
                <a href="/dashboard/todayAppointmentList">กลับหน้ารายการนัดแพทย์วันนี้</a>                                
            </h5>            
        </div>
        <div class="col-md-8 col-md-offset-1" align='center'>
            <div class="panel panel-default">
                <div class="panel-heading">                
                    <h2>ใบสั่งยา</h2>
                </div>
                <div class="panel-body">
                    <h4>                
                    ชื่อ : {{$pat_name}}  {{$pat_surname}}<br><br>
                    อาการ : {{$symptom}}<br>
                    </h4>
                    <hr>
                    <table class="table" id="allergy_table">
                    <br>
                        <label class="lead"><b>รายการยา</b></label>
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>ชื่อยา</th>
                            <th>จำนวน</th>
                            <th>วิธีการใช้</th>
                        </tr>            
                        </thead>
                        <tbody>
                            @foreach($prescriptions as $prescription)
                                <tr>
                                    <th>{{$prescription['id']}}</th>
                                    <th>{{$prescription['name']}}</th>
                                    <th>{{$prescription['num']}}</th>
                                    <th>{{$prescription['description']}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
            
        </div>
    </div>
@endsection


@stop
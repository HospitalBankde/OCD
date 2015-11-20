@extends('layout.default')

@section('title')
    <title>ใบสั่งยา</title>
@endsection

@section('script')
@endsection

@section('content')
    <div class="row">
            <div class="col-md-8 col-md-offset-1" align='center'>
                <h2><u>ใบสั่งยา</u></h2>
                <br>
                <label class="control-label">                
                    ชื่อ : {{$pat_name}}  {{$pat_surname}}<br><br>
                    อาการ : {{$symptom}}<br>
                </label>
            </div>
        </div>

        <table class="table" id="allergy_table">
        <br>
            <label class="lead"><b>รายการยาที่แพ้</b></label>
            <thead>
            <tr>
                <th>id</th>
                <th>ชื่อยา</th>
                <th>อาการที่แพ้</th>
            </tr>            
            </thead>
            <tbody>
                @foreach($prescriptions as $prescription)
                    <tr>
                        <th>{{$prescription['id']}}</th>
                        <th>{{$prescription['name']}}</th>
                        <th>{{$prescription['description']}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection


@stop
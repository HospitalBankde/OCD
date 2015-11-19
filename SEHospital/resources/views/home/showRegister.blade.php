@extends('layout.default')

@section('title')
    <title>Register</title>
@endsection

@section('script')
    {!! Html::script('js/register.js') !!}
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-1" align='center'>
                <h2>ท่านได้ทำการสมัครชิกเรียบร้อย</h2>
                <br>
                <label class="control-label">คุณได้เป็นสมาชิกของเว็บไซต์แล้ว<br>ก่อนที่คุณจะสามารถใช้บริการ คุณจะต้องทำการเข้าสู่ระบบก่อนที่มุมบนขวา</label>
                <br>
                <label class="control-label"><u>ข้อมูลสมาชิกของคุณคือ</u></label><br>
                ชื่อจริง : {{$firstname}}<br>
                นามสกุล : {{$surname}}<br>
                รหัสประชาชน : {{$ssn}}<br>
                เบอร์ติดต่อ : {{$tel}}<br><br>
                <label class="control-label"><u>ข้อมูลการเข้าสู่ระบบของคุณคือ</u></label><br>
                E-mail : {{$email}}<br>
                Password : {{$password}}<br>
            </div>
        </div>
@endsection

@stop
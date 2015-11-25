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
                @if (empty($errmsg))
                    <script lang="javascript">alert('ท่านได้ทำการสมัครสมาชิกเรียบร้อย');</script>
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
                    <!-- Password : {{$password}}<br> -->
                @else
                    <h4>Email: {{$email}} นี้ได้ถูกใช้ไปแล้ว</h4><br>
                    <h5>กรุณาเลือก login หรือติดต่อเจ้าหน้าที่หากลืมพาสเวิร์ด</h5>
                @endif
            </div>
        </div>
@endsection

@stop
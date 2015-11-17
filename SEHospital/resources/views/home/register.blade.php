/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 10/27/15 AD
 * Time: 5:32 PM
 */
@extends('layout.default')

@section('title')
    <title>Register</title>
@endsection

@section('script')
    {!! Html::script('js/register.js') !!}
@endsection

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <h2>สมัครบัญชีใหม่</h2>
                <br>
<<<<<<< HEAD
                <form class="form-horizontal" action="showRegister" method="POST" onsubmit="return validate_register_form(this);">
=======
                <form class="form-horizontal" action="/actionRegister" method="POST" onsubmit="return validate_register_form(this);">
>>>>>>> appointmentv0.1
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="firstname">ชื่อ</label>
                            <div class="controls">
                                <input type="text" id="firstname" name="firstname" placeholder="" class="form-control input-lg">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="lastname">นามสกุล</label>
                            <div class="controls">
                                <input type="text" id="lastname" name="lastname" placeholder="" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="ssn">รหัสบัตรประชาชน</label>
                            <div class="controls">
                                <input type="text" id="ssn" name="ssn" placeholder="" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="tel">เบอร์โทรศัพท์</label>
                            <div class="controls">
                                <input type="text" id="tel" name="tel" placeholder="" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">E-mail</label>
                            <div class="controls">
                                <input type="email" id="email" name="email" placeholder="" class="form-control input-lg">                                
                                <p class="help-block">Email นี้จะใช้ในการเข้าสู่ระบบ</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" id="password" name="password" placeholder="" class="form-control input-lg">
                                <p class="help-block">Password should be at least 8 characters</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password_confirm">Password (Confirm)</label>
                            <div class="controls">
                                <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control input-lg">
                                <p class="help-block">Please confirm password</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- Button -->
                            <div class="controls">
                                <button class="btn btn-success">Register</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
@endsection

@stop
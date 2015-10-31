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
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation"><a href="appointment"><span class="fa fa-user-md" aria-hidden="true"></span> นัดแพทย์</a></li>
                    <li role="presentation"><a href="about"><span class="fa fa-info" aria-hidden="true"></span> เกี่ยวกับเรา</a></li>
                    <li role="presentation"><a href="contact"><span class="fa fa-envelope-o" aria-hidden="true"></span> ติดต่อ</a></li>
                </ul>
            </nav>
            <h3 class="text-muted"><a href="/" style="text-underline: none;">iHospital</a></h3>
            <a style="float: right;" href="/">เข้าสู่ระบบ</a>
        </div>

        <div class="row">
            <div class="col-md-6">

                <form class="form-horizontal" action="/appointment" method="POST" onsubmit="return validate_register_form(this);">
                    <fieldset>
                        <div id="legend">
                            {{--<legend class="">Register</legend>--}}
                            <h2 class="page-header">สมัครบัญชีใหม่</h2>
                        </div>
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
                                <p class="help-block">Password should be at least 6 characters</p>
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
    </div>
@endsection

@stop
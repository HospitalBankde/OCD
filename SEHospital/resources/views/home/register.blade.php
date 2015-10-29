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
        </div>

        <div class="row">
            <div class="col-md-6">

                <form class="form-horizontal" action="" method="POST">
                    <fieldset>
                        <div id="legend">
                            {{--<legend class="">Register</legend>--}}
                            <h2 class="page-header">สมัครบัญชีใหม่</h2>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="username">Username</label>
                            <div class="controls">
                                <input type="text" id="username" name="username" placeholder="" class="form-control input-lg">
                                <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">E-mail</label>
                            <div class="controls">
                                <input type="email" id="email" name="email" placeholder="" class="form-control input-lg">
                                <p class="help-block">Please provide your E-mail</p>
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
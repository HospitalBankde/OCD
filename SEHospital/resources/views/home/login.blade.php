/**
* Created by PhpStorm.
* User: AunN
* Date: 10/31/15 AD
* Time: 6:14 PM
*/

@extends('layout.default')

@section('title')
    <title>Login</title>
@endsection

@section('script')

@endsection

@section('content')
    @if(isset($warning))
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
                {{$warning}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>เข้าสู่ระบบ</h2>
            <br>
            <form class="form-horizontal" action="/actionLogin" method="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>
                <!-- force sent role as patient -->
                <input type="hidden" name="role" id="role" value="patient">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Log in</button>
                         &nbsp;&nbsp;&nbsp;หรือ
                        <a role="button" class="btn btn-link" href="/register">สมัครบัญชีใหม่</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@stop
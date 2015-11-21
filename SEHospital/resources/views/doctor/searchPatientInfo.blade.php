@extends('layout.default')

@section('title')
    <title>Patient Info</title>
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
                <h2>ข้อมูลเบื้องต้นของผู้ป่วย</h2>
                <br>
                <form class="form-horizontal" action="postPatientInfo" method="POST">
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
                        <br>
                        <button class="btn btn-success" role="button">Search</a>
                    </fieldset>
                </form>

            </div>
        </div>
@endsection

@stop
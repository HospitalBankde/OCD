/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/17/15 AD
 * Time: 11:20 PM
 */
@extends('layout.default')

@section('title')
    <title>iHospital</title>
@endsection

@section('script')
@endsection

@section('content')

        <div class="jumbotron" >

            @if(isset($id))            
                <h2>สวัสดี! {{$name}}</h2>
            @else
                <h1>สวัสดี</h1>    
                <p class="lead">สมัครบัญชีผู้ใช้วันนี้ เพื่อรับบริการชั้นหนึ่ง!</p>
                <a class="btn btn-primary btn-lg" href="register" role="button">สมัครบัญชี</a>
                <br>
                <a class="btn btn-link" style="font-size: medium" href="login" role="button">เข้าสู่ระบบ</a>
            @endif            
        </div>

        <div class="row marketing">
            <div class="col-lg-6">
                <h4><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>  ประชาสัมพันธ์</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

                <h4><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  โปรโมชั่น</h4>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

                <h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span>  บทความเพื่อสุขภาพ</h4>
                <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
            </div>

            <div class="col-lg-6">
                <h4>Subheading</h4>
                <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

                <h4>Subheading</h4>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

                <h4>Subheading</h4>
                <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
            </div>
        </div>


        <!-- Modal test-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Notice</h4>
                    </div>
                    <div class="modal-body">
                        Under Construction...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>

@endsection

@stop
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
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation"><a href="appointment"><span class="fa fa-user-md" aria-hidden="true"></span> นัดแพทย์</a></li>
                    <li role="presentation"><a href="about"><span class="fa fa-info" aria-hidden="true"></span> เกี่ยวกับเรา</a></li>
                    <li role="presentation"><a href="contact"><span class="fa fa-envelope-o" aria-hidden="true"></span> ติดต่อ</a></li>
                </ul>
            </nav>
            <h3 class="text-muted">iHospital</h3>
        </div>

        <div class="jumbotron" >
            <h1>สิ่งเดียวที่เปลี่ยนไป <br> คือทุกสิ่ง</h1>
            <p class="lead">สมัครบัญชีผู้ใช้วันนี้ เพื่อรับบริการชั้นหนึ่ง!</p>
            <p><a class="btn btn-lg btn-success" href="#" role="button" data-toggle="modal" data-target="#myModal">สมัครบัญชี</a></p>
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
        <footer class="footer">
            <p>© Company 2014</p>
        </footer>

    </div>

@endsection

@stop
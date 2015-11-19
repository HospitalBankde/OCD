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

    {{--<!--parallax 1 -->--}}
    {{--<section class="bg-1 text-center">--}}
        {{--<h1>Bootstrap Parallax</h1>--}}
        {{--<p class="lead">Add Some Motion</p>--}}
    {{--</section>--}}
    {{--<!--/parallax 1-->--}}
    <div class="container">

        <div class="jumbotron bg-1">
            @if(isset($id) )
                <h2>สวัสดี! {{$name}}</h2>
                <p>ทำรายการของท่านได้ <a href="/dashboard">ที่นี่!</a></p>
            @else
                <div class="container-fluid">
                    <h1>สวัสดี</h1>
                    <p class="lead">สมัครบัญชีผู้ใช้วันนี้ เพื่อรับบริการชั้นหนึ่ง!</p>
                    <a class="btn btn-primary btn-lg" href="register" role="button">สมัครบัญชี</a>
                    <br>
                    <a class="btn btn-link hvr-grow" style="font-size: medium" href="login" role="button">เข้าสู่ระบบ</a>
                </div>
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
    </div>
@endsection

@section('bottom-script')
    <script type="text/javascript">
        (function($) {

            $.fn.parallax = function(options) {

                var windowHeight = $(window).height();

                // Establish default settings
                var settings = $.extend({
                    speed        : 0.15
                }, options);

                // Iterate over each object in collection
                return this.each( function() {

                    // Save a reference to the element
                    var $this = $(this);

                    // Set up Scroll Handler
                    $(document).scroll(function(){

                        var scrollTop = $(window).scrollTop();
                        var offset = $this.offset().top;
                        var height = $this.outerHeight();

                        // Check if above or below viewport
                        if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
                            return;
                        }

                        var yBgPosition = Math.round((offset - scrollTop) * settings.speed);

                        // Apply the Y Background Position to Set the Parallax Effect
                        $this.css('background-position', 'center ' + yBgPosition + 'px');

                    });
                });
            }
        }(jQuery));

        $('.bg-1,.bg-3').parallax({
            speed :	0.15
        });

        $('.bg-2').parallax({
            speed :	0.25
        });
    </script>
    <style type="text/css">
        .bg-1 {
            background: url('/img/homebg.jpg') no-repeat center center fixed;
            color:#fff;
            background-size:cover;
        }
        /* Grow */
        .hvr-grow {
            display: inline-block;
            vertical-align: middle;
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
            transition-duration: 0.3s;
            transition-property: transform;
        }

        .hvr-grow:hover,
        .hvr-grow:focus,
        .hvr-grow:active {
            transform: scale(1.1);
        }

    </style>
@endsection
@stop
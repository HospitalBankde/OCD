<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Inculde javascript and css library -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::script('js/jquery-2.1.1.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::style('css/custom.css') !!}
    {!! Html::style('font-awesome/css/font-awesome.min.css') !!}
    <!-- Include custom script file for each page -->
    @yield('script')
    <style type="text/css">
        .charge {
            position: relative;
            bottom: 0.5em;
            color: red;
            font-size: 0.5em;
        }

        .atoms {
            position: relative;
            top: 0.3em;
            color: blue;
            font-size: 0.5em;
        }
    </style>    
    <!-- Title for each page -->
    @yield('title')

</head>

<?php session_start() ?>
@if((isset($_SESSION['id']) && $_SESSION['role']!='patient'))
    <body class="custom" style="background-color: #FDFFD8">
@else
    <body class="custom" style="background-color: #FEFEFE">
@endif
<?php session_write_close() ?>
    <!-- Content for each page -->
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                @if(!isset($_SESSION['id']) || $_SESSION['role'] == 'patient')
                    <li role="presentation"><a href="/appointment"><span class="fa fa-user-md" aria-hidden="true"></span> นัดแพทย์</a></li>
                @endif
                    <li role="presentation"><a href="/about"><span class="fa fa-info" aria-hidden="true"></span> เกี่ยวกับเรา</a></li>
                    <li role="presentation"><a href="/contact"><span class="fa fa-envelope-o" aria-hidden="true"></span> ติดต่อ</a></li>
                </ul>
            </nav>

            @if(isset($_SESSION['id']))
                <input type="hidden" value="has_session" id="session_check">
            @else
                <input type="hidden" value="no_session" id="session_check">
            @endif

            @if(isset($_SESSION['id']) && $_SESSION['role'] != 'patient')    
                <h3 class="text-muted"><a href="/" style="text-decoration: none;" id="logo">iHospital<span class="atoms">{{$_SESSION['role']}}</span></a></h3>                            
            @else
                <h3 class="text-muted"><a href="/" style="text-decoration: none;" id="logo">iHospital</a></h3>
            @endif
        
            <?php 
                session_start(); 
                if (isset($_SESSION['id'])) {
                    echo '<div style="float: right;">' . $_SESSION['name'];
                    echo '&emsp;<a href="/dashboard"> dashboard</a>&emsp;|';
                    echo '&emsp;<a href="/logout">logout</a>' . '</div>';
                }
                else echo '<a style="float: right;" href="/login">เข้าสู่ระบบ</a>';
                session_write_close(); 
             ?>                        
        </div>


        @yield('content')

        <br><br><br>
        <footer class="footer">
            <p>© iHospital, 2015</p>
        </footer>
    </div>

    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
    <script type="text/javascript">
        var pressTimer

        $("#logo").mouseup(function(){
          clearTimeout(pressTimer)
          // Clear timeout          
          return false;
        }).mousedown(function(){
          // Set timeout
          if(document.getElementById("session_check").value == 'no_session'){
            pressTimer = window.setTimeout(function() {             
                window.location.href = '/loginOfficer';            
          },1000)
          }          
          return false; 
        });
    </script>
    @yield('bottom-script')
</body>
</html>
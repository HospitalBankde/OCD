<div class="container">		
		<div class="row">
               <div class="col-lg-3 col-md-6">
                    <a href="dashboard/profile">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>                             
                                </div>
                            </div>                        
                                <div class="panel-footer">
                                    <span class="pull-left">โปรไฟล์ของฉัน</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>                        
                        </div>
                    </a>
                </div>
        </div>
        <hr>
        <div class="row">
                <div class="col-lg-3 col-md-6">                
                                
                    @if(isset($id))
                        <input type="hidden" name="phar_id" value="{{$id}}">                    
                    @endif

                    <a href="dashboard/currentPrescription">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-medkit fa-5x"></i>
                                </div>
                               <!--  <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div> -->
                            </div>
                        </div>
                            <div class="panel-footer">
                                <span class="pull-left">รายการจ่ายยาขณะนี้</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>                        
                    </div> 
                    </a>               
                </div>
        </div>
	</div>
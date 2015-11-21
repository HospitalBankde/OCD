
<div class="panel panel-primary">
    <div class="panel-heading">
        ชื่อ : {{$firstname}}  {{$lastname}}
    </div>
    <div class="panel-body">
        <label class="control-label">                                            
            น้ำหนัก : {{$weight}}<br><br>
            ส่วนสูง : {{$height}}<br><br>
            อุณหภูมิ : {{$temperature}}<br><br>
            ความดันโลหิต : {{$bloodpressure}}<br><br>
            อัตราการเต้นของหัวใจ : {{$heartrate}}<br>
        </label>
    </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-body">
        <table class="table" id="allergy_table">
        <br>
            <label class="lead"><b>รายการยาที่แพ้</b></label>
            <thead>
            <tr>
                <th>id</th>
                <th>ชื่อยา</th>
                <th>อาการที่แพ้</th>
            </tr>            
            </thead>
            <tbody>
                @foreach($allergys as $allergy)
                    <tr>
                        <th>{{$allergy['id']}}</th>
                        <th>{{$allergy['name']}}</th>
                        <th>{{$allergy['description']}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
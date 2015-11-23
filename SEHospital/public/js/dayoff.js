var _MS_PER_DAY = 1000 * 60 * 60 * 24;

// a and b are javascript Date objects
function dateDiffInDays(date1, date2) {
  // Discard the time and time-zone information.
  var timeDiff = (date2.getTime() - date1.getTime());
  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
  return diffDays;
}

$(document).ready(function()
{        
    $.ajax(
    {
        url: '/doctorScheduleDay',
        type: 'GET',
        data: {select_doc:$('#select_doc').val()},
        dataType: 'json',
        success: function(response)
        {            
            var availday = response['availday'];                
            $( "#date" ).datepicker({
                minDate:"+2D",
                maxDate:"+3M +2D",
                numberOfMonths:1,
                dateFormat:"yy-mm-dd",
                onSelect: function(dateText) {                    
                }

            });                 
            $( "#date" ).datepicker('option','beforeShowDay',function(date){
                var cd = date.getDay();
                var td = new Date();
                var dateDiff =  dateDiffInDays(td, date);
                if(dateDiff < 0 || dateDiff > availday.length) {                   
                    return [false];
                }
                var ret = [!!availday[dateDiff]];
                return ret;
            });            
            //$("#date").datepicker( "refresh" );
        }
    });
});

function validate_dayoff_form(form) {
    var date = form.date.value;
    var description = form.description.value;
    var doc_id = form.doc_id.value;

    if(textEmpty(date)) {
        alert('กรุณาเลือกวันที่');
        form.date.focus();
        return false;
    }
    if(textEmpty(description)) {
        alert('กรุณากรอกหมายเหตุการลาพัก');
        form.description.focus();
        return false;
    }
    return true;
}
function textEmpty(text) {
    if(text.length == 0) {
        return true;
    } else {
        return false;
    }
}
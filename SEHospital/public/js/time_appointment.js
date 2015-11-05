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
        url: '/doctorDay',
        type: 'GET',
        data: {select_doc:$('#select_doc').val()},
        dataType: 'json',
        success: function(response)
        {
            var availday = response['availday'];
            $( "#date" ).datepicker({
                minDate:"+2D",
                maxDate:"+1M +2D",
                numberOfMonths:2,
                onSelect: function(dateText) {
                    document.getElementById('helpBlock').innerHTML = "วันที่เลือก : " + dateText ;
                    $.ajax(
                    {
                        url: '/doctorTime',
                        type: 'GET',
                        data: {select_doc:$('#select_doc').val(), select_date:dateText},
                        dataType: 'json',
                        success: function(response)
                        {
                            $('#inlineRadio1').attr("checked", false);
                            $('#inlineRadio2').attr("checked", false);
                            var doc_schedule = response['doc_schedule'];
                            if (doc_schedule['morning'] == 1) {
                                $('#inlineRadio1').attr('disabled', false);
                            }
                            else {
                                $('#inlineRadio1').attr('disabled', true);
                            }
                            if (doc_schedule['afternoon'] == 1) {
                                $('#inlineRadio2').attr('disabled', false);
                            }
                            else {
                                $('#inlineRadio2').attr('disabled', true);
                            }
                        }
                    });
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
        }
    });
});


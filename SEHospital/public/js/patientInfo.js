var button_beg = '<button id="button" onclick="showhide()">', button_end = '</button>';
var show_button = 'เพิ่มรายการยาที่แพ้', hide_button = 'ปิดรายการยาที่แพ้';
function showhide() {
    var div = document.getElementById( "hide_show" );
    var showhide = document.getElementById( "showhide" );
    if ( div.style.display !== "none" ) {
        div.style.display = "none";
        button = show_button;
        showhide.innerHTML = button_beg + button + button_end;
    } else {
        div.style.display = "block";
        button = hide_button;
        showhide.innerHTML = button_beg + button + button_end;
    }
}
function setup_button( status ) {
    if ( status == 'show' ) {
        button = hide_button;
    } else {
        button = show_button;
    }
    var showhide = document.getElementById( "showhide" );
    showhide.innerHTML = button_beg + button + button_end;
}
window.onload = function () {
    setup_button( 'hide' );
    showhide(); // if setup_button is set to 'show' comment this line
}

function showResult()
{
        var search = document.getElementById('typeahead').value;
        $.ajax(
        {
            url: 'medicineList',
            type: 'GET',
            data: {med_str:search},
            dataType: 'json',
            success: function(data)
            {
                var med_result = new Array();
                $.each(data.medicine_list, function(index, med_info) {
                    var fullmedname = med_info.med_id + '. ' + med_info.med_name;
                    med_result.push(fullmedname);
                });
                $('#typeahead').typeahead({ source:med_result });
            }
        });
}
row_id_by_far = 0;
function add_med()
{
  var med = document.getElementById("typeahead").value;
  var allergy_description = document.getElementById("allergyDescription").value;

  var med_index= med.indexOf(".");
  var med_id = med.substr(0, med_index); // Substring Only ID of Medicine
  var med_name =  med.substr(med_index+2); // Substring Only Name of Medicine
  if(!validateNonEmpty(med_name)) {
    alert('กรุณากรอกชื่อยา');
    document.getElementById("typeahead").focus();
    return false;
  }
  if(!validateNonEmpty(allergy_description)) {
    alert('กรุณากรอกอาการที่แพ้');
    document.getElementById("allergyDescription").focus();
    return false;
  }
  var table = document.getElementById("allergy_table");
  var number_of_row = table.rows.length;
  var row = table.insertRow(number_of_row);
  row.id = "row" + row_id_by_far;
  row_id_by_far++;
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);  
  cell1.innerHTML = med_id;
  cell2.innerHTML = med_name;
  cell3.innerHTML = allergy_description;
  cell4.innerHTML= '<a onclick=deleteRow(\"'+row.id+'\")> ลบ </a>';

  document.getElementById("typeahead").value = "";
  document.getElementById("allergyDescription").value= "";
  return true;
}

function deleteRow(row_id){
    var row = document.getElementById(row_id);
    row.parentNode.removeChild(row);
    
}

function validate_patientInfo_form(form) {
	var firstname = form.firstname.value;
	var lastname = form.lastname.value;
	var weight = form.weight.value;
	var height = form.height.value;
  var temperature = form.temperature.value;
  var bloodpressure = form.bloodpressure.value;
  var heartrate = form.heartrate.value;

  if(!validateNonEmpty(firstname)) {
  	alert('กรุณากรอกชื่อ');
    form.firstname.focus();
  	return false;
  }
  if(!validateNonEmpty(lastname)) {
    alert('กรุณากรอกนามสกุล');
  	form.lastname.focus();
  	return false;
  }
  if(!validateNonEmpty(weight) || !validateNumber(weight)) {
    alert('กรุณากรอกน้ำหนักหรือเป็นตัวเลขเท่านั้น');
    form.weight.focus();
    return false;
  }
  if(!validateNonEmpty(height) || !validateNumber(height)) {
    alert('กรุณากรอกส่วนสูงหรือเป็นตัวเลขเท่านั้น');
    form.height.focus();
    return false;
  }
  if(!validateNonEmpty(temperature) || !validateNumber(temperature)) {
    alert('กรุณากรอกอุณหภูมิหรือเป็นตัวเลขเท่านั้น');
    form.temperature.focus();
    return false;
  }
  if(!validateNonEmpty(bloodpressure) || !validateNumber(bloodpressure)) {
    alert('กรุณากรอกความดันโลหิตหรือเป็นตัวเลขเท่านั้น');
    form.bloodpressure.focus();
    return false;
  }
  if(!validateNonEmpty(heartrate) || !validateNumber(heartrate)) {
    alert('กรุณากรอกอัตราการเต้นของหัวใจหรือเป็นตัวเลขเท่านั้น');
    form.heartrate.focus();
    return false;
  }
  alert('ลงข้อมูลของผู้ป่วยเรียบร้อย');

  var table = document.getElementById("allergy_table");
  var info = [];

  for (var i = 1; i < table.rows.length; i++) {
    //iterate through rows
    //rows would be accessed using the "row" variable assigned in the for loop
    var row = table.rows[i];
    var dict = {"id":row.cells.item(0).innerHTML, "name":row.cells.item(1).innerHTML, "description":row.cells.item(2).innerHTML};
    info.push(dict);
  }     
  var data = {"allergy":info};
  document.getElementById('senddata').value = JSON.stringify(data);
  return true;
}

function validateNonEmpty(text) {
	if (text.length == 0) {
		return false;
	} else {
		return true;
	}
}

function validateNumber(text) {
    var re = /^[1-9]\d*(\.\d+)?$/
    return re.test(text);
}

function showResult()
{  
    $.ajax(
    {
        url: '/medicineList',
        type: 'GET',
        dataType: 'json',
        success: function(data)
        {
            var med_result = new Array();
            $.each(data.medicine_list, function(index, med_info) {            
                var fullmedname = med_info.med_id + '. ' + med_info.med_name;
                med_result.push(fullmedname);
            });
            //$('#typeahead').data('typeahead').source = med_result;
            $('#typeahead').typeahead({ source:med_result });
        }
    });
}
row_id_by_far = 0;
function add_med()
{
  var med = document.getElementById("typeahead").value;
  var med_amount = document.getElementById("med_amount").value;
  var description = document.getElementById("description").value;

  var med_index= med.indexOf(".");
  var med_id = med.substr(0, med_index); // Substring Only ID of Medicine
  var med_name =  med.substr(med_index+2); // Substring Only Name of Medicine
  
  if(!validateNonEmpty(med_name)) {
      alert('กรุณากรอกชื่อยา');
      document.getElementById("typeahead").focus();
      return false;
    }
    if(!validateAmoutOfMedicine(med_amount)) {
      alert('กรุณากรอกจำนวนยา');
     document.getElementById("med_amount").focus();
      return false;
    }
    if(!validateNonEmpty(description)) {
      alert('กรุณากรอกรายวิธีการใช้ยา');
      document.getElementById("description").focus();
      return false;
    }

  var table = document.getElementById("prescription_table");
  var number_of_row = table.rows.length;
  var row = table.insertRow(number_of_row);
  row.id = "row" + row_id_by_far;
  row_id_by_far++;
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
    
  cell1.innerHTML = med_id;
  cell2.innerHTML = med_name;
  cell3.innerHTML = med_amount;
  cell4.innerHTML = description;
  // cell5.innerHTML= '<input class=\"btn btn-warning\" type=\"button\" value=\"Delete\" onclick=\"deleteRow('+number_of_row+')\">';
  cell5.innerHTML= '<a onclick=deleteRow(\"'+row.id+'\")> ลบ </a>';
  // cell5.setAttribute("button",);

  document.getElementById("typeahead").value = "";
  document.getElementById("med_amount").value= "";
  document.getElementById("description").value = "";
  return true;
}

function deleteRow(row_id){
    var row = document.getElementById(row_id);
    row.parentNode.removeChild(row);
    
}

function validateNonEmpty(text) {
  if(text.length == 0) {
    return false;
  } else {
    return true;
  }
}

function validateAmoutOfMedicine(amount){
  var reg = /^[1-9][0-9]?$/;
  return reg.test(amount);
}

function checkPatientID(){
  var pat_id = document.getElementById('pat_id').value;
  var firstname = "";
  var lastname = "";
        $.ajax(
        {   
            url: '/getPatientInformation',
            type: 'GET',
            data: {pat_id:pat_id},
            dataType: 'json',
            success: function(data)
            {
                var pat_array = new Array();
                $.each(data.pat_info, function(index, pat_info) {
                    pat_array.push(pat_info);
                });
                var name=0;
                var surname = 1;
                // document.getElementById("patientname").innerHTML + pat_array[name] +" "+ pat_array[surname];
                document.getElementById('patientname').innerHTML = "ชื่อ สกุล " +": "+ pat_array[name] +" " +pat_array[surname] ; 
                //Change label to firstname and last name
            }
        });
}

function createPrescription(){

  // prepare all data in JSON and send to server

  var pat_id = document.getElementById('pat_id').value;
  var table = document.getElementById("prescription_table");
  var symtom = document.getElementById('symtom').value;
 
  if(!validateNonEmpty(pat_id)){
    alert("กรุณากรอกรหัสผู้ป่วย");
    document.getElementById("pat_id").focus();
    return false;
  }
  if(!validateNonEmpty(symtom)){
    alert("กรุณากรอกอาการของผู้ป่วย");
    document.getElementById("symtom").focus();
    return false;
  }
  var info = [];
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var dict = {"id":row.cells.item(0).innerHTML, "name":row.cells.item(1).innerHTML, "num":row.cells.item(2).innerHTML,"description":row.cells.item(3).innerHTML};
        info.push(dict);
    }     
    var data = {"pat_id":pat_id, "symtom":symtom,"prescriptions":info };
 
    document.getElementById('senddata').value = JSON.stringify(data);
    return true;

}
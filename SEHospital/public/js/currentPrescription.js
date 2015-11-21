function updatedPrescription()
{    
    // var current = document.getElementById('current_table');
    // var finished = document.getElementById('finished_table');
    // var cancelled = document.getElementById('calcelled_table');    
    var current_array = new Array();
    var finished_array = new Array();
    var cancelled_array = new Array();
    $.ajax(
    {
        url: 'updatedPrescription',
        type: 'GET',
        data: {},
        dataType: 'json',
        success: function(data)
        {   
            $.each(data.Current_info, function(index, Current_info) {
                current_array.push(Current_info);
            });
            $.each(data.Finished_info, function(index, Finished_info) {
                finished_array.push(Finished_info);
            });
            $.each(data.Cancelled_info, function(index, Cancelled_info) {
                cancelled_array.push(Cancelled_info);
            });
            // Remove only body's rows
            $("#current_table tbody tr").remove(); 
            $("#finished_table tbody tr").remove(); 
            $("#cancelled_table tbody tr").remove();                   
            updateCurrentTable(current_array);
            updateFinishedTable(finished_array);
            updateCancelledTable(cancelled_array);
        }
    });
}


row_id_by_far = 0;

function updateCurrentTable(array){
    var table = document.getElementById("current_table");
    var number_of_row = table.rows.length;  
    //get table body
    table = document.getElementById("current_table").getElementsByTagName('tbody')[0];    
    for(i=0;i<array.length;i++){                
        row = table.insertRow(number_of_row-1);
        number_of_row++;
        row.id = "row" + row_id_by_far;
        row_id_by_far++;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var diagnosis_id = array[i].diagnosis_id
        // exclude table header row 
        cell1.innerHTML = number_of_row-1;
        cell2.innerHTML = array[i].pat_id;
        cell3.innerHTML = array[i].pat_name + ' ' + array[i].pat_surname;        
        cell4.innerHTML = array[i].diagnosis_datetime.split(" ")[1];
        cell5.innerHTML = array[i].symptom_description;
        cell6.innerHTML = '<a style="cursor:pointer" type=\"button\" data-toggle=\"modal\" data-target=\"#showPrescriptions\" onclick=prescriptionDetail(\"'+diagnosis_id+'\") >แสดง</a> <a style="cursor:pointer" onclick=changeToFinish(\"'+diagnosis_id+'\") >เสร็จสิ้น</a> <a style="cursor:pointer" onclick=changeToCancelled(\"'+diagnosis_id+'\")>ยกเลิก</a>';
        // cell6.innerHTML = '<a type=\"button\" data-toggle=\"modal\" data-target=\"#showPrescriptions'+array[i].diagnosis_id+'\">แสดง</a> <a href=\"#\">เสร็จสิ้น</a> <a>ยกเลิก</a>';

        // cell5.innerHTML= '<input class=\"btn btn-warning\" type=\"button\" value=\"Delete\" onclick=\"deleteRow('+number_of_row+')\">';

    }
    
}

function updateFinishedTable(array){
    var table = document.getElementById("finished_table");
    var number_of_row = table.rows.length;  
    //get table body
    table = document.getElementById("finished_table").getElementsByTagName('tbody')[0];  
    for(i=0;i<array.length;i++){
        row = table.insertRow(number_of_row-1);
        number_of_row++;
        row.id = "row" + row_id_by_far;
        row_id_by_far++;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);        
        var diagnosis_id = array[i].diagnosis_id
        // exclude table header row 
        cell1.innerHTML = number_of_row-1;
        cell2.innerHTML = array[i].pat_id;
        cell3.innerHTML = array[i].pat_name + ' ' + array[i].pat_surname;
        cell4.innerHTML = array[i].diagnosis_datetime.split(" ")[1];
        cell5.innerHTML = array[i].symptom_description;
        cell6.innerHTML = '<a style="cursor:pointer" onclick=changeToCurrent(\"'+diagnosis_id+'\")>Undo</a>';
        // cell5.innerHTML= '<input class=\"btn btn-warning\" type=\"button\" value=\"Delete\" onclick=\"deleteRow('+number_of_row+')\">';

    }
    
}

function updateCancelledTable(array){
    var table = document.getElementById("cancelled_table");
    var number_of_row = table.rows.length;    
    //get table body
    table = document.getElementById("cancelled_table").getElementsByTagName('tbody')[0];
    for(i=0;i<array.length;i++){        
        row = table.insertRow(number_of_row-1);
        number_of_row++;
        row.id = "row" + row_id_by_far;
        row_id_by_far++;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var diagnosis_id = array[i].diagnosis_id
        // exclude table header row 
        cell1.innerHTML = number_of_row-1;
        cell2.innerHTML = array[i].pat_id;
        cell3.innerHTML = array[i].pat_name + ' ' + array[i].pat_surname;
        cell4.innerHTML = array[i].diagnosis_datetime.split(" ")[1];
        cell5.innerHTML = array[i].symptom_description;
        cell6.innerHTML = '<a style="cursor:pointer" onclick=changeToCurrent(\"'+diagnosis_id+'\")>Undo</a>';
       

    }
    
}

function prescriptionDetail(diagnosis_id)
{
        var current_array = new Array();
        $.ajax(
        {
            url: 'getPrescriptionDetail',
            type: 'GET',
            data: {diagnosis_id : diagnosis_id},
            dataType: 'json',
            success: function(data)
            {   
                $.each(data.Current_info, function(index, Current_info) {
                    current_array.push(Current_info);
                });
                deletePrescriptionTable();
                updatePrescriptionTable(current_array);
            }
        });
}

function updatePrescriptionTable(array){
    if(array.length!=0){
        var name = array[0].pat_id+" : " +array[0].pat_name +" "+array[0].pat_surname;
        document.getElementById("myModalLabel").innerHTML = name;

        for(i=0;i<array.length;i++){
            var table = document.getElementById("med_List_Table");
            var number_of_row = table.rows.length;
            var row = table.insertRow(number_of_row);
            number_of_row = number_of_row+i;
            row = table.insertRow(number_of_row);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);        
            var cell5 = row.insertCell(4);
            cell1.innerHTML = number_of_row; // Number of sequence 
            cell2.innerHTML = array[i].med_id; // Medicine ID
            cell3.innerHTML = array[i].med_name; // Medicine name
            cell4.innerHTML = array[i].med_num; // Medicine Amount
            cell5.innerHTML = array[i].use_description;  // How to use
            // cell5.innerHTML= '<input class=\"btn btn-warning\" type=\"button\" value=\"Delete\" onclick=\"deleteRow('+number_of_row+')\">';

        }  
    }
}

function deletePrescriptionTable(){
        
    var table = document.getElementById("med_List_Table");
    if(table != null){
        while(table.rows.length>1){  
            var row = table.deleteRow(1);
        } 
    }
    

}

function changeToCurrent(diagnosis_id){
    var status = 0;//Current
     $.ajax(

        {
            url: 'getChangeStatus',
            type: 'GET',
            data: {diagnosis_id : diagnosis_id,status : status},
            dataType: 'json',
            success: function(data)
            {   
                updatedPrescription();
            }
        });
}
function changeToFinish(diagnosis_id){        
    var status = 1;//Finish
     $.ajax(
        {
            url: 'getChangeStatus',
            type: 'GET',
            data: {diagnosis_id : diagnosis_id, status : status},
            dataType: 'json',
            success: function(data)
            {                   
                updatedPrescription();
            }
        });
}

function changeToCancelled(diagnosis_id){
    var status = 2;//Cancelled    
     $.ajax(
        {
            url: 'getChangeStatus',
            type: 'GET',
            data: {diagnosis_id : diagnosis_id, status : status},
            dataType: 'json',
            success: function(data)
            {   
                updatedPrescription();
            }
        });
}

function timedRefresh() {
    updatedPrescription();
    setTimeout(function() {
        timedRefresh();    
    }, 3000);
}


function checkDoctorID(){
  var doc_id = document.getElementById('search_doc_id').value;
  document.getElementById('doc_id').value = doc_id;
  var firstname = "";
  var lastname = "";
    $.ajax(
    {   
        url: '/getDoctorInformation',
        type: 'GET',
        data: {doc_id:doc_id},
        dataType: 'json',
        success: function(data)
        {
            var doc_array = new Array();
            $.each(data.doc_info, function(index, doc_info) {
                doc_array.push(doc_info);
            });
            var name=0;
            var surname = 1;
            document.getElementById('doctorname').innerHTML = "ชื่อ สกุล " +": "+ doc_array[name] +" " +doc_array[surname] ; 
        }
    });
}
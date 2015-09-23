$(document).ready(function()
{
    $("#select_dept").change(function(){
        $.ajax(
            {
                url: 'doctorList',
                type: 'GET',
                data: {dep_id:$(this).val()},
                dataType: 'json',
                success: function(doctors)
                {
                    var select = document.getElementById('select_doc');
                    select.options.length = 0;

                    // Default
                    var opt = document.createElement('option');
                    opt.value = "";
                    opt.appendChild(document.createTextNode("Any Doctor"));
                    $('#select_doc').append(opt);

                    $.each(doctors.doctor_list, function(index, doctor) {
                        var fullname = doctor.doc_name + ' ' + doctor.doc_surname;

                        var opt = document.createElement('option');
                        opt.value = doctor.doc_id;
                        opt.appendChild(document.createTextNode(fullname));
                        $('#select_doc').append(opt);
                    });

                    // Update related elements
                    var e = document.getElementById('select_dept');
                    var current_dept = e.options[e.selectedIndex].text;
                    document.getElementById('select_doc').disabled = false;
                    document.getElementById('dept_label').innerHTML = current_dept;

                    $('#select_doc').selectpicker('refresh');
                }
            });
    });

});
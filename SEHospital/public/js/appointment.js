function validate_doctor_search() {
    var x = document.getElementById('select_dep').value;
    if (x == null || x == "" || x === "-1") {
        alert("Please select department");
        return false;
    }
}

$(document).ready(function()
{
    $("#select_dep").change(function(){
        if (document.getElementById('select_dep').value === "-1"){
            var select = document.getElementById('select_doc');
            select.options.length = 0;
            var opt = document.createElement('option');
            opt.value = "-1";
            opt.appendChild(document.createTextNode("Any Doctor"));
            $('#select_doc').append(opt);
            document.getElementById('select_doc').disabled = true;
            document.getElementById('dep_label').innerHTML = "";
            $('#select_doc').selectpicker('refresh');
        }
        else{
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

                    // Create for
                    var opt = document.createElement('option');
                    opt.value = "-1";
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
                    var e = document.getElementById('select_dep');
                    var current_dep = e.options[e.selectedIndex].text;
                    document.getElementById('select_doc').disabled = false;
                    document.getElementById('dep_label').innerHTML = current_dep;

                    $('#select_doc').selectpicker('refresh');
                }
            });
        }
    });
});
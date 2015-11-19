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

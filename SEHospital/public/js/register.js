function validate_register_form(form) {
	var firstname = form.firstname.value;
	var lastname = form.lastname.value;
	var ssn = form.ssn.value;
	var tel = form.tel.value;
    var email = form.email.value;
    var password = form.password.value;
    var password_confirm = form.password_confirm.value;

    alert(firstname);
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
    if(validateSSN(ssn)) {
    	alert('รหัสประชาชนต้องเป็นเลขความยาว 13 ตัว');
    	form.ssn.focus();
    	return false;
	}
	if(validateTel(tel)) {
		alert('โทรศัพท์ต้องอยู่ในรูป XX-XXX-XXXX หรือ XXX-XXX-XXXX ');
		form.tel.focus();
		return false;
	}
	if(validateEmail(email)) {
		alert('email ไม่ถูกต้อง');
		form.email.focus();
		return false;
	}
	if(validatePassword(password)) {
    	alert('Password ต้องมีความยาวตั้งแต่ 8 และไม่เกิน 20 ตัวอักษร\n และต้องมีตัวเลขและตัวอักษรภาษาอังกฤษทั้งตัวเล็กและใหญ่่');
    	form.password.focus();
    	return false;
    }
    if(password_confirm != password) {
    	alert('Password ไม่ตรงกับ Password (Confirm)');
    	form.password_confirm.focus();
    	return false;
    }
    return true;
}

function validateNonEmpty(text) {
	if(text.length == 0) {
		return false;
	} else {
		return true;
	}
}
function validateSSN(ssn) {
	var re = /^\d{13}/;
	return re.test(ssn);
}
function validateTel(tel) {
	var re = /^\(?([0-9]{2,3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	return re.test(tel);
}
function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
    return re.test(email);
}
function validatePassword(pwd) {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
	return re.test(pwd);
}
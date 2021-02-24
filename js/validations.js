function validate_login() {

    var myForm = document.forms.myform;

    var username = myForm.user_name.value;
    var password = myForm.password.value;

    var flag = false;

    if (username.trim().length > 0) {
        flag = true;
    }

    if (flag && password.trim().length >= 6) {
        flag = true;
    } else {
        flag = false;
    }

    if (flag === false) {
        document.getElementById("loginValidationMessage").innerHTML = "<span style='color:#f00;'>Sorry..!, Your login faile. Please check username or password.</span><br/><br/>";
    } else {
        document.getElementById("loginValidationMessage").innerHTML = "";
    }

    return flag;

}
function confirm_delete(e) {

    var flag = confirm("Are you want to delete");
    if (!flag) {
        e.preventDefault();
    }
}



function validate_user_registration() {
    var form = document.forms.registration_form;
    var player_name = form.player_name.value;
    var player_password = form.player_password.value;
    var player_password_confirm = form.player_password_confirm.value;



    var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    var flag = false;
    if (player_name.trim().length > 0) {
        flag = true;
    } else {
        flag = false;
    }


    if (flag && player_password.trim().length >= 6) {
        flag = true;
    } else {
        flag = false;
    }


    if (flag && player_password_confirm.trim().length >= 6) {
        flag = true;
    } else {
        flag = false;
    }

    //=== equals is know as strict comparision, where it complare not only the values and also its types.
    if (flag && player_password === player_password_confirm) {
        flag = true;
    } else {
        flag = false;
    }

    if (flag && player_email.match(pattern)) {
        flag = true;
    } else {
        flag = false;
    }


    if (flag === false) {
        document.getElementById("registration_validate_message").innerHTML = "<span style='color:#f00;'>Enter same password</span><br/><br/>";
    } else {
        document.getElementById("registration_validate_message").innerHTML = " ";
    }

    return flag;
}



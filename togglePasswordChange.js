const cbPassword = document.getElementById("change_pass");

const passwordFieldsContainer = document.querySelector(".password_fields_container");

const passwordFields =
`
<div class="password_fields p-3 mt-3 border rounded">
    <label for="password">New Password</label>
    <input class="form-control" type="password" id="password" name="password" required> <br>
    <label for="password">Confirm Password</label>
    <input class="form-control" type="password" id="repeat_password" name="repeat_password" required> <br>
</div>
`

const togglePasswordChange = () => {
    if(cbPassword.checked){
        passwordFieldsContainer.innerHTML+=passwordFields;
    }else{
        passwordFieldsContainer.innerHTML="";

    }
}

cbPassword.addEventListener("click", togglePasswordChange);

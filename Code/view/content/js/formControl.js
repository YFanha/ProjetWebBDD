/**
 * file :   formControl.js
 * author : Yann Fanha
 * date :   11.05.2021
 * brief :  Form controler. Verify values the user put in fields and disable or active things
 */
document.addEventListener('DOMContentLoaded', function() {
    const btnRegister = document.getElementById('btnSubmitRegister');
    const inputPassword = document.getElementById('inputPassword');

    inputPassword.addEventListener('input', function () {
        const MAX_PWD_LENGTH = 16;
        const MIN_PWD_LENGTH = 8;
        const classHIDDEN = 'hidden';
        var pwdLength = inputPassword.value.length;

        console.log(pwdLength);

        if(pwdLength < MIN_PWD_LENGTH){
            //btnRegister.classList.add(classHIDDEN);
            btnRegister.disabled = true;
            console.log("classe : " + classHIDDEN + " ajoutée  -- ");
        } else {
            //btnRegister.classList.remove(classHIDDEN);
            btnRegister.disabled = false;
            console.log("classe : " + classHIDDEN + " retirée  -- ");
        }
    });
});
import $ from 'jquery';

const passwordShowIcon = "bi bi-eye-fill";
const passwordHideIcon = "bi bi-eye-slash-fill";
let showPassword = false;


$("#toggle-password").on('click', function() {
    showPassword = !showPassword;
    
    if(showPassword) {
        $("#password-icon").removeClass(passwordShowIcon);
        $("#password-icon").addClass(passwordHideIcon);
        $("#passwd").attr("type", "text");
    } else {
        $("#password-icon").removeClass(passwordHideIcon);
        $("#password-icon").addClass(passwordShowIcon);
        $("#passwd").attr("type", "password");
    }
})
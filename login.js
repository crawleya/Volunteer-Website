/* Alisha Crawley-Davis
 * CS 290
 * 6/7/2015
 * Final Project
 * Code modified from class materials, tutoring sessions, w3 schools, and this tutorial: http://web.enavu.com/tutorials/checking-username-availability-with-ajax-using-jquery/
 * */
$(document).ready(function () {
    "use strict";
    $('#submitbutton').click(function () {
        if ($('#username').val().length < 1 || $('#password').val().length < 1) {
            alert("Please fill out all fields");
            return false;
        }
        $('#username_availability_result').html('');
        check_availability();
        return false;
    });
});

//function to check login credentials
function check_availability() {
    "use strict";
    //get the form data
    var username = $('#username').val();
    var password = $('#password').val();
    //use ajax to run the check
    $.post("check_login.php", {username: username, password: password},
            function (result) {
        //if the result is not 1, login is incorrect
        if (result != 1) {
            $('#username_availability_result').html("Invalid username or password. Please try again.");
            $('#username_availability_result').css("color", "red");
        } else {
            window.location.replace("volunteer.php");
        }
    });
}

/* Alisha Crawley-Davis
 * CS 290
 * 6/7/2015
 * Final Project
 * Code modified from class materials, tutoring sessions, w3 schools, and this tutorial: http://web.enavu.com/tutorials/checking-username-availability-with-ajax-using-jquery/
 * */
$(document).ready(function () {
    "use strict";
    //check username as user fills out form
    $('#submitform').click(function () {
        $('#username_availability_result').html("");
        $('#pw_result').html("");
        if ($('#fname').val().length < 1 ||
                $('#lname').val().length < 1 ||
                $('#username').val().length < 1 ||
                $('#password').val().length < 1 ||
                $('#email').val().length < 1) {
            alert("Please fill in all fields");
            return false;
        }
        if (isNaN($('#grade').val()) || $('#grade').val() == "") {
            alert("Please enter a number for your child's grade");
            return false;
        }
        if ($('#grade').val() % 1 != 0) {
            alert("Please enter a whole number from 0 to 5 for your child's grade");
            return false;
        }
        if ($('#grade').val() < 0 || $('#grade').val() > 5) {
            alert("Please enter a number from 0 to 5 for your child's grade");
            return false;
        }
        //run the character number check
        if ($('#password').val().length < 6) {
            //if it's below the minimum show characters_error text
            $('#pw_result').html("Password needs to be at least six characters");
            $('#pw_result').css("color", "red");
        } else {
            //else check availability
            $('#username_availability_result').html("");
            $('pw_result').html("");
            check_availability();
        }
        return false;
    });
});
//function to check username availability
function check_availability() {
    //get the form data
    "use strict";
    var username = $('#username').val();
    var password = $('#password').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var grade = $('#grade').val();
    var email = $('#email').val();
    //use ajax to run the check
    $.post("regcheck.php", {username: username, password: password, fname: fname, lname: lname, grade: grade, email: email},
            function (result) {
        //if the result is 1
        if (result == 1) {
            window.location.replace("login.php?action=registrationsuccess");
        } else {
            //show that the username is NOT available
            $('#username_availability_result').html('Sorry, ' + username + ' is not available. Please enter a different username.');
            $('#username_availability_result').css("color", "red");
        }
    });
}

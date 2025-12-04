<?php
session_start();
include "./database/db.php";

if(isset($_POST['signup'])){
    if(!empty($_POST['fname']))
        $fname = $_POST['fname'];
    if(!empty($_POST['lname']))
        $lname = $_POST['lname'];
    if(!empty($_POST['emailSignup']))
        $email_signup = $_POST['emailsignup'];
    if(!empty($_POST['signup_pass']))
        $sign_pass = $_POST['signup_pass'];
    if(!empty($_POST['conf_signup_pass']))
        $conf_pass = $_POST['conf_signup_pass'];
}

$sql = "INSERT INTO user VALUES($email , $sign_pass , $fname , $lname)";



if (isset($_POST['login'])){
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    }
    if(!empty($_POST['login-pass'])){
        $login_pass = $_POST['login-pass'];
    }
}



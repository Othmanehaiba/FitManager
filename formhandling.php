<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require "./database/db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])){
    if(!empty($_POST['fname']))
        $fname = $_POST['fname'];
    if(!empty($_POST['lname']))
        $lname = $_POST['lname'];
    if(!empty($_POST['emailSignup']))
        $email_signup = $_POST['emailSignup'];
    if(!empty($_POST['signup_pass']))
        $sign_pass = $_POST['signup_pass'];
    if(!empty($_POST['conf_signup_pass']))
        $conf_pass = $_POST['conf_signup_pass'];
    
    $sql = "INSERT INTO user (email, mdp, firstName, lastName)
     VALUES('$email_signup' , '$sign_pass' , '$fname' , '$lname')";
    $row = $conn->query($sql);

    header("Location: login.php");
    exit();
    if(!$row){
        echo "NOK1";
        $_SESSION['error'] = "❌ Connexion échouée";
        header("Location: login.php");
        exit();
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $email = $_POST['email'];
    $login_pass = $_POST['login-pass'];

    $res = $conn->query("SELECT * FROM user WHERE email = '$email'");

    if ($res && $res->num_rows === 1) {

        $row = $res->fetch_assoc();

        if ($row['mdp'] === $login_pass) {
            $_SESSION['user'] = $row['id'];
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "<p class='error'>❌ Connexion échouée</p>";
            header("Location: login.php");
            exit();
        }

    }
}

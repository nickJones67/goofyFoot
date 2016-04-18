<?php
session_start();
?>
<?php
/*
*** @Program: SkateView
*** @Page: account.php
*** @Author: John Nelson
*** @Date: 27 APR 2016
*** @Description: PHP account management file
*/

require 'db_connect.php';

$action = $_POST["action"];
$role = $_POST["role"];
$email = $_POST["email"];
$uName = $_POST["username"];
$pWord = $_POST["password"];
$fName = $_POST["fName"];
$lName = $_POST["fName"];

switch ($action){
    case "Create":
        createAccount();
        break;
    case "Update":
        updateAccount();
        break;
    case "Delete":
        deleteAccount();
        break;
}


function createAccount(){
    $query = "INSERT INTO user (role_wk, first_name, last_name, user_name, email, hashed_password) VALUES (?,?,?,?,?,?)";
    global $mysqli_connection, $role, $email, $uName, $pWord, $fName, $lName;
    if ($query = $mysqli_connection->prepare("$query")) {
        $query->bind_param("ssssss", $role, $fName, $lName, $uName, $email, $pWord);
        $query->execute();
    }
}

function updateAccount(){
    $query = "UPDATE user set role_wk=?, first_name=?, last_name=?, hashed_password=? WHERE email=?";
    global $mysqli_connection, $role, $pWord, $fName, $lName;
    if ($query = $mysqli_connection->prepare("$query")) {
        $query->bind_param("ssss", $role, $fName, $lName, $pWord);
        $query->execute();
    }
}

function deleteAccount(){
    $query = "DELETE FROM user WHERE email=?";
    global $mysqli_connection, $email;
    if ($query = $mysqli_connection->prepare("$query")) {
        $query->bind_param("s", $email);
        $query->execute();
    }
}

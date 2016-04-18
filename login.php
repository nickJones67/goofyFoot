<?php
session_start();
?>
<?php
   /*
   *** @Program: SkateView
   *** @Page: login.php
   *** @Author: John Nelson
   *** @Date: 27 APR 2016
   *** @Description: PHP login file
   */
   require 'db_connect.php';

   function login()
   {
      global $mysqli_connection;
      $login = false;
      $email = $_POST["email"];
      $pWord = $_POST["password"];

      $row = array();
      if ($query = $mysqli_connection->prepare("SELECT first_name,role_wk,hashed_password,email FROM user WHERE email=?")) {
         $query->bind_param("s", $email);
         $query->execute();
         $query->bind_result($row[0], $row[1], $row[2], $row[3]);

         if ($pWord === $row[2]) {
            $login = true;
         } else {
            echo("Invalid username or password");
         }
      }

       if ($login) {
          if ($query = $mysqli_connection->prepare("SELECT name FROM role WHERE role_wk=?")) {
             $query->bind_param("s", $row[1]);
             $query->execute();
             $query->bind_result($row[4]);
             $_SESSION["user"] = $row[0];
             $_SESSION["email"] = $row[3];
             $_SESSION["role"] = $row[4];
             header("Location:index.php");
          }
       }
   }

function logout(){
   session_destroy();
   header("Location:index.php");
}

if (isset($_POST['logout'])){
   logout();
}else{
   login();
}


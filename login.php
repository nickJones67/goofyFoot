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
      $login = false;
      $email = $_POST["username"];
      $pWord = $_POST["password"];
      $row = array();
      if ($query = $mysqli_connection->prepare("SELECT hashed_password FROM user WHERE email=?")){
         $query->bind_param("s", $email);
         $query->execute();
         $query->bind_result($row[0]);

         if ($email === $row[0]){

         }

      }



      if ($login) {
         $_SESSION["user"] = $uName;
         header("Location:portfolio.php");
      }
   }

function logout(){
   session_destroy();
   header("Location:index.html");
}

if (isset($_POST['logout'])){
   logout();
}else{
   login();
}


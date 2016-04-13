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
      $email = $_POST["username"];
      $pWord = $_POST["password"];
      $row = array();
      if ($query = $mysqli_connection->prepare("SELECT first_name,hashed_password FROM user WHERE email=?")){
         $query->bind_param("s", $email);
         $query->execute();
         $query->bind_result($row[0], $row[1]);

         if ($pWord === $row[1]){
            $login = true;
         }else{
             
         }

          if ($login) {
              $_SESSION["user"] = $row[0];
              header("Location:portfolio.php");
          }
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


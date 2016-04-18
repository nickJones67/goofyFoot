 /*
 *** @Program: SkateView
 *** @Page: account.js
 *** @Author: John Nelson
 *** @Date: 27 APR 2016
 *** @Description: Account validation information
 */

 "use strict";
 function checkLogin(){
     var user = document.getElementById("username").value;
     var password = document.getElementById("password").value;
     
     if ((user !== null || user !== "") && (password !== null || password !== "")){
         document.getElementById("formLogin").submit();
         
     }
 }

 function checkAccount(action){
     $action = $_POST["action"];
     $role = $_POST["role"];
     $email = $_POST["email"];
     $uName = $_POST["username"];
     $pWord = $_POST["password"];
     $fName = $_POST["fName"];
     $lName = $_POST["fName"];

     switch (action){
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
     

 }
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
     var errorMsg;
     var curRole = document.getElementById("currentRole").value;
     var curEmail = document.getElementById("currentEmail").value;
     var user = document.getElementById("username").value;
     var password = document.getElementById("password").value;
     var confirmPassword = document.getElementById("confirmPassword").value;
     var email = document.getElementById("email").value;
     var fName = document.getElementById("fName").value;
     var lName = document.getElementById("lName").value;
     var role = document.getElementById("role").value;

     document.getElementById("formManagement").submit();

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

     function createAccount(){
         var mError = false;
         if (!user){
             errorMsg = buildErrorMessage(errorMsg, "Username can't be blank");
         }
         if (!password){
             errorMsg = buildErrorMessage(errorMsg, "Password can't be blank");
         }
         if (!confirmPassword){
             errorMsg = buildErrorMessage(errorMsg, "Confirm password can't be blank");
         }else if (password !== confirmPassword){
             errorMsg = buildErrorMessage(errorMsg, "Passwords must match");
         }
         if (!email){
             errorMsg = buildErrorMessage(errorMsg, "Email can't be blank");
         }

         if (mError){
             error(errorMsg);
         }else{
             document.getElementById("action").value = "Create";
             document.getElementById("formManagement").submit();
         }
     }

     function updateAccount(){
         if (!(role === "Admin" || curEmail === email)){
             error("You must be owner of account or admin user to update account information")
             return;
         }

         if (password){
             if (!(confirmPassword && password === confirmPassword)){
                 error("Passwords must match");
                 return;
             }
         }

         document.getElementById("action").value = "Update";
         document.getElementById("formManagement").submit();
     }

     function deleteAccount(){
         if (!(role === "Admin" || curEmail === email)){
             error("You must be owner of account or admin user to delete account")
             return;
         }else{
             document.getElementById("action").value = "Delete";
             document.getElementById("formManagement").submit();
         }
     }
 }

 function buildErrorMessage(mCurrentError, mNewError){
     if (mCurrentError){
         mCurrentError += ", " + mNewError;
     }else{
         mCurrentError = mNewError;
     }

     return mCurrentError;
 }

 function error(message){
     document.getElementById("error").value = message;
     document.getElementById("error").hidden = false;
 }
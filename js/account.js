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
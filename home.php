<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
   body {
     background-color: #f4f4f4;
     font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
     margin: 0;
     height: 100vh;
     display: flex;
     align-items: center;
     justify-content: center;
   }
form {
   position: fixed;
   top: 10px;
   right: 10px;
   margin: 0;
 }


 button.btn-danger {
   background-color: #dc3545;
   color: #fff;
   border: none;
   padding: 8px 16px;
   border-radius: 4px;
   cursor: pointer;
   font-size: 14px;
   transition: background-color 0.3s ease;
 }


 button.btn-danger:hover {
   background-color: #c82333;
 }
   .chat-container {
width:90%;
     border: 1px solid #ddd;
     border-radius: 8px;
     overflow: hidden;
     box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);


     }


   .chat-header {
     background-color: #007bff;
     color: #fff;
     padding: 10px;
     text-align: center;
     font-size: 18px;
     font-weight: bold;
     border-bottom: 1px solid #ddd;
   }


   .chat-messages {
     flex: 1;
     overflow-y: auto;
     padding: 10px;
   }


   .message {
     margin-bottom: 15px;
     overflow: hidden;
   }


   .message .user {
     font-weight: bold;
     margin-bottom: 5px;
   }


   .message .content {


     border: 1px solid #ddd;
     border-radius: 8px;
     padding: 10px;
   }


   .message .time {
     color: #888;
     font-size: 12px;
     float: right;
   }


     .chat-input {
     position: fixed;
     bottom: 0;
     left: 0;
     width: 100%;
     padding: 10px;
     background-color: #fff;
     z-index: 1000;
   }


   .input-group-addon,
   .btn-send {
     background-color: #007bff;
     color: #fff;
     border: none;
   }
 </style>
</head>
<body onload="load()">
<form action="login.php" method="post">
   <input type="hidden" name="auth" value="logout">
   <button type="submit" class="btn btn-danger" style="position: fixed; top: 10px; right: 10px;">Logout</button>
 </form>
 <div id="con" class="container">
   <div class="chat-container">
     <div class="chat-header">
       Chat Room
     </div>
     <div class="chat-messages" id="chat-messages">
       <!-- More messages go here -->
     </div>
     <br>
     <br>
     <div id="end">
     </div>
     <div id="chat-input" class="chat-input">
       <div class="input-group">
         <textarea id="msg" class="form-control" placeholder="Type your message..."></textarea>
         <div class="input-group-append">
           <button onclick="send()" class="btn btn-send" type="button">Send</button>
         </div>
       </div>
     </div>
   </div>
 </div>
 <script>
 function load() {
   var element = document.getElementById("con");


   // Assuming getMsg returns a Promise, you can use .then
   getMsg().then(() => {
       // After sending the message, scroll to the bottom of the screen
       element.scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });
   }).catch((error) => {
       console.error("Error fetching messages:", error);
   });
}
let msgs = [];
function updateScreen(obj){
    let uName = getCookie("userid")[0];
 let uN = getCookie("userid")[1];


     let revs = document.getElementById("chat-messages");
let content = "";


 let dispName;
 let bg;
 let c;


 for (let i = 0; i < obj.length; i++) {
 if (uName === obj[i]["user_id"]){
   dispName = "You ("+uN+")";
   bg = "#075E54";
   c = "#ffffff";
 }
 else{
       dispName = obj[i]["username"];
       bg = "#ddd";
       c = "#000000";
 }
 console.log(obj[i]["message_text"]);
   content += `<div class="message">
         <div class="user">`+dispName+`</div>
         <div style="background-color:`+bg+`;`+`color:`+c+`;" class="content">` + obj[i]["message_text"] + `


         </div>
         <div class="time">` + obj[i]["timestamp"] + `</div>
       </div>
       `;
}

   revs.innerHTML += content;








}

function filterLatestEntry(array1, array2) {
  // Find the latest entry's ID across both arrays:
  const latestId = Math.max(...array1.map(item => item.id), ...array2.map(item => item.id));

  // Filter out the entry with the latest ID:
  const filteredArray = array1.concat(array2).filter(item => item.id !== latestId);
  return filteredArray;

}

function filterLatestAndAdditionalEntries(array1, array2) {
  // Find the latest entry's ID:
  const latestId = Math.max(...array1.map(item => item.id), ...array2.map(item => item.id));

  // Filter out the latest entry and entries only in array2:
  const filteredArray = array1.filter(item => {
    return item.id !== latestId && array2.some(item2 => item2.id === item.id);
  });

  return filteredArray;
}


function disp(jsn) {


 let obj = jsn; // Correct variable name

 if (msgs.length === obj.length){
   return;


 }
 if (msgs.length === 0){
   msgs = obj;
   updateScreen(obj);
 }
 else if (obj.length > msgs.length){
  //let test = JSON.stringify(filterLatestAndAdditionalEntries(obj,msgs));
 //alert(test);
  let msgsLength = msgs.length - 1;
   //alert(msgsLength);
   let newArr = obj.slice(msgsLength);
   updateScreen(newArr);
   //alert(JSON.stringify(newArr));
   alert(msgs);
   msgs = [...msgs, ...newArr];
   alert(JSON.stringify(newArr));

  alert(JSON.stringify(msgs));

}


}


function move(){
var element = document.getElementById("con"); // Use document.documentElement to refer to the whole document
   if (element) {
     element.scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });
   }
}
function send(){


   if (msg){
 // After sending the message, scroll to the bottom of the screen
   let msg = document.getElementById("msg").value;
   let mesgDiv = document.getElementById("chat-messages");




 let dispName = "You ("+getCookie("userid")[1] + ")";
  let bg = "#075E54";
   let c = "#ffffff";
   const now = new Date();


   const formattedTime = now.toLocaleString('en-GB', {
   day: '2-digit',
   month: '2-digit',
   year: 'numeric',
   hour: '2-digit',
   minute: '2-digit',
   second: '2-digit'
});


   let content = "";
   content += `<div class="message">
         <div class="user">`+dispName+`</div>
         <div style="background-color:`+bg+`;`+`color:`+c+`;" class="content">` + msg  + `


         </div>
         <div class="time">` + formattedTime + `</div>
       </div>
       `;
   mesgDiv.innerHTML += content;
 let userIdValue = getCookie("userid")[0];
 let uName = getCookie("userid")[1];

 let newMsg = {"message_id":msgs[msgs.length - 1]["message_id"] + 1,"user_id":userIdValue,"message_text":msg,"username":uName,"timestamp":formattedTime}
msgs.push(newMsg);
//alert(JSON.stringify(msgs[msgs.length - 1]));
 move();


 fetch('http://192.168.0.203/api/db/mesg', {
   method: 'POST',
   body: JSON.stringify({uid: userIdValue,message:msg,uname:uName})
 })
}
}


function getMsg() {
   // Return the fetch Promise directly
   return fetch("http://192.168.0.203/api/db/getMsg")
       .then(response => response.json())
       .then(data => disp(data));
}
setInterval(getMsg,5000);


function getCookie(name){
 let uId = <?php echo $_SESSION["userid"]?>;
return uId;






}


</script>


 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

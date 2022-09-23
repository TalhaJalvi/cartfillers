
<?php
//starting session here as we will need user info on next page then we are storing it here
session_start();
?>
</!DOCTYPE html>
<html>
<head>
	<title>forgotpassword.php</title>  
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<style type="text/css">
.container{
  display:grid;
  grid-gap: 2px;
  width: 100%;
  grid-template-areas: " navbar navbar " 
                       " form   form  "
}
.form{
  grid-area: form;
 margin: auto;
 width: 500px;
 height: 500px;
 margin-top: 100px;
 border-radius: 8px;
 position: relative;
   background-color: #DCDCDC;
 /* The above line position relative means anything inside will be positioned according to  this content not b-model if not used 
    our cross button will be positioned relative to bg-model*/   
}
#notifi{
  /* Only for JS purpose */
}

form{
  margin-top: 30px;

}


  /* Now stylizing our text boxes*/
 input[type="text"]{
  width: 220px;
  height: 30px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-left: 130px;
  margin-top: 15px;
 } 
 
 /* On focus changing border colour*/
  input[type="text"]:focus{
  border-color: #1b9bff;
 } 

form button{
  margin-top: 12px;
}

.navbar{
  grid-area: navbar;
  height: 80px;
  width: 100%;
background-color: #292930;
  color: white;
  border-radius: 12px;
  display: flex;

}
label.logo{
  color: #FCC133;
  font-size: 40px;
  line-height: 80px;
  padding: 0 100px;
  font-weight: bold;
}
nav ul{
  float: right;
  margin-right: 20px;
  text-decoration: none;
}
nav ul li{
  display: inline-block;
  line-height: 60px;
  margin: 0 5px;
}
nav ul li a{
  color: white;
  font-size: 20px;
  padding: 0px 13px;
  border-radius: 3px;
}
nav ul li button{
  margin-left: 0px; 
  color: white;
background-color: #FCC133;
  height: 40px;
  width: 120px;
  font-size: 14px;
  padding: 0px 2px;
  border-radius: 6px;
  text-transform: uppercase;

}
nav ul li button:hover{
  background: #1b9bff;
  transition: .5s;
}
a:hover{
  background: #1b9bff;
  transition: .5s;
}
@media (max-width: 1030px){
  label.logo{
    font-size: 25px;
    padding-left: 50px;
  }
  nav ul li a{
    font-size: 14px;
  }
  #img{
  display: none;
}

}
@media (max-width: 950px){

.navbar{
  width: 100%;
}

    #img{
  display: none;
}

h2{
  size: 12px;
}
}
@media (max-width: 380px){
  label.logo{
    font-size: 20px;
    padding-left: 50px;
  }
  nav ul li a{
    font-size: 16px;
  }
    #img{
  display: none;
}
}


  </style>

</head>
<body>
<div class="container">
  <!-- This is our navbar class-->
    <div class="navbar">
    
     <nav>
      <label class="logo"> CartFiller's</label>
      <ul>
        <li><a href="https://blog.feedspot.com/marketing_blogs/ "  target="_blank">BLOGS</a></li>
        <li><a href="Aboutus.php">About us</a></li>
        <img src="images\cart logo.png" height="40" width="40" style="margin-left: 30px;" id="img" />
      </ul>
    </nav>
       <!-- Navbar class ends here below-->
  </div>


 <div class="form">
      <!-- Showing image at first -->
      <center><img src="images\user icon for login popup.png" style="padding-top: 20px;" width="150" height="150"></center>
      <form method="post"  action="forgotpas.php" >
        <center><b style="color: white;">Please Enter Your Mail so we can find your Account</b></center>
        <center><font size="-1" style="color: white;" id="notifi"> </font></center>
        <input type="text" name="usrmail"  required="true" placeholder="&#128231;  Your Email Here">
      
         </br>
        <center><input type="submit" style="background-color: #FCC133; width: 100px; height: 40px; border-radius: 10px; color: white;"  name="Send" value="Send Code" /></center>    
      </form>
      <!-- Form class ends below--> 
     </div>
     <!-- Main container ends below -->
</div>
</body>
</html>
<?php
$usermail="";
$token="";
if (isset($_POST["Send"])) {
//Now if user clicks send code button
   //First we check whether text entered in the text field is valid EMAIL or not
 $usermail=$_POST['usrmail'];
 if (!filter_var($usermail, FILTER_VALIDATE_EMAIL)) {?>
   <script>
       document.getElementById('notifi').innerHTML = "Email Syntax was incorrect";
      </script>
      <?php
}
else{
 //Now firstly checking this email exists in out Database or not
 $conn=mysqli_connect('localhost','root','','cartfillers');
 if($conn==false){
    //If connection building is failed to database
  echo "Connection to DBMS failed";
 }
 else{
 $query="SELECT * FROM `members` WHERE `Email`='$usermail'";
 $result=mysqli_query($conn,$query);
 $row=mysqli_num_rows($result);
 if($row==1){
  //We will enter here if record of user is present in our database
  //Now mailing him token on his mail 

  //First generating a unhique token
  /*There are many methods to generate a unique token but it should be unique and has less chance to match with other token generated We will use uniqid() and sha1()
    functions for this purpose  first one will accept a string and return a unique identifier based on time in micro secounds. The secound one will calculate hash of 
    that string using US secure Hash Algorithm 1 At the end we will have  a unique 40 character long token */



    $token=sha1(uniqid($usermail,true));
    $url="localhost/project/forgotpas.php?token=$token";

    /* SERVER["REQUEST_TIME"] returns time or time staamp when request was made to server */
    $timestmp=$_SERVER['REQUEST_TIME'];

    //Now that tken has been generated sending it to user and database

    //First to user so if sent successfully then we will save it to database
    //Sending Email to our user (who has requested this)

$to = $usermail;
$subject = 'Account Recovery';
$from = 'talhajalvi321@email.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message='
<html>
<body>
<p>Hi,<br>
This mail is sended on response to your request of account password recovery. Please click on link below to proceed</p>
<a href="'.$url.'">Recover password</a>
</br>
</br>
<p>Regards,<br>
Cartfillers Inc.</p>
</body>
</HTML>'
;
// Sending email
if (mail($to, $subject, $message, $headers)) {
    //Now if mail was successfully sent we are saving this url and user who requested email to database for our further use
    $query2="INSERT INTO `reset_password` (`usermail`, `token`, `tstamp`) VALUES ('$usermail', '$token', '$timestmp')";
    $result2=mysqli_query($conn,$query2);
    if(!$result2){
            echo "Error in DB";
    }
    else
      {?>
      <script>

       document.getElementById('notifi').innerHTML = "Recovery link was sent via Email check your mail for further";
      </script>
      <?php   
    }
 }
 else {?>
      <script>
       document.getElementById('notifi').innerHTML = "Email sending failed! Please give correct mail or check connection (internet)";
      </script>
<?php
}
}
 else{?>
        <script>
       document.getElementById('notifi').innerHTML = "This mail is not a registered mail";
      </script>
 <?php
}

 }
}
}


//Now when user clicks on provided link we will check whether his token is valid and has not expired if not then he will be directed to new password page
if(isset($_GET["token"])){
$token=$_GET["token"];
//Now getting data from database
$conn=mysqli_connect('localhost','root','','cartfillers');
if(!$conn){
  echo "connection failed";

}
else{
$query3="SELECT * FROM `reset_password` WHERE `token`='$token'";
$result3=mysqli_query($conn,$query3);
$row3=mysqli_num_rows($result3);
$detail=mysqli_fetch_array($result3);
if($row3==1){
  //Now that request has been found getting user mail who has requested this password recovery

  $timestmp=$detail['tstamp'];
  $usermail=$detail['usermail'];
  //Now checking whether token has been expired or not if yes then deleting record from database of that user
  //1 day measured in secounds 60 sec * 60 min * 24 hours
  //Remember that timestamp type stores all information like year,month,day,time from local time zone to UTC then when accessed convert it to that time zone
  $delta=86400;
  if($_SERVER["REQUEST_TIME"] - $timestmp > $delta){
     ?>
   <script>
       document.getElementById('notifi').innerHTML = "Token has expired! Request for new one";
      </script>
      <?php
      //Now deleting row containing this token
      $query4="DELETE FROM `reset_password` WHERE `reset_password`.`token` = '$token'";
      $result4=mysqli_query($conn,$query4);
  }
  //if not expired then storing user mail and directing user to new password page
  else{
    $_SESSION['token']=$token;
    $_SESSION['usermail']=$usermail;
        ?>
    <script>
          window.open('recoverpass.php','_self');
    </script>
    <?php
  } 
}else{
  ?>
   <script>
       document.getElementById('notifi').innerHTML = "No data found! Request again for password recovery";
      </script>
      <?php
}
}
}
?>
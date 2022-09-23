
<?php
//Starting session here so that we can get data from previous page (data is user mail whose password isto be recovered
session_start();
$usermail= $_SESSION['usermail'];
$token=$_SESSION['token'];
?>
</!DOCTYPE html>
<html>
<head>
	<title>Recoverpassword.php</title>   
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
background-color: #DCDCDC;
 border-radius: 8px;
 position: relative;
 /* The above line position relative means anything inside will be positioned according to  this content not b-model if not used 
    our cross button will be positioned relative to bg-model*/   
}
#notifi{
  /* Only for JS purpose */
  color: white;
}
#formrec{
  /* Only for JS purpose */
}

form{
  margin-top: 30px;
}


  /* Now stylizing our text boxes*/
 input[type="password"]{
  width: 220px;
  height: 30px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-top: 15px;
 } 
 
 /* On focus changing border colour*/
  input[type="password"]:focus{
  border-color: #1b9bff;
 } 

 /* Now stylizing our text boxes*/
 input[type="text"]{
  width: 220px;
  height: 30px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-top: 15px;
 } 
 
 /* On focus changing border colour*/
  input[type="text"]:focus{
  border-color: #1b9bff;
 } 

form button{
  margin-top: 12px;
}
.pstxt1{
  /* Only for JS purpose */
}
.pstxt2{
  /* Only for JS purpose */
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
      <form id="formrec" method="post" action="recoverpass.php" >
        
        <center><input  type="password" name="pass1"  required="true" placeholder="&#128274; New Password here"  class ="pstxt1"></center>
        <center><input type="password" name="pass2"  required="true" placeholder="&#128274; Retype New Password here" class="pstxt2"></center></br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  onclick ="showpassword()">
      </br>
        <center><font id="notifi"></font></center>
      
         </br>
        <center><input type="submit" style="background-color: #FCC133; width: 100px; height: 40px; border-radius: 10px; color: white;"  name="Send" value="Reset Password" /></center>    
      </form>
      <!-- Form class ends below--> 
     </div>
     <!-- Main container ends below -->
</div>


<script type="text/javascript">
  function showpassword() {
    // body...
    //Now accessing type of both textfields in our form
    //This code is for showing password inn text field
    var x=document.querySelector('.pstxt1');
    if (x.type=="password") {

      x.type="text";

    }
    else{
      x.type="password";
    }

     var y=document.querySelector('.pstxt2');
      if (y.type=="password") {

      y.type="text";

    }
    else{
      y.type="password";
    }
  }
</script>
</body>
</html>
<?php 
if (isset($_POST["Send"])) {
  //First checking whether these two passwords match or not
  $pass1=$_POST["pass1"];
  $pass2=$_POST["pass2"];
  if ($pass1===$pass2) {
    //if password match then
    //Now updating user passwrd in data base
    $conn=mysqli_connect('localhost','root','','cartfillers');
    $query="UPDATE `members` SET  `Password` = '$pass1'  WHERE `members`.`Email`='$usermail'";
    $result=mysqli_query($conn,$query);
    if($result){  
  //Now after password was successfully updated deleting token so no one can use link again  to change password again
  $query2="DELETE from `reset_password` WHERE `reset_password`.`token` = '$token' AND `reset_password`.`usermail`='$usermail'";
  $result2=mysqli_query($conn,$query2);
  //Now unsetting session variables
  session_destroy();
  //Now going back to index page
    ?>
      <script>alert("Password was successfully updated! Please try to login again");
      //returning to same window when data was successfully uploaded to database
      window.open('index.php','_self');
    </script>
    <?php
   }
else{
    ?>
    <script type="text/javascript">
      document.getElementById('notifi').innerHTML="try again! Failed to update password";  
    </script>
    <?php
}
  }
  else{
    //If password not match then
    ?>
    <script type="text/javascript">
      document.getElementById('notifi').innerHTML="Password not match";  
    </script>

  <?php
}
}
 ?>

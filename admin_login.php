
<?php
//starting session here as we will need user info on next page then we are storing it here
session_start();
?>

<html>
<head>
	<title>admin login.php</title>  
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
}

form{
  margin-top: 30px;
}


  /* Now stylizing our text boxes*/
 input[type="number"]{
  width: 220px;
  height: 30px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-left: 130px;
  margin-top: 15px;
 } 
  input[type="text"]{
  width: 220px;
  height: 30px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-left: 130px;
  margin-top: 15px;
 } 
  input[type="password"]{
  width: 220px;
  height: 30px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-left: 130px;
  margin-top: 15px;
 } 
 /* On focus changing border colour*/
  input[type="number"]:focus{
  border-color: #1b9bff;
 } 
  input[type="password"]:focus{
  border-color: #1b9bff;
 } 
  input[type="text"]:focus{
  border-color: #1b9bff;
 } 
.pstxt1{
  /* Only for JS purpose */
}
form button{
  margin-top: 12px;
}

.navbar{
  grid-area: navbar;
  height: 80px;
  width: 100%;
background-color:#292930;
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
.checkbtn{
  font-size: 30px;
  color: white;
  float: right;
  line-height: 80px;
  margin-right: 40px;
  cursor: pointer;
  display: none;
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
      <form method="post"  action="admin_login.php" >
        <center><b style="color: white;">ADMIN please Login from here through your given cresedentials</b></center>
        <center><font size="-1" style="color: white;" id="notifi"> </font></center>
        <input type="number" name="adminid"  required="true" placeholder="&#128231;  Your Employee ID Here">
        <input type="password" name="adminpass" class="pstxt1" required="true" placeholder="&#128274;  Your Password Here">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  onclick ="showpassword()">
         <label style="color: white;">show password</label>
         </br>
        <center><input type="submit" style="background-color: #FCC133; width: 100px; height: 40px; border-radius: 10px; color: white;"  name="Login" value="Log in" /></center>    
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
  }
</script>
</body>
</html>
<?php
if (isset($_POST["Login"])) {
//Now if user clicks send code button
   //First we check whether text entered in the text field is valid EMAIL or not
 $adminid=$_POST['adminid'];
 $adminpassword=$_POST['adminpass'];

//Now making connection with our DB
 $conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
  # code...
  echo "Connection to DBMS failed";
}
else{
  //Now checking this admin exists in our db or not
  //Retrieving data which matches our admin cresedentials
  $queryadmin="SELECT * FROM `admin` WHERE `ID`='$adminid' AND `password`='$adminpassword'"; 
  //Now running query 
  $runadmin=mysqli_query($conn,$queryadmin);
  if($runadmin==true){
    //Now counting number of rows
    $rowadmin=mysqli_num_rows($runadmin);
    if($rowadmin>0){
    //Now making user login
      $_SESSION['admin']=$adminid;
   ?>
  <script type="text/javascript">
    window.open("admin_panel.php","_self");
  </script>
   <?php
    
    }
    else{
          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "No such admin exists";
    </script>
    <?php
    }
  }
  else{
    ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Failed to recive data from database";
    </script>
    <?php
  }
}


}

?>
 
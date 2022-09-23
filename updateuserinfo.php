<?php
// Starting session so that we could easily get data (we require user mail) into our this form
session_start();




//Now at above we are writing code for updation if user changes anything in it's profile else to it's email as it cannot be 
//changed

if(isset($_POST["Update"])){
  //Now it user clicks on update biutton on previous page we will enter this if statement
  //First getting values from forms
  $mail=$_SESSION['userid'];
  $password=$_POST['password'];
  $gender=$_POST['gender'];
  $name=$_POST['username'];
  $phoneno=$_POST['phone_number'];
  $address=$_POST['address'];
  $paymentmethod=$_POST['paymentmethod'];
  $mastercardno=$_POST['master_cardno'];
  //Now if payment method is not according to condition
  if($paymentmethod=="on delivery" && $mastercardno!="None" && $mastercardno!=""){
    echo '<script>alert("Your Mastercard nuimber should be None or empty")</script>';
    echo '<script>window.open("updateuserinfo.php","_self")</script>';
    //Stopping form to be submitted
    return false;
  }

  if($paymentmethod=="mastercard" && ($mastercardno=="None" || $mastercardno=="")){
    echo '<script>alert("Your Mastercard nuimber should not be None or empty")</script>';
    echo '<script>window.open("updateuserinfo.php","_self")</script>';
    //Stopping form to be submitted
    return false;
  }
  //Now if we donot go into these if's we are ready to update our data to our database
  // Now it's time to connect to our xamp mySQL database
$conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
  # code...
  echo "Connection to DBMS failed";
}
else{
  //Now if connection successful we will be here
  //Now writing and executing our update query
  $query="UPDATE `members` SET  `Password` = '$password', `gender` = '$gender', `Name` = '$name', `Phoneno` = '$phoneno', `Address` = '$address', `Payement_Method` = '$paymentmethod', `mastercard_no` = '$mastercardno' WHERE `members`.`Email` = '$mail'";
  $run=mysqli_query($conn,$query);
  if($run==true){
    ?>
    <script>
      alert('Data updated successfully');
      //returning to same window when data was successfully uploaded to database
      //now after information has been changed logging out from our website
      window.open('logout.php','_self');
    </script>
    <?php
  }else{
    ?>
    <script>
      alert('data not updated');
      //returning to same window when data was not successfully uploaded to database
      //window.open('index.php','_self');
    </script>
    <?php
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>update user info</title>
	<style type="text/css">
		body{
 width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.7);
  /* if we do simple opacity 0.7 it will also affect content within it so to make opacity only to remain in rhis we use rgba (red,green,blue, alpha 
     for opacity)*/

  position: absolute;
  /* So that our popup appear above background above this dark screen*/
  top: 0;
  /* Using flex to justify our popup in mid of screen; i.e making flex container*/
  justify-content: center;
  align-items: center;
  /* Making our content in flex or bg model to be in center first line horizontally and secoiund vertically*/
  /* Remember flex is a contrainer, elements of which are items and we can apply several CSS properties of flex to these items*/
		}
.form{
margin-left: 30%;	
 width: 500px;
 height: 1000px;
 background-color: white;
 border-radius: 8px;
 position: relative;
 /* The above line position relative means anything inside will be positioned according to  this content not b-model if not used 
    our cross button will be positioned relative to bg-model*/
}

form{
  margin-top: 60px;
}


  /* Now stylizing our text boxes*/
 input[type="text"]{
  width: 220px;
  height: 20px;
  border-radius: 6px;
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-left: 130px;
  margin-top: 15px;
 } 
  input[type="password"]{
  display: block;

  /* Display block means that all iput elements (one text field one password field and one button will appear on separate lines)*/
  margin-left: 130px;
  margin-top: 15px;  
  width: 220px;
  height: 20px;
  border-radius: 6px;
 } 
 /* On focus changing border colour*/
  input[type="text"]:focus{
  border-color: #1b9bff;
 } 
  input[type="password"]:focus{
    border-color: #1b9bff;
 }
input[type="radio"]{
  margin-left: 15%;
  display: inline-block;
  margin-top: 8%;
}
form button{
  margin-top: 12px;
}
	</style>
</head>
<body>
<!-- Now before showing user infor on screen first getting data from database -->
<?php
//First getting databse connection
 $conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
  # code...
  //If connection building is failed to database
  echo "Connection to DBMS failed";
}
else{
$query="SELECT * FROM `members`";
//Now executing query
$run=mysqli_query($conn,$query);
//Now finding that specific user info
while ($row=mysqli_fetch_array($run)) {
	//Now if we found our specific user then showing it's previous details in form so that he can edit easily
	if($_SESSION['userid'] == $row['Email']){
		//Now if we have found our requires user, now showing from and variab les in it
		?>
     <div class="form">
     	<!-- Showing image at first -->
     	<center><img src="images\user icon for login popup.png" style="padding-top: 20px;" width="150" height="150"></center>
     	<form method="post"  action="updateuserinfo.php" >
        Password:<hr><input type="password" name="password" required="true" value=<?php echo $row['Password'];?> >
       
        <!-- For radio buttons giving same name to all radio buttons related to same class so that only one of them can be selected
             and not all -->
      <?php       
      if($row['gender']=="m"){
      	?>
        Gender:<hr><input type="radio" id="MALE" name="gender" value="m" <?php echo 'checked'; //For making it selected?>>
        <label for="male">Male</label>
        <input type="radio" id="FEMALE" name="gender" value="f">
        <label for="female">Female</label>
        <input type="radio" id="OTHER" name="gender" value="o">
        <label for="other">Other</label></br>
        <?php
    }
    ?>
    
          <?php       
      if($row['gender']=="f"){
      	?>
        Gender:<hr><input type="radio" id="MALE" name="gender" value="m">
        <label for="male">Male</label>
        <input type="radio" id="FEMALE" name="gender" value="f" <?php echo 'checked'; //For making it selected?>>
        <label for="female">Female</label>
        <input type="radio" id="OTHER" name="gender" value="o">
        <label for="other">Other</label></br>
        <?php
    }
    ?>
          <?php       
      if($row['gender']=="o"){
      	?>
        Gender:<hr><input type="radio" id="MALE" name="gender" value="m" <?php echo 'checked'; //For making it selected?>>
        <label for="male">Male</label>
        <input type="radio" id="FEMALE" name="gender" value="f">
        <label for="female">Female</label>
        <input type="radio" id="OTHER" name="gender" value="o" <?php echo 'checked'; //For making it selected?>>
        <label for="other">Other</label></br>
        <?php
    }
    ?>

        Name:<hr><input type="text" name="username" required="true" value=<?php echo $row['Name'];?>>
        Phone number<hr><input type="text" name="phone_number" required="true" onkeypress="isInputNumber(event)" value=<?php echo $row['Phoneno'];?>>
        Address:<hr><input type="text" name="address" required="true" value=<?php echo $row['Address'];?>>
        </br><?php

        //Now selecting one radio button on basis of database value
        if($row['Payement_Method']=="on delivery"){	
         ?> 	
        Payment method:<hr><input type="radio" name="paymentmethod" value="on delivery" <?php echo 'checked';?>>
        <label for="ondelivery"><img src="images\on delivery.png" width="70" height="70"> on delivery </label>
        <input type="radio"  name="paymentmethod" value="mastercard" id="MASTERCARD">
        <label for="mastercard"><img src="images\Mastercard.png" width="70" height="70"> Master Card </label>
         Master Card #:<hr> <input type="text" name="master_cardno"  value="None">
        <?php
        }

        if($row['Payement_Method']=="mastercard"){
          ?> 	
        Payment method:<hr><input type="radio" name="paymentmethod" value="on delivery">
        <label for="ondelivery"><img src="images\on delivery.png" width="70" height="70"> on delivery </label>
        <input type="radio"  name="paymentmethod" value="mastercard" <?php echo 'checked';?>>
        <label for="mastercard"><img src="images\Mastercard.png" width="70" height="70"> Master Card </label>
         Master Card #:<hr> <input type="text" name="master_cardno"  value=<?php echo $row['mastercard_no'];?>>
         <?php
        }
        ?>
       
      
        <center><input type="submit" style="background-color: #4C2D73; width: 100px; height: 40px; border-radius: 10px; color: white;"  name="Update" value="Update" onclick="check()" /></center> 		
     	</form>
     	
     </div>

	<?php
	}
}
}
?>
<script type="text/javascript">
//Java Script code here

/* Function for only numeric characters can be entered in froms textfield (for phone number and mastercard number)*/
function isInputNumber(evt){
  var char=String.fromCharCode(evt.which);
  if(!(/[0-9]/.test(char))){
    evt.preventDefault();
  }
}
/* Function for numeric checking in registration form ends here */
</script>
</body>
</html>
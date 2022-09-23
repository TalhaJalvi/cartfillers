<!DOCTYPE html>
<html>
<head>
  <title>cartfillers.com</title>
      
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="index.css">
    

</head>
<body>
  <!-- Main div containing all class-->
  <div class="container">

  <!-- This is our navbar class-->
    <div class="navbar">
    
     <nav>
      <label class="logo"> CartFiller's</label>
      <ul>
        <li><a href="admin_login.php">Admin</a></li>
        <li><a href="https://blog.feedspot.com/marketing_blogs/ "  target="_blank">BLOGS</a></li>
        <li><a href="Aboutus.php">About us</a></li>
        <img src="images\cart logo.png" height="40" width="40" style="margin-left: 30px;" id="img" />
        <li><button id="Feedbacklink" >Feedback</button></li>



        <!-- These both 'login' and 'Register' buttons will work with js below -->
        <li><button   id="loginbutton">Log in</button></li>
        <li><button   id="registerbutton">Register</button></li>
      </ul>
    </nav>



       <!-- Navbar class ends here below-->
  </div>
        

    <div class="video">
<iframe width="1100" height="530" src="https://www.youtube.com/embed/edXjFRl2NhA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<br>
<br>
    <!-- Slider class end here above-->
     <!-- This div is for footer-->
        <div class="footer">
        <
        <ul>
        <li style="list-style-type: none;"><h1><b>CartFiller's</b></br><i class="fab fa-facebook"  ></i>&nbsp;&nbsp;<i class="fab fa-whatsapp-square"></i>&nbsp;&nbsp;<i class="fab fa-twitter"></i>&nbsp;&nbsp;<i class="fab fa-instagram"></i>&nbsp;&nbsp;<i class="fas fa-at"></i></h1> </li></ul>

       <!-- Lower footer starts here-->
         
        
       <div class="lowerfooter_left"1>
       <ul style="list-style: none;">
        <br>
        <br>
        <li><a href="#"> Branding</a></li>
        <li><a href="#"> Marketing</a></li>
        <li><a href="#"> Compaigns</a></li>
       </ul>
       </div>


       <div class="lowerfooter_right">
       <ul style="list-style: none;">
        <br>
        <br>
        <li><a href="#"> Branding</a></li>
        <li><a href="#"> Marketing</a></li>
        <li><a href="#"> Compaigns</a></li>
       <br>
       <br>
       <li><a href="mailto:talhajalvi321@gmail.com">Email Cartfiller's</a></li>
       </ul>


       </div>
     
      </div>
    <!-- Upperfooter ends below-->
      <!-- Main container ends below -->
</div>


  <!-- Model login form section-->
  <div class="bg-model">
    <div class="model-content">
      <!-- Placing cross icon button to close pop up whwn it is opened-->
      <div class="close_lgin_popup_btn">
        +
        <!-- The above will work by JS code below -->
        <!-- Div close_lgin_popup_btn ends here -->
      </div>
      <!-- Giving top padding or space to our image-->
      <center><img src="images\user icon for login popup.png" style="padding-top: 20px;" width="100" height="100"></center>
      <form action="loginvalidationbdms.php" method="post">
        <input type="text" name="mail" placeholder="&#128231;  Email" required="true">
        <input type="password" name="password" placeholder="&#128274; password" required="true">
        <center><a href="forgotpas.php" style="color: #4C2D73;">Forgot Password</a></center>
        <input type="submit" value="login" style="background-color: #4C2D73; width: 80px; height: 30px; border-radius: 10px; color: white; margin-left: 40%;">
      </form>
      <!-- div model-content ends here -->
    </div>
    <!-- Div bg-model ends here -->
  </div>



 <!-- Model register form section-->
  <div class="bg-model2">
    <div class="model-content2">
      <!-- Placing cross icon button to close pop up whwn it is opened-->
      <div class="close_regter_popup_btn">
        +
        <!-- The above will work by JS code below -->
        <!-- Div close_regter_popup_btn ends here -->
      </div>
      <!-- Giving top padding or space to our image-->
      <center><img src="images\user icon for login popup.png" style="padding-top: 20px;" width="150" height="150"></center>
      <!-- Now for saving data in database first giving address of our related php file where our database code is written (in this case it is 'registration.php' then our method is 'post' which is used to upload data in our database  we have to place ou whole project folder to htdocs folder in xamp folder in C, then change all HTML file extensions to php then run it from localhost -->

      <form  method="post" action="registration.php" onsubmit="return functionchckblank()">

        <!-- Names to these form elements are given for database our php (database code) will get data from these names and we 
             will store them in a variable then from this they are uploaded to our database -->


        <!-- Now for making checks giving all elements a specific ID and then making function funcionchckblank() to check
             whether any field is empty or not empty  and for only numeric data to be entered using onkeypress and inside
             of it we use  isInputNumber(event) function which we have defined in java script-->     
        
        <input type="text" name="mail" id="EMAIL" placeholder="&#128231; Email (Gmail where mail can be sent)" required="true">
        <input type="password" name="password" placeholder="&#128274; password" id="PASSWORD" required="true">
        <input type="password"  placeholder="&#128274; Re-type Password" id="RETYPEPASSWORD" required="true">
       
        <!-- For radio buttons giving same name to all radio buttons related to same class so that only one of them can be selected
             and not all -->

        <input type="radio" id="MALE" name="gender" value="m">
        <label for="male">Male</label>
        <input type="radio" id="FEMALE" name="gender" value="f">
        <label for="female">Female</label>
        <input type="radio" id="OTHER" name="gender" value="o">
        <label for="other">Other</label>
        <input type="text" name="username" placeholder="🙍‍ Your Name" id="USERNAME" required="true">
        <input type="text" name="phone_number" placeholder="&#128241; Phone number #" id="PHONENO" onkeypress="isInputNumber(event)" required="true">
        <input type="text" name="address" placeholder="&#127969; Address" id="ADDRESS" required="true">
        </br>
        <input type="radio" name="paymentmethod" value="on delivery" id="ONDELIVERY">
        <label for="ondelivery"><img src="images\on delivery.png" width="30" height="30" > on delivery </label>
        <input type="radio"  name="paymentmethod" value="mastercard" id="MASTERCARD">
        <label for="mastercard"><img src="images\Mastercard.png" width="30" height="30" > Master Card </label>
        <input type="text" name="master_cardno" placeholder="Credit card number (mastercard)" id="MASTERCARDNO" onkeypress="isInputNumber(event)">
        <center><input type="submit" style="background-color: #4C2D73; width: 100px; height: 40px; border-radius: 10px; color: white;"  name=" Register" value="submit"  /></center>
      </form>
      <!-- div model-content2 ends here -->
    </div>
    <!-- Div bg-model2 ends here -->
  </div>





 <!-- Model feedback form section-->
  <div class="bg-model3">
    <div class="model-content3">
      <!-- Placing cross icon button to close pop up whwn it is opened-->
      <div class="close_fdlink_popup_btn">
        +
        <!-- The above will work by JS code below -->
        <!-- Div close_regter_popup_btn ends here -->
      </div>
      <form action="feedback.php" method="post" onsubmit="return functionchckfdblank()">
        <center><textarea name="feedback" placeholder="Type Your text here...." id="FEEDBACKTXTAREA"></textarea></center>
        
        <center><input type="submit" name="submit" value="submit" style="background-color: #4C2D73; width: 100px; height: 40px; border-radius: 10px; color: white;"></center>
      </form>
      <!-- div model-content2 ends here -->
    </div>
    <!-- Div bg-model2 ends here -->
  </div>






<!-- ---------------------------------------------------------Adding java script code here ------------------------------------------------------->
<script type="text/javascript">

/* Now what we are doing here is that we are taking element from document by 'id ', which is first loginbutton' on main screen, and adding actionmk
  listener of 'mouse click' and then making function on it, now in in function querying document for element having class 'bg-model' , which is our
  div of making everything dark and showing login form, and showing it as flex container*/

  document.getElementById('loginbutton').addEventListener('click',function functionloginopn(){
    document.querySelector('.bg-model').style.display='flex';
  })


/* Now the below code is querying our document for element having class 'close_lgin_popup_btn', and adding action listener to it and makin g function
   now in function finding element with class 'bg-model' and making it to display none i.e closing it*/

document.querySelector('.close_lgin_popup_btn').addEventListener('click',function functionlogincls () {
  document.querySelector('.bg-model').style.display='none';
})


/* Now what we are doing here is that we are taking element from document by 'id ', which is first registerbutton' on main screen, and adding action
  listener of 'mouse click' and then making function on it, now in in function querying document for element having class 'bg-model2' , which is our
  div of making everything dark and showing registeration form, and showing it as flex container*/
 document.getElementById('registerbutton').addEventListener('click',function functionregstopn(){
    document.querySelector('.bg-model2').style.display='flex';
  })


/* Now the below code is querying our document for element having class 'close_regter_popup_btn', and adding action listener to it and making function
   now in function finding element with class 'bg-model2' and making it to display none i.e closing it*/

document.querySelector('.close_regter_popup_btn').addEventListener('click',function functionregistrcls () {
  document.querySelector('.bg-model2').style.display='none';
})


/* Now what we are doing here is that we are taking element from document by 'id ', which is Feedback link' on main screen navbar, and adding action
  listener of 'mouse click' and then making function on it, now in in function querying document for element having class 'bg-model3' , which is our
  div of making everything dark and showing login form, and showing it as flex container*/
 document.getElementById('Feedbacklink').addEventListener('click',function functionfdbckopn(){
    document.querySelector('.bg-model3').style.display='flex';
  })


/* Now the below code is querying our document for element having class 'close_fdlink_popup_btn', and adding action listener to it and making function
   now in function finding element with class 'bg-model3' and making it to display none i.e closing it*/

document.querySelector('.close_fdlink_popup_btn').addEventListener('click',function functionfdbckcls () {
  document.querySelector('.bg-model3').style.display='none';
})




/* For form validation registration form (should not be blank) adding java script */
   function functionchckblank(){
    //For mail
   
   //For gender
   if ((document.getElementById('MALE').checked==false) && (document.getElementById('FEMALE').checked==false) && (document.getElementById('OTHER').checked==false)) {
    alert('Please Select a gender');
    return false;
   }
  
   //For payement method
   if ((document.getElementById("ONDELIVERY").checked==false) && (document.getElementById("MASTERCARD").checked==false)) {
    alert('Please select a payment method');
    return false;
   }

 //Now checking whether passwords in password field and in re-type password field match
   if ((document.getElementById('PASSWORD').value)!=(document.getElementById('RETYPEPASSWORD').value)) {
    alert('passwords do not match');
    return false;
   }
   //Matching password field ends above

   // Now it's time to check if matercard is selected as payement method then, matercard number is mandatory else not
       //For mastercard number
   if (document.getElementById('MASTERCARD').checked==true){    
   if (document.getElementById('MASTERCARDNO').value=="") {
    alert('You have selected payement method as mastercard so please give its number');
    return false;
   }
 }

 // Mastercard mandatory section ends here
   return true;
}

/* Function for only numeric characters can be entered in froms textfield (for phone number and mastercard number)*/
function isInputNumber(evt){
  var char=String.fromCharCode(evt.which);
  if(!(/[0-9]/.test(char))){
    evt.preventDefault();
  }
}
/* Function for numeric checking in registration form ends here */



/* Function for checking whether feedback field is blank or not */
function functionchckfdblank(){
 if(document.getElementById('FEEDBACKTXTAREA').value==""){
  alert("Please write your feedback before submitting!!");
  return false;
  //So that feedback is not submitted if nothing is written
 }
 //if not empty then submit your feedback
 return true;
}
</script>
<!--  -------------------------------------------------------------Java Script ends here ---------------------------------------------------------->
</body>
</html>
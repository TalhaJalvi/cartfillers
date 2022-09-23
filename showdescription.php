 <?php
 //Accessing values from main page and showing them here
 if(isset($_POST["Show_Description"])){

 $picaddress=$_POST['image'];

 //Fields which are important for shopping
 $p_id=$_POST['p_id'];
 $pdesp=$_POST['p_name'];
 $price=$_POST['price'];
 $brand=$_POST['p_brand'];
 $quantity=$_POST['quantity'];
}
 ?>




 </!DOCTYPE html>
 <html>
 <head>
   <title>description.php</title>
   <style type="text/css">
     /* -------------------------------------------------------------------------------------------------------------------*/
/* Login model form popup windows css here*/

/* This is for msking our orignal screen background black opacity*/
.background{
  display: flex; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: scroll; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

}
/* Content of of our bg-model this is white coloured form whic will appear*/
.descripcontent{
 width: 80%;
 height: auto;
background-color: white;
 border-radius: 8px;
 position: relative;
 margin: auto;
 overflow-y: auto;
}

/* CSS code for cross button layout on login pop up*/
.closbtn{
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  transform: rotate(45deg);
}
.closbtn:hover{
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.main{
  display: flex;
  width: 100%;
  height: auto;
}
.left{
  width: auto;
  margin: auto;
  float: left;
}
.right{
  width: auto;
  margin:auto;
  float: right;
}

  input[type="text"]:focus{
  border-color: #1b9bff;
 } 
   </style>
 </head>
 <body>
  <!-- All Screen BAckground starts here -->
  <div class="background">
    <!-- Main white screen starts here -->
    <div class="descripcontent">
      <!-- Placing cross icon button to close pop up whwn it is opened-->
      <div class="closbtn">
        +
        <!-- Div close_lgin_popup_btn ends here -->
      </div>
      
      <div class="main">
        <div class="left">
          <img src="<?php echo $picaddress;?>">
        </div>
        <div class="right">
        <center><font size="+2"><b><u>Description:</u></b></font></center><hr>
        </br>
        <font size="+1"><?php echo $pdesp;?></font>
        </br>
        <center><font size="+2"><b><u>Brand:</u></b></font></center><hr>
        </br>
        <font size="+1"><?php echo $brand;?></font>
        </br>
        <center><font size="+2"><b><u>Price:</u></b></font></center><hr>
        </br>
        <font size="+1"><?php echo $price;?></font>
        </br>
        <center><font size="+2"><b><u>Condition:</u></b></font></center><hr>
        </br>
        <font size="+1"><?php echo "New";?></font>
        </br>
        <center><font size="+2"><b><u>Quantity:</u></b></font></center><hr>
        </br>

        <form action="Main.php" method="post">
        <center><input type="text" name="quantity" size="1" required="true" value="<?php echo $quantity;?>"></center>
      </br>
        <center> <input type="submit" name="add_to_cart" value="Add To Cart" style="background-color: #4C2D73; width: 150px; height: 60px; border-radius: 10px; color: white; margin: auto;"></center>
        </br>
        


        <!-- Making hidden fields for making order -->
        <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
        <input type="hidden" name="p_name" value="<?php echo $pdesp; ?>">
        <input type="hidden" name="p_brand" value="<?php echo $brand;?>">
        <input type="hidden" name="price" value="<?php echo $price;?>">

        </form>

        </div>
      </div>





      <!-- Main white screen ends here -->
    </div>
    <!-- All Screen Background ends here -->
  </div>


 </body>
 </html>

 
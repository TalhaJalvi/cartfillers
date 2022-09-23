<?php
//This session is used to store data in PHPSESSID cookies while a specific user is logged in 
//Starting session before page is loaded so we can get data (email) from loginvalidationdbms.php page above code 
session_start();

        $con = mysqli_connect('localhost','root');
         mysqli_select_db($con,'cartFillers');
         //Now it's time to store data in cart 
         if(isset($_POST["add_to_cart"])){
          //i.e if user clicks on add to cart button then this will be executed
          if($_SESSION['shopping_cart']){
              //Now if some products data is already present in session variable shopping cart
              //Now checking whether product user is trying to add is already present in it if
              //yes then we will not add it in our cart else we will


            //Firstly getting data in column form from shopping cart variable (data which is already stored in it)
            //Now we are getting id's of our previous products, first parameter is session variable from which we
            //are getting data and 2nd is of which column i.e we are getting only one column here
            $items_array_id=array_column($_SESSION["shopping_cart"], "item_id");
            if(in_array($_POST['p_id'], $items_array_id)){
              //Now if item already present
              echo  '<script> alert("Item already present in cart")</script>';
            }
            else{
              //if not already present then we will ad it
              $count=count($_SESSION["shopping_cart"]);
               $items_array = array(
               'item_id' =>$_POST['p_id'],
               'item_name' => $_POST['p_name'],
               'item_brand' => $_POST['p_brand'],
               'item_quantity'=> $_POST['quantity'],
               'item_price' => $_POST['price']
            );
             //Now storing data of one product in session variable shopping_cart
               $_SESSION['shopping_cart'][$count]=$items_array;
               echo '<script type="text/javascript">alert ("item added to cart")</script>';
               echo '<script type="text/javascript">windows.location="Main.php"</script>';
            }
}

             else{
              //if no data is present in cart then this will be executed
               $items_array = array(
               'item_id' =>$_POST['p_id'],
               'item_name' => $_POST['p_name'],
               'item_brand' => $_POST['p_brand'],
               'item_quantity'=> $_POST['quantity'],
               'item_price' => $_POST['price']
            );
             //Now storing data of one product in session variable shopping_cart
               $_SESSION['shopping_cart'][0]=$items_array;
               echo '<script type="text/javascript">alert ("item added to cart")</script>';
             }
}
//Most upper if($_SESSION["shopping_cart"])) ends here








//Now writing deleting item code here
if (isset($_GET["action"])) {
//if user clicks on removal link then we will be here
  if ($_GET["action"]=="delete") {
    //Now if action is delete as with removal link we have this
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
      //Now itering through all items id's and checking which item id matches id of required item which we have been given from
      //link of item 'removal'
      if ($value["item_id"]==$_GET["id"]) {
        //Now if id matches with some item then we will enter this loop
        unset($_SESSION["shopping_cart"][$key]);
        //above unset function destroys item's all details i.e keys and item is removed from cart
        //Now showing alerts of item being removed and redirecting page
        echo '<script>alert("item was successfully removed from cart")</script>)';
        echo '<script>window.location="Main.php"</script>';
      }

    }

  }

}




//Now if user want to delete all order i.e clicks on cancel order then this bellow code after if will execute
if(isset($_POST["cancelorder"])){
  //Now destroying all cart items
  foreach ($_SESSION["shopping_cart"] as $key => $value) {
    //Now destroying them one by one
    unset($_SESSION["shopping_cart"][$key]);
  }
  //Now showing message
  echo '<script>alert("cart was successfully emptied")</script>';
  echo '<script>window.location="Main.php"</script>';
}



//Now if user want to place order it will be saved on company's database
if (isset($_POST["ordercart"])) {
//Now placing order to database
//First dividing all values into different variables
 //Defining all variables that are used in this process 

  $userdb=$_SESSION['userid'];
  $productid="";
  $namedb="";
  $quantitydb="";
  $pricedb="";
  $tpricedb="";
  $branddb="";
  $totaldb=0; 
foreach ($_SESSION["shopping_cart"] as $key => $value) {
    $productid=$productid.$value["item_id"].",";
    $namedb=$namedb.$value["item_name"].",";
    $quantitydb=$quantitydb.$value["item_quantity"].",";
    $pricedb=$pricedb.$value["item_price"].",";
    $tpricedb=$tpricedb.($value["item_price"]*$value["item_quantity"]).",";
    $totaldb=$totaldb+($value["item_price"]*$value["item_quantity"]);
    $branddb=$branddb.$value["item_brand"].",";
  }  
  //Now all values in one db now sending it to database
  //First making connection with database
  $conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
  # code...
  //If connection building is failed to database
  echo "Connection to DBMS failed";
}
else{
  //Before making order checking user  way of payement
  $query1="SELECT * FROM `members` WHERE `Email`='$userdb'";
  $run1=mysqli_query($conn,$query1);
  //Now our first query is executed
  //Now if row is greater than 1 fetching it's data i.e of user
  //First of all couting row retrieved in this process
   while ($row=mysqli_fetch_array($run1)) {
    //Payment method is now stored in this variable of current user
    $paymentdb=$row['Payement_Method'];
    $addressdb=$row['Address'];
    $mastercarddb="";
    $codedb="";
        $Date=date("y-m-d");
    //Now if payment method is mastercard then we will take it's mastercard number else it will be empty
    if ($paymentdb=="mastercard") {
      $mastercarddb=$row['mastercard_no'];
       $codedb=rand(1000,10000);
    }
    //Now if payment method is on delivery then generating random code and sending it to database this will be between 1000 10000
    if ($paymentdb=="on delivery") {
      $codedb=rand(1000,10000);
    }
    $phonenodb=$row['Phoneno'];
  }

  //Now generating query for data insertion in table of database
  //As our connection with database was successful
  $query2="INSERT INTO `customer_orders` (`user_mail`,`products_ids`, `p_name`, `quantity`, `price`, `p_total`, `Brand`, `total`,`address`,`phone_num`,`payment_method`,`mastercard_no`,`code`,`Date`) VALUES ( '$userdb', '$namedb','$productid','$quantitydb', '$pricedb', '$tpricedb', '$branddb', '$totaldb','$addressdb','$phonenodb','$paymentdb','$mastercarddb','$codedb','$Date')";
  //Now executing our query
  $run2=mysqli_query($conn,$query2);
  if($run2==true){
    //Deleting or destroying all cart
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
    //Now destroying them one by one
    unset($_SESSION["shopping_cart"][$key]);
  }
  /* -----------------------------------------------------------------------------------------------------------------------------*/
      if($paymentdb=="mastercard"){
        ?>
      <script> alert("order was successful!! Your payment method was '<?php echo $paymentdb;?>' Amount would be deducted automstically from your account (caution: if not delivered till 15 days contact us on our provided numbers");
      //returning to same window when data was successfully uploaded to database
      window.open('Main.php','_self');
    </script>
    <?php
    }
     if($paymentdb=="on delivery"){
        ?>
      <script>alert("order was successful!! Your payment method was '<?php echo $paymentdb;?>' Your code is '<?php echo $codedb;?>' pay by seeing this code (caution: if not delivered till 15 days contact us on our provided numbers");
      //returning to same window when data was successfully uploaded to database
      window.open('Main.php','_self');
    </script>
    <?php
    }
  /* -----------------------------------------------------------------------------------------------------------------------------*/


     
  }else{
    ?>
    <script>
      alert('Order was unsuccessfull' );
      //returning to same window when data was not successfully uploaded to database
      //window.open('index.php','_self');
    </script>
    <?php
  }
}
}
            ?>
</!DOCTYPE html>
<html>
<head>
	<title></title>
	 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
	  <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

</head>
<body>
<div class="container">
  <!-- This is our navbar class-->
	  <div class="navbar">
	   <nav>
      <label class="logo"> CartFiller's</label>
      <ul>
        <!-- Now for allowing user to edit his information -->
        <li><a href="updateuserinfo.php"><i class="fas fa-user-cog"></i>&nbsp;Edit  info</a></li>
        <!-- Showing mail (user id who has logged in) on navbar from loginvalidationdbms.php using session variable
             where our user info is stored using above mentioned cookes-->
        <li><?php echo $_SESSION['userid']; ?></li>
      </ul>

      
    </nav>
       <!-- Navbar class ends here below-->
	</div>
    <!-- main div starts here map will be shown here -->
    	<!-- Here our products type will be shown -->
    	<div class="upmenu">
    		</br>
    	    </br>
    	    <button class="upmenubuttons"  id="tshirts">T-Shirts</button>	    
    	    <button class="upmenubuttons"  id="jeans">Pents</button>   
    	    <button class="upmenubuttons"  id="hoddies">Hoddies</button>    	    
    	    <button class="upmenubuttons"  id="shoes">Shoes</button>
          <button class="upmenubuttons"  id="cart"><font size="+4">&#128722;</font></button>
          <button class="upmenubuttons"  id="history">Order history <i class="fa fa-history" style="font-size: 30;"></i></button>
           <button class="upmenubuttons" onclick="window.location.href='logout.php'">Logout<span class="iconify" data-icon="mdi-logout" data-inline="false" style="font-size: 30;"></span></button>

    	</div>

    	<!-- Now building products that will be shown on right side -->
<div class="lowmenu">
      <!-- This is T-shirts div -->
      <div class="rightmenu1">
           <h2>NIKE</h2>
           <hr> 
           </br>
       <!-- Slider -->    
       <div class="carousel">
     
      <a>&#10094;</a>


      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = " SELECT * FROM `NIKE_T_SHIRTS` ";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-block;" method="post" action="showdescription.php" >
          <div class="slider-box">
         	<p class="time">New</p>
         	<div class="img-box">
         	<img src="<?php echo $product['image'];?>">
         	</div>	
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Nike">
          <input type="text" name="quantity" value="" style="width: 50%;align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         
         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
          <!-- Overall slider ends here -->

            
    </div>
    <!-- carousel or slider ends here -->
      </br>
       <h2>ARMANI</h2>
           <hr> 
           </br>
       <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `armani_t_shirts`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Armani">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         
         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
          <!-- Overall slider ends here -->     
    </div>
       <!-- carousel or slider ends here -->
        </div>
        <!-- Right menu 1 ends here -->       



         <!------------------------------------- This is div of jeans pents ----------------------------------------------->       
        <div class="rightmenu2">
    	 <h2>LEVI'S</h2>
           <hr> 
  </br>
        <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `levis_pents`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Levis">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         
         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
          <!-- Overall slider ends here -->     
    </div>
       <!-- carousel or slider ends here -->

      </br>

    
       <h2>ARMANI</h2>
           <hr> 
           </br>
         <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `armani_pents`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Armani">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
          <!-- Overall slider ends here -->     
    </div>
       <!-- carousel or slider ends here -->
      
      </div>
      <!----------------------------------------------- Pents right div end above ------------------------------------------->
      


      <!----------------------------------------- Here Hoodies right div (Section) starts ------------------------------------>
      <div class="rightmenu3">
      		 <h2>ADDIDAS</h2>
           <hr> 
      </br>
         <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `addidas_hoddies`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Addidas">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true"> 
           <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         
         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
          <!-- Overall slider ends here -->     
    </div>
       <!-- carousel or slider ends here -->

      </br>

    
       <h2>PUMA</h2>
           <hr> 
           </br>
        <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `puma_hoddies`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Puma">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         
         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
          <!-- Overall slider ends here -->     
    </div>
        


      </div>
      <!---------------------------------------------- Div for Hoodies (Secton) ends above right menu3 ---------------------------->

      <!-------------------------------------------------- Div for Shoes starts here ---------------------------------------------->
      <div class="rightmenu4">
      		 <h2>BATA</h2>
           <hr> 
      </br>
           <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `bata_shoes`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Bata">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>
           
        
         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
               <!-- Overall slider ends here -->     
    </div>

      </br>

    
       <h2>BORJAN</h2>
           <hr> 
           </br>
            <!-- carousel or strats here Slider -->    
        <div class="carousel">
      <a>&#10094;</a>
      <?php
      /* What we are doing here is that we are taking values from database and showing them in our slider so this is why
         we are using while loop first writing query to get data of products then executing query and then counting number
         of rows and if number of rows>0 (i.e data is present) so using while loop till data is fetched and then showing
         it in our slider */ 

          //if($con){
         // echo "connection succussful";
           // else{
         // echo "no connection";
          //}
            $query = "SELECT * FROM `borjan_shoes`";
            $queryfire = mysqli_query($con, $query);
            $num = mysqli_num_rows($queryfire);

          if($num > 0){
    while($product = mysqli_fetch_array($queryfire)){
          ?>
      <!-- All products are shown one by one ----->
          <form style="display: inline-flex;" method="post" action="showdescription.php">
          <div class="slider-box">
          <p class="time">New</p>
          <div class="img-box">
           
          <img src="<?php echo $product['image'];?>">
          </div>  
          <input type="hidden" name="p_id" value="<?php echo $product['ID']; ?>">
          <input type="hidden" name="p_name" value="<?php echo $product['name']; ?>">
          <input type="hidden" name="p_brand" value="Borjan">
          <input type="text" name="quantity" value="" style="width: 50%; align-self: center;" placeholder="quantity" required="true">
          <input type="hidden" name="image" value="<?php echo $product['image'];?>">
          <input type="hidden" name="price" value="<?php echo $product['cost'];?>"><a class="price"><u>Price:</u><?php echo $product['cost'];?></a></br>

         <input type="submit" name="Show_Description" value="Show Description" class="cart" style="color: white;" />
         </div>
         </form>
         <?php
       }
     }
     ?>
               <!-- Overall slider ends here -->     
    </div>
  </div>

 <!-----------------------------------------------------Shoes div ends here ------------------------------------------------------->
      <!-- This will be shown on screen when no product is selected -->
      <div class="rightmenu5" style="  width: 100%;
  height: 550px;
  border-radius: 15px;
  border-top: solid; 
  border-bottom: solid;
  margin: auto;s
  border-color: #4C2D73;">
  <br>
  <br>
    <iframe width="1300" height="520" src="https://www.youtube.com/embed/rhSfrvlwHXE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

         <div class="rightmenu6">
        <!-- here history will be displayed i.e previous orders of user -->
        <table width="100%">
          <tr>
            <th>Order ID</th>
            <th>Days Remaining</th>
            <th>Total bill</th>
            <th>Date Ordered</th>
            <th>Code</th>
            <th>Payment method</th>
            <th colspan="2">Action</th>
          </tr>
        <?php
        //First connecting to the datab ase and getting orders of user 
         $conn=mysqli_connect('localhost','root','','cartfillers');
         if(!$conn){
          echo "Error during database connection";
         }
         $user=$_SESSION['userid'];
         //Now getting order data of that specific user who has been loged in
         $order="SELECT * FROM `customer_orders` WHERE `user_mail`='$user'";
         $reslt=mysqli_query($conn,$order);
         if(!$reslt){
          echo "Error during fetching user data";
         }
         else{
           while ($row=mysqli_fetch_array($reslt)) {
             //Now it's time to diplay all data
            //Calculating date here
            $date2=date("y-m-d");
            $date2=strtotime($date2);
            $date1=$row['Date'];
            $date1=strtotime($date1);
            $days=$date2-$date1;
            $days=round($days/(60*60*24));
            $days=15-$days;
            if($days<0){
              $days="Delivery Period is over! Please contact us";
            }
              ?>
               <tr>
                 <td><center><?php echo $row['o_id'];?></center></td>
                 <td><center><?php echo $days;?></center></td>
                 <td><center><?php echo $row['total'];?></center></td>
                 <td><center><?php echo $row['Date'];?></center></td>
                 <td><center><?php echo $row['code'];?></center></td>
                 <td><center><?php echo $row['payment_method'];?></center></td>
                 <form action="orderdescription.php" method="post" >
                 <input type="hidden" name="order_id" value="<?php echo $row['o_id'];?>">
                 <input type="hidden" name="user_mail" value="<?php echo $row['user_mail'];?>">
                  <input type="hidden" name="productids" value="<?php echo $row['products_ids'];?>">
                 <input type="hidden" name="productsnames" value="<?php echo $row['p_name'];?>">
                 <input type="hidden" name="quantity" value="<?php echo $row['quantity'];?>">
                 <input type="hidden" name="price" value="<?php echo $row['price'];?>">
                 <input type="hidden" name="brand" value="<?php echo $row['Brand'];?>">
                 <input type="hidden" name="code" value="<?php echo $row['code'];?>">
                 <input type="hidden" name="total" value="<?php echo $row['total'];?>">
                 <input type="hidden" name="orderdate" value="<?php echo $row['Date'];?>">
                 <input type="hidden" name="remdays" value="<?php echo $days;?>">
                 <input type="hidden" name="paymentmethod" value="<?php echo $row['payment_method'];?>">
                 <input type="hidden" name="address" value="<?php echo $row['address'];?>">
                 <input type="hidden" name="phonenum" value="<?php echo $row['phone_num'];?>">
                 <td><center><input type="submit" name="description" value="description" style="background-image: linear-gradient(#00FF00,#228B22); color: white;"></center></td>
               </form>
               </tr>
               
              
              <?php
         }
            }

        ?>
         </table>
      </div>


<!------------------------------ This div is for cart items which are added by user and updating them ------------------------------>
<div class="rightmenu7">

  <table  width="90%" border="+2" style="margin: auto;" >
    <thead>
    <tr>
      <th>S_No</th>
      <th>Brand</th>
      <th>item Name</th>
      <th>item Quantity</th>
      <th>Price of product</th>
      <th>Total</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
          <?php
            //First checking whether shopping cart is empty or no if yes then we will not show anything
            if (!empty($_SESSION["shopping_cart"])) {
              # code...
              //Total amount will be stored in this variable
              $total=0;
              //used to show product number
              $Sno=1;
              //Now showing products
              foreach ($_SESSION["shopping_cart"] as $key => $value) {
                ?>
                <tr>
                  <td><?php echo $Sno++;?></td>
                  <td><?php echo $value["item_brand"];?></td>
                  <td><?php echo $value["item_name"];?></td>
                  <td><?php echo $value["item_quantity"];?></td>
                  <td><?php echo $value["item_price"];?></td>
                  <!-- Now it's time to show total price (i.e item_quantity*price) of each product separately-->
                  <!-- The number_format() function is an inbuilt function in PHP which is used to format a number
                       with thousands. It returns the formatted number on success otherwise it gives E_WARNING on failure.
                   -->
                   <!-- The two in function after comma is for having output having two decimal places -->
                   <!-- Simply we can say that it is a function for converting number to specific format here 2 decimal places
                        after point -->
                  <td><?php echo number_format($value["item_quantity"]*$value["item_price"],2);?></td>
                  <!-- Now if user want to delete any item writing it's function -->
                  <td><a href="Main.php?action=delete&id=<?php echo $value["item_id"];?>"><u>Remove</u></a></td>  
                </tr>
                <?php
                //Now calculating total amount of user after each iteration our total amount will bew increased
                $total=$total+$value["item_quantity"]*$value["item_price"];
              }
              //Above foreach loop ends now its time to print final row which is printing total amount which is built
              ?>
              <tr>
                <td colspan="5"><center><b>Total:</b></center></td>
                <td colspan="2"><center><?php echo number_format($total,2);?></center></td>
              </tr>
              <tr>
                <form action="Main.php" method="post">  
                <td colspan="5"><input type="submit" name="ordercart" value="order" style="width: 100%;background-image: linear-gradient(#00FF00,#228B22);"></td>
                <td colspan="2"><input type="submit" name="cancelorder" value="cancel"  style="width: 100%;background-image: linear-gradient(#00FF00,#228B22);"></td>
              </form>
              </tr>
              <?php
            }
          
              
      ?>
  </tbody>
  </table>
</div>
<!---------------------------------------------- Cart display ends above --------------------------------------------------------->
</div>
<!--------------------------------------------------------Main right div ends here ------------------------------------------------->
</div>
<!----------------------------------------------- Container ends above ----------------------------------------------------------->

<script type="text/javascript">
document.getElementById('tshirts').addEventListener('click',function showrightmenu1(){
    document.querySelector('.rightmenu1').style.display='block';

    /*Closing all other if opened*/
    document.querySelector('.rightmenu5').style.display='none';
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';
    document.querySelector('.rightmenu6').style.display='none';
    document.querySelector('.rightmenu7').style.display='none';
  })
	
document.getElementById('jeans').addEventListener('click',function showrightmenu2(){
    document.querySelector('.rightmenu2').style.display='block'
        /*Closing all other if opened*/
    document.querySelector('.rightmenu5').style.display='none';    
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';
    document.querySelector('.rightmenu6').style.display='none';
    document.querySelector('.rightmenu7').style.display='none';
  })

document.getElementById('hoddies').addEventListener('click',function showrightmenu3(){
    document.querySelector('.rightmenu3').style.display='block';
        /*Closing all other if opened*/
    document.querySelector('.rightmenu5').style.display='none';    
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';
    document.querySelector('.rightmenu6').style.display='none';
    document.querySelector('.rightmenu7').style.display='none';
  })

document.getElementById('shoes').addEventListener('click',function showrightmenu4(){
    document.querySelector('.rightmenu4').style.display='block';
        /*Closing all other if opened*/
    document.querySelector('.rightmenu5').style.display='none';
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu6').style.display='none';
    document.querySelector('.rightmenu7').style.display='none';
  })

document.getElementById('history').addEventListener('click',function showrightmenu4(){
    document.querySelector('.rightmenu6').style.display='block';
        /*Closing all other if opened*/
    document.querySelector('.rightmenu5').style.display='none';
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';
    document.querySelector('.rightmenu7').style.display='none';
  })

document.getElementById('cart').addEventListener('click',function showcart(){
    document.querySelector('.rightmenu7').style.display='block';
        /*Closing all other if opened*/
    document.querySelector('.rightmenu5').style.display='none';
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';
    document.querySelector('.rightmenu6').style.display='none';
  })
</script>
</body>
</html>
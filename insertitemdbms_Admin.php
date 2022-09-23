
<?php
//starting session here as we will need user info on next page then we are storing it here
if(isset($_GET['action'])){
	if($_GET['action']=="nitem"){
		$id=$_GET['id'];
	if($id=='1'){
		//New we are setting end bound for 
		$endbound=100;
		echo $endbound;

	}
		if($id=='101'){
		//New we are setting end bound for 
		$endbound=200;
        echo $endbound;
	}
		if($id=='201'){
		//New we are setting end bound for 
		$endbound=300;
        echo $endbound;
	}
		if($id=='301'){
		//New we are setting end bound for 
		$endbound=400;
        echo $endbound;
	}
		if($id=='401'){
		//New we are setting end bound for 
		$endbound=500;
        echo $endbound;
	}
		if($id=='501'){
		//New we are setting end bound for 
		$endbound=600;
        echo $endbound;
	}
		if($id=='601'){
		//New we are setting end bound for 
		$endbound=700;

	}
	    if($id=='701'){
		//New we are setting end bound for 
		$endbound=800;
        echo $endbound;
	}
	}
}
?>

<html>
<head>
	<title>insert item.php</title>  

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
      <form method="post"  action="insertitemdbms_Admin.php?action=nitem&id=<?php echo $id?>"  enctype="multipart/form-data" >
        <center><b style="color: white;">Please enter procut id in between <?php echo $id;?> and <?php echo $endbound;?> which is not occupied by any previous product</b></center>
        <center><font size="-1"  id="notifi"> </font></center>
         

         <input type="text" name="productid" placeholder="product ID here" required="true">
         <input type="text" name="name" placeholder="Name of product here" required="true">
         <input type="number" name="price" placeholder="Enter price of product here" required="true">
         <input type="number" name="quantity" placeholder="Enter quantity here" required="true">
         <center><input type="file"  name="uploadfile"  value="insertindb" ></center> 


         </br>
        <center><input type="submit" style="background-color: #FCC133; width: 100px; height: 40px; border-radius: 10px; color: white;"  name="upload" value="upload" /></center>    
      </form>
      <!-- Form class ends below--> 
     </div>
     <!-- Main container ends below -->
</div>

<script type="text/javascript">
</script>
</body>
</html>
<?php
if (isset($_POST["upload"])) {
//Now if user clicks send code button
   //Getting values from input fields
   $productid=$_POST['productid'];
   $productname=$_POST['name'];
   $productprice=$_POST['price'];
   $productquantity=$_POST['quantity'];	

    //Now uploading picture
   $filename = $_FILES["uploadfile"]["name"]; 
   $tempname = $_FILES["uploadfile"]["tmp_name"];     
   $folder = "images/".$filename; 

     if (move_uploaded_file($tempname, $folder))  { 
            $msg = "Image uploaded successfully"; 
            echo $msg;
            //Now sending data to database
            //Now making connection with our DB
 $conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
  # code...
  echo "Connection to DBMS failed";
}
else{
  //Now checking this admin exists in our db or not
  //Retrieving data which matches our admin cresedentials
   if($id>='1' && $id<='100'){	
  $query1="SELECT * FROM `nike_t_shirts` WHERE `ID`='$productid'"; 
  //Now running query 
  $run1=mysqli_query($conn,$query1);
  if($run1==true){
    //Now counting number of rows
    $row1=mysqli_num_rows($run1);
    if($row1>0){
    //Now making user login
   ?>
  <script type="text/javascript">
     document.getElementById('notifi').innerHTML = "A product with similar id already exists in database! Please change product id";
  </script>
   <?php
    
    }
    else{
    	//Now if no such product exists with similar id then inserting data in database
    	$query2="INSERT INTO `nike_t_shirts` (`ID`, `name`, `image`, `cost`, `quantity`) VALUES ('$productid', '$productname', '$folder', '$productprice', '$productquantity')";
    	$run2=mysqli_query($conn,$query2);
    	if($run2==true){
    		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Item was successfully added";
    </script>
    <?php
    	}
    	else{
    		    		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Failed to update database";
    </script>
    <?php
    	}


    }
  }
  else{
        		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Failed to recieve data of previous products ";
    </script>
    <?php
  }
}

}
        }else{ 
    		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Failed to upload image";
    </script>
    <?php
      }
      
//////////////////////////////////////////////////////////////////
        //Retrieving data which matches our admin cresedentials
   if($id>='101' && $id<='200'){	
  $query1="SELECT * FROM `armani_t_shirts` WHERE `ID`='$productid'"; 
  //Now running query 
  $run1=mysqli_query($conn,$query1);
  if($run1==true){
    //Now counting number of rows
    $row1=mysqli_num_rows($run1);
    if($row1>0){
    //Now making user login
   ?>
  <script type="text/javascript">
     document.getElementById('notifi').innerHTML = "A product with similar id already exists in database! Please change product id";
  </script>
   <?php
    
    }
    else{
    	//Now if no such product exists with similar id then inserting data in database
    	$query2="INSERT INTO `armani_t_shirts` (`ID`, `name`, `image`, `cost`, `quantity`) VALUES ('$productid', '$productname', '$folder', '$productprice', '$productquantity')";
    	$run2=mysqli_query($conn,$query2);
    	if($run2==true){
    		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Item was successfully added";
    </script>
    <?php
    	}
    	else{
    		    		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Failed to update database";
    </script>
    <?php
    	}


    }
  }
  else{
        		          ?>
    <script type="text/javascript">
       document.getElementById('notifi').innerHTML = "Failed to recieve data of previous products ";
    </script>
    <?php
  }
}


}

?>

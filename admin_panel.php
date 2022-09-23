
<?php
//starting session here as we will need user info on next page then we are storing it here
session_start();
?>
</!DOCTYPE html>
<html>
<head>
	<title>admin panel</title>
	  <link rel="stylesheet" type="text/css" href="admin_panel.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 
</head>
<body>
<div class="container">
  <!-- This is our navbar class-->
	   <div class="navbar">
     <nav>
      <label class="logo"><b>CartFiller's</b>&nbsp;<i>AdminPanel</i></label>
      <ul>
        <!-- Now for allowing user to edit his information -->
        <!-- Showing mail (user id who has logged in) on navbar from loginvalidationdbms.php using session variable
             where our user info is stored using above mentioned cookes-->
             
        <li><b>User ID: </b><?php echo  $_SESSION['admin']; ?></li>
      </ul>
    </nav>
       <!-- Navbar class ends here below-->
  </div>
    <!-- main div starts here map will be shown here -->
    <div class="mainbody">
    	<!-- Here our products type will be shown -->
    	<div class="leftmenu">
    		</br>
    	    </br>
    	    <button class="leftmenubuttons" style=" background: #FCC133;" ><i class="fa fa-dashboard" style="font-size: 48px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</button>	    
    	    <button class="leftmenubuttons"  id="regmembers"><i class="fa fa-user" style="font-size: 48px;"></i>&nbsp;&nbsp;&nbsp;Registered members</button>   
    	    <button class="leftmenubuttons"  id="customerorders"><i class="fa fa-shopping-cart" style="font-size: 48px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Orders</button>    	 
           <button class="leftmenubuttons"  id="feedback"><i class="fa fa-envelope" style="font-size:48px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Visitors feedback</button>   
    	    <button class="leftmenubuttons"  id="stock"><i class="fa fa-shopping-bag" aria-hidden="true" style="font-size: 48;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stocks</button>
          <button class="leftmenubuttons" onclick="window.location.href='logout.php'"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>Sign Out</button>
    	</div>

    	<!-- Now building products that will be shown on right side -->

      <!-- This is T-shirts div -->
      <div class="rightmenu1">
        <table width="100%">
          <tr>
            <th>Member ID</th>s
            <th>Member name</th>
            <th>Member Email</th>
            <th>Phone number</th>
            <th>Address</th>
            <th>Payment method</th>
            <th>Mastercard No(any)</th>
            <th>Account status</th>
          </tr>
        <?php
        //First connecting to the datab ase and getting orders of user 
         $conn=mysqli_connect('localhost','root','','cartfillers');
         if(!$conn){
          echo "Error during database connection";
         }
         $query="SELECT * FROM `members`";
         $reslt=mysqli_query($conn,$query);
         if(!$reslt){
          echo "Error during fetching user data";
         }
         else{
           while ($row=mysqli_fetch_array($reslt)) {
             //Now it's time to diplay all data

              ?>
               <tr>
                 <td><center><?php echo $row['member_id'];?></center></td>
                 <td><center><?php echo $row['Name'];?></center></td>
                 <td><center><?php echo $row['Email'];?></center></td>
                 <td><center><?php echo $row['Phoneno'];?></center></td>
                 <td><center><?php echo $row['Address'];?></center></td>
                 <td><center><?php echo $row['Payement_Method'];?></center></td>
                 <td><center><?php echo $row['mastercard_no'];?></center></td>
                 <td><center><?php echo $row['status'];?></center></td>
               </tr>
               
              
              <?php
         }
            }

        ?>
         </table>
        </div>
                <!-- Right menu 1 ends here -->


         <!-- This is div of jeans pents -->       
        <div class="rightmenu2">
         <table width="100%">
          <tr>
            <th>Order ID</th>
            <th>User Mail</th>s
            <th>Product Ids</th>
            <th>Quantity</th>
            <th>Total (RS)</th>
            <th>Order Code</th>
            <th>Order Date</th>
            <th>Days Rem</th>
            <th>Action</th>
          </tr>
        <?php
        //First connecting to the datab ase and getting orders of user 
         $conn2=mysqli_connect('localhost','root','','cartfillers');
         if(!$conn2){
          echo "Error during database connection";
         }
         $query2="SELECT * FROM `customer_orders`";
         $reslt2=mysqli_query($conn2,$query2);
         if(!$reslt2){
          echo "Error during fetching user data";
         }
         else{

           while ($row2=mysqli_fetch_array($reslt2)) {
             //Now it's time to diplay all data
                     //Calculating date here
            $date2=date("y-m-d");
            $date2=strtotime($date2);
            $date1=$row2['Date'];
            $date1=strtotime($date1);
            $days=$date2-$date1;
            $days=round($days/(60*60*24));
            $days=15-$days;
            if($days<0){
              $days="period over";
            }
              ?>
               <tr>
                 <td><center><?php echo $row2['o_id'];?></center></td>
                 <td><center><?php echo $row2['user_mail'];?></center></td>
                 <td><center><?php echo $row2['products_ids'];?></center></td>
                 <td><center><?php echo $row2['quantity'];?></center></td>
                 <td><center><?php echo $row2['total'];?></center></td>
                 <td><center><?php echo $row2['code'];?></center></td>
                 <td><center><?php echo $row2['Date'];?></center></td>
                 <td><center><?php echo $days;?></center></td>
                 <td><center><a href="">Show Description</a></center></td>
               </tr>
               
              
              <?php
         }
            }

        ?>
         </table>
      
      </div>
      <!-- Pents right div end above -->
      


      <!-- Here Hoodies right div (Section) starts -->
      <div class="rightmenu3">
      	 <table width="100%">
          <tr>
            <th>ID</th>
            <th>Feedback</th>
            <th>Date recieved</th>
            <th>Action</th>
          </tr>
        <?php
        //First connecting to the datab ase and getting orders of user 
         $conn3=mysqli_connect('localhost','root','','cartfillers');
         if(!$conn3){
          echo "Error during database connection";
         }
         $query3="SELECT * FROM `feedback`";
         $reslt3=mysqli_query($conn3,$query3);
         if(!$reslt3){
          echo "Error during fetching user data";
         }
         else{

           while ($row3=mysqli_fetch_array($reslt3)) {
             //Now it's time to diplay all data
              ?>
               <tr>
                 <td><center><?php echo $row3['ID'];?></center></td>
                 <td><center><?php echo $row3['Feedback'];?></center></td>
                 <td><center><?php echo $row3['Date'];?></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
               
              
              <?php
         }
            }

        ?>
         </table>
      


      </div>
      <!-- Div for Hoodies (Secton) ends above right menu3 -->
      <!-- Div for Shoes starts here -->
      <div class="rightmenu4">
        <h2><b><u>Shirts</b></u></h2>
      	 <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        <?php
        //First connecting to the datab ase and getting orders of user 
         $conn=mysqli_connect('localhost','root','','cartfillers');
         if(!$conn){
          echo "Error during database connection";
         }
         $queryst1="SELECT * FROM `nike_t_shirts`";
         $resltst1=mysqli_query($conn,$queryst1);
         if(!$resltst1){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst1=mysqli_fetch_array($resltst1)) {
             //Now it's time to diplay all data
    
              ?>
               <tr>
                 <td><center><?php echo $rowst1['ID'];?></center></td>
                 <td><center><?php echo "Shirts";?></center></td>
                 <td><center><?php echo "NIKE";?></center></td>
                 <td><center><?php echo $rowst1['name'];?></center></td>
                 <td><center><?php echo $rowst1['quantity'];?></center></td>
                 <td><center><?php echo $rowst1['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="Deleteitem_admin.php?action=delete&id=1&id1=<?php echo $rowst1['ID'];?>">DELETE</a></center></td>
            
               </tr>

               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=1">Add new Product</a></center></td>
              </tr>
         <?php  }?>

          </table> 
          <br>
         <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
         <?php 
         $queryst2="SELECT * FROM `armani_t_shirts`";
         $resltst2=mysqli_query($conn,$queryst2);
         if(!$resltst2){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst2=mysqli_fetch_array($resltst2)) {
             //Now it's time to diplay all data
    
              ?>
            <tr>
                 <td><center><?php echo $rowst2['ID'];?></center></td>
                 <td><center><?php echo "Shirts";?></center></td>
                 <td><center><?php echo "ARMANI";?></center></td>
                 <td><center><?php echo $rowst2['name'];?></center></td>
                 <td><center><?php echo $rowst2['quantity'];?></center></td>
                 <td><center><?php echo $rowst2['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="Deleteitem_admin.php?action=delete&id=101&id1=<?php echo $rowst2['ID'];?>">DELETE</a></center></td>
               </tr>
      
         
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=101">Add new Product</a></center></td>
              </tr>
         <?php  }?>

          </table>
          <h2><b><u>Pents</b></u></h2>
          <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
          <?php
         $queryst3="SELECT * FROM `armani_pents`";
         $resltst3=mysqli_query($conn,$queryst3);
         if(!$resltst3){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst3=mysqli_fetch_array($resltst3)) {
             //Now it's time to diplay all data
    
              ?>
                <tr>
                 <td><center><?php echo $rowst3['ID'];?></center></td>
                 <td><center><?php echo "Pents";?></center></td>
                 <td><center><?php echo "ARMANI";?></center></td>
                 <td><center><?php echo $rowst3['name'];?></center></td>
                 <td><center><?php echo $rowst3['quantity'];?></center></td>
                 <td><center><?php echo $rowst3['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=201">Add new Product</a></center></td>
              </tr>
         <?php  }?>



          </table>
          <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
          <?php
         $queryst4="SELECT * FROM `levis_pents`";
         $resltst4=mysqli_query($conn,$queryst4);
         if(!$resltst4){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst4=mysqli_fetch_array($resltst4)) {
             //Now it's time to diplay all data
    
              ?>
                <tr>
                 <td><center><?php echo $rowst4['ID'];?></center></td>
                 <td><center><?php echo "Pents";?></center></td>
                 <td><center><?php echo "LEVIS";?></center></td>
                 <td><center><?php echo $rowst4['name'];?></center></td>
                 <td><center><?php echo $rowst4['quantity'];?></center></td>
                 <td><center><?php echo $rowst4['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
              
    
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=301">Add new Product</a></center></td>
              </tr>
         <?php  }?>
</table>

            <h2><b><u>Hoodies</b></u></h2>
          <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
          <?php
         $queryst5="SELECT * FROM `addidas_hoddies`";
         $resltst5=mysqli_query($conn,$queryst5);
         if(!$resltst5){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst5=mysqli_fetch_array($resltst5)) {
             //Now it's time to diplay all data
    
              ?>
                <tr>
                 <td><center><?php echo $rowst5['ID'];?></center></td>
                 <td><center><?php echo "Hoodies";?></center></td>
                 <td><center><?php echo "ADDIDAS";?></center></td>
                 <td><center><?php echo $rowst5['name'];?></center></td>
                 <td><center><?php echo $rowst5['quantity'];?></center></td>
                 <td><center><?php echo $rowst5['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
    
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=401">Add new Product</a></center></td>
              </tr>
         <?php  }?>

          </table>



          <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
          <?php
         $queryst6="SELECT * FROM `puma_hoddies`";
         $resltst6=mysqli_query($conn,$queryst6);
         if(!$resltst6){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst6=mysqli_fetch_array($resltst6)) {
             //Now it's time to diplay all data
    
              ?>
                <tr>
                 <td><center><?php echo $rowst6['ID'];?></center></td>
                 <td><center><?php echo "Hoodies";?></center></td>
                 <td><center><?php echo "PUMA";?></center></td>
                 <td><center><?php echo $rowst6['name'];?></center></td>
                 <td><center><?php echo $rowst6['quantity'];?></center></td>
                 <td><center><?php echo $rowst6['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
      
         
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=501">Add new Product</a></center></td>
              </tr>
         <?php  }?>

          </table>





         <h2><b><u>Shoes</b></u></h2>
          <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
          <?php
         $queryst6="SELECT * FROM `bata_shoes`";
         $resltst6=mysqli_query($conn,$queryst6);
         if(!$resltst6){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst6=mysqli_fetch_array($resltst6)) {
             //Now it's time to diplay all data
    
              ?>
                <tr>
                 <td><center><?php echo $rowst6['ID'];?></center></td>
                 <td><center><?php echo "Shoes";?></center></td>
                 <td><center><?php echo "BATA";?></center></td>
                 <td><center><?php echo $rowst6['name'];?></center></td>
                 <td><center><?php echo $rowst6['quantity'];?></center></td>
                 <td><center><?php echo $rowst6['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=601">Add new Product</a></center></td>
              </tr>
         <?php  }?>



          </table>
          <table width="100%">
          <tr>
            <th>Stock ID</th>
            <th>Stock type</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
          <?php
         $queryst6="SELECT * FROM `borjan_shoes`";
         $resltst6=mysqli_query($conn,$queryst6);
         if(!$resltst6){
          echo "Error during fetching user data";
         }
         else{

           while ($rowst6=mysqli_fetch_array($resltst6)) {
             //Now it's time to diplay all data
    
              ?>
                <tr>
                 <td><center><?php echo $rowst6['ID'];?></center></td>
                 <td><center><?php echo "Shoes";?></center></td>
                 <td><center><?php echo "BORJAN";?></center></td>
                 <td><center><?php echo $rowst6['name'];?></center></td>
                 <td><center><?php echo $rowst6['quantity'];?></center></td>
                 <td><center><?php echo $rowst6['cost'];?></center></td>
                 <td><center><a href="">UPDATE</a></center></td>
                 <td><center><a href="">DELETE</a></center></td>
               </tr>
               <?php
             }?>
              <tr style="background-color: white;">
              <td colspan="8" rowspan="2"><center><a href="insertitemdbms_Admin.php?action=nitem&id=701">Add new Product</a></center></td>
              </tr>
         <?php  }?>

          </table>
      </div>
      </div>

</div>

</div>
<!-- Container ends above -->
<script type="text/javascript">

document.getElementById('regmembers').addEventListener('click',function showrightmenu1(){
    document.querySelector('.rightmenu1').style.display='block'
        /*Closing all other if opened*/
   
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';
  })

document.getElementById('customerorders').addEventListener('click',function showrightmenu2(){
    document.querySelector('.rightmenu2').style.display='block';
        /*Closing all other if opened*/
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu3').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';

  })

document.getElementById('feedback').addEventListener('click',function showrightmenu3(){
    document.querySelector('.rightmenu3').style.display='block';
        /*Closing all other if opened*/
    document.querySelector('.rightmenu1').style.display='none';
    document.querySelector('.rightmenu2').style.display='none';
    document.querySelector('.rightmenu4').style.display='none';

  })

document.getElementById('stock').addEventListener('click',function showrightmenu4(){
    document.querySelector('.rightmenu4').style.display='block';
        /*Closing all other if opened*/
     document.querySelector('.rightmenu1').style.display='none';
     document.querySelector('.rightmenu2').style.display='none';
     document.querySelector('.rightmenu3').style.display='none';
  })



</script>
</body>
</html>
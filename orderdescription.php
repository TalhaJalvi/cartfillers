<?php
	//First loading autoloader of dompdf liberary
	require_once 'dompdf/autoload.inc.php';

	//Now giving reference of dompdf namespace
    use Dompdf\Dompdf;
//First getting data from previous php file
if(isset($_POST["description"])){
	$orderid=$_POST['order_id'];
	$usermail=$_POST['user_mail'];
	$productids_arr=explode("," ,$_POST['productids']);
	$products_arr=explode(",", $_POST['productsnames']);
	$quantity_arr=explode(",", $_POST['quantity']);
	$price_arr=explode(",",$_POST['price']);
	$brand_arr=explode(",", $_POST['brand']);
	$code=$_POST['code'];
	$total=$_POST['total'];
	$orderdate=$_POST['orderdate'];
	$remdays=$_POST['remdays'];
	$paymentmethod=$_POST['paymentmethod'];
	$custaddress=$_POST['address'];
	$phonenum=$_POST['phonenum'];
      
    //Now we have all the data it's time to make downloadable pdf from it using fpdf liberray
   
   //Using domPDF to make pdf (converting HTML to PDF)

    //Now intializing Dompdf class; throw object of it we can access any method of Dompdf class
    $object = new Dompdf(array('isPhpEnabled' => true));

    //Now writing HTML code which will be converted to pdf
    $html = '
 <!DOCTYPE html>
 <html>
 <header>
 <title>Order Report</title>
 <style>
 th{
 background-color:purple;
 color:white;
 }
 tr:nth-child(odd){
 	background-color:#dddddd;
 }
 </style>
 </header>
 <body>
 <div>
   <img src="images\cart logo.png" width="100" height-"100"/>
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
   <font size="+4" style="color:#A0A0A0;"><b>Cartfillers.Inc.</b></font>
  </div>
 <hr>
 <br>
 <div>
 <font size="+3" style="color:purple;"><b>Customer Info:</b></font>
 <br>
 <br>
 <font size="+1"><b><u>Email: </u></b>&nbsp;&nbsp;' .$usermail.'</font><br>
 <font size="+1"><b><u>Payment method: </u></b>&nbsp;&nbsp;' .$paymentmethod.'</font><br>
 <font size="+1"><b><u>Delivery Address: </u></b>&nbsp;&nbsp;' .$custaddress.'</font><br>
 <font size="+1"><b><u>Phone No: </u></b>&nbsp;&nbsp;' .$phonenum.'</font><br>
 </div>
 <br>
 <div>
 <font size="+3" style="color:purple;"><b>Order Info:</b></font>
 <br>
 <br>
 <font size="+1"><b><u>Order ID: </u></b>&nbsp;&nbsp;' .$orderid.'</font><br>
 <font size="+1"><b><u>Products Type: </u></b>&nbsp;&nbsp; Garments</font><br>
 <font size="+1"><b><u>Date Ordered: </u></b>&nbsp;&nbsp;' .$orderdate.'</font><br>
 <font size="+1"><b><u>Remaining Days: </u></b>&nbsp;&nbsp;' .$remdays.'</font><br>
 <font size="+1"><b><u>Security Code (Shown during delivery):</u></b>&nbsp;&nbsp;' .$code.'</font><br><br>
 <table width="100%">
 <tr>
 <th>P IDs</th>
 <th>Products</th>
 <th>Quantity</th>
 <th>Brand</th>
 <th>Price Each</th>
 <th>Total</th>
 </tr>';
 //Now it's time to show main producs and their description
 $size=count($products_arr);
 for($i=0; $i<$size; $i++){
 	$html.='<tr>';
 	$html.='<td>'.$productids_arr[$i].'</td>';
 	$html.='<td>'.$products_arr[$i].'</td>';
 	$html.='<td>'.$quantity_arr[$i].'</td>';
 	$html.='<td>'.$brand_arr[$i].'</td>';
 	$html.='<td>'.$price_arr[$i].'</td>';
 	$html.='</tr>';
 }
    $html.='<tr style="background-color:#dddddd;">';
  	$html.='<td> </td>';
  	$html.='<td> </td>';
 	$html.='<td> </td>';
 	$html.='<td> </td>';
 	$html.='<td> </td>';
 $html.='<td>'.$total.'</td>';
 $html.='</tr>';
 $html.='</table>
<br>
<br>
<br>
<br>
<p>For any query contact us on: <a href="localhost/project/Aboutus.php" target="_blank">About us</a></p>

  </body>
  </html>';


    //Now converting our html code into pdf using loadHTML method
    $object->loadHTML($html);

    //Now setting paper size etc
    $object->setPaper('A4', 'portrait');

    //Render HTML as PDF
    $object->render();

    //Get output of genearted pdf in browser
    $object->stream("order report",array("Attachment"=>0));
}
?>
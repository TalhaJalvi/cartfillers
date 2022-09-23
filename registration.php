

<?php

// First getting values in variables from our HTML file  (from form of registration)
$mail=$_POST['mail'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$username=$_POST['username'];
$phone_number=$_POST['phone_number'];
$address=$_POST['address'];
$paymentmethod=$_POST['paymentmethod'];
$master_cardno=$_POST['master_cardno'];

if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
	    ?>
     	<Script>
     	alert("Email syntax not correct!!");
     	window.open('index.php','_self');
     </Script>
     	<?php
}
// Now it's time to connect to our xamp mySQL database
$conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
	# code...
	echo "Connection to DBMS failed";
}
else{
    //Before sending it to our database checking whether email already exists or not
     $qry1="SELECT *from `cartfillers`.`members` WHERE `Email`='$mail'";
     $result=mysqli_query($conn,$qry1);
     $row=mysqli_num_rows($result);
     if($row>0){
     	?>
     	<Script>
     	alert("Email already exists!!");
     	window.open('index.php','_self');
     </Script>
     	<?php
     }
     else{
	//Sending data to our database
	$qry2="INSERT INTO `members` (`Email` ,`Password` ,`gender` ,`Name` ,`Phoneno` ,`Address` ,`Payement_Method`,`mastercard_no`,`status`) VALUES ('$mail','$password','$gender','$username','$phone_number','$address','$paymentmethod','$master_cardno','0')";

$run=mysqli_query($conn,$qry2);
	if($run==true){
		//Now it's time to send activation link
		$tmstp=$_SERVER['REQUEST_TIME'];
		$token=sha1(uniqid($mail.$password,true));
		$query2="INSERT INTO `useraccount_activation` (`usermail`, `token`, `timestamnp`) VALUES ('$mail', '$token', '$tmstp')";
		$run2=mysqli_query($conn,$query2);
		if ($run2==true) {
			//Now sending m,ail to user
			$link="localhost/project/loginvalidationbdms.php?token=$token&user=$mail";
			$to = $mail;
$subject = 'Account Activation';
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
This mail is sended on response to your request of account account activation. Please click on link below to proceed</p>
<a href="'.$link.'">Activate My Account</a>
</br>
</br>
<p>Regards,<br>
Cartfillers Inc.</p>
</body>
</HTML>'
;
if (mail($to, $subject, $message, $headers)) {
		?>
		<script>
			alert('Data insarted successfully');
			//returning to same window when data was successfully uploaded to database
			window.open('index.php','_self');
		</script>
		<?php
	}
	else{
				?>
		<script>
			alert('Failed to send activation link contact us for further');
			//returning to same window when data was successfully uploaded to database
			window.open('index.php','_self');
		</script>
		<?php
	}
}
	}else{
		?>
		<script>
			alert('data not inserted');
			//returning to same window when data was not successfully uploaded to database
			//window.open('index.php','_self');
		</script>
		<?php
	}


}
}

?>
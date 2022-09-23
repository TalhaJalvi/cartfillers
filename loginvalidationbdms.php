<?php
session_start();

//logging in user directly if he clicks on account activation link
if (isset($_GET['token'])) {
$token=$_GET['token'];
$user=$_GET['user'];

$conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
	# code...
	//If connection building is failed to database
	echo "Connection to DBMS failed";
}
else{
//Now checking whether this token exists in our database
$queryactactiv1="SELECT * FROM `useraccount_activation` WHERE `usermail`='$user' AND `token`='$token'";
$runactactiv1=mysqli_query($conn,$queryactactiv1);
$rownum1=mysqli_num_rows($runactactiv1);
if ($rownum1>0) {
   //Now as we have found account now activating account
	$queryactactiv2="UPDATE `members` SET `status` = '1' WHERE `members`.`Email`='$user'";
	$runactactiv2=mysqli_query($conn,$queryactactiv2);
	if($runactactiv2==true){
	//Deleting token so it cannot be used again once used
	$queryactactiv3="DELETE FROM `useraccount_activation` WHERE `token` ='$token' AND `usermail`='$mail'";
	$runactactiv3=mysqli_query($conn,$queryactactiv3);
    if ($runactactiv3==true) {
   	?>
     <script type="text/javascript">
     	alert("Your account was updated successfully");
     </script>
	<?php
	//Making user login now
	$_SESSION['userid']=$user;
	header('location:Main.php');
	}
	else{
					?>
     <script type="text/javascript">
     	alert("Account activation failed please contact us");
     	window.open('index.php','_self');
     </script>
	<?php
	}
}
	else{
				?>
     <script type="text/javascript">
     	alert("Account activation failed please contact us");
     	window.open('index.php','_self');
     </script>
	<?php
	}

}
else{
	?>
     <script type="text/javascript">
     	alert("No account was found in database!!");
     	window.open('index.php','_self');
     </script>
	<?php
}
}
}
else{
//Now making connection to our database and rertrieving only email and password so we can match it
$conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
	# code...
	//If connection building is failed to database
	echo "Connection to DBMS failed";
}
else{
    //if connection build was successful
    //Getting or querying data from database
    //getting username and password entered by user  into variables
    $mail=$_POST['mail'];
    $password=$_POST['password'];

    $qry="SELECT * FROM `members` WHERE `Email`='$mail' AND `Password`='$password'";
    $run=mysqli_query($conn,$qry);
	$row=mysqli_num_rows($run);
	$rew=mysqli_fetch_array($run);
if($row<1){
		?>
		<script>
			alert('username and password not matched!! or account does not exists');
	        window.open('index.php','_self');
		</script>
		<?php
	}else{
		//Now email of user who as logged in is stored in mail variable
		//Storing it in user id (actually when we start a session PHPSESSID cookies store information till 
		//browsing session is expired and we are using these cookies to get data in main.php which is next page after login)
		$status=$rew['status'];
		if($status == '0'){
			?>
			<script>
			alert("Account not activated please verify your account through link which we have mailed you on your given user mail");
		    window.open('index.php','_self');
		</script>
		<?php
		}
		else{
		$_SESSION['userid']=$mail;
	    header('location:Main.php');
	}
	}

}
}

?>
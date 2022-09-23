<?php
//Getting value from previous page in our variable
$feedback=$_POST['feedback'];


// Now it's time to connect to our xamp mySQL database
$conn=mysqli_connect('localhost','root','','cartfillers');
if ($conn==false) {
	# code...
	echo "Connection to DBMS failed";
}
else{
	//Sending data to our database
	$date=date('y-m-d');
	$qry="INSERT INTO `cartfillers`.`feedback` (`Feedback`,`Date`) VALUES ( '$feedback','$date')";

$run=mysqli_query($conn,$qry);
	if($run==true){
		?>
		<script>
			alert('Feed back was successfully submitted DONT WORRY YOUR ID WILL BE HIDDEN');
			//returning to same window when data was successfully uploaded to database
			window.open('index.php','_self');
		</script>
		<?php
	}else{
		?>
		<script>
			alert('Failed to submit feedback');
			//returning to same window when data was not successfully uploaded to database
			window.open('index.php','_self');
		</script>
		<?php
	}
}
?>
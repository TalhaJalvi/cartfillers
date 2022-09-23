<?php

 $conn=mysqli_connect('localhost','root','','cartfillers');
         if(!$conn){
          echo "Error during database connection";
         }
         else{
if(isset($_GET['action'])){
	if ($_GET['action']=="delete") {

      if($_GET['id']=="101"){
      		$pris=$_GET['id1']	;
	$query="DELETE FROM `armani_t_shirts` WHERE `armani_t_shirts`.`ID` = $pris ";
	$run=mysqli_query($conn,$query);
	if($run==true){
		?>
		<script type="text/javascript">
			alert("Item deleted successfully");
			window.open("admin_panel.php","_self");
		</script>
		<?php
	}
    else{
    	echo "Failed to delete";
    }
	}



	      if($_GET['id']=="1"){
      		$pris=$_GET['id1']	;
	$query="DELETE FROM `nike_t_shirts` WHERE `nike_t_shirts`.`ID` = $pris ";
	$run=mysqli_query($conn,$query);
	if($run==true){
		?>
		<script type="text/javascript">
			alert("Item deleted successfully");
			window.open("admin_panel.php","_self");
		</script>
		<?php
	}
    else{
    	echo "Failed to delete";
    }
	}
}
}
}
?>
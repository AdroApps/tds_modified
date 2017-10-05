<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	
	$year = $_POST['year'];
	$quarter = $_POST['quarter'];
	$date = date("Y/m/d");
	$sql = "INSERT INTO `quarter_info` (`quarter_id`, `client_id`, `financial_year`, `quarter`, `status`, `total_amount`, `created_date`) VALUES ('".$year."' , '".$quarter."' ,  '".$date."' )";
	
	$data = mysqli_query($conn,$sql);
	
	if($data) {
    $status='success';
   }
   else {
     $status='failure';
   }
   
}
else if($_POST['type']=='update'){
	$id = $_POST['id'];

	
	 $newyear = $_POST['year'];
	 $newquarter = $_POST['quarter'];
	 
	 $sql = "UPDATE `quarter_info` SET  `year` = '".$newyear."'  ,`quarter` = '".$newquarter."'  WHERE `id` = '".$id."'";
	 $query = mysqli_query($conn ,$sql); 
   if($query) {
    $status='success';
   }
   else {
     $status='failure';
   }
 else if($_POST['type']=='delete'){

	$id = $_POST['id'];
	
	$sql = "DELETE FROM `quarter_info` WHERE `id` = '".$id."'";
	
	$data = mysqli_query($conn, $sql);
	
	if($data) {
			$status= "success";
	}
	else {
		$status= "failure";
	}
?>

 

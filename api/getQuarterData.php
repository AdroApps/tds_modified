<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	
	$year = $_POST['year'];
	$quarter = $_POST['quarter'];
	$service=$_POST['service'];
	$apname=$_POST['apname'];
	$date = date("Y/m/d");
	$status='';
	$sql = "INSERT INTO `quarter_info` (`quarter_id`, `client_id`, `financial_year`, `quarter`,`authorised_person_name`, `status`, `total_amount`, `created_date`) VALUES ('','".$_SESSION['user_id']."','".$year."' , '".$quarter."' ,'".$apname."','".$status."' ,'".$service."', '".$date."' )";

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
	 $apname=$_POST['apname'];
	 $sql = "UPDATE `quarter_info` SET  `financial_year` = '".$newyear."'  ,`quarter` = '".$newquarter."',`authorised_person_name`='".$apname."' WHERE `quarter_id` = '".$id."'";

	 $query = mysqli_query($conn ,$sql); 
   if($query) {
    $status='success';
   }
   else {
     $status='failure';
   }
}
 else if($_POST['type']=='delete'){

	$id = $_POST['id'];
	
	$sql = "DELETE FROM `quarter_info` WHERE `quarter_id` = '".$id."'";
	
	$data = mysqli_query($conn, $sql);
	
	if($data) {
			$status= "success";
	}
	else {
		$status= "failure";
	}
 }
 else if($_POST['type']=='verify'){
	 $chkquery="SELECT * from quarter_info where financial_year='".$_POST['year']."' AND quarter='".$_POST['quarter']."'" ;

	$checkdata = mysqli_query($conn,$chkquery);
  if (mysqli_num_rows($checkdata) != 0)
  {
     $status='failure';
  }

  else
  {
   $status='success';
  }
 }
  echo json_encode([$status]);
?>

 

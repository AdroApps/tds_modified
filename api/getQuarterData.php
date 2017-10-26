<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	
	$year = $_POST['year'];
	$quarter = $_POST['quarter'];
	$service=$_POST['service'];
	$apname=$_POST['apname'];
	$date = date("Y-m-d h:i:s");
	$status='';
	$sql = "INSERT INTO `quarter_info` (`quarter_id`, `client_id`, `financial_year`, `quarter`,`authorised_person_name`, `status`, `total_amount`, `created_date`) VALUES ('','".$_SESSION['user_id']."','".$year."' , '".$quarter."' ,'".$apname."','".$status."' ,'".$service."', '".$date."' )";
	$data = mysqli_query($conn,$sql);	
	if($quarter == "Q1") {
		$month1 = "January";
		$month2 = "Febuary";
		$month3 = "March";
    } else if($quarter == "Q2") {
		$month1 = "April";
		$month2 = "May";
		$month3 = "June";
    } else if($quarter == "Q3") {
		$month1 = "July";
		$month2 = "August";
		$month3 = "September";
    } else {
		$month1 = "October";
		$month2 = "November";
		$month3 = "December";
    }
	$esql="SELECT * from client_employees where client_id=".$_SESSION['user_id']." and status=1";
	$edata=mysqli_query($conn,$esql);
	$getqid="SELECT quarter_id from quarter_info where client_id=".$_SESSION['user_id']." and financial_year='".$year."' and quarter='".$quarter."'";
	$getqdata=mysqli_fetch_assoc (mysqli_query($conn, $getqid));
    $qid=$getqdata['quarter_id'];
	while($row=mysqli_fetch_assoc($edata)){
	$tdsql="INSERT INTO `tds_info` (`tds_id`, `client_id`, `emp_id`, `quarter_id`, `salary1`, `month1`, `tdsamount1`, `salary2`, `month2`, `tdsamount2`, `salary3`, `month3`, `tdsamount3`,`total_amount`, `created_date`) VALUES('','".$_SESSION['user_id']."','".$row['emp_id']."','$qid','','".$month1."','','','".$month2."','','','".$month3."','','','$date')";
	$tdsdata=mysqli_query($conn,$tdsql);
	}
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
	$tsql = "DELETE FROM `tds_info` WHERE `quarter_id` = '".$id."'";
	
	$tdata = mysqli_query($conn, $tsql);
	
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

 

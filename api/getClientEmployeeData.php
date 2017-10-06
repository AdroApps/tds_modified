<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	$ename = $_POST['name'];
	$pan = $_POST['panno'];
	$adhar = $_POST['addhar'];
	$date = date("Y/m/d h:i:s");

	$sql = "INSERT INTO `client_employees`(`emp_id`,`client_id`,`pan` , `aadhar` ,`emp_name`,`created_date`) VALUES ('','".$_SESSION['user_id']."','".$pan."' , '".$adhar."' , '".$ename."','".$date."')";  
	$data  = mysqli_query($conn,$sql);
	
		  if($data) {
    $status='success';
   }
   else {
     $status='failure';
   }
   
}
else if($_POST['type']=='verify'){
	if($_POST['id'])	
	$chkquery="SELECT emp_id from client_employees where emp_id!=".$_POST['id']." AND (emp_name='".$_POST['name']."' OR pan='".$_POST['panno']."' OR  aadhar='".$_POST['addhar']."')" ;
	else
		$chkquery="SELECT emp_id from client_employees where emp_name='".$_POST['name']."' OR pan='".$_POST['panno']."' OR  aadhar='".$_POST['addhar']."'" ;

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
else if($_POST['type']=='update'){
	$id = $_POST['id'];

	
	$newename = $_POST['name'];
	$newpan = $_POST['panno'];
	$newadhar = $_POST['addhar'];
	$sql1 = "UPDATE `client_employees` SET  `pan`='".$newpan."' ,`aadhar`='".$newadhar."' , `emp_name`='".$newename."'   WHERE `emp_id` = '".$id."' ";
   $query1 = mysqli_query($conn ,$sql1); 
   if($query1) {
    $status='success';
   }
   else {
     $status='failure';
   }
}
else if($_POST['type']=='delete'){

	$id = $_POST['id'];
	$sql = "DELETE FROM `client_employees` WHERE `emp_id` = '".$id."'";
	$data = mysqli_query($conn, $sql);
	  if($data) {
    $status='success';
   }
   else {
     $status='failure';
   }
}
else if($_POST['type']=='setstatus'){
	$id=$_POST['id'];
	$sql1 = "UPDATE `user_info` SET `status`='".$_POST['val']."' WHERE `userid` = '".$id."' ";

   $query1 = mysqli_query($conn ,$sql1); 
   if($query1) {
    $status='success';
   }
   else {
     $status='failure';
   }
}
else{
}
   echo json_encode([$status]);

?>

<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	$ename = $_POST['name'];
	$pan = $_POST['panno'];
	$adhar = $_POST['addhar'];
	$date = date("Y/m/d h:i:s");
 if($_POST['cid'])
	 $client_id=$_POST['cid'];
 else
	 $client_id=$_SESSION['user_id'];
	$sql = "INSERT INTO `client_employees`(`emp_id`,`client_id`,`pan` , `aadhar` ,`emp_name`,`created_date`,`status`) VALUES ('','". $client_id."','".$pan."' , '".$adhar."' , '".$ename."','".$date."','1')";  
	$data  = mysqli_query($conn,$sql);
	
$id=  mysqli_insert_id($conn); 
	$nsql="INSERT INTO `notifications` (`notification_id`, `message`, `created_by`, `created`, `created_date`) VALUES (NULL,'".EMPLOYEE_MESSAGE."', '".$_SESSION['user_id']."', '$id', '$date')";

$ndata=mysqli_query($conn,$nsql);
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
  $status=mysqli_num_rows($checkdata);
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

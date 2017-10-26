<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	$ename = $_POST['name'];
	$email = $_POST['email'];
	 $pwd = $_POST['password'];
	 $pno=$_POST['pno'];
	$pwd = hash('sha256', $pwd); 
	$date = date("Y-m-d h:i:s");
	$sql = "INSERT INTO `user_info`(`userid`,`username` , `emailId` ,`password`,`created_by`,`created_date`,`status`,`role_id`,`name`,`phone_number`) VALUES ('','".$ename."' , '".$email."' , '".$pwd."','".$_SESSION['user_id']."','$date','1','4','".$ename."','".$pno."')";

		$query1  = mysqli_query($conn,$sql);
}
else if($_POST['type']=='edit'){
	
	
$id = $_POST['id'];
$pno=$_POST['pno'];
	$newename = $_POST['name'];
	$newemail = $_POST['email'];
	
	if( $_POST['password']!=''){
	   $pwd = $_POST['password'];
	   $pwd = hash('sha256', $pwd); 
	$sql1 = "UPDATE `user_info` SET `username`='".$newename."' ,`password`='$pwd' ,`name`='".$newename."' ,`phone_number`='".$pno."', `emailId`='".$newemail."'   WHERE `userid` = '".$id."' ";
	
	}
	else{
	$sql1 = "UPDATE `user_info` SET `username`='".$newename."' , `name`='".$newename."' ,`phone_number`='".$pno."', `emailId`='".$newemail."'   WHERE `userid` = '".$id."' ";
	}
	
$query1  = mysqli_query($conn,$sql1);
}
else if($_POST['type']=='delete'){
	$id = $_POST['id'];
	$sql = "DELETE FROM `user_info` WHERE `userid` = '".$id."'";
	$query1  = mysqli_query($conn,$sql);
}

	
	
	  if($query1) {
    $status='success';
   }
   else {
     $status='failure';
   }
  
   echo json_encode([$status]);
?>
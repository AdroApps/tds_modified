<?php
include_once "../conn.php";

if($_POST['type']=='insert'){
	$username= $_POST['username'];
	$mail = $_POST['email'];
	$password = $_POST['password'];
	$password = hash('sha256', $password);
	$pname = $_POST['name'];
	$number  = $_POST['number'];
	$userid = $_SESSION['user_id'];
	$roleid=2;
	$status=1;
	$date = date("Y/m/d h:i:s");
	$sql = "INSERT INTO `user_info` ( `userid` , `username` , `password` , `emailId` , `phone_number` ,`name`, `role_id` , `created_by` , `created_date` , `status`) VALUES ('' , '".$username."','".$password."' , '".$mail."' , '".$number."' , '".$pname."' , '".$roleid."' , '".$_SESSION['user_id'] ."' , '".$date."' , '".$status."')";

	$data = mysqli_query($conn,$sql);
	  if($data) {
    $status='success';
   }
   else {
     $status='failure';
   }
   
}
else if($_POST['type']=='verify'){
	
	$chkquery="SELECT username from user_info where username='".$_POST['username']."' OR emailId='".$_POST['email']."' OR  phone_number='".$_POST['phone_no']."'" ;
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

	$neworganization = $_POST['uname'];
	$newmail = $_POST['mail'];
	$newpassword = $_POST['password'];
	$newnumber = $_POST['number']; 
	$newname = $_POST['name'];
	if($newpassword==''){
	$password=',';}
	else{
		$password=hash('sha256', $newpassword);
	
	$password=",`password`='".$password."',";}

   $sql1 = "UPDATE `user_info` SET `username`='".$neworganization."',`emailId`='".$newmail."'  ".$password." `phone_number`='".$newnumber."'   WHERE `userid` = '".$id."' ";

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
	
	$sql = "DELETE FROM `user_info` WHERE `userid` = '".$id."'";
	$data = mysqli_query($conn, $sql);
	if($data) {
			$status= "success";
	}
	else {
		$status= "failure";
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
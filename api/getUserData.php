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
	
	$getcli="select GROUP_CONCAT(`user_info`.`userid`) as `userid` from user_info where created_by=".$id;
	$getsql=mysqli_fetch_array(mysqli_query($conn,$getcli));
	$fsql = "DELETE FROM `file_uploads_info` WHERE `user_id` IN('".$getsql[0]."')";
	$fdata = mysqli_query($conn, $fsql);
	$qsql = "DELETE FROM `quarter_info` WHERE `client_id` IN('".$getsql[0]."')";
	$qdata = mysqli_query($conn, $qsql);
	$esql = "DELETE FROM `client_employees` WHERE `client_id` IN('".$getsql[0]."')";
	$edata = mysqli_query($conn, $esql);
	$tdssql = "DELETE FROM `tds_info` WHERE `client_id` IN('".$getsql[0]."')";
	$tdsdata = mysqli_query($conn, $tdssql);
	$csql = "DELETE FROM `client_info` WHERE `auditor_id` = '".$id."'";
	$cdata = mysqli_query($conn, $csql);
	$usql = "DELETE FROM `user_info` WHERE `created_by` = '".$id."'";
	$udata = mysqli_query($conn, $usql);	
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
$sql2 = "UPDATE `user_info` SET `status`='".$_POST['val']."' WHERE `created_by` = '".$id."' ";
   $query1 = mysqli_query($conn ,$sql1); 
    $query1 = mysqli_query($conn ,$sql2); 
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
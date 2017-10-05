<?php
include_once "../conn.php";

if($_POST['type']=='insert') {
	$ename = $_POST['ename'];
	$pan = $_POST['pan'];
	$adhar = $_POST['adhar'];
	$date = date("Y/m/d h:i:s");

	$sql = "INSERT INTO `client_employees`(`pan` , `aadhar` ,`emp_name`,`created_date`) VALUES ('".$ename."' , '".$pan."' , '".$adhar."','".$_SESSION['user_id']."')";  

	$data  = mysqli_query($conn,$sql);
	
		  if($data) {
    $status='success';
   }
   else {
     $status='failure';
   }
   
}
/*else if($_POST['type']=='verify'){
	
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
}*/
else if($_POST['type']=='update'){
	$id = $_POST['id'];

	
	$newename = $_POST['name'];
	$newpan = $_POST['pan'];
	$newadhar = $_POST['adhar'];
	$sql1 = "UPDATE `client_employees` SET  `pan`='".$newpan."' ,`adhar`='".$newadhar."' , `emp_name`='".$newename."' ,  WHERE `emp_id` = '".$id."' ";

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

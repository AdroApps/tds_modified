<?php

include_once "../conn.php";
if($_POST['type']=='insert'){
	$username= $_POST['username'];
	$mail = $_POST['email'];
	$password = $_POST['password'];
	$password = hash('sha256', $password);
	$pname = $_POST['clientname'];
	$number  = $_POST['phonenumber'];
	$userid = $_SESSION['user_id'];
	$tan=$_POST['tan'];
	$area=$_POST['area'];
	$city=$_POST['city'];
	$service=$_POST['service_charges'];	
	$assign=$_POST['assign'];
	$roleid=3;
	$status=1;
	$date = date("Y/m/d h:i:s");
	$sql = "INSERT INTO `user_info` ( `userid` , `username` , `password` , `emailId` , `phone_number` ,`name`, `role_id` , `created_by` , `created_date` , `status`) VALUES ('' , '".$username."','".$password."' , '".$mail."' , '".$number."' , '".$pname."' , '".$roleid."' , '".$_SESSION['user_id'] ."' , '".$date."' , '".$status."')";

	$data = mysqli_query($conn,$sql);  
	$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT userid FROM `user_info` WHERE `emailId` = '$mail' "));
	$client_id= $result['userid'];
$clientsql = "INSERT INTO `client_info` ( `client_info_id` ,`client_id`,`auditor_id`, `tan` , `client_name` , `city` , `area` ,`service_charges`, `created_date` ,`assigned_to`) VALUES ('' , '".$client_id."', '".$_SESSION['user_id']."', '".$tan."','".$pname."' ,  '".$city."' , '".$area."' , '".$service."' , '".$date."','$assign' )";

	$cdata = mysqli_query($conn,$clientsql);
	  if($cdata) {
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

	$uname = $_POST['uname'];
	$newmail = $_POST['mail'];
	$newpassword = $_POST['password'];
	$newnumber = $_POST['number']; 
	$newname = $_POST['name'];
	$city=$_POST['city'];
	$tan=$_POST['tan'];
	$service=$_POST['service'];
	$area=$_POST['area'];
	$udate = date("Y/m/d h:i:s");
	$orgname=$_POST['orgname'];
	$assign=$_POST['assign'];
	if($newpassword==''){
	$password=',';}
	else{
		$password=hash('sha256', $newpassword);
	
	$password=",`password`='".$password."',";}

   $sql1 = "UPDATE `user_info` SET `username`='".$uname."',`emailId`='".$newmail."'  ".$password." `phone_number`='".$newnumber."'   WHERE `userid` = '".$id."' ";
  
   $sql="UPDATE `client_info` SET `client_name`='".$orgname."',`assigned_to`='".$assign."',`city`='".$city."',`area`='".$area."',`tan`='".$tan."' ,`service_charges`='".$service."',`created_date`='".$udate."' WHERE `client_id` = '".$id."' ";
$query1 = mysqli_query($conn ,$sql1);      
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
	
	$sql = "DELETE FROM `user_info` WHERE `userid` = '".$id."'";
	$data = mysqli_query($conn, $sql);
	$sqluser = "DELETE FROM `client_info` WHERE `client_id` = '".$id."'";
	$datauser = mysqli_query($conn, $sqluser);
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
else if($_GET['type']=='import' || $_POST['type']=='import'){
	print_r($_FILES);
		$file = $_FILES['file_url']['tmp_name'];
		$handle = fopen($file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
			
		if( $filesop[0]!='Name'){
		
			$pan = $filesop[1];
			$name = $filesop[0];
			$adar = $filesop[2];
			$ldate=date('Y-m-d H:i:s');
		$checked=checkdetails($pan,$adar);
		if($checked){
$query = "INSERT INTO `client_employees` (`emp_id`, `client_id`, `pan`, `aadhar`, `emp_name`, `status`, `created_date`)values ('', '".$_SESSION['user_id']."','".$pan."','".$adar."','".$name."','1','".$ldate."')";

			 $rgetorg=mysqli_query($conn, $query);
		
		     $c = $c + 1;
			$i++;
			
		}
		}
	
		}		if($sql){
				echo "You database has imported successfully. You have inserted ". $c ." records";
			}else{
				echo "Sorry! There is some problem.";
			}
}
else if($_GET['type']=='export' || $_POST['type']=='export'){
}
function checkdetails($pan,$adar){
	$conn = mysqli_connect(DB_HOST, DB_UNAME, DB_PASSWORD, DB_NAME);
 $getuserorg="SELECT * FROM client_employees` WHERE pan='".$pan."' and aadhar='".$adar."'";
 $userorg=mysqli_query($conn, $getuserorg);
if( mysqli_num_rows($userorg)>0){
	$checked=false;
}
else
	$checked=true;
return $checked;
}
   echo json_encode([$status]);

?>
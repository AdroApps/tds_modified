
<?php
include_once "conn.php";
include_once "header.php";
if($_SESSION['role_id']==CLIENT )
$esql="SELECT c.client_name,c.tan,c.area,c.city,u.emailId,u.phone_number from client_info c,user_info u where u.userid=c.client_id and c.client_id=".$_SESSION['user_id'];
else
	$esql="SELECT * from user_info where userid=".$_SESSION['user_id'];

$edata=mysqli_query($conn,$esql);
while($row=mysqli_fetch_assoc($edata)){
if($_SESSION['role_id']==CLIENT ){	
$tan=$row['tan'];
$name=$row['client_name'];
$city=$row['city'];
$area=$row['area'];
}
else{
$name=$row['name'];
}
$email=$row['emailId'];
$pno=$row['phone_number'];
}

if(isset($_POST['btn-edit']))
		{

	$name=$_POST['name'];
	$email=$_POST['email'];
	$pno=$_POST['pno'];
	if($_SESSION['role_id']==CLIENT ){
	$tan=$_POST['tan'];
	$area=$_POST['area'];
	$city=$_POST['city'];
	$usql="UPDATE client_info c,user_info u SET c.client_name='".$name."',u.name='".$name."',c.city='".$city."',c.area='".$area."',u.username='".$name."',u.emailId='".$email."',u.phone_number='".$pno."' WHERE userid=".$_SESSION['user_id'];
	
	}
	else
		   $usql="UPDATE user_info u SET u.username='".$name."',u.name='".$name."',u.emailId='".$email."',u.phone_number='".$pno."' WHERE userid=".$_SESSION['user_id'];
	   		
		$udata=mysqli_query($conn,$usql);
		if($udata)
			echo "<script>alert('Profile updated Sucessfully'); window.location='edit_profile.php'</script>";
		else
			echo "<script>alert('Could not save the data'); </script>";
		}
?>
<div class="container">
<div class="row">
  <div class="col-md-6 col-md-offset-3">
       <div class="login-panel panel panel-default" style="margin-top:5%">
     <div class="panel-heading ">
                Edit Profile
                </div>
 <form class="form-horizontal"  method="post" role="form">
 <div class="panel-body login">
 <div class="form-group">
 <label for="inputEmail1" class="col-lg-3 control-label">Email</label>
 <div class="col-lg-9">
   <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email;?>">
 </div>
 </div>
 <div class="form-group">
 <label for="name" class="col-lg-3 control-label">Name</label>
 <div class="col-lg-9">
   <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $name;?>">
 </div>
 </div>
 <div class="form-group">
 <label for="pno" class="col-lg-3 control-label">Phone Number</label>
 <div class="col-lg-9">
   <input type="text" maxlength="10" class="form-control"  name="pno" placeholder="Phone Number" value="<?php echo $pno;?>">
 </div>
 </div>
 <?php if($_SESSION['role_id']==CLIENT){?>
 
 <div class="form-group">
  <label for="city" class="col-lg-3 control-label">City</label>
 <div class="col-lg-9">
   <input type="text" maxlength="10" class="form-control"  name="city" placeholder="City" value="<?php echo $city;?>">
 </div>
 </div>
  <div class="form-group">
  <label for="area" class="col-lg-3 control-label">Area</label>
 <div class="col-lg-9">
   <input type="text" maxlength="10" class="form-control"  name="area" placeholder="Area" value="<?php echo $area;?>">
 </div>
 </div>
  <div class="form-group">
 <label for="tan" class="col-lg-3 control-label">TAN Number</label>
 <div class="col-lg-9">
   <input type="text" maxlength="10" class="form-control"  readonly name="tan" placeholder="TAN Number" value="<?php echo $tan;?>">
 </div>
 </div>

 <?php }?>
 <div class="form-group">
 <div class="col-lg-offset-4 col-lg-5">
 <input type="submit" class="btn btn-block btn-primary newbtn" name="btn-edit" value='Update'/>
 </div> 
  </div> </div>
</form> 
 </div>
 </div> </div>
</div>
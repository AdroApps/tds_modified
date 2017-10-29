<?php
include_once "conn.php";
include_once "header.php";


if(isset($_POST['btn-pwd']))
		{
		$old_pass=$_POST['curpwd'];
		$old_pass=hash('sha256', $old_pass);
		$new_pass=$_POST['newpwd'];
		$re_pass=$_POST['rnewpwd'];
		$chg_pwd=mysqli_query($conn,"select password from user_info where userid='".$_SESSION['user_id']."'");
		$chg_pwd1=mysqli_fetch_array($chg_pwd);
		$data_pwd=$chg_pwd1['password'];
		if($old_pass=='' || $new_pass=='' || $re_pass==''){
			echo "<script>alert('Please enter the required fields');</script>";
		}
		else if($data_pwd==$old_pass){
		if($new_pass==$re_pass){
			$new_pass=hash('sha256', $new_pass);
			$update_pwd=mysqli_query($conn,"update user_info set password='$new_pass' where userid='".$_SESSION['user_id']."'");
			echo "<script>alert('Password updated Sucessfully'); window.location='logout.php'</script>";
		}
		else{
			echo "<script>alert('Your new and Retype Password is not match'); </script>";
		}
		}
		else
		{
		echo "<script>alert('Your old password is wrong'); </script>";
		}}
?><div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default" style="margin-top:25%">
                <div class="panel-heading ">
                Change Password
                </div>
               
				<form method="post"> <div class="panel-body login">
            <div class="form-group">
            	
               
            	<input type="password" name="curpwd" class="form-control" placeholder="Current Password" maxlength="50"  />
            </div>
             <div class="form-group">
            	
               
            	<input type="password" name="newpwd" class="form-control" placeholder="New Password" maxlength="50"  />
            </div>
            <div class="form-group">
            
               <input type="password" name="rnewpwd" class="form-control" placeholder="Retype New Password" maxlength="40"/>
            </div>
            
            <div class="form-group">
            	<input type="submit" class="btn btn-block btn-primary newbtn" name="btn-pwd" value='Change Password'/>
            </div>
            
            
        
        </div>
   
    </form>
    </div>	

</div></div>	

</div>
<?php include_once "footer.php";?>
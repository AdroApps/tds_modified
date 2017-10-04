<?php	
include_once "conn.php";
session_start();
define ('SUPERADMIN' , '1');
define ('AUDITOR' , '2');
define ('CLIENT' , '3');
define ('AUTHOR' , '4');
define ('AGENT' , '5');
define('STATUS_SUCCESS','1');
define('STATUS_FAILURE','0');

if(isset($_POST['sub'])){
	$mail = $_POST['mail'];
    $pwd = $_POST['password'];
	$pwd = hash('sha256', $pwd); 
    $email="";
    $password="";
	
	
    $client_sql = "SELECT * FROM `user_info` WHERE `emailId` = '".$mail."' AND `password` = '".$pwd."'";
    $client_result = mysqli_query($conn , $client_sql);
	
    if(mysqli_num_rows($client_result) != 0) {
		  while($client_row=mysqli_fetch_assoc($client_result)) {
			$email=$client_row['emailId'];
			$status=$client_row['status'];
			$password=$client_row['password'];
			$_SESSION['role_id'] = $client_row['role_id'];		
			$_SESSION['user_id'] = $client_row['userid'];
			$_SESSION['org']=$client_row['organization'];
		}
		if($email == $mail && $password == $pwd && $status==STATUS_SUCCESS) {

			if($_SESSION['role_id']==SUPERADMIN)
			   header('Location:users.php');
		   if($_SESSION['role_id']==AUDITOR)
			   header('Location:clients.php');
			
		}
		else{
			 echo "<center><h2 style='margin-top:10px;color:#273246;font-size:18px'>User has been blocked</h2></center>";
		}
		
	}
    else {
        echo "<center><h2 style='margin-top:10px;color:#273246;font-size:18px'>Invalid Email/Password</h2></center>";
    }
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/core.css" rel="stylesheet" type="text/css">
	<link href="css/components.css" rel="stylesheet" type="text/css">
	<link href="css/colors.css" rel="stylesheet" type="text/css">
 <link rel = "stylesheet" href="css/style.css">
    <title>TDS MANAGEMENT SYSTEM</title>

</head>
<body>
	<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default" style="margin-top:50%">
                <div class="panel-heading">
                    <center><h3 class="panel-title"><b>LOGIN</b></h3></center>
                </div>
                <div class="panel-body">
                    <form action="" method="POST">
						<fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="mail" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password">
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
			<input type="submit" name="sub" value="Login" class="btnbg btn btn-lg btn-success btn-block newbtn">
                      
			<!--input type="submit" name="submit" value="submit" class="btn btn-md btn-primary"-->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>



<?php
include_once "conn.php";
define ('SUPERADMIN' , '1');
define ('AUDITOR' , '2');
define ('CLIENT' , '3');
define ('AUTHOR' , '4');
define ('AGENT' , '5');
define('STATUS_SUCCESS','1');
define('STATUS_FAILURE','0');
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>
<!DOCTYPE html>
<html>
<head>
<script>
var url = "http://localhost/tds_mod/api/";
</script>
<style>body {
  padding-top: 50px;
}

</style>
<title>TDS MANAGEMENT SYSTEM</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/core.css" rel="stylesheet" type="text/css">
	<link href="css/components.css" rel="stylesheet" type="text/css">
	<link href="css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets-->


<link rel = "stylesheet" href="css/style.css">
	<!-- Core JS files -->

	<script type="text/javascript" src="js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->
	


  
  </head><body><div class="navbar navbar-inverse navbar-fixed-top" role="navigation">	
	<div class="navbar-header">
        <div class="navbar-header"><a class="navbar-brand" href="#">ADRO</a></div>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	
</div>
<div class="navbar navbar-inverse navbar-static-top" role="navigation">	

	<ul class="nav navbar-nav navbar-nav-material">
				<?php if($_SESSION['role_id']==SUPERADMIN){?>
					<li class="<?php active('users.php');?>"><a href="users.php"><i class="icon-puzzle4 position-left"></i> USERS</a></li>
				<?php }?>
					<?php if($_SESSION['role_id']==AUDITOR){?>
					<li class="<?php active('clients.php');?>"><a href="clients.php"><i class="icon-puzzle4 position-left"></i>Clients</a></li>
				<li class="<?php active('adminaddemployee.php');?>"><a href="adminaddemployee.php"><i class="icon-puzzle4 position-left"></i>Employees</a></li>
				
				<li class="<?php active('internal_user.php');?>"><a href="internal_user.php"><i class="icon-puzzle4 position-left"></i>INTERNAL USERS</a></li>
				<?php }?>
				<?php if($_SESSION['role_id']==CLIENT){?>
					<li class="<?php active('usertable.php');?>"><a href="usertable.php"><i class="icon-puzzle4 position-left"></i>Clients</a></li>
				<li class="<?php active('adminaddemployee.php');?>"><a href="adminaddemployee.php"><i class="icon-puzzle4 position-left"></i>Employees</a></li>
				
				<li class="<?php active('internal_user.php');?>"><a href="internal_user.php"><i class="icon-puzzle4 position-left"></i>INTERNAL USERS</a></li>
				<?php }?>
				
			</ul>
	<div class="collapse navbar-collapse">
		
<!--client menu-->

			
			<!--page header<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>-->
						


		<ul class="nav navbar-nav pull-right">
			
			<li><a href="#"><div id="buttonplace"></div></a></li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="#"><span class="badge badge-warning pull-right"></span> <i class="icon-comment-discussion"></i> Messages</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
              </ul>
            </li>
		</ul>
		
	</div>
</div>



</body>
</html>
	 
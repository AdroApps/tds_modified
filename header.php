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
var url = "http://localhost/tds_modified/api/";
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
	


  
  </head><body><div class="navbar navbar-inverse navbar-fixed-top" style="top:0;position:fixed;" role="navigation">	
	<div class="navbar-header col-md-10 col-sm-10 col-xs-12">
        <div class="navbar-header col-md-8 col-xs-6"><a class="navbar-brand" href="#">ADRO</a></div>
		<button type="button" class="pull-right col-xs-4 navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	<div class="col-md-2 col-xs-2 col-xs-12">
	
        <div class="navbar-header"><a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['name'];?></a></div>
	
	</div>
	
</div>
<div class="navbar navbar-inverse navbar-static-top" style="position:fixed;width:100%;" role="navigation">	

	<ul class="nav navbar-nav navbar-nav-material">
				<?php if($_SESSION['role_id']==SUPERADMIN){?>
					<li class="<?php active('users.php');?>"><a href="users.php"><i class="icon-users position-left"></i> USERS</a></li>
				<?php }?>
					<?php if($_SESSION['role_id']==AUDITOR){?>
					<li class="<?php active('clients.php');?>"><a href="clients.php"><i class="icon-user-tie position-left"></i>Clients</a></li>
				
				<li class="<?php active('internal_users.php');?>"><a href="internal_users.php"><i class="icon-users position-left"></i>INTERNAL USERS</a></li>
				<?php }?>
				<?php if($_SESSION['role_id']==CLIENT){?>
					<li class="<?php active('quarter_data.php');?>"><a href="quarter_data.php"><i class="icon-profile position-left"></i>TDS</a></li>
				<li class="<?php active('client_employees.php');?>"><a href="client_employees.php"><i class="icon-briefcase position-left"></i>Employees</a></li>
				<?php }?>
				<?php if($_SESSION['role_id']==AUTHOR){?>
					<li class="<?php active('clients.php');?>"><a href="clients.php"><i class="icon-user-tie position-left"></i>Clients</a></li>
				<?php }?>
			</ul>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav pull-right">
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="#"><span class="badge badge-warning pull-right"></span> <i class="icon-comment-discussion"></i> Notifications</a></li>
						<li class="divider"></li>
						<li><a href="change_password.php"><i class="icon-key"></i> Change Password</a></li>
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
              </ul>
            </li>
		</ul>
		
	</div>
</div>


<script>

var ALERT_TITLE = "Info!";
var ALERT_BUTTON_TEXT = "Ok";

if(document.getElementById) {
	window.alert = function(txt) {
		createCustomAlert(txt);
	}
}

function createCustomAlert(txt) {
	d = document;

	if(d.getElementById("modalContainer")) return;

	mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
	mObj.id = "modalContainer";
	mObj.style.height = d.documentElement.scrollHeight + "px";
	
	alertObj = mObj.appendChild(d.createElement("div"));
	alertObj.id = "alertBox";
	if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
	alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
	alertObj.style.visiblity="visible";

	h1 = alertObj.appendChild(d.createElement("h1"));
	h1.appendChild(d.createTextNode(ALERT_TITLE));

	msg = alertObj.appendChild(d.createElement("p"));
	//msg.appendChild(d.createTextNode(txt));
	msg.innerHTML = txt;

	btn = alertObj.appendChild(d.createElement("a"));
	btn.id = "closeBtn";
	btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
	btn.href = "#";
	btn.focus();
	btn.onclick = function() { removeCustomAlert();location.reload();return false; }

	alertObj.style.display = "block";
	
}

function removeCustomAlert() {
	document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
function ful(){
alert('Alert this pages');
}</script>
</body>
</html>
	 
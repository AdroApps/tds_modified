<?php
include_once "conn.php";
if(!isset($_SESSION['user_id']) ){
			   header('Location:index.php');exit();
}
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

<title>TDS MANAGEMENT SYSTEM</title>
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
	


  
  </head><body>
  
  <nav class="navbar navbar-default navbar-fixed-top">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Adro</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		<div class="col-sm-3 col-md-3 search">
       
        <div class="input-group inpt">
            <input id="myInput" type="text" class="form-control" placeholder="Search" name="q">
           
        </div>
        </div>
          <ul class="nav navbar-nav">
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
          
		  <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $_SESSION['name'];?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li><a href="edit_profile.php"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="notifications.php"><span class="badge badge-warning pull-right"></span> <i class="icon-comment-discussion"></i> Notifications</a></li>
						<li class="divider"></li>
						<li><a href="change_password.php"><i class="icon-key"></i> Change Password</a></li>
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
		  
        </div><!--/.nav-collapse -->
     
    </nav>


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
	return false;
	
}

function removeCustomAlert() {
	document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
function ful(){
alert('Alert this pages');
}/*
	<table class="table table-fixed" >
		<thead>
			<tr>
				
				<th  class="col-xs-1"> Name</th>
				<th  class="col-xs-2">Email</th>
				<th  class="col-xs-2">Phone Number</th>
				<th  class="col-xs-2">Internal Users</th>
				<th  class="col-xs-1">Status</th>				
				<th  class="col-xs-2">Date</th>
				<th class="col-xs-1">Edit</th>
				<th class="col-xs-1">Delete</th>
			</tr>
			
		</thead>
		<tbody id="myTable">
		<?php if( mysqli_num_rows($user_data)<=0){
	
	echo "<tr align='center' ><td class='nores'>No Results Found</td></tr>";
}
				?>
			<?php
			
			while($row=mysqli_fetch_array($user_data)){

				echo "<tr id=".$row[0]." align='center'>
				<td class='edit-orgname col-xs-1'><a href='auditor_users.php?auditor=$row[0]'>".$row[1]."</a></td>";
				echo
				"<td class='edit-mail col-xs-2'>".$row[3]."</td>";
				echo "<input type='hidden' value='$row[1]' class='edit-uname$row[0]'/>";
				echo
				"<td class='edit-number col-xs-2'>".$row[4]."</td>";
				
						echo "<td class='col-xs-2'>	<a href='internal_users.php?auditor_id=$row[0]' class='btn btn-xs btnbg '>
							<span class='glyphicon glyphicon-briefcase'></span>
						</a></td>";
				if($row[9]=='1')
				echo "<td class='edit-pname col-xs-1'><input id='checkbox1' type='checkbox' checked='checked' value='".$row[9]."' onChange='setStatus(0,$row[0])'/></td>";
			else
				
				echo "<td class='edit-pname col-xs-1'><input id='checkbox1' class='$row[0]' type='checkbox' value='".$row[9]."'  onChange='setStatus(1,$row[0])'/></td>";
				echo
				"<td class='edit-date col-xs-2'>".date('d-m-Y', strtotime($row[8]))."</td>";
				
				
				echo"
				<td class='col-xs-1'>
						<a  data-toggle='modal' data-target='#myUserModal' class='edit_user btn btn-xs btnbg'>
							<span class='glyphicon glyphicon-edit'></span>
						</a>
					</td>
					<td class='col-xs-1'>
						<a id='$row[0]' class='btn btn-xs btnbg remove-item'>
							<span class='glyphicon glyphicon-trash'></span>
						</a>
					</td>
				
				</tr>";
			}
			
			?>
		</tbody>
	</table>*/
	$( document ).ready(function() {
	 $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").each(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
   });
	</script>
</body>
</html>
	 
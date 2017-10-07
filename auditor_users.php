<?php
include_once "conn.php";
include_once "header.php";

$user_sql = "SELECT * FROM `user_info` WHERE `created_by` = '".$_GET['auditor']."' ";
$user_data = mysqli_query($conn , $user_sql);


?>


<!--/Top navbars position-->
<!--page header-->
	
<!--page header-->

<div class="panel panel-flat panelflat newpanel">
<div class="table-responsive" >
	<table class="table table-fixed">
		<thead>
			<tr>
				
				<th  class="col-xs-2"> Name</th>
				<th  class="col-xs-2">Email</th>
				<th  class="col-xs-3">Phone Number</th>
				<th  class="col-xs-2">Status</th>				
				<th  class="col-xs-3">Date</th>
			</tr>
			
		</thead>
		<tbody>
			<?php
			
			while($row=mysqli_fetch_array($user_data)){

				echo "<tr id=".$row[0]." align='center'>
				<td class='edit-orgname col-xs-2'>".$row[1]."</a></td>";
				echo
				"<td class='edit-mail col-xs-2'>".$row[3]."</td>";
				echo "<input type='hidden' value='$row[1]' class='edit-uname$row[0]'/>";
				echo
				"<td class='edit-number col-xs-3'>".$row[4]."</td>";
				if($row[9]=='1')
				echo "<td class='edit-pname col-xs-2'><input id='checkbox1' type='checkbox' checked='checked' value='".$row[9]."' onChange='setStatus(0,$row[0])'/></td>";
			else
				
				echo "<td class='edit-pname col-xs-2'><input id='checkbox1' class='$row[0]' type='checkbox' value='".$row[9]."'  onChange='setStatus(1,$row[0])'/></td>";
				echo
				"<td class='edit-date col-xs-3'>".$row[8]."</td>";
				
				
				echo"
				
				
				</tr>";
			}
			
			?>
		</tbody>
	</table>
</div>
</div>

<!----EDIT MODAL--->
<input type="hidden" id="user_role" value="<?php echo $_SESSION['type']; ?>"/>



<?php
include_once "conn.php";
include_once "header.php";
$getcli="select GROUP_CONCAT(`user_info`.`userid`) as `userid` from user_info where created_by=".$_SESSION['user_id'];
	$getsql=mysqli_fetch_array(mysqli_query($conn,$getcli));

	$sql="select u.name,n.* from notifications n,user_info u where n.created_by IN(".$getsql[0].") and u.userid=n.created_by";

	$res=mysqli_query($conn,$sql);
	
?>
<div class="panel panel-flat panelflat newpanel">

<table class="table table-fixed">
		<thead>
			<tr>
				

				<th class="col-xs-9">Message</th>
				<th class="col-xs-3">Date</th>
			</tr>
		</thead>
		<tbody  id="myTable">
<?php
					while($row = mysqli_fetch_array($res)){
						
						?>


 <tr  align='center'>
 <?php echo '<td class="col-xs-9">'. $row['name'].' '.$row['message'].'</td>';
 echo '<td class="col-xs-3">'. $row['created_date'].'</td>';
 ?>
 </tr>
<?php }?></table>
</div>
</div>
</div>
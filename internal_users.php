<?php
include_once "conn.php";
include_once "header.php";
if($_GET['auditor_id'])
	$sql1 = "SELECT * FROM `user_info` where role_id='".AUTHOR."' and created_by=".$_GET['auditor_id'];
else
  $sql1 = "SELECT * FROM `user_info` where role_id='".AUTHOR."' and created_by=".$_SESSION['user_id'];

  $data1 = mysqli_query($conn, $sql1);
 
	if($data1)
	{
		$txt= '' ;
	}
	else
	{
		$txt= 'not moved'.mysqli_error($conn);
	}
  
?>
		<input type="hidden" id="roleid" value="<?php echo $_SESSION['role_id'];?>"/>
	  
<!-- Modal -->
<div id="myuserModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NEW ENTRY</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
			<div class="form-group">
				<input type="text" class ="form-control" id="name" name="name" Placeholder="Enter Employee Name">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="email" name="email" Placeholder="Enter Email Id">
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="password" name="password" Placeholder="Enter Password">
			</div>
		<div class="form-group">
				<input type="text" class ="form-control" id="pnumber" name="pnumber" Placeholder="Enter Phone Number">
			</div>
		<input type="button" value="submit" id="add-submit"  class="btn btn-md btnbg newbtn btn-primary">
	</form>
	</div>
	</div>
	<!----/modal Content--->
</div>
</div>
<!---modal--->

<!---internal_users table-->
<div class="panel panel-flat newpanel">
<div class="table-responsive pre-scrollable" style="min-height:506px">
			
 <div class="panel-heading">Users Information<div id="buttonplace" class="pull-right col-xs-6"></div></div>		
	<table class="table table-fixed">
		<thead>
			<tr>
				

				<th class="col-xs-2">Employee Name</th>
				<th class="col-xs-3">Email</th>
				<th class="col-xs-2">Phone Number</th>
				<th class="col-xs-1">Status</th>
				<th class="col-xs-2">Edit</th>
				<th class="col-xs-2">Delete</th>
			</tr>
		</thead>
		<tbody  id="myTable">	<?php if( mysqli_num_rows($data1)<=0){
	
	echo "<tr align='center' ><td class='nores'>No Results Found</td></tr>";
}
				?>
			<?php
				
				while($row = mysqli_fetch_array($data1)){
					echo "<tr  align='center' id=".$row[0].">
					<td class='col-xs-2 edit-name'>".$row[5]."</td>";
					echo
					"<td class='col-xs-3 edit-email'>".$row[3]."</td>";
					echo"
					<td class='col-xs-2 edit-pnumber'>".$row[4]."</td>";
					if($row[9]=='1')
				echo "<td class='edit-pname col-xs-1'><input id='checkbox1' type='checkbox' checked='checked' value='".$row[9]."' onChange='setStatus(0,$row[0])'/></td>";
			else
				
				echo "<td class='edit-pname col-xs-1'><input id='checkbox1' class='$row[0]' type='checkbox' value='".$row[9]."'  onChange='setStatus(1,$row[0])'/></td>";
					
				echo "
				<td class='col-xs-2'>
						<a  data-toggle='modal' data-target='#myInternalUserModal' class='edit_addUser btn btn-xs btnbg'>
							<span class='glyphicon glyphicon-edit'></span>
						</a>
					</td>
					<td class='col-xs-2'>
						<a id='$row[0]' class='btn btn-xs btnbg remove-item'>
							<span class='glyphicon glyphicon-trash'></span>
						</a>
					</td>
				
				</tr>";
				
				}
			
				?>
		</tbody>

	</table>
</div>
</div>
<!---internal_users table-->


<!-----EDIT MODAL---->

<!-- Modal -->
<div id="myInternalUserModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT ENTRY</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
		<input type="hidden" id="edit-id"/>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-name" name="name" Placeholder="Enter Employee Name">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="edit-email" name="email" Placeholder="Enter Email Id">
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-password" name="num" Placeholder="Enter Password">
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-pnumber" name="pnumber" Placeholder="Enter Phone Number">
			</div>
		<input type="submit" value="submit"  id="edit-submit" class="btn btn-md btnbg newbtn btn-primary">
	</form>
	</div>
	</div>
	<!----/modal Content--->
</div>
</div>
<!---modal--->
<?php include_once "footer.php";?>
<script>
$( document ).ready(function() {

	var roleid=$('#roleid').val();
	if(roleid!=1)
		$('#buttonplace').html('<i class="icon-user-plus position-left" data-toggle="modal" data-target="#myuserModal"></i>');
});
$("body").on("click","#edit-submit",function(e){
	e.preventDefault();
		var id=$('#edit-id').val();
		var name=$('#edit-name').val();
       var email= $('#edit-email').val();
		 var password=$('#edit-password').val();
        var pnumber=$('#edit-pnumber').val();
		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getInternalUserData.php',
        data:{id:id,name:name,email:email,password:password,pno:pnumber,type:'edit'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myUserModal').modal('hide');
		//location.reload();
       
    });
	
});
 $("body").on("click",".edit_addUser",function(){
       $tr = $(this).closest('tr');
	   var id=$tr.attr('id');
	   var name =  $('.edit-name', $tr).text();
	   var email = $('.edit-email' , $tr).text();
	   var password =  $('.edit-password', $tr).text();
	   var pno =  $('.edit-pnumber', $tr).text();
		$('#edit-id').val(id);
        $('#edit-name').val(name);
        $('#edit-email').val(email);
		 $('#edit-password').val(password);
		 $('#edit-pnumber').val(pno);
        });
	$("body").on("click","#add-submit",function(){
	var name=$('#name').val();
   var email= $('#email').val();
	 var password=$('#password').val();
	  var pno=$('#pnumber').val();
	$.ajax({
	dataType: 'json',
	type:'POST',
	url: url+'getInternalUserData.php',
	data:{name:name,email:email,password:password,pno:pno,type:'insert'}
}).done(function(data){       
	alert('Inserted Successfully.');
	$('#myUserModal').modal('hide');
	//location.reload();
   
});
	
});
$("body").on("click",".remove-item",function(){
    var id = $(this).attr('id');
    var c_obj = $(this).parent().parent();
	console.log(c_obj);
   var r = confirm("Are you sure you want to delete this?");
    if (r == true) {
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getInternalUserData.php',
        data:{id:id,type:'delete'}
    }).done(function(data){
        c_obj.remove();
        alert('Record Deleted Successfully.');
       
    });
 }

});
</script>


<?php
include_once "conn.php";
include_once "header.php";
if($_SESSION['role_id']==SUPERADMIN)
$user_sql = "SELECT * FROM `user_info` WHERE `created_by` = '".$_SESSION['role_id']."' ";
elseif($_SESSION['role_id']==AUDITOR)
$user_sql = "SELECT u.*,c.* FROM user_info u, client_info c WHERE u.userid= c.client_id and u.created_by = '".$_SESSION['user_id']."' ";
elseif($_SESSION['role_id']==AUTHOR)
$user_sql = "SELECT u.*,c.* FROM user_info u, client_info c WHERE u.userid= c.client_id and c.assigned_to = '".$_SESSION['user_id']."' ";

//echo $user_sql;exit;
$user_data = mysqli_query($conn , $user_sql);


?>


<!--/Top navbars position-->
<!--page header-->
	
<!--page header-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NEW ENTRY</h4>
      </div>
      <div class="modal-body">
        <form action ="" method="POST" id="clientinfo">
			            <div class="form-group  col-md-6">
						<input type = "text" class="form-control" id ="username" name="username" required placeholder = "Enter User Name">
						</div>
						<div class="form-group  col-md-6">
						<input type = "email" class="form-control" id ="email" name="email" required placeholder = "Enter Email">
						</div>
						<div class="form-group  col-md-6">
						<input type = "password" class="form-control" id ="password" name="password" required placeholder = "Enter Password">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="clientname" name="clientname" required placeholder = "Enter Client Name">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="number" pattern="\d*" required maxlength="10" name="phonenumber" placeholder = "Enter Phonenumber">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="tan" name="tan" required pattern="\d*" required maxlength="10" placeholder = "Enter Tan Number">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="city" name="city" required placeholder = "Enter City">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="area" name="area" required placeholder = "Enter Area">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="service_charges" name="service_charges" required placeholder = "Enter Service Charges">
						</div>
							<div class="form-group col-md-6">
				<?php
$select="select u.name,u.userid from user_info u where u.role_id='".AUTHOR."' and u.created_by='".$_SESSION['user_id']."'"; 
$sres = mysqli_query($conn, $select);
?>

<select class="form-control" name="assi" id="assi"/>
<option value="">Select Client</option>
<?php 
while($row=mysqli_fetch_array($sres))
{ ?>
<option value="<?php echo $row['userid']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
</select>
			</div>
						 <div class="clearfix"></div>
						<input type="submit" name="submit" value="submit" class="btn btn-md btnbg btn-success newbtn">

					</form>
</div>
</div>
	<!--/modal content-->
</div>
</div>
<!---modal-->
<div class="panel panel-flat panelflat newpanel">
 <div class="panel-heading">Clients Information<div id="buttonplace" class="pull-right col-xs-6"></div></div>
<div class="table-responsive" >
	<table class="table table-fixed">
		<thead>
			<tr class="col-xs-12">
				
				<th  class="col-xs-2">Client Name</th>
				<th  class="col-xs-1">Email Id</th>
				<th  class="col-xs-2">Phone Number</th>
				<th  class="col-xs-1">Tan</th>
				<th  class="col-xs-1">city</th>
				<th  class="col-xs-1">Status</th>				
				<th  class="col-xs-1">Date</th>
				<th  class="col-xs-1">Employees</th>
				<th class="col-xs-1">Edit</th>
				<th class="col-xs-1">Delete</th>
			</tr>
			
		</thead>
		<tbody>
			<?php
			
			while($row=mysqli_fetch_array($user_data)){
				echo "<tr  class='col-xs-12' id=".$row[0]." align='center'>
				<td class='edit-orgname col-xs-2'><a href='quarter_data.php?clientid=$row[0]'>".$row[14]."</a></td>";
				echo
				"<td class='edit-mail col-xs-1'>".$row[3]."</td>";
				echo "<input type='hidden' value='$row[1]' class='edit-uname$row[0]'/>";
					echo "<input type='hidden' value='$row[17]' class='edit-area$row[0]'/>";
					echo "<input type='hidden' value='$row[18]' class='edit-service$row[0]'/>";
					echo "<input type='hidden' value='$row[15]' class='edit-assign$row[0]'/>";
				echo
				"<td class='edit-number col-xs-2'>".$row[4]."</td>";
				echo
				"<td class='edit-tan col-xs-1'>".$row[13]."</td>";
				echo
				"<td class='edit-city col-xs-1'>".$row[16]."</td>";
				//echo
				//"<td class='edit-area col-xs-1'>".$row[16]."</td>";
				if($row[9]=='1')
				echo "<td class='edit-pname col-xs-1'><input id='checkbox1' type='checkbox' checked='checked' value='".$row[9]."' onChange='setStatus(0,$row[0])'/></td>";
			else
				
				echo "<td class='edit-pname col-xs-1'><input id='checkbox1' class='$row[0]' type='checkbox' value='".$row[9]."'  onChange='setStatus(1,$row[0])'/></td>";
				echo
				"<td class='edit-date col-xs-1'>".$row[8]."</td>";
				
				
				echo"
				<td class='col-xs-1'>
						<a href='client_employees.php?client_id=$row[0]' class='btn btn-xs btnbg '>
							<span class='glyphicon glyphicon-briefcase'></span>
						</a>
					</td>
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
	</table>
</div>
</div>

<!----EDIT MODAL--->
<input type="hidden" id="user_role" value="<?php echo $_SESSION['type']; ?>"/>
<!-- Modal -->
<div id="myUserModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT ENTRY</h4>
      </div>
      <div class="modal-body">
        <form action ="" method="POST">
		<input type="hidden" id="edit-id"/>
						 <div class="form-group  col-md-6">
						<input type = "text" class="form-control" id ="edit-uname" name="username" required placeholder = "Enter User Name">
						</div>
						<div class="form-group  col-md-6">
						<input type = "email" class="form-control" id ="edit-mail" name="email" required placeholder = "Enter Email">
						</div>
						<div class="form-group  col-md-6">
						<input type = "password" class="form-control" id ="edit-password" name="password" required placeholder = "Enter Password">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="edit-orgname" name="clientname" required placeholder = "Enter Client Name">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="edit-number" pattern="\d*" required maxlength="10" name="phonenumber" placeholder = "Enter Phonenumber">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="edit-tan" name="tan" required pattern="\d*" required maxlength="10" placeholder = "Enter Tan Number">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="edit-city" name="city" required placeholder = "Enter City">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="edit-area" name="area" required placeholder = "Enter Area">
						</div>
						<div class="form-group col-md-6">
						<input type = "text" class="form-control" id ="edit-service" name="service_charges" required placeholder = "Enter Service Charges">
						</div>
						<div class="form-group col-md-6">
				<?php
$select="select u.name,u.userid from user_info u where u.role_id='".AUTHOR."' and u.created_by='".$_SESSION['user_id']."'"; 
$sres = mysqli_query($conn, $select);
?>

<select class="form-control" name="edit-assi" id="edit-assi"/>
<option value="">Select Client</option>
<?php 
while($row=mysqli_fetch_array($sres))
{ ?>
<option value="<?php echo $row['userid']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
</select>
			</div>
						 <div class="clearfix"></div>
						
						<input type="button" name="submit" value="submit" id="edit-submit" class="btn btn-md btn-success btnbg newbtn">
						<input type="button" class="btn btn-md btn-default btnbg newbtn" name="cancel" value="Cancel" data-dismiss="modal">
            
					</form>
</div>
</div>
	<!--/modal content-->
</div>
</div>
<!---modal-->


<script>
$( document ).ready(function() {

	$('#buttonplace').html('<i class="icon-user-plus position-left" data-toggle="modal" data-target="#myModal"></i>');

});
 function setStatus(val,id){
		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getUserData.php',
        data:{id:id,val:val,type:'setstatus'}
    }).done(function(data){       
       
    });
 }
function checkMail(mailid,pno,uname){
	var msg=false;
$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientData.php',
       data:{type:'verify',email:mailid,username:uname,phone_no:pno},
		success: function(data) {
                console.log(data);  // this is currently returning FALSE
                                    // Which is totally correct!
                 if(data[0]=='success')
		    msg=true;
       else
		    msg=false;
		sessionStorage.cmsg = msg;


            }
    });
	var umsg=sessionStorage.getItem("cmsg")
	return umsg;
}
$( "#clientinfo" ).submit(function( event ) {
	
  event.preventDefault();
    var uname=$('#username').val();
       var mail= $('#email').val();
		 var password=$('#password').val();
       var name=$('#clientname').val();
       var number= $('#number').val();
		 var tan=$('#tan').val();
        var city=$('#city').val();
        var area=$('#area').val();
        var service_charges=$('#service_charges').val();
		var assign=$('#assi').val();
       var chkMail=checkMail(mail,number,uname);
		if(!chkMail){
		
		
		alert('Username/Email ID/Phone Number Already Exists');
		
		
		}else{
	
			$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientData.php',
        data:{assign:assign,email:mail,username:uname,password:password,clientname:name,phonenumber:number,tan:tan,city:city,area:area,service_charges:service_charges,type:'insert'}
    }).done(function(data){       
        alert('Record Inserted Successfully.');

		$('#myModal').modal('hide');
	

       });
}
	   });
$("body").on("click","#edit-submit",function(){
		var id=$('#edit-id').val();
		var uname=$('#edit-uname').val();
		var orgname=$('#edit-orgname').val();
       var mail= $('#edit-mail').val();
		 var password=$('#edit-password').val();
        var number=$('#edit-number').val();
		var tan=$('#edit-tan').val();
		var area=$('#edit-area').val();
		var service=$('#edit-service').val();
		var city=$('#edit-city').val();
		var assi=$('#edit-assi').val();

		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientData.php',
        data:{id:id,uname:uname,mail:mail,password:password,city:city,area:area,service:service,orgname:orgname,tan:tan,number:number,assign:assi,type:'update'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myUserModal').modal('hide');
		
       
    });
	
});
 $("body").on("click",".edit_user",function(){
       $tr = $(this).closest('tr');
	   
	   var id=$tr.attr('id');
	   var uname =  $('.edit-uname'+id).val();
	   var service= $('.edit-service'+id).val();
	   var assi=$('.edit-assign'+id).val();
	   var area= $('.edit-area'+id).val();
	   var mail = $('.edit-mail' , $tr).text();
	   var password =  $('.edit-password', $tr).text();
	   var name = $('.edit-orgname' , $tr).text();
	   var number =  $('.edit-number', $tr).text();
       var tan= $('.edit-tan', $tr).text();
	   var city= $('.edit-city', $tr).text();
		$('#edit-id').val(id);
        $('#edit-uname').val(uname);
        $('#edit-mail').val(mail);
        $('#edit-orgname').val(name);
		 $('#edit-number').val(number);
		 $('#edit-area').val(area);
		 $('#edit-city').val(city);
		 $('#edit-tan').val(tan);
		  $('#edit-service').val(service);
		//  $('#assi option[value='+assi+']').attr('selected','selected');
		$("#edit-assi").val(assi);
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
        url: url+'getClientData.php',
        data:{id:id,type:'delete'}
    }).done(function(data){
        c_obj.remove();
        alert('Record Deleted Successfully.');
       
    });
 }

});
</script>


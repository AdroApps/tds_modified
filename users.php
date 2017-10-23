<?php
include_once "conn.php";
include_once "header.php";
if($_SESSION['role_id']=='1')
$user_sql = "SELECT * FROM `user_info` WHERE `created_by` = '".$_SESSION['role_id']."' ";
else	
$user_sql = "SELECT * FROM `user_info` WHERE `created_by` = '".$_SESSION['user_id']."' ";
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
        <form action ="" method="POST" id="userinfo">
						<div class="form-group">
						<input type = "text" class="form-control" id ="username" name="username" required placeholder = "Enter User Name">
						</div>
						<div class="form-group">
						<input type = "email" class="form-control" id ="email" name="email" required placeholder = "Enter Email">
						</div>
						<div class="form-group">
						<input type = "password" class="form-control" id ="password" name="password" required placeholder = "Enter Password">
						</div>
						
						<div class="form-group">
						<input type = "text" class="form-control" id ="number" pattern="\d*" required maxlength="10" name="phonenumber" placeholder = "Enter Phonenumber">
						</div>
						<div class="form-group">
						<input type="text" class ="form-control" id="name" name="name" required Placeholder="Enter name">
						</div>
						
						<input type="submit" name="submit" value="submit" class="btn btn-md newbtn btnbg btn-success">

					</form>
</div>
</div>
	<!--/modal content-->
</div>
</div>
<!---modal-->
<div class="panel panel-flat panelflat newpanel">

 <div class="panel-heading">Users Information<div id="buttonplace" class="pull-right col-xs-6"></div></div>
<div class="table-responsive" >
	<table class="table table-fixed">
		<thead>
			<tr>
				
				<th  class="col-xs-2"> Name</th>
				<th  class="col-xs-2">Email</th>
				<th  class="col-xs-2">Phone Number</th>
				<th  class="col-xs-2">Status</th>				
				<th  class="col-xs-2">Date</th>
				<th class="col-xs-1">Edit</th>
				<th class="col-xs-1">Delete</th>
			</tr>
			
		</thead>
		<tbody>
		<?php if( mysqli_num_rows($user_data)<=0){
	
	echo "<tr align='center' ><td class='nores'>No Results Found</td></tr>";
}
				?>
			<?php
			
			while($row=mysqli_fetch_array($user_data)){

				echo "<tr id=".$row[0]." align='center'>
				<td class='edit-orgname col-xs-2'><a href='auditor_users.php?auditor=$row[0]'>".$row[1]."</a></td>";
				echo
				"<td class='edit-mail col-xs-2'>".$row[3]."</td>";
				echo "<input type='hidden' value='$row[1]' class='edit-uname$row[0]'/>";
				echo
				"<td class='edit-number col-xs-2'>".$row[4]."</td>";
				if($row[9]=='1')
				echo "<td class='edit-pname col-xs-2'><input id='checkbox1' type='checkbox' checked='checked' value='".$row[9]."' onChange='setStatus(0,$row[0])'/></td>";
			else
				
				echo "<td class='edit-pname col-xs-2'><input id='checkbox1' class='$row[0]' type='checkbox' value='".$row[9]."'  onChange='setStatus(1,$row[0])'/></td>";
				echo
				"<td class='edit-date col-xs-2'>".$row[8]."</td>";
				
				
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
						<div class="form-group">
						<input type = "text" class="form-control" id ="edit-uname" name="username" required placeholder = "Enter User Name">
						</div>
						<div class="form-group">
						<input type = "email" class="form-control" id ="edit-email" name="email" required placeholder = "Enter Email">
						</div>
						<div class="form-group">
						<input type = "password" class="form-control" id ="edit-password" name="password" required placeholder = "Enter Password">
						</div>
						
						<div class="form-group">
						<input type = "text" class="form-control" id ="edit-number" pattern="\d*" required maxlength="10" name="phonenumber" placeholder = "Enter Phonenumber">
						</div>
						<div class="form-group">
						<input type="text" class ="form-control" id="edit-pname" name="name" required Placeholder="Enter name">
						</div>
						
						<input type="button" name="submit" value="submit" id="edit-submit" class="btn btn-md btn-success newbtn btnbg">
						<input type="button" class="btn btn-md btn-default newbtn" name="cancel" value="Cancel" data-dismiss="modal">
            
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
        url: url+'getUserData.php',
        data:{type:'verify',email:mailid,username:uname,phone_no:pno},
		success: function(data) {
                console.log(data);  // this is currently returning FALSE
                                    // Which is totally correct!
                 if(data[0]=='success')
		    msg=true;
       else
		    msg=false;
		sessionStorage.msg = msg;


            }
    });
	var umsg=sessionStorage.getItem("msg")
	return umsg;
}
$( "#userinfo" ).submit(function( event ) {
	
  event.preventDefault();
  var name=$('#username').val();
       var mail= $('#email').val();
		 var password=$('#password').val();
        var pname=$('#name').val();
        var number=$('#number').val();
		
        var chkMail=checkMail(mail,number,name);

		if(!chkMail){
		
		
		alert('Username/Email ID/Phone Number Already Exists');
		
		
		}else{
	
			$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getUserData.php',
        data:{username:name,email:mail,password:password,name:pname,phonenumber:number,type:'insert'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myModal').modal('hide');
		location.reload();
	

       });
}
	   });
$("body").on("click","#edit-submit",function(){
		var id=$('#edit-id').val();
		var orgname=$('#edit-uname').val();
       var mail= $('#edit-email').val();
		 var password=$('#edit-password').val();
        var pname=$('#edit-pname').val();
        var number=$('#edit-number').val();
		

		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getUserData.php',
        data:{id:id,uname:orgname,mail:mail,password:password,pname:pname,number:number,type:'update'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myUserModal').modal('hide');
		location.reload();
       
    });
	
});
 $("body").on("click",".edit_user",function(){
       $tr = $(this).closest('tr');
	   
	   var id=$tr.attr('id');
	   var uname =  $('.edit-uname'+id).val();
	   var mail = $('.edit-mail' , $tr).text();
	   var password =  $('.edit-password', $tr).text();
	   var name = $('.edit-orgname' , $tr).text();
	   var number =  $('.edit-number', $tr).text();

		$('#edit-id').val(id);
        $('#edit-uname').val(uname);
        $('#edit-email').val(mail);
        $('#edit-pname').val(name);
		 $('#edit-number').val(number);
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
        url: url+'getUserData.php',
        data:{id:id,type:'delete'}
    }).done(function(data){
        c_obj.remove();
        alert('Record Deleted Successfully.');
       
    });
 }

});
</script>


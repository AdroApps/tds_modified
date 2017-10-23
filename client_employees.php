<?php
include_once "conn.php";
include_once "header.php";
if($_SESSION['role_id']==CLIENT)
	$sql1 = "SELECT * FROM `client_employees` WHERE client_id='".$_SESSION['user_id']."' ORDER BY emp_id DESC ";
else
$sql1 = "SELECT * FROM `client_employees` WHERE client_id='".$_GET['client_id']."' ORDER BY emp_id DESC ";

 $data1 = mysqli_query($conn, $sql1);

?>

	<input type="hidden" id="clientid" value="<?php echo $_GET['client_id']; ?>"/>

		<input type="hidden" id="roleid" value="<?php echo $_SESSION['role_id']; ?>"/>
<div class="panel panel-flat panelflat newpanel">
 <div class="panel-heading">Employee Information<div id="buttonplace" class="pull-right col-xs-6"></div>
 </div>
<div class="table-responsive" >
	<table class="table table-fixed">
		<thead>
			<tr>
<?php if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR){?>
				<th  class="col-xs-2">Employee Name</th>
				<th  class="col-xs-2">Pan Number</th>
				<th  class="col-xs-3">Adhar Number</th>				
				<th  class="col-xs-2">Status</th>
				<th  class="col-xs-3">Date</th>
<?php }else{?>
	             <th  class="col-xs-2">Employee Name</th>
				<th  class="col-xs-2">Pan Number</th>
				<th  class="col-xs-2">Adhar Number</th>				
				<th  class="col-xs-2">Status</th>
				<th  class="col-xs-2">Date</th>
				<th  class="col-xs-1">Edit</th>
				<th  class="col-xs-1">Delete</th>
	<?php }?>
			</tr>
		</thead>
	
		<tbody>
			<?php
					while($row = mysqli_fetch_array($data1)){
						
					
					if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR){
						echo "<tr style='min-height:45px;' id=".$row[0]." align='center'>";
					echo "<td class='edit-name col-xs-2'>".$row[4]."</td>";
					echo "<td  class='edit-panno col-xs-2'>".$row[2]."</td>";
					
					echo
					"<td class='edit-addhar col-xs-3'>".$row[3]."</td>";
					if($row[5]=='1')
			        	echo "<td class='edit-pname col-xs-2'><input id='checkbox1'  type='checkbox' checked='checked' value='".$row[5]."' onChange='setStatus(0,$row[0])'/></td>";
			        else 				
			         	echo "<td class='edit-pname col-xs-2'><input id='checkbox1'  class='$row[0]' type='checkbox' value='".$row[5]."'  onChange='setStatus(1,$row[0])'/></td>";
					echo
					"<td class='edit-date col-xs-3'>".$row[6]."</td></tr>";
					}
					
					else{
							
					echo "<tr id=".$row[0]." align='center'>";
						echo "<td class='edit-name col-xs-2'>".$row[4]."</td>";
					echo "<td  class='edit-panno col-xs-2'>".$row[2]."</td>";
					
					echo
					"<td class='edit-addhar col-xs-2'>".$row[3]."</td>";
					if($row[5]=='1')
			        	echo "<td class='edit-pname col-xs-2'><input id='checkbox1'  type='checkbox' checked='checked' value='".$row[5]."' onChange='setStatus(0,$row[0])'/></td>";
			        else 				
			         	echo "<td class='edit-pname col-xs-2'><input id='checkbox1'  class='$row[0]' type='checkbox' value='".$row[5]."'  onChange='setStatus(1,$row[0])'/></td>";
					echo
					"<td class='edit-date col-xs-2'>".$row[6]."</td>";
					echo"
					 <td class=' col-xs-1 $style'>
						<a data-toggle='modal' data-target='#myEmployeeModal' class='edit_addemployee btn btn-xs btnbg'>
							<span class='glyphicon glyphicon-edit'></span>
						</a>
					</td>
					<td class='col-xs-1'>
						<a id='$row[0]' class='btn btn-xs btnbg remove-item  $style'>
							<span class='glyphicon glyphicon-trash'></span>
						</a>
					</td>
					 </tr>";
					}
				
				}
			
				?>
		</tbody>

	</table>
</div>
</div>
<!--/Client Table-->
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
        <form action="" method="POST" id="client_employees">
			<div class="form-group">
				<input type="text" class ="form-control" id="panno" name="panno" maxlength="10" Placeholder="Enter Pan Number" required>
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="addhar" name="addhar"  maxlength="16" Placeholder="Enter Adhar Number" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="ename" name="ename" Placeholder="Enter Employee FullName" required>
			</div>
			
			
		<input type="submit" name="submit" value="submit"  class="btnbg btn btn-md btn-primary newbtn">
	</form>
	</div>
	</div>
	<!----/modal Content--->
</div>
</div>
<!---modal--->

<!-----EDIT MODAL---->

<!-- Modal -->
<div id="myEmployeeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT ENTRY</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="export">
		<input type="hidden" id="edit-id"/>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-panno" name="panno" maxlength="10" Placeholder="Enter Pan Number">
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-addhar" name="addhar" maxlength="12" Placeholder="Enter Adhar Number">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="edit-name" name="ename" Placeholder="Enter Employee FullName">
			</div>
			
			
		<input type="button" value="submit"  id="edit-submit" class="btn btn-md btn-primary btnbg newbtn">
	</form>
	</div>
	</div>
	<!----/modal Content--->
</div>
</div>
<!---modal--->

<script>

$( document ).ready(function() {
var cid=$('#clientid').val();
    var roleid=$('#roleid').val();
	if(roleid==3)	{	
	$('#buttonplace').html('<form action="" method="post" id="file-upload" name="file-upload" enctype="multipart/form-data"><input type="file" id="file" name="file_url" style="height:0;width:0;"/> </form> <i class="icon-user-plus position-left" data-toggle="modal" data-target="#myModal"></i> <i id="upload" class="icon-folder-upload position-left" ></i>');
	document.getElementById('file-upload').onchange = function () {
upload();
};}
else{
$('#buttonplace').html('<form action="'+url+'ClientEmployeeExport.php?client_id='+cid+'"  id="export" method="post" name="export_excel"><div class="control-group"><div class="controls"><button style="margin-top: -8px;" type="submit"  name="export" class="btn btn-primary button-loading newbtn" data-loading-text="Loading..."><i  class="icon-download position-left" ></i></button>	</div>	</div></form>');
}
 $("#upload").click(function(){
   $('#file').click();
 });
  $('#file').change(function() {
  $('#file-upload').submit();
});

});

function chkDetails(name,panno,addhar,id){
	var msg=false;
	
	
	 $.post(url+'getClientEmployeeData.php',
    {
       type:'verify',name:name,panno:panno,addhar:addhar,id:id
    },
    function(data, status){
       console.log(data);
	   console.log(status);
	    if(data[0]=='success')
		    msg=true;
       else
		    msg=false;
		sessionStorage.cmsg = msg;
    });
	
	var umsg=sessionStorage.getItem("cmsg")
	return umsg;
}
$( "#client_employees" ).submit(function( event ) {
event.preventDefault();
		var name= $('#ename').val();
		var panno=$('#panno').val();
		 var addhar=$('#addhar').val();
		 var chkStatus=chkDetails(name,panno,addhar);
		 console.log('ckjj'+chkStatus);
if(panno.length<10){
	alert('Invalid Pan card Number');
}
else if(addhar.length<12){
	alert('Invalid Aadhar Number');
}
else if(!chkStatus){
alert('Pan/Aadhar/Name already exits');
}
else{
	$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientEmployeeData.php',
        data:{panno:panno,addhar:addhar,name:name,type:'insert'}
    }).done(function(data){       
        alert('Record Added Successfully.');
		$('#myEmployeeModal').modal('hide');
    });

}	
});

$("body").on("click","#edit-submit",function(){

		var id=$('#edit-id').val();
		var name= $('#edit-name').val();
		var panno=$('#edit-panno').val();
		 var addhar=$('#edit-addhar').val();
		 var chkStatus=chkDetails(name,panno,addhar,id);
if(panno.length<10){
	alert('Invalid Pan card Number');
}
else if(addhar.length<12){
	alert('Invalid Aadhar Number');
}
else if(!chkStatus){
	alert('Pan/Aadhar/Name already exits');
}
else{
	$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientEmployeeData.php',
        data:{id:id,panno:panno,addhar:addhar,name:name,type:'update'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myEmployeeModal').modal('hide');

    });

}	
});
 $("body").on("click",".edit_addemployee",function(){
      var $tr = $(this).closest('tr');
	   
	  console.log($('.edit-name' , $tr).text());
	  console.log($('.edit-name' , $tr).html());
	   var id=$tr.attr('id');
	   var name = $('.edit-name' , $tr).text();
	  // console.log(name);
	   var panno =  $('.edit-panno', $tr).text();
	   var addhar =  $('.edit-addhar', $tr).text();
	   
		$('#edit-id').val(id);
        $('#edit-panno').val(panno);
        $('#edit-name').val(name);
		$('#edit-addhar').val(addhar);
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
        url: url+'getClientEmployeeData.php',
        data:{id:id,type:'delete'}
    }).done(function(data){
        c_obj.remove();
        alert('Record Deleted Successfully.');
       
    });
 }

});
 $('#file-upload').submit( function(e) {
    e.preventDefault();

    var data = new FormData(this); // <-- 'this' is your form element
    
		$.ajax({
        type:'POST',
        url: url+'getClientData.php?type=import',        
		data: data,
            cache: false,
            contentType: false,
            processData: false,
      }).done(function(data){       
        alert('Data uploaded Successfully.');

    });

	});
	function upload() {
    var upload = document.getElementById('file');
	console.log(upload);
    var image = upload.files[0];
    $.ajax({
url: url+'getClientData.php?type=import',   
      type: "POST",
      data: new FormData($('#file-upload')[0]),
      contentType:false,
      cache: false,
      processData:false,
      success:function (msg) {
		  
		 alert('File uploaded Successfully.');
	  }
      });
};

</script>
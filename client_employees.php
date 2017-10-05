<?php
include_once "conn.php";
include_once "header.php";
?>

	

<div class="panel panel-flat panelflat newpanel">
<div class="table-responsive" >
	<table class="table table-fixed">
		<thead>
			<tr>
				

				<th  class="col-xs-2">Employee Name</th>
				<th  class="col-xs-2">Pan Number</th>
				<th  class="col-xs-2">Adhar Number</th>
				<th  class="col-xs-2">Date</th>
				<th  class="col-xs-2">Edit</th>
				<th  class="col-xs-2">Delete</th>
				
			</tr>
		</thead>
		</table>	
		<tbody>
			<?php
				$sql1 = "SELECT * FROM `client_employees` WHERE client_id='".$_SESSION['user_id']."' ORDER BY emp_id DESC ";
  $data1 = mysqli_query($conn, $sql1);
 
	if($data1)
	{
		echo '' ;
	}
	else
	{
		echo 'not moved'.mysqli_error($conn);
	}
				while($row = mysqli_fetch_array($data1)){
					
					echo "<tr id=".$row[0]." align='center'>
					<td  class='edit-pan col-xs-2'>".$row[3]."</td>";
					echo
					"<td class='edit-adhar col-xs-2'>".$row[4]."</td>";
					echo
					"<td class='edit-name col-xs-2'>".$row[5]."</td>";
					echo
					"<td class='edit-date col-xs-2'>".$row[6]."</td>";
					
					echo"
					 <td col-xs-2'>
						<a data-toggle='modal' data-target='#myEmployeeModal' class='edit_addemployee btn btn-xs btnbg'>
							<span class='glyphicon glyphicon-edit'></span>
						</a>
					</td>
					<td col-xs-2'>
						<a id='$row[0]' class='btn btn-xs btnbg'>
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
				<input type="text" class ="form-control" id="pan" name="pan" maxlength="10" Placeholder="Enter Pan Number">
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="adhar" name="adhar"  maxlength="16" Placeholder="Enter Adhar Number">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="name" name="ename" Placeholder="Enter Employee FullName">
			</div>
			
			
		<input type="button" name="submit" value="submit"  class="btnbg btn btn-md btn-primary newbtn">
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
        <form action="" method="POST">
		<input type="hidden" id="edit-id"/>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-pan" name="pan" Placeholder="Enter Pan Number">
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-adhar" name="adhar" Placeholder="Enter Adhar Number">
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
	$('#buttonplace').html('<button type="New" class="btn btn-xs btncls btn-default" data-toggle="modal" data-target="#myModal">New Employee</button>');
    console.log( "ready!" );
});
$( "#client_employees" ).submit(function( event ) {
	
  event.preventDefault();

	var name= $('#ename').val();
		var pan=$('#pan').val();
		 var adhar=$('#adhar').val();
		var reg = /[^A-Za-z0-9]/;		
if(number.length!=10 || reg.test(number)){
	alert('Invalid Pan card Number');
}

else if(adhar.length!=16){
	alert('Invalid Aadhar Number');
}
else{
		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientEmployeeData.php',
        data:{pan:pan,adhar:adhar,ename:name,type:'insert'}
    }).done(function(data){       
        alert('Record Inserted Successfully.');
		$('#myModal').modal('hide');
        location.reload();
    });
}
});
$("body").on("click","#edit-submit",function(){

		var id=$('#edit-id').val();
		var name= $('#edit-name').val();
		var pan=$('#edit-pan').val();
		 var adhar=$('#edit-adhar').val();
if(number.length<10){
	alert('Invalid Pan card Number');
}
else if(adhar.length<16){
	alert('Invalid Aadhar Number');
}
else{
	$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getClientEmployeeData.php',
        data:{id:id,pan:pan,adhar:adhar,name:name,type:'update'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myEmployeeModal').modal('hide');
        location.reload();
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
	   var pan =  $('.edit-pan', $tr).text();
	   var adhar =  $('.edit-adhar', $tr).text();
	   
		$('#edit-id').val(id);
        $('#edit-pan').val(pan);
        $('#edit-name').val(name);
		$('#edit-adhar').val(adhar);
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
        data:{id:id}
    }).done(function(data){
        c_obj.remove();
        alert('Record Deleted Successfully.');
       
    });
 }

});
</script>
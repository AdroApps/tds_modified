<!--client table-->

<?php
include_once "conn.php";
include_once "header.php";
if(isset($_GET['clientid']))
	$client_id=$_GET['clientid'];

else	
	$client_id=$_SESSION['user_id'];

$sql1 = "SELECT c.*,q.* FROM `quarter_info` q, `client_info` c WHERE c.client_id=q.client_id and c.client_id='".$client_id."' ORDER BY q.quarter_id DESC ";
$data1 = mysqli_query($conn, $sql1);
$service="SELECT service_charges from client_info where client_id=".$client_id;
$sdata=mysqli_fetch_assoc (mysqli_query($conn, $service));
$service_charge=$sdata['service_charges'];
if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR)
	$style='none';
else
	$style='block';
?>
<!--Client Table-->
<div class="panel panel-flat panelflat newpanel">
 <div class="panel-heading">Quarter Information<div id="buttonplace" style="display:<?php echo $style;?>" class="pull-right col-xs-6"></div>
 </div>
<div class="table-responsive" >
	<table class="table table-fixed">
	<thead>
	        <tr>
			<?php if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR){?>
				<th class="col-xs-2">Organisation Name</th>					
				<th class="col-xs-2">Tan</th>
				<th class="col-xs-2">Financial Year</th>
				<th class="col-xs-1">Quarter</th>
				<th class="col-xs-1">Authorised</th>
				<th class="col-xs-2">Status</th>
				<th class="col-xs-2">Date</th>
			<?php }else{?>
			<th class="col-xs-2">Organisation Name</th>					
				<th class="col-xs-1">Tan</th>
				<th class="col-xs-2">Financial Year</th>
				<th class="col-xs-1">Quarter</th>
				<th class="col-xs-1">Authorised</th>
				<th class="col-xs-1">Status</th>
				<th class="col-xs-2">Date</th>
				<th class="col-xs-1">Edit</th>
				<th class="col-xs-1">Delete</th>
			<?php }?>
			</tr>	
<?php if( mysqli_num_rows($data1)<=0){
	
	echo "<tr align='center'><td  class='nores'>No Results Found</td></tr>";
}
				?><tbody>
			
			<?php	while($row = mysqli_fetch_array($data1)){
					echo "<tr style='min-height: 45px;' align='center' id=".$row[10].">";
					if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR){
						echo "<td data-th='Organisation Name' class='edit-orgname col-xs-2'><a href='tds_data.php?qid=$row[10]'>".$row[4]."</a></td>
					<td  data-th='Tan' class='edit-tan col-xs-2'>".$row[3]."</td>
					<td  data-th='Financial Year' class='edit-year col-xs-2'>".$row[12]."</td>
					";
					echo
					"<td  data-th='Quarter' class='edit-quarter col-xs-1'>".$row[13]."</td>
					<td  data-th='Authorised' class='edit-apname col-xs-1'>".$row[14]."</td>";
					echo
					"<td  data-th='Status' class='edit-status col-xs-2'>".$row[15]."</td>";
					echo
					"<td  data-th='Date' class='edit-date col-xs-2'>".date('d-m-Y', strtotime($row[17]))."</td>";
									
					}
					else{
					echo "<td  data-th='Organisation Name' class='edit-orgname col-xs-2'><a href='tds_data.php?qid=$row[10]'>".$row[4]."</a></td>
					<td  data-th='Tan' class='edit-tan col-xs-1'>".$row[3]."</td>
					<td  data-th='Financial Year' class='edit-year col-xs-2'>".$row[12]."</td>
					";
					echo
					"<td data-th='Quarter' class='edit-quarter col-xs-1'>".$row[13]."</td>
					<td  data-th='Authorised' class='edit-apname col-xs-1'>".$row[14]."</td>";
					echo
					"<td data-th='Status' class='edit-status col-xs-1'>".$row[15]."</td>";
					echo
					"<td data-th='Date' class='edit-date col-xs-2'>".date('d-m-Y', strtotime($row[17]))."</td>";
					
					
						
					echo"
					<td data-th='Edit' class='col-xs-1'>
						<a  data-toggle='modal' data-target='#myEditModal' class='edit_category btn btn-xs btnbg'>
							<span class='glyphicon glyphicon-edit'></span>
						</a>
					</td>
					<td data-th='Delete' class='col-xs-1'>
						<a id='$row[10]' class='btn btn-xs btnbg remove-item'>
							<span class='glyphicon glyphicon-trash'></span>
						</a>
					</td>";
					}
					 echo "</tr>";
					
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
        <form action="" method="POST" id="quarterdata">
			<div class="form-group ">
				<select id="year" name="year" class="form-control" required>
					<option>Select Financial Year</option>
					<option>2017-2018</option>
					<option>2018-2019</option>
					<option>2019-2020</option>
					<option>2020-2021</option>
					<option>2021-2022</option>
					<option>2022-2023</option>
					<option>2023-2024</option>
					<option>2024-2025</option>
					<option>2025-2026</option>
					<option>2026-2027</option>
					<option>2027-2028</option>
					<option>2028-2029</option>
					<option>2029-2030</option>
				</select>
			</div>
			<div class="form-group ">
				<select  id="quarter" name="quarter" class="form-control" required>
					<option>Select Quarter</option>
					<option>Q1</option>
					<option>Q2</option>
					<option>Q3</option>
					<option>Q4</option>
				</select>
			</div>
			<div class="form-group ">				
				<input type="text" id="apname"   class="form-control" name="autpname" placeholder="Authorised Name"/>
			</div>
			<div class="form-group">
				<input type="text" id="service"  class="form-control" name="service" placeholder="Service Charge" readonly value="<?php echo $service_charge;?>"/>
			</div>
			<input type="submit" name="submit" value="submit" class="btn btn-md btn-primary btnbg newbtn">
			
			<input type="button" class="btn btn-md btn-default btnbg newbtn" name="cancel" value="Cancel" data-dismiss="modal">
		</form>
</div>
	<!--/modal content-->
</div>
</div>
</div>

<!---Edit Modal-->
<!-- Modal -->
<div id="myEditModal" class="modal fade" role="dialog">
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
			<div class="form-group col-md-6">
				<select id="edit-year" name="year" class="form-control"required>
					<option>Select Financial Year</option>
					<option>2017-2018</option>
					<option>2018-2019</option>
					<option>2019-2020</option>
					<option>2020-2021</option>
					<option>2021-2022</option>
					<option>2022-2023</option>
					<option>2023-2024</option>
					<option>2024-2025</option>
					<option>2025-2026</option>
					<option>2026-2027</option>
					<option>2027-2028</option>
					<option>2028-2029</option>
					<option>2029-2030</option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<select  id="edit-quarter" name="quarter" class="form-control">
					<option>--------Quarter---------</option>
					<option>Q1</option>
					<option>Q2</option>
					<option>Q3</option>
					<option>Q4</option>
				</select>
			</div>
			<div class="form-group ">				
				<input type="text" id="edit-apname"   class="form-control" name="autpname" placeholder="Authorised Name"/>
			</div>
			<div class="form-group">
				<input type="text" id="edit-service"  class="form-control" name="service" placeholder="Service Charge" readonly value="<?php echo $service_charge;?>"/>
			</div>
			<input type="button" name="submit" value="submit" id="edit-submit" class="btn btn-md btn-primary btnbg newbtn">
			
			<input type="button" class="btn btn-md btn-default btnbg newbtn" name="cancel" value="Cancel" data-dismiss="modal">
             </div> 
			
		</form>
</div>

	<!--/modal content-->
	
</div>
</div>
</div>

<script>

						
$( document ).ready(function() {
	$('#buttonplace').html(' <i class="icon-folder-plus position-left"  data-toggle="modal" data-target="#myModal"></i>');
    console.log( "ready!" );
});
function chkDetails(year,quarter){
	var msg=false;
	
	
	 $.post(url+'getQuarterData.php',
    {
       type:'verify',year:year,quarter:quarter
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
$( "#quarterdata" ).submit(function( event ) {
	
  event.preventDefault();
    var year=$('#year').val();
       var quarter= $('#quarter').val();
	var apname=$('#apname').val();	
	var service=$('#service').val();
	
	var checkQuarter=chkDetails(year,quarter);
	if(!checkQuarter){
		alert('Same Quarter and Same Year Info already exists');
	}else{	$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getQuarterData.php',
        data:{apname:apname,service:service,year:year,quarter:quarter,type:'insert'}
    }).done(function(data){       
        alert('Record Inserted Successfully.');
		$('#myModal').modal('hide');
		location.reload();
	});
	}

	   });
$("body").on("click","#edit-submit",function(){ 
		var year=$('#edit-year').val();
       var quarter= $('#edit-quarter').val();
	   var service=$('#edit-service').val();
       var apname= $('#edit-apname').val();
		 var id=$('#edit-id').val();
		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getQuarterData.php',
        data:{id:id,apname:apname,service:service,quarter:quarter,year:year,type:'update'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myEditModal').modal('hide');
		location.reload();
       
    });
	
});
 $("body").on("click",".edit_category",function(){
       $tr = $(this).closest('tr');
	   var id=$tr.attr('id');
	   var year =  $('.edit-year', $tr).text();
	   var quarter =  $('.edit-quarter', $tr).text();
	   var apname =  $('.edit-apname', $tr).text();
		$('#edit-id').val(id);
        $('#edit-year').val(year);
        $('#edit-quarter').val(quarter);		
        $('#edit-apname').val(apname);
		
	  });
$("body").on("click",".remove-item",function(){
    var id = $(this).attr('id');
    var c_obj = $(this).parent().parent();
	console.log(c_obj);
   var r = confirm("Are you sure you want to delete this. Deleting this will remove tds information for this quarter?");
    if (r == true) {
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getQuarterData.php',
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
        url: url+'import_data_tds.php',        
		data: data,
            cache: false,
            contentType: false,
            processData: false,
      }).done(function(data){       
        alert('Data uploaded Successfully.');
		location.reload();
    });

	});

</script>
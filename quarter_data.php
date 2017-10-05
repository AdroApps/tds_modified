<!--client table-->

<?php
include_once "conn.php";
include_once "header.php";
$id = $_SESSION['id'];



if(isset($_POST['submit'])) {
	$qsql = "SELECT * FROM `clienttable` WHERE `quarter`='".$_POST['quarter']."'  and year='".$_POST['year']."' and organization='".$_SESSION['org']."'";
    $qdata= mysqli_query($conn , $qsql);
if( mysqli_num_rows($qdata)<=0){
	
	$organization = $_POST['organization'];
	$tan = $_POST['tan'];
	$year = $_POST['year'];
	$quarter = $_POST['quarter'];
	$status = $_POST['status'];
	$pname= $_POST['personname'];
	$mail = $_POST['email'];
	$number = $_POST['phonenumber'];
	$service = $_POST['service'];
	$date = date("Y/m/d");
	$sql = "INSERT INTO `clienttable`(`organization` , `tan` , `year` , `quarter` , `status` ,
	  `pname` , `email` , `number` , `service` ,`date`) VALUES ('".$organization."' , '".$tan."' ,
	   '".$year."' , '".$quarter."' , '".$status."' , '".$pname."' , '".$mail."' , '".$number."' ,
	    '".$service."' , '".$date."' )";
	
	$data = mysqli_query($conn,$sql);
	
	if($data)  {
		
	header('location :clienttable.php') ;
	}	
	else {
		echo "not moved".mysqli_error($conn);
	}
}
else{
echo '<script language="javascript">';
echo 'alert("Same year and same Quarter Information Exists")';
echo '</script>';

}
}

$sql2 = "SELECT * FROM `usercreate` WHERE `email` = '".$_SESSION['e']."' ";
$data2 = mysqli_query($conn , $sql2);

$sql1 = "SELECT * FROM `clienttable` WHERE `email`='".$_SESSION['e']."' ";

$data1 = mysqli_query($conn,$sql1);

	while($row = mysqli_fetch_assoc($data2)) {
		$organization  = $row['organization'];
		$mail = $row['email'];
		$password = $row['password'];
		$pname = $row['pname'];
		$number  = $row['number'];
		$tan = $row['tan'];
		$city = $row['city'];
		$area = $row['area'];
		$service = $row['service'];
}
?>

<!--page header-->
	
<!--page header-->
<!--Client Table-->
<div class="panel panel-flat panelflat newpanel">
<div class="table-responsive pre-scrollable " style="min-height:506px;" >
     
 <table class="table table-hover table-condensed" id="target">
	<tr>
				
				<th width="14%">Organization Name</th>
				<th width="7%">Tan</th>
				<th width="11%">Financial Year</th>
				<th width="8%">Quarter</th>
				<th width="7%">Status</th>
				<th width="16%">Authorised Person Name</th>
				<th width="15%">Email</th>
				<th width="9%">PhoneNumber</th>
				<th width="10%">Date</th>
				<th width="5%">Edit</th>
				<th width="5%">Delete</th>
			</tr>	
<?php if( mysqli_num_rows($data1)<=0){
	
	echo "<tr align='center' class='nores'><td >No Results Found<td></tr>";
}
				?><tbody>
			
			<?php	while($row = mysqli_fetch_array($data1)){
				
					echo "<tr align='center' id=".$row[0].">
					
					<td width='17%' class='edit-org'><a href='clientdetails.php?clientdetails=$row[0]'>".$row[1]."</a></td>";
					echo
					"<td width='10%' class='edit-tan'>".$row[2]."</td>";
					echo
					"<td width='13%' class='edit-year'>".$row[3]."</td>";
					echo
					"<td width='8%' class='edit-quarter'>".$row[4]."</td>";
					echo
					"<td width='12%'>".$row[5]."</td>";
					echo
					"<td width='12%' class='edit-pname'>".$row[6]."</td>";
					echo
					"<td width='15%' class='edit-mail'>".$row[7]."</td>";
					echo
					"<td width='9%' class='edit-number'>".$row[8]."</td>";
					echo
					"<td width='10%'>".$row[9]."</td>";
					echo"
					<td width='5%'>
						<a  data-toggle='modal' data-target='#myEditModal' class='edit_category btn btn-xs btnbg'>
							<span class='glyphicon glyphicon-edit'></span>
						</a>
					</td>
					<td width='5%'>
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
        <form action="" method="POST">

		<div class="form-group">
				<input type="text" class="form-control" id="org" name="organization" value = "<?php echo $organization; ?>" Placeholder="Enter Organization Name" required>
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="tan" name="tan" value = "<?php echo $tan; ?>"  Placeholder="Enter Tan" required>
			</div>
			<div class="form-group">
				<select id="year" name="year" class="form-control" required>
					<option>Select Financial Year</option>
					<option>2017-2018</option>
					<option>2016-2017</option>
					<option>2015-2016</option>
					<option>2014-2015</option>
				</select>
			</div>
			<div class="form-group">
				<select  id="quarter" name="quarter" class="form-control" required>
					<option>Select Quarter</option>
					<option>Q1</option>
					<option>Q2</option>
					<option>Q3</option>
					<option>Q4</option>
				</select>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="pname" name="personname" value="<?php echo $pname;?>" Placeholder="Enter Authorised Person Name" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="mail" name="email" value="<?php echo $mail;?>" Placeholder="Enter Your Email" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="number" name="phonenumber" value="<?php echo $number;?>" Placeholder="Enter Your Phonenumber" required>
			</div>
			<div class="form-group">
				<input type="number" class="form-control" id="service" name="service" value="<?php echo $service;?>" Placeholder="Enter Service Charges" required>
			</div>
			<div class="form-group">
			<input type="submit" name="submit" value="submit" class="btn btn-md btn-primary btnbg">
			
			<input type="button" class="btn btn-md btn-default btnbg" name="cancel" value="Cancel" data-dismiss="modal">
             </div> 
			<div class="form-group">
			</div>
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
		<div class="form-group">
				<input type="text" class="form-control" id="edit-org" name="organization" value = "<?php echo $organization; ?>" Placeholder="Enter Organization Name" required>
			</div>
			<div class="form-group">
				<input type="text" class ="form-control" id="edit-tan" name="tan"  Placeholder="Enter Tan" required>
			</div>
			<div class="form-group">
				<select id="edit-year" name="year" class="form-control"required>
					<option>----Financial Year----</option>
					<option>2017-2018</option>
					<option>2016-2017</option>
					<option>2015-2016</option>
					<option>2014-2015</option>
				</select>
			</div>
			<div class="form-group">
				<select  id="edit-quarter" name="quarter" class="form-control">
					<option>--------Quarter---------</option>
					<option>Q1</option>
					<option>Q2</option>
					<option>Q3</option>
					<option>Q4</option>
				</select>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="edit-pname" name="personname" value="<?php echo $pname;?>" Placeholder="Enter Authorised Person Name" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="edit-mail" name="email" value="<?php echo $mail;?>" Placeholder="Enter Your Email" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="edit-number" name="phonenumber" value="<?php echo $number;?>" Placeholder="Enter Your Phonenumber" maxlength="10" required>
			</div>
			<div class="form-group">
			<input type="button" name="submit" value="submit" id="edit-submit" class="btn btn-md btn-primary btnbg">
			
			<input type="button" class="btn btn-md btn-default btnbg" name="cancel" value="Cancel" data-dismiss="modal">
             </div> 
			<div class="form-group">
			</div>
		</form>
</div>

	<!--/modal content-->
	
</div>
</div>
</div>

<script>

						
$( document ).ready(function() {
	$('#buttonplace').html('<button type="New" class="btn btn-xs btncls  btn-default" data-toggle="modal" data-target="#myModal">New</button>');
    console.log( "ready!" );
});
$("body").on("click","#edit-submit",function(){ 
		var year=$('#edit-year').val();
       var number= $('#edit-number').val();
		 var mail=$('#edit-mail').val();
        var pname=$('#edit-pname').val();
		var id=$('#edit-id').val();
        var tan=$('#edit-tan').val();
		
        var quarter=$('#edit-quarter').val();

		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'cedit.php',
        data:{id:id,pname:pname,tan:tan,quarter:quarter,year:year,no:number,mail:mail}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myEditModal').modal('hide');
       
    });
	
});
 $("body").on("click",".edit_category",function(){
       $tr = $(this).closest('tr');
	   var id=$tr.attr('id');
	   var org =  $('.edit-org', $tr).text();
	   var tan = $('.edit-tan' , $tr).text();
	   var quarter =  $('.edit-quarter', $tr).text();
	   var pname = $('.edit-pname' , $tr).text();
	   var mail =  $('.edit-mail', $tr).text();
	   var number = $('.edit-number' , $tr).text();
	   var year =  $('.edit-year', $tr).text();

		$('#edit-id').val(id);
        $('#edit-year').val(year);
        $('#edit-number').val(number);
		 $('#edit-mail').val(mail);
        $('#edit-pname').val(pname);
		 $('#edit-org').val(org);
        $('#edit-tan').val(tan);
		 $('#edit-org').val(org);
        $('#edit-quarter').val(quarter);
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
        url: url+'cdelete.php',
        data:{id:id}
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
$( document ).ready(function() {
    console.log( "ready!" );

$( ".newtable" ).scroll(function() {
	console.log('success');
 /* $('#target tr:first').css('position','sticky');
  $('#target tr').css('z-index','-1');
  $('#target tr:first').css('height','25px');
  $('#target tr:first').css('z-index','9999');
$('#target tr:first').css('width','95%');*/
});
});

</script>
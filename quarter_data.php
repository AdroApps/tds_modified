<!--client table-->

<?php
include_once "conn.php";
include_once "header.php";
?>
<!--Client Table-->
<div class="panel panel-flat panelflat newpanel">
<div class="table-responsive" >
	<table class="table table-fixed">
	<thead>
	<tr>
				
				<th class="col-xs-2">Financial Year</th>
				<th class="col-xs-2">Quarter</th>
				<th class="col-xs-2">Status</th>
				<th class="col-xs-2">Date</th>
				<th class="col-xs-2">Edit</th>
				<th class="col-xs-2">Delete</th>
			</tr>	
<?php if( mysqli_num_rows($data1)<=0){
	
	echo "<tr align='center' class='nores'><td >No Results Found<td></tr>";
}
				?><tbody>
			
			<?php	while($row = mysqli_fetch_array($data1)){
				
					echo "<tr align='center' id=".$row[0].">
					<td class='edit-year col-xs-2'>".$row[3]."</td>";
					echo
					"<td class='edit-quarter col-xs-2'>".$row[4]."</td>";
					echo
					"<td class='col-xs-2'>".$row[5]."</td>";
					echo"
					<td class='col-xs-2'>
						<a  data-toggle='modal' data-target='#myEditModal' class='edit_category btn btn-xs btnbg'>
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
			<div class="form-group col-md-6">
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
			<div class="form-group col-md-6">
				<select  id="quarter" name="quarter" class="form-control" required>
					<option>Select Quarter</option>
					<option>Q1</option>
					<option>Q2</option>
					<option>Q3</option>
					<option>Q4</option>
				</select>
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
	$('#buttonplace').html('<button type="New" class="btn btn-xs btncls  btn-default" data-toggle="modal" data-target="#myModal">New</button>');
    console.log( "ready!" );
});
$( "#quarterdata" ).submit(function( event ) {
	
  event.preventDefault();
    var year=$('#year').val();
       var quarter= $('#quarter').val();
	 else{
	
			$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getQuarterData.php',
        data:{year:year,quarter:quarter,type:'insert'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myModal').modal('hide');
		location.reload();
	

       });
}
	   });
$("body").on("click","#edit-submit",function(){ 
		var year=$('#edit-year').val();
       var quarter= $('#edit-quarter').val();
		 var id=$('#edit-id').val();
		$.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'getQuarterData.php',
        data:{id:id,quarter:quarter,year:year,type:'update'}
    }).done(function(data){       
        alert('Record Updated Successfully.');
		$('#myEditModal').modal('hide');
       
    });
	
});
 $("body").on("click",".edit_category",function(){
       $tr = $(this).closest('tr');
	   var id=$tr.attr('id');
	   var year =  $('.edit-year', $tr).text();
	   var quarter =  $('.edit-quarter', $tr).text();
	   
		$('#edit-id').val(id);
        $('#edit-year').val(year);
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
        url: url+'getQuarterData.php',
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

</script>
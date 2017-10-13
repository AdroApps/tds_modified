<?php
include_once "conn.php";
include_once "header.php";
$qsql = "SELECT c.client_id,c.tan,u.phone_number,c.service_charges,c.client_name,q.quarter,q.status,q.authorised_person_name,q.financial_year,c.client_id,u.emailId from user_info u,client_info c,quarter_info q where c.client_id=u.userid and c.client_id=q.client_id and q.quarter_id=".$_GET['qid'];
$qdata= mysqli_query($conn,$qsql);

while($row = mysqli_fetch_assoc($qdata)) {
	//print_r($row);
	$id = $row['client_id'];
	$organization = $row['client_name'];
	$tan = $row['tan'];
	$year = $row['financial_year'];
	$quarter = $row['quarter'];
	$status = $row['status'];
	$pname = $row['authorised_person_name'];
	$mail = $row['emailId'];
	$number = $row['phone_number'];
	$service = $row['service_charges'];//.mysqli_error($conn);
	
}
$tdsamount1tot = "";
$tdsamount2tot = "";
$tdsamount3tot = "";

$sql1 = "SELECT * FROM `quarter_info` WHERE `quarter_id` = '".$_GET['qid']."'";

$data1= mysqli_query($conn,$sql1);
$data2= mysqli_query($conn,$sql1);
$sql_data = "SELECT * FROM `tds_info` WHERE `quarter_id` = '".$_GET['qid']."'  ";
$sql_res= mysqli_query($conn,$sql_data);
while($row = mysqli_fetch_array($sql_res)) {
	$tdsamount1tot += $row['tdsamount1'];
	$tdsamount2tot += $row['tdsamount2'];
	$tdsamount3tot += $row['tdsamount3'];

	}
	if($quarter == "Q1") {
		$month1 = "January";
		$month2 = "Febuary";
		$month3 = "March";
    } else if($quarter == "Q2") {
		$month1 = "April";
		$month2 = "May";
		$month3 = "June";
    } else if($quarter == "Q3") {
		$month1 = "July";
		$month2 = "August";
		$month3 = "September";
    } else {
		$month1 = "October";
		$month2 = "November";
		$month3 = "December";
    }
	$totaltdsamount = $tdsamount1tot + $tdsamount2tot + $tdsamount3tot+$service;
	
?>  
<input type="hidden" id="quarter_id" value="<?php echo $quarter;?>"/>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
	
		<!-- Client details -->
	<div class="panel panel-flat panelflat newpanel">
			<table class="table table-hover table-condensed" >
					<h3 style = "margin-left:15px">Organization TDS Information</h3>
						<thead>
							<tr align="center">
								<th>Organization</th>
								<th>tan</th>
								<th>year</th>
								<th>Quarter</th>
								<th>status</th>
								<th>Person Name</th>
								<th>Email</th>
								<th>Phone Number</th>
					
							</tr>
						</thead>
						<tbody>
							<tr align="center">
								<td><?php echo "$organization";?></td>
								<td><?php echo "$tan";?></td>
								<td><?php echo "$year";?></td>
								<td><?php echo "$quarter";?></td>
								<td><?php echo "$status";?></td>
								<td><?php echo "$pname";?></td>
								<td><?php echo "$mail";?></td>
								<td><?php echo "$number";?></td>
								
							</tr>
						</tbody>
			</table>	
			<!-- /client details -->
			
			<!-----Quarter Table--
					
<table class="tdat">
  
  <tr>
  
   <td class="col-md-4 pull-right"><?php echo "$month1";?></td>
   <td class="col-md-4"></td>
   <td class="col-md-4">Total TDS amount : <?php echo "$tdsamount1tot";?></td>
  </tr>
    <tr>
  
   <td class="col-md-4 pull-right"><?php echo "$month2";?></td>
     <td class="col-md-4"></td>
   <td class="col-md-4">Total TDS amount : <?php echo "$tdsamount2tot";?></td>
  </tr>
    <tr>
  
   <td class="col-md-4 pull-right"><?php echo "$month3";?></td>
     <td class="col-md-4"></td>
   <td class="col-md-4">Total TDS amount : <?php echo "$tdsamount3tot";?></td>
  </tr>
</table>-->
			<table class= "table table condensed">
				<h3 style = "margin-left:15px">Quarter - <?php echo "$quarter";?></h3>
				<tr>
					<td class="col-md-4 month"><?php echo "$month1";?></td>
					
					<td class="col-md-5 col-md-offset-3 amt">Total TDS amount:&nbsp;<input type="textbox" class="tot" disabled value=" <?php echo "$tdsamount1tot";?>"/></td>
				</tr>
				<tr>
					<td class="col-md-4 month"><?php echo "$month2";?></td>
					<td class="col-md-5 col-md-offset-3 amt">Total TDS amount:&nbsp;<input type="textbox" class="tot"  disabled value=" <?php echo "$tdsamount2tot";?>"/></td>
				</tr>
				
				<tr>
					<td class="col-md-4 month"><?php echo "$month3";?></td>
					<td class="col-md-5 col-md-offset-3 amt">Total TDS amount:&nbsp;<input type="textbox" class="tot"  disabled value=" <?php echo "$tdsamount3tot";?>"/></td>
				</tr>
				<tr>
					<td class="col-md-4 "></td>
					<td class="col-md-5 col-md-offset-3 amt">&nbsp;&nbsp;&nbsp;Service Charges:&nbsp;<input type="textbox" class="tot"  disabled value=" <?php echo "$service";?>"/></td>
				</tr>
				<tr>
					<td class="col-md-4 "></td>
					<td class="col-md-5 col-md-offset-3 amt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grand Total:&nbsp;<input type="textbox" class="tot"  disabled value=" <?php echo "$totaltdsamount";?>"/></td>
				</tr>
			
			</table>
			
	</div>
	<!-----Quarter Table---->
			
		<!--Employee table-->

	<!--div class="col-lg-12">
	<div class ="panel panel-flat" style="margin-top:5px"> 
		<div class="table-responsive pre-scrollable" style="max-height:506px"-->
<div class="panel panel-flat panelflat newpanel" >
<div class="table-responsive" >
	<table class="table table-fixed table-fixed1" id="user_data">
 <thead>
             <tr align="center">
                <th class="col-xs-1">Employee name</th>
				<th class="col-xs-1">Pan </th>
				<th class="col-xs-1">Month</th>
				<th class="col-xs-1">salary</th>
				<th class="col-xs-1">TDS amt</th>
				<th class="col-xs-1">Month</th>
				<th class="col-xs-1">salary</th>
				<th class="col-xs-1">TDS amt</th>
				<th class="col-xs-1">Month</th>
				<th class="col-xs-1">salary</th>
				<th class="col-xs-1">TDS amt</th>		
                <th class="col-xs-1">Delete</th>
             </tr>
     </thead>

	</table>
</div>
</div>
<!--/Employee table-->
<?php
/*
$psql="select pan,employeename from employee_info where client_id=".$_SESSION['user_id'];

$pan_res = mysqli_query($conn, $psql);
$panos=array();
while($row = mysqli_fetch_array($pan_res)) {
$panos[$row['employeename']]=$row['pan'];
//	array_push($panos, $row['pan']);
	//$pannos=implode(',',$panos);
}$object = new stdClass();

foreach ($panos as $key => $value)
{
    $object->$key = $value;
}
$object = json_decode(json_encode($array), FALSE);
*/
?>
<input type="hidden" id="pannos" value='<?php echo json_encode($panos);?>'/>

<!-----Attach File form and Table--->
	<div class="col-lg-12">
		<center><form action="" method="post" id="file-upload" name="file-upload" enctype="multipart/form-data">
			<div style="position:relative;margin-top:2%;">
                            <a class="btn btn-sm btn-default newbtn" href="javascript:;" style="margin-bottom:30px;">
                                <input type="file" name="file_url" >
                            </a>
                            &nbsp;<span class="label label-info" id="img"></span>
                            <input type="submit"   class="btn btn-sm btn-default newbtn" style=" margin-top: -30px;margin-left: 11px" name="filesubmit" value="Submit">
                      </div>
            				
		</form>
		</center>
<div class="panel panel-flat panelflat newpanel" >
<div class="table-responsive" >
	<table class="table table-fixed " >
	<thead>
	<tr align="center">
						<th class="col-xs-2">Name</th>
						<th class="col-xs-3">View</th>
						<th class="col-xs-3">Download</th>
						<th class="col-xs-2">Date</th>
						<th class="col-xs-2">Delete</th>
					</tr>
	</thead>
				<tbody style="height:200px;">
				
			<?php

$filesql = "SELECT * FROM `file_uploads_info` WHERE user_id=".$_SESSION['user_id']." AND quarter_id=".$_GET['qid']." ORDER BY created_date DESC";
$filedata = mysqli_query($conn, $filesql);
	?>
	
				<?php
				 $currentPath = $_SERVER['PHP_SELF']; 

				 // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
				 $pathInfo = pathinfo($currentPath); 

				 // output: localhost
				 $hostName = $_SERVER['HTTP_HOST']; 

				 // output: http://
				 $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

				 // return: http://localhost/myproject/
				  $url=$protocol.'://'.$hostName.$pathInfo['dirname']."/api/fileuploads/";
if( mysqli_num_rows($filedata)<=0){
	
	echo "<tr align='center'><td  class='nores'>No Results Found</td></tr>";
}
			
				while($roww = mysqli_fetch_array($filedata)){
				
				 ?>
				 	
				 <tr align="center" >
				 <td class="col-xs-2"><?php echo $roww[1]?></td>
				 
				 <td class="col-xs-3"><a href="<?php echo $url.$roww[1];?>" target="_blank">View</a></td>
				 
				 <td class="col-xs-3"><a href="<?php echo $url.$roww[1];?>" download>Download</a></td>
				 <?php echo
				 "<td class='col-xs-2'>".$roww[3]."</td>";
				 echo "<td  class='col-xs-2'>
						<a class='btn btn-xs btnbg remove-image' id='$roww[0],$roww[2]' >
							<span class='glyphicon glyphicon-trash'></span>
						</a>
					</td>";
				 echo "</tr>";
				}
			$_SESSION['qid']=$_GET['qid'];	?>
				
			</tbody>
			
			</table>
</div>
</div>
<!-----/Attach File form and Table--->

<input type="hidden" id="qid" value="<?php echo $_GET['qid'];?>"/>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

	  var qid=$('#qid').val();
//s.appendTo('body');
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"api/getTdsData.php?type=fetch&qid="+qid,
     type:"POST"
    }
   });
   
  $("#user_data").css("width","100%");
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"api/getTdsData.php?type=update&qid="+qid,
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
	  var p=JSON.parse($('#pannos').val());
console.log(p);
var s = $('<select />').attr('id','panid').attr('class','form-control');

 for (var key in p) {
      if (p.hasOwnProperty(key)) {
        console.log(key + " -> " + p[key]);
		  var panop=$('<option />', {value: p[key], text: p[key]}).attr('id',key);
		    panop.appendTo(s);
      }
    }
	  var temp = new Array();
// this will return an array with strings "1", "2", etc.
//temp = pannos.split(",");
console.log(s);
	  var month1,month2,month3;
	  var quarter=$('#quarter_id').val();
	  if(quarter == "Q1") {
		month1 = "January";
		month2 = "Febuary";
		month3 = "March";
    } else if(quarter == "Q2") {
		month1 = "April";
		month2 = "May";
		month3 = "June";
    } else if(quarter == "Q3") {
		month1 = "July";
		month2 = "August";
		month3 = "September";
    } else {
		month1 = "October";
		month2 = "November";
		month3 = "December";
    }
   var html = '<tr>';
   html += '<td width="5%" contenteditable id="data1"></td>';
   html += '<td width="5%" contenteditable id="data2"></td>';
    html += '<td width="5%" contenteditable id="data3">'+month1+'</td>';
   html += '<td width="5%" contenteditable id="data4"></td>';
    html += '<td  width="5%" contenteditable id="data5"></td>';
   html += '<td width="5%" contenteditable id="data6">'+month2+'</td>';
    html += '<td width="5%" contenteditable id="data7"></td>';
   html += '<td width="5%" contenteditable id="data8"></td>';
    html += '<td width="5%" contenteditable id="data9">'+month3+'</td>';
   html += '<td width="5%" contenteditable id="data10"></td>';
    html += '<td width="5%" contenteditable id="data11"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></td>';
   html += '<td></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
   $('#data2').append(s);
  });

$(document).on('change','#panid',function(){
 $tr = $(this).parent().parent();
	   console.log($tr);
  var id = $(this).children(":selected").attr("id");
  alert(id);
  $('td#data1', $tr).text(id);
});
  $(document).on('click', '#insert', function(){
   var first_name = $('#data1').text();
   var pno = $('#data2 option:selected').text();
   var month1 = $('#data3').text();
   var sal1 = $('#data4').text();
   var tdsamt1 = $('#data5').text();
   var month2 = $('#data6').text();
   var sal2 = $('#data7').text();
   var tdsamt2 = $('#data8').text();
   var month3 = $('#data9').text();
   var sal3 = $('#data10').text();
   var tdsamt3 = $('#data11').text();
   var qid=$('#qid').val();
   if(first_name != '' && pno != '' && month1!='' && sal1!='' && tdsamt1!='' && month2!='' && sal2!='' && tdsamt2!=''  && month3!='' && sal3!='' && tdsamt3!='')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{first_name:first_name, pno:pno,month1:month1,sal1:sal1,tdsamt1:tdsamt1,month2:month2,month3:month3,sal3:sal3,sal2:sal2,tdsamt2:tdsamt2,tdsamt3:tdsamt3,qid:qid},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
	  location.reload();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
 
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
  $("#user_data").css("width","100%");
 });
 $("body").on("click",".remove-image",function(){
    var id = $(this).attr('id');
    var c_obj = $(this).parent().parent();
	console.log(c_obj);
   var r = confirm("Are you sure you want to delete this?");
    if (r == true) {
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url+'tdsFileUpload.php',
        data:{id:id,type:'delete'},
    }).done(function(data){
        c_obj.remove();
        alert('File Deleted Successfully.');
       location.reload();
    });
 }

});
 $('#file-upload').submit( function(e) {
    e.preventDefault();
	alert(32);

    var data = new FormData(this); // <-- 'this' is your form element
    
		$.ajax({
        type:'POST',
        url: url+'tdsFileUpload.php',        
		data: data,
		dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
      }).done(function(data){       
        alert('File uploaded Successfully.');
		location.reload();
    });

	});
</script>



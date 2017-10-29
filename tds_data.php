<?php
include_once "conn.php";
include_once "header.php";
$qsql = "SELECT c.client_id,c.tan,u.phone_number,c.service_charges,c.client_name,q.quarter,q.status,q.authorised_person_name,q.financial_year,c.client_id,u.emailId from user_info u,client_info c,quarter_info q where c.client_id=u.userid and c.client_id=q.client_id and q.quarter_id=".$_GET['qid'];
$qdata= mysqli_query($conn,$qsql);
	$SQL = "select c.emp_name,c.pan,c.aadhar,t.month1,t.salary1,t.tdsamount1,t.month2,t.salary2,t.tdsamount2,t.month3,t.salary3,t.tdsamount3 from client_employees c,tds_info t,quarter_info q where c.emp_id=t.emp_id and t.quarter_id=q.quarter_id and q.quarter_id=".$_GET['qid'];

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
	$service = $row['service_charges'];	
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
	if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR)
	$style='none';
else
	$style='block';
if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR){
	
?>  
<style>
.newtd{   
   height: 40px!important;
}
</style>
<?php }else{?>

<style>
.newtd{    padding: 13px!important;
    line-height: 17px!important;
}
</style>
<?php }?>
<input type="hidden" id="quarter_id" value="<?php echo $_GET['qid'];?>"/>

<input type="hidden" id="quarter" value="<?php echo $quarter;?>"/>
<input type="hidden" id="roleid" value="<?php echo $_SESSION['role_id'];?>"/>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
	
		<!-- Client details -->
		<div class="panel panel-default newpanel">
    <div class="panel-heading">Organization TDS Information</div>
    <div class="panel-body">
	<table class="table table-hover table-condensed" >
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
								<td id="org"><?php echo "$organization";?></td>
								<td><?php echo "$tan";?></td>
								<td><?php echo "$year";?></td>
								<td><?php echo "$quarter";?></td>
								<td>
									<?php if($_SESSION['role_id']!=CLIENT){?>
								<div class="form-group">
				<select  id="status" name="status" class="form-control statuschange">
				        <option <?php echo ($status == '') ? "selected='selected'" : ''; ?>>Select Status</option>
						<option <?php echo (trim($status) == 'Completed') ? "selected='selected'": ''; ?>>Completed</option>
						<option <?php echo (trim($status) == 'Processing') ? "selected='selected'": ''; ?>">Processing</option>
						
                     

				</select>
			</div>
										<?php }else { echo $status; } ?>
									
								</td>
								<td><?php echo "$pname";?></td>
								<td><?php echo "$mail";?></td>
								<td><?php echo "$number";?></td>								
							</tr>
						</tbody>
			</table>	
	</div>
</div>

				<div class="panel panel-default tbpanel">
				<div class="panel-heading">Quarter - <?php echo "$quarter";?></div>
				<div class="panel-body">
			<table class= "table table condensed quarteri" border="0">
				<tr>
					<td class="col-md-8 pull-right month"><?php echo "$month1";?></td>
					
					<td class="col-md-4 col-md-offset-3 amt"> TDS amount:&nbsp;<input type="textbox" id="tot1" class="tot" disabled value="<?php echo "$tdsamount1tot";?>"/></td>
				</tr>
				<tr>
					<td class="col-md-8 pull-right  month"><?php echo "$month2";?></td>
					<td class="col-md-4 col-md-offset-3 amt">TDS amount:&nbsp;<input type="textbox" id="tot2"  class="tot" disabled value=" <?php echo "$tdsamount2tot";?>"/></td>
				</tr>
				
				<tr>
					<td class="col-md-8 pull-right  month"><?php echo "$month3";?></td>
					<td class="col-md-4 col-md-offset-3 amt"> TDS amount:&nbsp;<input type="textbox" id="tot3" class="tot"  disabled value=" <?php echo "$tdsamount3tot";?>"/></td>
				</tr>
				<tr>
					<td class="col-md-8 "></td>
					<td class="col-md-4 col-md-offset-3 amt">&nbsp;&nbsp;&nbsp;Service Charges:&nbsp;<input type="textbox" class="tot"  disabled value=" <?php echo "$service";?>"/></td>
				</tr>
				<tr>
					<td class="col-md-8 "></td>
					<td class="col-md-4 col-md-offset-3 amt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grand Total:&nbsp;<input type="textbox" id="total"  class="tot" disabled value=" <?php echo "$totaltdsamount";?>"/></td>
				</tr>
			
			</table>
			
	</div>
</div>
<div class="panel panel-flat panelflat tbpanel" >
 <div class="panel-heading">Employee Information<div id="tdsemplace" style="text-align: right;" class="pull-right col-xs-6"></div></div>
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
	<th class="col-xs-1">Total amt</th>						
<?php if($_SESSION['role_id']==3){
//echo '<th class="col-xs-1">Delete</th>  </tr>';
}?>               
			  
     </thead>

	</table>
</div>
</div>
<!--/Employee table-->

<input type="hidden" id="pannos" value='<?php echo json_encode($panos);?>'/>

<!-----Attach File form and Table--->
<div class="panel panel-flat panelflat tbpanel" >

 <div class="panel-heading">File Information<div style="display:<?php echo $style;?>" id="buttonplace" class="pull-right col-xs-6"><form action="" method="post" id="file-upload" name="file-upload" enctype="multipart/form-data"><input type="file" id="file" name="file_url" style="height:0;width:0;"/> </form> <i id="upload" class="icon-upload position-left" ></i></div></div>
<div class="table-responsive" >
	<table class="table table-fixed " >
	<thead>

		  <tr align="center">	<?php if($_SESSION['role_id']!=CLIENT){?>
						<th class="col-xs-3">File Name</th>
						<th class="col-xs-3">View</th>
						<th class="col-xs-3">Download</th>
						<th class="col-xs-3">Date</th>
	<?php }else{ ?>
	           
						<th class="col-xs-2">File Name</th>
						<th class="col-xs-3">View</th>
						<th class="col-xs-3">Download</th>
						<th class="col-xs-2">Date</th>
						<th class="col-xs-2">Delete</th>
					
		<?php }?></tr>
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
				 "<td class='col-xs-2'>".date('d-m-Y', strtotime($roww[3]))."</td>";
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

<!-----/Attach File form and Table--->

<input type="hidden" id="qid" value="<?php echo $_GET['qid'];?>"/>
<?php include_once "footer.php";?>
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
	 var load=0;
	  var roleid=$('#roleid').val();
	  var qid=$('#quarter_id').val(); var quarter=$('#quarter').val();
	  var org=$('#org').text();
	  if(roleid!=3){
	  $('#tdsemplace').html('<form action="'+url+'tdsEmployeeExport.php?qid='+qid+'&quarter='+quarter+'&org='+org+'"  id="export" method="post" name="export_excel"><div class="control-group"><div class="controls"><button style="background:white!important;color:  #243a51!important;margin-top: -8px;" type="submit"  name="export" class="btn btn-primary button-loading newbtn" data-loading-text="Loading..."><i  class="icon-download position-left" ></i></button>	</div>	</div></form>');}
	  // Monitor your selects for change by classname
    $('.statuschange').on('change', function() { 

         // Save the place increment and value of the select
              var value = $(this).val();

	         var userid= $("#userid").val();
             var recid = $("#quarter_id").val();

         // Send this data to a script somewhere via AJAX
         $.ajax({
             method: "POST",
             url: "api/getTdsData.php",
             data: { 
               userid:userid,
			   recid:recid,
               value: value,
			   type:'status'
             }
          })
          .done(function( msg ) {
              alert( "Data Saved");
			 // location.reload();
          });
    });
 $("#upload").click(function(){
   $('#file').click();
 });
 $('#file').change(function() {
  $('#file-upload').submit();
});
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
   if(load>0)
	   checktds(qid);
  load++;
  }
  function checktds(id){
	  
   $.ajax({
    url:"api/getTdsData.php",
    method:"POST",
    data:{type:'divup',id:id},
    success:function(data)
    {
     data=JSON.parse(data);
	 
	 console.log(data.month1);
	$('#tot1').val(data['month1']);
	$('#tot2').val(data['month2']);
	$('#tot3').val(data['month3']);
	$('#total').val(data['total']);
	
    }
   });
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
	  var quarter=$('#quarter').val();
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
	
var roleid=$('#roleid').val();

if(roleid==3){
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
}else{
    var html = '<tr>';
   html += '<td width="5%"  id="data1"></td>';
   html += '<td width="5%"  id="data2"></td>';
    html += '<td width="5%"  id="data3">'+month1+'</td>';
   html += '<td width="5%"  id="data4"></td>';
    html += '<td  width="5%"  id="data5"></td>';
   html += '<td width="5%"  id="data6">'+month2+'</td>';
    html += '<td width="5%"  id="data7"></td>';
   html += '<td width="5%"  id="data8"></td>';
    html += '<td width="5%"  id="data9">'+month3+'</td>';
   html += '<td width="5%"  id="data10"></td>';
    html += '<td width="5%"  id="data11"></td>';
  
   html += '<td></td>';
   html += '</tr>';
}
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
	  //location.reload();
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
     url:"api/getTdsData.php",
     method:"POST",
     data:{id:id,type:'delete'},
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
       //location.reload();
    });
 }

});
document.getElementById('file-upload').onchange = function () {
upload();
};

var roleid=$('#roleid').val();
if(roleid!=3){ $("th[aria-controls^='user_data']:first").removeClass('col-xs-1');
//	 $("th[aria-controls^='user_data']:first").addClass('col-xs-2');
}
 });
function upload() {
    var upload = document.getElementById('file');
    var image = upload.files[0];
    $.ajax({
      url:url+'tdsFileUpload.php', 
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



<?php 
include_once "../conn.php";

if($_GET['type']=='fetch') {
$columns = array('first_name', 'pno','month1','sal1','tdsamt1','month2','sal2','tdsamt2','month3','sal3','tdsamt3',);
$query="select c.pan,c.aadhar,c.emp_name,c.emp_id,t.tds_id,t.month1,t.month2,t.month3,t.salary1,t.salary2,t.salary3,t.tdsamount1,t.tdsamount2,t.tdsamount3,t.total_amount from client_employees c,tds_info t where t.emp_id=c.emp_id and t.quarter_id='".$_GET['qid']."'";

if(isset($_POST["order"]))
{
 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= ' ORDER BY emp_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));
//echo $query.''.$query1;
$result = mysqli_query($conn, $query . $query1);



$data = array();

while($row = mysqli_fetch_array($result))
{
	//print_r($row);
	if($_SESSION['role_id']==AUTHOR || $_SESSION['role_id']==AUDITOR){
		$sub_array = array();
 $sub_array[] = '<div  width="5%" data-id="'.$row["tds_id"].'" data-column="employeename">' . $row["emp_name"] . '</div>';
 $sub_array[] = '<div   width="5%" data-id="'.$row["tds_id"].'" data-column="pan">' . $row["pan"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="month1">' . $row["month1"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="salary1">' . $row["salary1"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="tdsamount1">' . $row["tdsamount1"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="month2">' . $row["month2"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="salary2">' . $row["salary2"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="tdsamount2">' . $row["tdsamount2"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="month3">' . $row["month3"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="salary3">' . $row["salary3"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="tdsamount3">' . $row["tdsamount3"] . '</div>'; 
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="total_amount">' . $row["total_amount"] . '</div>';
	}
	else{
 $sub_array = array();
 $sub_array[] = '<div  width="5%" data-id="'.$row["tds_id"].'" data-column="employeename">' . $row["emp_name"] . '</div>';
 $sub_array[] = '<div   width="5%" data-id="'.$row["tds_id"].'" data-column="pan">' . $row["pan"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="month1">' . $row["month1"] . '</div>';
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="salary1">' . $row["salary1"] . '</div>';
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="tdsamount1">' . $row["tdsamount1"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="month2">' . $row["month2"] . '</div>';
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="salary2">' . $row["salary2"] . '</div>';
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="tdsamount2">' . $row["tdsamount2"] . '</div>';
 $sub_array[] = '<div  width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="month3">' . $row["month3"] . '</div>';
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="salary3">' . $row["salary3"] . '</div>';
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="tdsamount3">' . $row["tdsamount3"] . '</div>'; 
 $sub_array[] = '<div contenteditable width="5%" class="update" data-id="'.$row["tds_id"].'" data-column="total_amount">' . $row["total_amount"] . '</div>';
	}
 // if($_SESSION['role_id']==3)
 //$sub_array[] = '<a  class=" btn btn-xs btnbg"><span class="glyphicon glyphicon-trash delete" id="'.$row["tds_id"].'"></span> </a>';
 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "select c.pan,c.aadhar,c.emp_name,c.emp_id,t.month1,t.month2,t.month3,t.salary1,t.salary2,t.salary3,t.tdsamount1,t.tdsamount2,t.tdsamount3,t.total_amount from client_employees c,tds_info t where t.emp_id=c.emp_id and t.quarter_id='".$_GET['qid']."' ORDER BY emp_id DESC";

 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);


}
if($_GET['type']=='update'){
	print_r($_POST);
	 $value = mysqli_real_escape_string($conn, $_POST["value"]);
	 if($_POST["column_name"]=='tdsamount1' || $_POST["column_name"]=='tdsamount2' ||  $_POST["column_name"]=='tdsamount3'){
 $query = "UPDATE tds_info SET ".$_POST["column_name"]."='".$value."',total_amount=tdsamount1+tdsamount2+tdsamount3 WHERE tds_id = '".$_POST["id"]."'";
	 }
	 else{
		  $query = "UPDATE tds_info SET ".$_POST["column_name"]."='".$value."'  WHERE tds_id = '".$_POST["id"]."'";
	 }


 if(mysqli_query($conn, $query))
 {
  echo 'Data Updated';
 }
}
if($_POST['type']=='delete'){
	
 $query = " DELETE FROM tds_info WHERE tds_id = '".$_POST["id"]."'";


 if(mysqli_query($conn, $query))
 {
  echo  'Data deleted';
 }
 
echo json_encode($output);
}
if($_POST['type']=='status'){
$status=0;
$date = date("Y/m/d h:i:s" );
$updasql="UPDATE quarter_info SET status='".$_REQUEST['value']."' WHERE quarter_id=".$_REQUEST['recid'];
	$udata = mysqli_query($conn,$updasql);
/*$sql = "INSERT INTO `notification`(`notification_id` , `user_id` , `rec_id` , `status` , 
	  `message` ,`date`) VALUES ('' , '".$_REQUEST['userid']."' ,
	   '".$_REQUEST['recid']."'  ,'".$status."' ,'".$_REQUEST['value']."', '".$date."')";

	$data = mysqli_query($conn,$sql);*/
}
if($_POST['type']=='divup'){
	$service="SELECT service_charges from client_info where client_id=".$_SESSION['user_id'];
	$sdata=mysqli_query($conn,$service);	
	$srow = mysqli_fetch_assoc($sdata);
	
	$divque="SELECT SUM(tdsamount1) as month1,SUM(tdsamount2) as month2,SUM(tdsamount3) as month3,(SUM(tdsamount1) + SUM(tdsamount2) + SUM(tdsamount3)) as 'total' FROM `tds_info` where quarter_id=".$_POST['id'];
		$udata = mysqli_query($conn,$divque);
		$row = mysqli_fetch_assoc($udata);
		$status=array();
		$status['total']=$row['total']+$srow['service_charges'];
		$status['month1']=	$row['month1'];
		
		$status['month2']=	$row['month2'];
		
		$status['month3']=	$row['month3'];
		
		$sql = "UPDATE `quarter_info` SET `total_amount`='".$status['total']."' WHERE quarter_id=".$_POST['id'];

	$data = mysqli_query($conn,$sql);
		echo json_encode($status);
}
?>
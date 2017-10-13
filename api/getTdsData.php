<?php 
include_once "../conn.php";

if($_GET['type']=='fetch') {
$columns = array('first_name', 'pno','month1','sal1','tdsamt1','month2','sal2','tdsamt2','month3','sal3','tdsamt3',);
$query="select c.pan,c.aadhar,c.emp_name,c.emp_id,t.tds_id,t.month1,t.month2,t.month3,t.salary1,t.salary2,t.salary3,t.tdsamount1,t.tdsamount2,t.tdsamount3 from client_employees c,tds_info t where t.emp_id=c.emp_id and c.client_id=".$_SESSION['user_id']." and t.quarter_id='".$_GET['qid']."'";

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY emp_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);



$data = array();

while($row = mysqli_fetch_array($result))
{
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

 $sub_array[] = '<a  class=" btn btn-xs btnbg"><span class="glyphicon glyphicon-trash delete" id="'.$row["tds_id"].'"></span> </a>';
 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "select c.pan,c.aadhar,c.emp_name,c.emp_id,t.month1,t.month2,t.month3,t.salary1,t.salary2,t.salary3,t.tdsamount1,t.tdsamount2,t.tdsamount3 from client_employees c,tds_info t where t.emp_id=c.emp_id and c.client_id=".$_SESSION['user_id']." and t.quarter_id='".$_GET['qid']."' ORDER BY emp_id DESC";
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
 $query = "UPDATE tds_info SET ".$_POST["column_name"]."='".$value."' WHERE tds_id = '".$_POST["id"]."'";


 if(mysqli_query($conn, $query))
 {
  echo 'Data Updated';
 }
}

?>
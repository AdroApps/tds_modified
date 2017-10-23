
<?php	
include_once 'conn.php';

$sql = "SELECT * From `clienttable` WHERE `id` = '".$_GET['clientdetails']."' ";
$data= mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($data)) {
	//print_r($row);
	$id = $row['id'];
	$organization = $row['organization'];
	$tan = $row['tan'];
	$year = $row['year'];
	$quarter = $row['quarter'];
	$status = $row['status'];
	$pname = $row['pname'];
	$mail = $row['email'];
	$number = $row['number'];
	$service = $row['service'];//.mysqli_error($conn);
	
}
		$file = $_FILES['file']['tmp_name'];
		$handle = fopen($file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
			
		if( $filesop[0]!='Organisation'){
			echo "<pre>";
			print_r($filesop);			
			echo "</pre>";
		//$date = $filesop[1];
      //  $newDate = date("Y-m-d", strtotime($date));			
			
			$name = $filesop[0];
			$quarter=$filesop[12];
			$pan = $filesop[1];
			$adar = $filesop[2];
			$month1=$fileop[3];			
			$salary1=$fileop[4];
			$tdsamt1=$fileop[5];
			$month2=$fileop[6];
			$salary2=$fileop[7];
			$tdsamt2=$fileop[8];
			$month3=$fileop[9];
			$salary3=$fileop[10];
			$tdsamt3=$fileop[11];
			$userid=getUserId($filesop[0]);
            $count=checkMail($filesop[0]);

			$ldate=date('Y-m-d H:i:s');
			if($count)
				

			{ $query = "insert into clienttable(`id`, `employeename`, `pan`, `adhar`, `month1`, `salary1`, `tdsamount1`, `month2`, `salary2`, `tdsamount2`, `month3`, `salary3`, `tdsamount3`, `quarter`, `created_date`, `userid`, `qid`) values ('','$name','$adar','$pan''$month1','$salary1','$tdsamount1', '$month2','$salary2','$tdsamount2','$month3','$salary3','$tdsamount3', '$quarter','$ldate','$_SESSION['user_id']','$_GET['clientdetails']')";
			 $rgetorg=mysqli_query($conn, $query);
			}
		     $c = $c + 1;
			$i++;
		}
	
		}		if($sql){
				echo "You database has imported successfully. You have inserted ". $c ." records";
			}else{
				echo "Sorry! There is some problem.";
			}

function getOrganisation($id){
$conn = mysqli_connect(DB_HOST, DB_UNAME, DB_PASSWORD, DB_NAME);

 $getorg="SELECT id FROM usercreate WHERE organization='".$id."'";

$rgetorg=mysqli_query($conn, $getorg);
$row = mysqli_fetch_assoc($rgetorg);
return $row['id'];
}
function checkMail($pan){
$conn = mysqli_connect(DB_HOST, DB_UNAME, DB_PASSWORD, DB_NAME);

 $getorg="SELECT count(*) as count FROM addemployee WHERE pan='".$pan."'";

$rgetorg=mysqli_query($conn, $getorg);
$row = mysqli_fetch_assoc($rgetorg);
if( $row['count']>0){
	return false;
}
else{
	return true;
}
}
function getUserId($id){
$conn = mysqli_connect(DB_HOST, DB_UNAME, DB_PASSWORD, DB_NAME);
 $getuserorg="SELECT id FROM usercreate WHERE email='".$id."'";

$userorg=mysqli_query($conn, $getuserorg);
return $row['id'];
}
	?>
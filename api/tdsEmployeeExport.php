<?php 
include_once "../conn.php";
$mheader='DDO\'S INCOME TA MONTH WISE DEDUCTION PARTICULARS';
$qsql="select c.client_name,c.tan,q.quarter,q.financial_year from quarter_info q,client_info c where c.client_id=q.client_id and q.quarter_id=".$_GET['qid'];
$qData = mysqli_query ($conn,$qsql ) ;
$qfields = mysqli_num_fields ( $qData );
$info=array('NAME OF THE CLIENT','TAN NUMBER','FINANCIAL YEAR','QUARTER');


for ( $i = 0; $i < $qfields; $i++ )
{
    //$header .= mysqli_field_name( $exportData , $i ) . "\t";
	

	 $qheader .=$info[$i]. "\t\t\t\t";
}
while( $row = mysqli_fetch_row( $qData ) )
{
	
    $line = '';
    foreach( $row as $value )
    {              
                              
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t\t\t\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t\t\t\t";
        }
		
		if($row[2] == "Q1") {
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
        $line .= $value;
    }
    $qresult .= trim( $line ) . "\n\n\n";
}

$qresult = str_replace( "\r" , "" , $qresult );
	$sql = "select c.emp_name as Name,c.pan as PanNumber,c.aadhar as AadharNumber ,t.month1,t.salary1 as Salary,t.tdsamount1 as TDSamt,t.month2,t.salary2 as Salary,t.tdsamount2 as TDSamt,t.month3,t.salary3 as Salary,t.tdsamount3 as TDSamt,t.total_amount as Total from client_employees c,tds_info t,quarter_info q where c.emp_id=t.emp_id and t.quarter_id=q.quarter_id and q.quarter_id='".$_GET['qid']."'";

$header = '';
$result ='';
$exportData = mysqli_query ($conn,$sql ) ;

$fields = mysqli_num_fields ( $exportData );

for ( $i = 0; $i < $fields; $i++ )
{
	
	
	$month=mysqli_fetch_field_direct($exportData, $i)->name;

	
    //$header .= mysqli_field_name( $exportData , $i ) . "\t";
	if($month=='month1')
        $header .=$month1. "\t";
	else if($month=='month2')
        $header .=$month2. "\t";
	else if($month=='month3')
		   $header .=$month3. "\t";
	else
	 $header .=mysqli_fetch_field_direct($exportData, $i)->name. "\t";
}

while( $row = mysqli_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {              
                              
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=tds-".$_GET['quarter']."-".$_GET['org'].".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "\t\t\t\t\t\t$mheader\t\t\t\n\n\n";
print "$qheader\n$qresult";

print "$header\n$result";
 $tsql="select sum(t.tdsamount1) as month1,sum(t.tdsamount2) as month2,sum(t.tdsamount3) as month3,q.total_amount as Total,c.service_charges from quarter_info q,client_info c,tds_info t where q.quarter_id=t.quarter_id and q.client_id=c.client_id and q.quarter_id=".$_GET['qid'];
 $tData=mysqli_fetch_array(mysqli_query($conn,$tsql));
$amt=$tData['total_amount']-$tData['service_charges'];
echo "\n\n\t\t\t\t\t".$tData['month1']."\t\t\t".$tData['month2']."\t\t\t".$tData['month3']."\t".$amt;
//print "\n\n$tresult";
?>
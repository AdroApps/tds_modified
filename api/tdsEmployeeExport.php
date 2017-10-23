<?php 
include_once "../conn.php";
	$sql = "select c.emp_name,c.pan,c.aadhar,t.month1,t.salary1,t.tdsamount1,t.month2,t.salary2,t.tdsamount2,t.month3,t.salary3,t.tdsamount3 from client_employees c,tds_info t,quarter_info q where c.emp_id=t.emp_id and t.quarter_id=q.quarter_id and q.quarter_id='".$_GET['qid']."'";

$header = '';
$result ='';
$exportData = mysqli_query ($conn,$sql ) ;

$fields = mysqli_num_fields ( $exportData );

for ( $i = 0; $i < $fields; $i++ )
{
    //$header .= mysqli_field_name( $exportData , $i ) . "\t";
	

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
print "$header\n$result";
?>
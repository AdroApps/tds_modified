<?php


include_once 'conn.php';
$SQL = "SELECT u.organization as Organization,a.employeename as EmployeeName,a.pan as PanNumber,a.adhar as AdharNumber FROM addemployee a,usercreate u WHERE u.id=a.orgid AND a.userid=".$_SESSION['user_id'];
$header = '';
$result ='';
$exportData = mysqli_query ($conn,$SQL ) or die ( "Sql error : " . mysqli_error( ) );

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
header("Content-Disposition: attachment; filename=employees.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>
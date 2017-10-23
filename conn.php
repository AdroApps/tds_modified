<?php
session_start();

 ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 
define ('DB_HOST' , 'localhost');

define ('DB_UNAME' , 'root');

define ('DB_PASSWORD' , '');

define ('DB_NAME' , 'tds_modified');

define ('SUPERADMIN' , '1');
define ('AUDITOR' , '2');
define ('CLIENT' , '3');
define ('AUTHOR' , '4');
define ('AGENT' , '5');
define('STATUS_SUCCESS','1');
define('STATUS_FAILURE','0');
$conn = mysqli_connect(DB_HOST, DB_UNAME, DB_PASSWORD, DB_NAME);

$_SESSION['LAST_ACTIVITY'] = time();
/*if(empty($_SESSION['e'])){
     header('Location: clientlogin.php');
     exit;
    echo $_SESSION['e'];
    }*/
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
} else if (time() - $_SESSION['created'] > 5400) {
    // session started more than 30 minutes ago
    //session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    session_destroy();
    $_SESSION['created'] = time();  // update creation time
     header('Location: index.php');
     exit;
}
/*function session_set()
{
    if(empty($_SESSION['e'])){
     header('Location: clientlogin.php');
    echo $_SESSION['e'];
    }
}
	/*ini_set("session.cookie_lifetime","300");

   if(!isset($_SESSION["timeout"])){
     $_SESSION['timeout'] = time();
   };
   $st = $_SESSION['timeout'] + 300; //session time is 1 minute


  if(time() < $st){
    session_destroy();
  }

/*if($conn) {
	echo "connected to db";
	} else {
		echo "not connected to db";
		}
	
?>*/
?>



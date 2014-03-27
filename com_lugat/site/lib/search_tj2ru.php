<?php
require_once("dbconnect.php");
if (isset($_GET['q'])) {
	//anticrack
	$t = strip_tags(substr($_GET['q'],0,140));
	$t = trim(stripslashes($t));
	if( $t != '' ) {
		//anticrack
		$t = mysql_real_escape_string($t);
		$sql="SELECT term FROM pef4p_lugat_key_tj WHERE `term` LIKE '$t%' LIMIT 0,8";
		$result = mysql_query($sql,$conn);
		if(!$result) {
		    $message  = 'Invalid query: ' . mysql_error();
			die($message);
		}
		$rows = array();
		while($row = mysql_fetch_row($result)){
			echo $row[0],"\n";
		}
		mysql_free_result($result);
	} 
}
?>
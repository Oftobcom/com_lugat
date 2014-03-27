<?php
require_once("dbconnect.php");
require_once("cloud.php");

$tbl_cloud="testdb_lugat_tagcloud_en";
if (isset($_GET['SearchWord'])) {
	$tbl="testdb_lugat_en2tj_v01";
	//anticrack
	$t = strip_tags(substr($_GET['SearchWord'],0,140));
	$t = trim(stripslashes($t));
	$len = mb_strlen($t,"utf-8");
	$found = 0;
	if( $len > 0 ) {
		//anticrack
		$t = mysql_real_escape_string($t);
		$sql="SELECT tj from $tbl WHERE `en`='".$t."'";
		$result = mysql_query($sql,$conn);
		if(!$result){
			echo "Can't load from the English-Tajik dictionary <br/>".mysql_error()."<br/>";
			return;
		}
		$string = '';
		while($row = mysql_fetch_row($result)){
			$found++;
			$string .= $row[0].'<br>';
		}
		mysql_free_result($result);
	} 
	if($found>0) {
		if($len>4) CloudUpdate($t, $tbl_cloud);
	}
	else {
		$string = "The word is not found. Sorry!";
		NotFoundWord($t,"en2tj");
	}
}

if(isset($t)) echo "<b>$t</b><br>$string";
?>
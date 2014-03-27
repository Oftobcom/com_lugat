<?php
require_once("dbconnect.php");
require_once("cloud.php");

$tbl_cloud="pef4p_lugat_tagcloud_tj";
if (isset($_GET['SearchWord'])) {
	//anticrack
	$t = strip_tags(substr($_GET['SearchWord'],0,140));
	$t = trim(stripslashes($t));
	$len = mb_strlen($t,"utf-8");
	$found = 0;
	if( $len > 0 ) {
		//anticrack
		$t = mysql_real_escape_string($t);
		$sql="SELECT ru from pef4p_lugat_tj2ru_v01 WHERE `tj`='".$t."'";
		$result = mysql_query($sql,$conn);
		if(!$result){
			echo "Can't load from the Tajik-Russian dictionary <br/>".mysql_error()."<br/>";
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
		$string = "Слово не найдено. Извините!<br>Рекомендуем <b><a href='http://oftob.com/%D1%80%D1%83%D1%81%D1%81%D0%BA%D0%BE-%D1%82%D0%B0%D0%B4%D0%B6%D0%B8%D0%BA%D1%81%D0%BA%D0%B8%D0%B9-%D1%80%D0%B0%D0%B7%D0%B3%D0%BE%D0%B2%D0%BE%D1%80%D0%BD%D0%B8%D0%BA/' target='_blank'>РУССКО-ТАДЖИКСКИЙ РАЗГОВОРНИК</a></b>, содержащий повседневные частоиспользуемые фразы";
		//NotFoundWord($t,"tj2ru");
	}
}

if(isset($t)) echo "<b>$t</b><br>$string";
?>
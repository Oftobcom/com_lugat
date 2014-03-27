<?php
require_once("dbconnect.php");
require_once("cloud.php");

CloudSave("testdb_lugat_tagcloud_ru", "ru2tj");
CloudSave("testdb_lugat_tagcloud_tj", "tj2ru");
CloudSave("testdb_lugat_tagcloud_en", "en2tj");
CloudSave("testdb_lugat_tagcloud_tj2en", "tj2en");
CloudSave("testdb_lugat_tagcloud_ru2uz", "ru2uz");

function CloudSave($tbl_cloud, $direction) {

	$cloud = CloudDraw($tbl_cloud, $direction);
	$cloud .= "<br><span class=\"tagcloud_head\">Общее количество слов в рейтинге: ";
	$cloud .= CloudDim($tbl_cloud);

	$filename="/???/components/com_lugat/cache/topwords_".$direction.".txt";
	if (is_writable($filename))
		$fp = fopen($filename, 'w');
	else
		$fp = fopen($filename, 'x');

	if (!$fp) {
		echo "Cannot open file ($filename)";
		exit;
	}

	// Write $cloud to cache file.
	if (fwrite($fp, $cloud) === FALSE) {
		echo "Cannot write to file ($filename)";
		exit;
	}

	echo "Top words Cloud ($direction) updated successfully\n";

	fclose($fp);
}
?>
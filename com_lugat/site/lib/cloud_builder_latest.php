<?php
require_once("dbconnect.php");
require_once("cloud.php");

CloudSave("pef4p_lugat_tagcloud_ru", "ru2tj");
CloudSave("pef4p_lugat_tagcloud_tj", "tj2ru");
CloudSave("pef4p_lugat_tagcloud_en", "en2tj");
CloudSave("pef4p_lugat_tagcloud_tj2en", "tj2en");
CloudSave("pef4p_lugat_tagcloud_ru2uz", "ru2uz");

function CloudSave($tbl_cloud, $direction) {
	$cloud = CloudLatestDraw($tbl_cloud, $direction);
	$filename="/storage/home/srv102159/oftob.com/components/com_lugat/cache/latestwords_".$direction.".txt";
	
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

	echo "Latest words Cloud ($direction) updated successfully\n";

	fclose($fp);
}
?>
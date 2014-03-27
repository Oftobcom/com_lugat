<?php

function CloudUpdate($t, $tbl_cloud){
	global $conn;
	
	$t=mb_strtolower($t,"utf-8");
	if(CloudFilter($t)==0){
		$sql = "SELECT COUNT(*) FROM $tbl_cloud WHERE term='$t'";
		$result_count = mysql_query($sql);
		$count = mysql_result($result_count, 0);
		mysql_free_result($result_count);
		if($count==0) {
			$sql = "INSERT INTO $tbl_cloud (`term`) SELECT '$t'"; 
			$result = mysql_query($sql);
			if(!$result) echo "Problems with Tag Cloud - Insert<br>";
		}
		else {
			$sql = "UPDATE $tbl_cloud SET counter=counter+1 WHERE term='$t'";
			$result = mysql_query($sql);
			if(!$result) echo "Problems with Tag Cloud - Update<br>";
		}
	}
}

function CloudDraw($tbl_cloud,$dic){
      // don't forget to connect to DB first!
	  $cloud = ''; // variable to keep the results of function
      $terms = array(); // create empty array
      $maximum = 0; // $maximum is the highest counter for a search term
      $sql="SELECT term, counter FROM $tbl_cloud ORDER BY counter DESC, dt DESC LIMIT 40";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)){
          $term = $row['term'];
          $counter = $row['counter'];
          // update $maximum if this term is more popular than the previous terms
          if ($counter>$maximum) $maximum = $counter;
          $terms[] = array('term' => $term, 'counter' => $counter);
      }
      // sort terms unless you want to retain the order of highest to lowest
      sort($terms);
	  
	foreach ($terms as $k) { // start looping through the tags
		// determine the popularity of this term as a percentage
		$fontclass = round(($k['counter'] / $maximum) * 10)+1;
		// determine the class for this term based on the percentage
		// output this term
		$cloud .= "<span class='s$fontclass'><a href=\"#\" class='l_word'>" . $k['term'] . "</a></span> ";
	}
 
	return $cloud;

}

function CloudLatestDraw($tbl_cloud,$dic){
	global $conn;
	// don't forget to connect to DB first!
	$cloud = ''; // variable to keep the results of function
	$sql="SELECT term FROM $tbl_cloud ORDER BY dt DESC LIMIT 40";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result))
		$cloud .= " <a href=\"#\" class='l_word'>". $row['term'] . "</a>";
	
	return $cloud;
}

function CloudFilter($t){
	global $conn;
	
	$sql = "SELECT COUNT(*) FROM testdb_lugat_tagcloud_filter WHERE term='$t'";
	$result_count = mysql_query($sql);
	$count = mysql_result($result_count, 0);
	mysql_free_result($result_count);
	return $count;
}

function CloudDim($tbl_cloud){
	global $conn;
	
	$sql = "SELECT COUNT(*) FROM $tbl_cloud";
	$result_count = mysql_query($sql);
	$count = mysql_result($result_count, 0);
	mysql_free_result($result_count);
	return $count;
}

function NotFoundWord($term,$direction){
	global $conn;
	$t = mysql_real_escape_string($term);
	$sql = "INSERT INTO testdb_lugat_notfound_$direction (`term`) SELECT '$t'"; 
	$result = mysql_query($sql,$conn);
}

?>
<?php
	require_once("includes/Functions.php");
	$spec_id = isset($_REQUEST['spec_id'])?$_REQUEST['spec_id']:1;
	$result = getDateRdv($spec_id);
	$json = "{}";
	if ($result->num_rows > 0){
		//Initialize array variable
		$dbdata = array();
		while ($row = $result->fetch_assoc()) {
			  array_push($dbdata ,$row);
		}
		$json = json_encode($dbdata);
	}
	echo $json;
?>
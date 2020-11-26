<?php
	require_once("includes/Functions.php");
	deletePatient($_REQUEST['cin']);
	Redirect_to("index.php");
?>
<?php
	require_once("includes/Functions.php");
	$cin = $_REQUEST["cin"];
	$nom = $_REQUEST["nom"];
	$prenom = $_REQUEST["prenom"];
	$date_n = $_REQUEST["dateN"];
	$tel = $_REQUEST["tel"];
	$adresse = $_REQUEST["adresse"];
	insertPatient($nom,$prenom,$adresse,$tel,$date_n,$cin);
	Redirect_to("index.php");
?>
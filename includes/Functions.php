<?php
require_once("Database.php");
function DB_Connexion(){
	$db = new Database();
	return $db->getConnection();
}

function Redirect_to($New_Location){
    header("Location:".$New_Location);
	exit;
}

/*
	param = specialite id 
*/
function getDateRdv($id){
	$mysqli = DB_Connexion();
	$sql_query = "select date_rdv from rdv where foreign_id = ".$id . " and Date(date_rdv) >= CURDATE() order by date_rdv asc";
	$result = $mysqli->query($sql_query);
	$mysqli->close();
	return $result;
}

function insertDateRdv($day,$time,$spec_id){
	$mysqli = DB_Connexion();
	$date = $day ." ". $time;
	$sql_query = "insert into rdv(date_rdv, foreign_id) VALUES ('".$date."',".$spec_id.")";
	$result = $mysqli->query($sql_query);
	$mysqli->close();
	return $result;
}

function getSpecialite(){
	$mysqli = DB_Connexion();
	$sql_query="select * from specialite";
	$result = $mysqli->query($sql_query);
	$mysqli->close();
	return $result;
}

function getPatient(){
	$mysqli = DB_Connexion();
	$sql_query="select * from patient";
	$result = $mysqli->query($sql_query);
	$mysqli->close();
	return $result;
}

function insertPatient($nom,$prenom,$adresse,$tel,$date_n,$cin){
	$mysqli = DB_Connexion();
	$sql_query="insert into patient (nom,prenom,adresse,tel,date_n,cin) values('".$nom."','".$prenom."','".$adresse."','".$tel."','".$date_n."','".$cin."')";
	$result = $mysqli->query($sql_query);
	$mysqli->close();
	return $result;
}

function deletePatient($cin){
	$mysqli = DB_Connexion();
	$sql_query="delete from patient where cin ='".$cin."'";
	$result = $mysqli->query($sql_query);
	$mysqli->close();
	return $result;
}
?>
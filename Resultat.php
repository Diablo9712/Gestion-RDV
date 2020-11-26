<?php 
	require_once("includes/Functions.php");
	$date_Reservation = isset($_POST["date_Reservation"])?$_POST['date_Reservation']:'';
	$timepicker = isset($_POST["timepicker"])?$_POST['timepicker']:'';
	$spec_id = isset($_POST["spec_id"])?$_POST['spec_id']:'';
	if(isset($date_Reservation) && isset($timepicker) && isset($spec_id)){
		$result = insertDateRdv($date_Reservation,$timepicker,$spec_id);
	}
	$cin = isset($_POST["cin"])?$_POST['cin']:'';
	$nom = isset($_POST["nom"])?$_POST['nom']:'';
	$prenom = isset($_POST["prenom"])?$_POST['prenom']:'';
	$dateN = isset($_POST["dateN"])?$_POST['dateN']:'';
	$tel = isset($_POST["tel"])?$_POST['tel']:'';
	$adresse = isset($_POST["adresse"])?$_POST['adresse']:'';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Resultat</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
	<body>
	<table class="table table-hover">
		<tr><td>Date de Reservation</td><td><?php echo $date_Reservation." à ".$timepicker; ?></td></tr>
		<tr><td>CIN</td><td><?php echo $cin; ?></td></tr>
		<tr><td>Nom</td><td><?php echo $nom; ?></td></tr>
		<tr><td>Prenom</td><td><?php echo $prenom; ?></td></tr>
		<tr><td>Date de Naissance</td><td><?php echo $dateN; ?></td></tr>
		<tr><td>Telephone</td><td><?php echo $tel; ?></td></tr>
		<tr><td>Adresse</td><td><?php echo $adresse; ?></td></tr>
	</table>
	<input type="button" class="btn btn-success hidden-print" onclick="print()" value="Imprimer" />
	</body>
	<script src="js/bootstrap.min.js"></script>
</html>
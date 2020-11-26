<?php 
	require_once("includes/Functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Choisir un Client</title><!-- todo change title when press next document.title = 'test'; -->
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/jquery.timepicker.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- multistep form -->
<form id="msform" method="post" action="Resultat.php">
	<div class="container">
	<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
			<div class="form-group">
			<!-- progressbar -->
			<ul id="progressbar">
				<li class="active">Client</li>
				<li>Specialité</li>
				<li>Rendez Vous</li>
			</ul>
		</div>
	<!-- fieldsets -->
	<fieldset class="panel panel-info form-horizontal">
		<div class="panel-heading">Choisir ou ajouter un client</div>
		<div class="panel-body">
		
		<div class="form-group">
			<div class="col-lg-12">
				<input type="text" name="cin"  id="cin" class="form-control" placeholder="Cin" required />
			</div>
		</div>
  
		<div class="form-group">
			<div class="col-lg-12">
				<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required />
			</div>
		</div>  
	
		<div class="form-group">
			<div class="col-lg-12">
				<input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" required />
			</div>
		</div>  
		
		<div class="form-group">
			<div class="col-lg-12">
				<input type="date" name="dateN" id="dateN" class="form-control" placeholder="Date de naissance" required />
			</div>
		</div>  
		
		<div class="form-group">
			<div class="col-lg-12">
				<input type="text" name="tel" id="tel" class="form-control"  placeholder="Tel" required />
			</div>
		</div>    
		
		<div class="form-group">
			<div class="col-lg-12">
				<input type="text" name="adresse" id="adresse" class="form-control"  placeholder="Adresse" required />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-lg-offset-5">
			  <input type="button" name="ajouter" value="Ajouter" onclick="addPatient()" class="btn btn-primary"/>  <input type="reset" value="Vider" class="btn btn-danger"/>
			</div>
		</div>
		<div class="form-group">
			<table class="table table-hover">
				<tr><th>Cin</th><th>Nom</th><th>Prenom</th><th>Date de naissance</th><th>Tel</th><th>Adresse</th><th>#</th></tr>
				<?php 
				$result = getPatient();
					while($tab=mysqli_fetch_array($result)){
					   echo "<tr class='success' onclick='fill(".json_encode($tab).")'><td>".$tab['cin']."</td><td>".$tab['nom']."</td><td>".$tab['prenom']."</td><td>".$tab['date_n']."</td><td>".$tab['tel']."</td><td>".$tab['adresse']."</td><td><a href='SupprimerPatient.php?cin=".$tab['cin']."'>Supprimer</a></td></tr>";
					}
				?>
			</table>
		</div>
		<div class="form-group">
			<div class="col-lg-6 col-lg-offset-5">	  
				<input type="button" name="next" class="next action-button" value="Next" />
			</div>
		</div>
		</div>
	</fieldset>
	<fieldset class="panel panel-info form-horizontal">
		<div class="panel-heading">Choisir une spécialité</div>
		<div class="panel-body">
			<div class="form-group">
			<div class="col-lg-6 col-lg-offset-3">
				<select class="form-control" name="spec_id" id="spec_id"	onchange="getDateRdv()">
					<?php $res_spec = getSpecialite();
						while($tab=mysqli_fetch_array($res_spec)){
							echo "<option value='".$tab["id"]."'>".$tab["titre"]."</option>";
						}
					?>
				</select>
			</div>
			</div>
		<div class="form-group">
			<div class="col-lg-8 col-lg-offset-4">
				<input type="button" name="previous" class="previous action-button" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next" />  
			</div>
		</div>
		</div>
	</fieldset>
	<fieldset class="panel panel-info form-horizontal">
		<div class="panel-heading">Choisir un Rendez Vous</div>
		<div class="panel-body">
		<div class="form-group">
			<div class="col-lg-8 col-lg-offset-4">
			  <div id="datepicker"></div>
			</div>
		</div>		
		<div class="form-group">
			<label class="col-lg-4 control-label" for="date_Reservation">Choisir une date</label>
			<div class="col-lg-8">
			  <input class="form-control" type="text" id="date_Reservation" name="date_Reservation" required readonly="readonly"/>
			</div>
		</div>		
		<div class="form-group">
			<label class="col-lg-4 control-label" for="timepicker">Choisir un rendez vous</label>
			<div class="col-lg-8">
			  <input class="form-control" type="text" id="timepicker" name="timepicker" required />
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-8 col-lg-offset-4">	
				<input type="button" name="previous" class="previous action-button" value="Previous" /> <input type="submit" name="submit" onclick="insertDateRdv()" class="submit action-button" value="Submit" />  
			</div>
		</div>
		</div>
	</fieldset>
	</div>
	</div>
	</div>
</form>
</body>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/datepicker-fr.js"></script>
	<script src="js/jquery.timepicker.min.js"></script>
	<script src="js/jquery.easing.min.js" type="text/javascript"></script>
    <script  src="js/index.js"></script>
    <script  src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		getDateRdv(); //get rdv depending on speciality with ajax & update calendar
	</script>
<html>

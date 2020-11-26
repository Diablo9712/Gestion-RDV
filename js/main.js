	function fill(json){
		document.getElementById("cin").value = json.cin;
		document.getElementById("nom").value = json.nom;
		document.getElementById("prenom").value = json.prenom;
		dateN = new Date(json.date_n);
		year = dateN.getFullYear();
		month = months_with_leading_zeros(dateN); 
		day = days_with_leading_zeros(dateN);
		document.getElementById("dateN").value = year+"-"+month+"-"+day;
		document.getElementById("tel").value = json.tel;
		document.getElementById("adresse").value = json.adresse;
	}
	
	function minutes_with_leading_zeros(dt){ 
		return (dt.getMinutes() < 10 ? '0' : '') + dt.getMinutes();
	}
	
	function months_with_leading_zeros(dt){ 
		return (dt.getMonth() < 10 ? '0' : '') + (dt.getMonth()+1);
	}
	
	function days_with_leading_zeros(dt){ 
		return (dt.getDate() < 10 ? '0' : '') + dt.getDate();
	}
	
	function getDateRdv(){
		specId = document.getElementById("spec_id").value;
		$(document).ready(function(){
				/*param 
					@String page
					@list of post param
					@function to manipulate result
				*/
				$.post("rdv.php",
				{
				  spec_id: specId
				},
				function(data,status){
					json = JSON.parse(data);
					mainfunction(json);
				});
		});
	}
	
	
	
	function addPatient(){
		cin = document.getElementById("cin").value;
		nom = document.getElementById("nom").value;
		prenom = document.getElementById("prenom").value;
		dateN = document.getElementById("dateN").value;
		tel = document.getElementById("tel").value;
		adresse = document.getElementById("adresse").value;
		window.location.href = "AjouterPatient.php?cin="+cin+"&nom="+nom+"&prenom="+prenom+"&dateN="+dateN+"&tel="+tel+"&adresse="+adresse;
	}
	
	function deletePatient(cin){
		$(function(){
				/*	param
					@String page with get param(optional)
					@function to manipulate result
				*/
				$.get("supprimerPatient.php?cin="+cin,function(data,status){
					console.log(status);
				});
		});
	}
	
/*
	Specialité 
		---Nom specialité
		---Duree de rendez vous === step
		---l'heure de debut de cette specialité
		---l'heure de fin de cette specialité
		----------------Optionel--------------------
		---Ajouter des Jours non disponible dans la semaine (toujours)
		---Ajouter des jours occasionnel non disponible annuelle
		---Possibilité de desactiver un jour au choix calendrier & button desactiver
		
*/
function mainfunction(json){
	
	step = 30; //duree de rendez vous
	start = '8';
	end = '14';
	quantity_rdv = (parseInt(end,10)-parseInt(start,10))*60/step+1;//+1 to add last rdv
	array_rdv = [];//rdv to disable
	array_days = [];//days to disable
	if(!$.isEmptyObject(json)){
		dayToVerify = json[0].date_rdv.substring(0,10);
	}
	counter = 0;
	for (i in json) {
		array_rdv.push(json[i].date_rdv);//building the array of dates
		if(json[i].date_rdv.includes(dayToVerify)){
			counter++;
			if(counter==quantity_rdv)
				array_days.push(json[i].date_rdv.substring(0,10));
		}else{
			dayToVerify = json[i].date_rdv.substring(0,10);
			counter = 1;
		}
	}
	
	$(function() {
		runDatePicker(array_days);
		disableDays(array_days);
	});
	
	function runDatePicker(array){
		//run datepicker : disable previous days & weekends
		$( "#datepicker" ).datepicker({
			minDate: 0,
			firstDay: 1,//set monday
			dateFormat: 'yy-mm-dd'
		});
	}
	
	function disableDays(array){
		$("#datepicker").datepicker('option', {
			beforeShowDay: function(date){
				string = jQuery.datepicker.formatDate('yy-mm-dd', date);
				//disable the days that are full & add class called full to edit style
				if( array.indexOf(string) != -1 )
					return [false,'full'];
				//TODO add param list of dates 
				return $.datepicker.noWeekends(date);
			}
		});
	}
	
	//put selected date on input text && update available rendez vvous
	$(document).on("change", "#datepicker", function () {
		day = $(this).val();
		$("#date_Reservation").val(day);
		runTimePicker(start,end,step);
		timeRanges = getTimeRanges(array_rdv,day,step);
		//timeRanges = [['8', '9'],['13', '14:01']];//param filter the json array by day to disable inavailable rdv 
		disableTimeRanges(timeRanges);
		$("#timepicker").focus();//display timepicker on date Change
	});
	
	function runTimePicker(minTime,maxTime,step){
		$("#timepicker").timepicker({
			'step': step,
			'timeFormat': 'H:i',
			'minTime' : minTime,
			'maxTime' : maxTime,
			'disableTextInput' : true
		});
	}
	
	/*
	ex :
		var timeRanges = [['8', '9'],['13', '14:01']];
		disableTimeRanges(timeRanges);
	*/
	function disableTimeRanges(timeRanges){
		$("#timepicker").timepicker('option', {
			'disableTimeRanges': timeRanges
		});
	}
	
	function getTimeRanges(array_rdv,day,step){
		timeRanges = [];
		today = new Date();
		date = today.getFullYear()+'-'+months_with_leading_zeros(today)+'-'+today.getDate();
		//if day == today disable previous rdv
		if(day==date){
			timeRange = [];
			schedule = '0';//start
			timeRange.push(schedule);
			hour = today.getHours().toString();
			minute = minutes_with_leading_zeros(today).toString();
			schedule = hour.concat(':',minute);//end
			timeRange.push(schedule);
			timeRanges.push(timeRange);
		}
		for (i in array_rdv) {
			 if(array_rdv[i].includes(day)){
				 rdv = new Date(array_rdv[i]);
				 timeRange = [];//init an empty list
				 hour = rdv.getHours().toString();//start
				 minute = minutes_with_leading_zeros(rdv).toString();//start
				 schedule = hour.concat(':',minute);//start
				 timeRange.push(schedule);
				 rdv.setMinutes(rdv.getMinutes() + step);//add step
				 hour = rdv.getHours().toString();//end
				 minute = minutes_with_leading_zeros(rdv).toString();//end
				 schedule = hour.concat(':',minute);//end
				 timeRange.push(schedule);
				 timeRanges.push(timeRange);//add array to array of Arrays
			 }
		}
		return timeRanges;
	}
	
}
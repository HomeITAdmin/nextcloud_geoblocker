var last_used_service_id = 0;
var baseUrl = OC.generateUrl('/apps/geoblocker');

function updateServiceStatus(service_id) {
	$.ajax({
	    url: baseUrl + '/service/status/' + service_id,
	    type: 'GET'
	}).done(function (response) {
		document.getElementById('status-chosen-service').innerHTML=response;
	}).fail(function (response, code) {
		document.getElementById('status-chosen-service').innerHTML=t('geoblocker','Status of the service cannot be determined.');
	});	
}

function updateDatabaseDate(service_id) {
	$.ajax({
	    url: baseUrl + '/service/hasDatabaseDate/' + service_id,
	    type: 'GET'
	}).done(function (response) {
		if (response) {				
			$.ajax({
			    url: baseUrl + '/service/getDatabaseDate/' + service_id,
			    type: 'GET'
			}).done(function (response) {
				document.getElementById('database-date').style.display='block';
				document.getElementById('database-date-string').innerHTML=response;
			}).fail(function (response, code) {
				document.getElementById('database-date').style.display='none';
			});
		} else {
			document.getElementById('database-date').style.display='none';
		}
	}).fail(function (response, code) {
		document.getElementById('database-date').style.display='none';
	});		
}

function updateDatabaseFileLocationExists(service_id) {	
		$.ajax({
		    url: baseUrl + '/service/getDatabaseFileLocation/' + service_id,
		    type: 'GET'
		}).done(function (response) {
			document.getElementById('database-path').style.display='block';
			document.getElementById('database-path-string').value=response;
		}).fail(function (response, code) {
			document.getElementById('database-path').style.display='none';
		});	
}

function updateDatabaseFileLocation(service_id) {
	$.ajax({
	    url: baseUrl + '/service/hasDatabaseFileLocation/' + service_id,
	    type: 'GET'
	}).done(function (response) {
		if (response) {
			updateDatabaseFileLocationExists(service_id);
		} else {
			document.getElementById('database-path').style.display='none';
		}
	}).fail(function (response, code) {
		document.getElementById('database-path').style.display='none';
	});
}

function updateDatabaseUpdate(service_id){
	$.ajax({
	    url: baseUrl + '/service/hasDatabaseUpdate/' + service_id,
	    type: 'GET'
	}).done(function (response) {
		if (response) {
			document.getElementById('database-update').style.display='block';
			updateDatabaseUpdateStatus(service_id);
		} else {
			document.getElementById('database-update').style.display='none';
		}
	}).fail(function (response, code) {
		document.getElementById('database-update').style.display='none';
	});
}

function updateStatusToStringPrefix(status){
	var string_begin = '';	
	switch(status) {
	  case 0:
		string_begin = t('geoblocker','Update not possible. ');
	    break;
	  case 1:
		string_begin = t('geoblocker','Update possible. ');
	    break;
	  case 2:
		string_begin = t('geoblocker','Update running. ');
		break;
	  default:
		string_begin = t('geoblocker','Update undefined. ');
	}
	return string_begin;
}

function delayedUpdateDatabaseStatus(service_id){
	console.log("Test");
	setTimeout(function () {
		if (last_used_service_id == service_id) {
			updateDatabaseUpdateStatus(service_id);
			updateServiceStatus(service_id);
			updateDatabaseDate(service_id);
		}
	}, 10000);
	
}

function updateDatabaseUpdateStatus(service_id){
	$.ajax({
	    url: baseUrl + '/service/getDatabaseUpdateStatus/' + service_id,
	    type: 'GET'
	}).done(function (response) {
		if (response == 1) {
			document.getElementById('database-update-button').disabled=false;
		} else {
			document.getElementById('database-update-button').disabled=true;
			if (response == 2) {
				delayedUpdateDatabaseStatus(service_id);
			}
		}
		updateDatabaseUpdateStatusString(service_id, response);
	}).fail(function (response, code) {
		document.getElementById('database-update-button').disabled=true;
	});
}

function updateDatabaseUpdateStatusString(service_id, status){
	var prefix = updateStatusToStringPrefix(status);
	document.getElementById('database-update-string-prefix').innerHTML=prefix;
	if (status != 1 ) {
		$.ajax({
		    url: baseUrl + '/service/getDatabaseUpdateStatusString/' + service_id,
		    type: 'GET'
		}).done(function (response) {
			if (response) {
				document.getElementById('database-update-string').innerHTML=response;
			} else {
				document.getElementById('database-update-string').innerHTML='';
			}
		}).fail(function (response, code) {
			document.getElementById('database-update-string').innerHTML='';
		}); 
	} else {
		document.getElementById('database-update-string').innerHTML='';
	}
}

function updateConfigurationOptions(service_id) {
	$.ajax({
	    url: baseUrl + '/service/hasConfigurationOption/' + service_id,
	    type: 'GET'
	}).done(function (response) {
		if (response) {
			document.getElementById('service-config').style.display='block';
			updateDatabaseFileLocation(service_id);
			updateDatabaseUpdate(service_id);
		} else {
			document.getElementById('service-config').style.display='none';
		}
	}).fail(function (response, code) {
		document.getElementById('service-config').style.display='none';
	});
}

function updateAllServiceInformation(service_id){
	updateServiceStatus(service_id);		
	updateDatabaseDate(service_id);		
	updateConfigurationOptions(service_id);		
}

function fakeAdressAction(checked) {
	var value = '0';
	if (checked) {
		value = '1';
	}
	OCP.AppConfig.setValue('geoblocker', 'doFakeAddress', value);
	
	var checkinput = new RegExp("^[a-f0-9.:]{6,39}$");
	var fake = document.getElementById('fake-address').value;
	
	if(checkinput.test(fake)) {
		OCP.AppConfig.setValue('geoblocker', 'fakeAddress', fake);
	}else {
		OCP.AppConfig.setValue('geoblocker', 'fakeAddress', '127.0.0.1');
	}
}

$(document).ready(function() {
	$('#log-with-ip-address').click(function() {
		var value = '0';
		if (this.checked) {
			value = '1';
		}
		OCP.AppConfig.setValue('geoblocker', 'logWithIpAddress', value);
	});
	$('#log-with-country-code').click(function() {
		var value = '0';
		if (this.checked) {
			value = '1';
		}
		OCP.AppConfig.setValue('geoblocker', 'logWithCountryCode', value);
	});
	$('#log-with-user-name').click(function() {
		var value = '0';
		if (this.checked) {
			value = '1';
		}
		OCP.AppConfig.setValue('geoblocker', 'logWithUserName', value);
	});
	$('#delaying-active').click(function() {
		var value = '0';
		if (this.checked) {
			value = '1';
		}
		OCP.AppConfig.setValue('geoblocker', 'delayIpAddress', value);
	});
	$('#blocking-active').click(function() {
		var value = '0';
		if (this.checked) {
			value = '1';
		}
		OCP.AppConfig.setValue('geoblocker', 'blockIpAddress', value);
	});
	$('#do-fake-address').click(function() {
		fakeAdressAction(this.checked);
	});
	$('#fake-address').change(function() {
		fakeAdressAction(document.getElementById('do-fake-address').checked);
	});
	
	$('#database-path-string').change(function() {
		var path = this.value;
		service_id = last_used_service_id;
		
		var baseUrl = OC.generateUrl('/apps/geoblocker');
		$.ajax({
		    url: baseUrl + '/service/getUniqueServiceString/' + service_id,
		    type: 'GET'
		}).done(function (response) {
			OCP.AppConfig.setValue('geoblocker', response+'_DatabaseFileLocation', path);
			setTimeout(function () {
					$('#choose-service').change();
		    	}, 1000);
			
		}).fail(function (response, code) {
			console.error('Cannot save database file location!')
		});
	});
	$('#choose-service').change(function() {
		var service_id = this.value;
		last_used_service_id = service_id;
		OCP.AppConfig.setValue('geoblocker',
				 'chosenService'
				 , service_id);
		
		updateAllServiceInformation(service_id);		
	});
	$('#choose-service').change();
	$('#choose-countries').click(function() {
		var countryList = '';
		for (var i = 0; i < this.options.length; i++) {
			if (this.options[i].selected == true) {
				countryList += this.options[i].value + ', ';
			} 
		}
		OCP.AppConfig.setValue('geoblocker',
				 'choosenCountries'
				 , countryList);
		document.getElementById('countryList').innerHTML = countryList;
	});
	$('#choose-white-black-list').click(function() {
		OCP.AppConfig.setValue('geoblocker',
				 'choosenWhiteBlackList'
				 , this.value);		
	});
	$('#database-update-button').click(function() {
		service_id = last_used_service_id;
		var baseUrl = OC.generateUrl('/apps/geoblocker');
		$.ajax({
		    url: baseUrl + '/service/updateDatabase/' + service_id,
		    type: 'GET'
		}).done(function (response) {
			console.log('Update sucessful.');
		}).fail(function (response, code) {
			console.error('Update not sucessful.');
		});
		setTimeout(function () {
			updateAllServiceInformation(service_id);
    	}, 1000);
	});
});

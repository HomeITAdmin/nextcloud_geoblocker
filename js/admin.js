var last_used_service_id = 0;

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
	$('#do-fake-address').click(function() {
		var value = '0';
		if (this.checked) {
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
	});
	$('#fake-address').change(function() {
		var value = '0';
		if (document.getElementById('do-fake-address').checked) {
			value = '1';
		}
		OCP.AppConfig.setValue('geoblocker', 'doFakeAddress', value);
		
		var checkinput = new RegExp("^[a-f0-9.:]{6,39}$");
		var fake = this.value;
		
		if(checkinput.test(fake)) {
			OCP.AppConfig.setValue('geoblocker', 'fakeAddress', fake);
		}else {
			OCP.AppConfig.setValue('geoblocker', 'fakeAddress', '127.0.0.1');
		}
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
		
		var baseUrl = OC.generateUrl('/apps/geoblocker');
		$.ajax({
		    url: baseUrl + '/service/status/' + service_id,
		    type: 'GET'
		}).done(function (response) {
			document.getElementById('status-chosen-service').innerHTML=response;
		}).fail(function (response, code) {
			document.getElementById('status-chosen-service').innerHTML=t('geoblocker','Status of the service cannot be determined.');
		});
		
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
		
		$.ajax({
		    url: baseUrl + '/service/hasConfigurationOption/' + service_id,
		    type: 'GET'
		}).done(function (response) {
			if (response) {
				document.getElementById('service-config').style.display='block';
				$.ajax({
				    url: baseUrl + '/service/hasDatabaseFileLocation/' + service_id,
				    type: 'GET'
				}).done(function (response) {
					if (response) {
						$.ajax({
						    url: baseUrl + '/service/getDatabaseFileLocation/' + service_id,
						    type: 'GET'
						}).done(function (response) {
							document.getElementById('database-path').style.display='block';
							document.getElementById('database-path-string').value=response;
						}).fail(function (response, code) {
							document.getElementById('database-path').style.display='none';
						});
					} else {
						document.getElementById('database-path').style.display='none';
					}
				}).fail(function (response, code) {
					document.getElementById('database-path').style.display='none';
				});
				$.ajax({
				    url: baseUrl + '/service/hasDatabaseUpdate/' + service_id,
				    type: 'GET'
				}).done(function (response) {
					if (response) {
						document.getElementById('database-update').style.display='block';
					} else {
						document.getElementById('database-update').style.display='none';
					}
				}).fail(function (response, code) {
					document.getElementById('database-update').style.display='none';
				});
			} else {
				document.getElementById('service-config').style.display='none';
			}
		}).fail(function (response, code) {
			document.getElementById('service-config').style.display='none';
		});
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
			console.log('Update started sucessfully.');
		}).fail(function (response, code) {
			console.error('Update not started.');
		});
	});
});

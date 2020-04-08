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
	$('#choose-service').change(function() {
		OCP.AppConfig.setValue('geoblocker',
				 'chosenService'
				 , this.value);
		
		var baseUrl = OC.generateUrl('/apps/geoblocker');
		$.ajax({
		    url: baseUrl + '/service/status/' + this.value,
		    type: 'GET'
		}).done(function (response) {
			document.getElementById('status-chosen-service').innerHTML=response;
		}).fail(function (response, code) {
			document.getElementById('status-chosen-service').innerHTML=t('geoblocker','Status of the service cannot be determined.');
		});
		
		$.ajax({
		    url: baseUrl + '/service/hasDBDate/' + this.value,
		    type: 'GET'
		}).done(function (response) {
			if (response) {				
				$.ajax({
				    url: baseUrl + '/service/getDBDate/' + this.value,
				    type: 'GET'
				}).done(function (response) {
					document.getElementById('date-database').style.display='block';
					document.getElementById('date-database-string').innerHTML=response;
				}).fail(function (response, code) {
					document.getElementById('date-database').style.display='none';
				});
			} else {
				document.getElementById('date-database').style.display='none';
			}
		}).fail(function (response, code) {
			document.getElementById('date-database').style.display='none';
		});
		
	});
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
});

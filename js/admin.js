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
	$('#choose-countries').click(function() {
		var countryList = '';
		for (var i = 0; i < this.options.length; i++) {
			if (this.options[i].selected == true) {
				countryList += this.options[i].value + ', ';
				console.log(this.options[i].value);
			} else {
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

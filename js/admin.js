var last_used_service_id = 0;
var baseUrl = OC.generateUrl("/apps/geoblocker");

function updateStatusToStringPrefix(status) {
	var string_begin = "";
	switch (status) {
		case 0:
			string_begin = t("geoblocker", "Update not possible. ");
			break;
		case 1:
			string_begin = t("geoblocker", "Update possible. ");
			break;
		case 2:
			string_begin = t("geoblocker", "Update running. ");
			break;
		default:
			string_begin = t("geoblocker", "Update undefined. ");
	}
	return string_begin;
}

function delayedUpdateDatabaseStatus(service_id) {
	setTimeout(function () {
		if (last_used_service_id == service_id) {
			updateAllServiceInformation(service_id);
		}
	}, 10000);
}

function updateAllServiceInformation(service_id) {
	fetch(baseUrl + "/service/getAllServiceData/" + service_id, {
		method: "GET",
		headers: {
			requesttoken: OC.requestToken,
		},
	})
		.then(function (resp) {
			if (!resp.ok) {
				throw new Error("Request failed with status " + resp.status);
			}
			return resp.json();
		})
		.then(function (response) {
			document.getElementById("status-chosen-service").innerHTML =
				response["status"];
			if (response["hasDatabaseDate"]) {
				document.getElementById("database-date").style.display =
					"block";
				document.getElementById("database-date-string").innerHTML =
					response["getDatabaseDate"];
			} else {
				document.getElementById("database-date").style.display = "none";
			}
			if (response["hasConfigurationOption"]) {
				document.getElementById("service-config").style.display =
					"block";

				if (response["hasDatabaseFileLocation"]) {
					document.getElementById("database-path").style.display =
						"block";
					document.getElementById("database-path-string").value =
						response["getDatabaseFileLocation"];
				} else {
					document.getElementById("database-path").style.display =
						"none";
				}

				if (response["hasDatabaseUpdate"]) {
					document.getElementById("database-update").style.display =
						"block";
					if (response["getDatabaseUpdateStatus"] == 1) {
						document.getElementById(
							"database-update-button",
						).disabled = false;
					} else {
						document.getElementById(
							"database-update-button",
						).disabled = true;
						if (response["getDatabaseUpdateStatus"] == 2) {
							delayedUpdateDatabaseStatus(service_id);
						}
					}
					var prefix = updateStatusToStringPrefix(
						response["getDatabaseUpdateStatus"],
					);
					document.getElementById(
						"database-update-string-prefix",
					).innerHTML = prefix;
					document.getElementById(
						"database-update-string",
					).innerHTML = response["getDatabaseUpdateStatusString"];
				} else {
					document.getElementById("database-update").style.display =
						"none";
				}
			} else {
				document.getElementById("service-config").style.display =
					"none";
			}
		})
		.catch(function (err) {
			document.getElementById("status-chosen-service").innerHTML = t(
				"geoblocker",
				"Status of the service cannot be determined.",
			);
			document.getElementById("database-date").style.display = "none";
			document.getElementById("service-config").style.display = "none";
		});
}

function fakeAddressAction(checked) {
	var value = "0";
	if (checked) {
		value = "1";
	}
	OCP.AppConfig.setValue("geoblocker", "doFakeAddress", value);
	OCP.AppConfig.setValue(
		"geoblocker",
		"fakeAddressUser",
		document.getElementById("fake-address-user").value,
	);

	var checkinput = new RegExp("^[a-f0-9.:]{6,39}$");
	var fake = document.getElementById("fake-address").value;

	if (checkinput.test(fake)) {
		OCP.AppConfig.setValue("geoblocker", "fakeAddress", fake);
	} else {
		OCP.AppConfig.setValue("geoblocker", "fakeAddress", "127.0.0.1");
	}
}

document.addEventListener("DOMContentLoaded", function () {
	document
		.getElementById("log-with-ip-address")
		.addEventListener("click", function () {
			var value = "0";
			if (this.checked) {
				value = "1";
			}
			OCP.AppConfig.setValue("geoblocker", "logWithIpAddress", value);
		});
	document
		.getElementById("log-with-country-code")
		.addEventListener("click", function () {
			var value = "0";
			if (this.checked) {
				value = "1";
			}
			OCP.AppConfig.setValue("geoblocker", "logWithCountryCode", value);
		});
	document
		.getElementById("log-with-user-name")
		.addEventListener("click", function () {
			var value = "0";
			if (this.checked) {
				value = "1";
			}
			OCP.AppConfig.setValue("geoblocker", "logWithUserName", value);
		});
	document
		.getElementById("delaying-active")
		.addEventListener("click", function () {
			var value = "0";
			if (this.checked) {
				value = "1";
			}
			OCP.AppConfig.setValue("geoblocker", "delayIpAddress", value);
		});
	document
		.getElementById("blocking-active")
		.addEventListener("click", function () {
			var value = "0";
			if (this.checked) {
				value = "1";
			}
			OCP.AppConfig.setValue("geoblocker", "blockIpAddress", value);
			OCP.AppConfig.setValue("geoblocker", "blockIpAddressBefore", value);
		});
	document
		.getElementById("do-fake-address")
		.addEventListener("click", function () {
			fakeAddressAction(this.checked);
		});
	document
		.getElementById("fake-address")
		.addEventListener("change", function () {
			fakeAddressAction(
				document.getElementById("do-fake-address").checked,
			);
		});

	document
		.getElementById("database-path-string")
		.addEventListener("change", function () {
			var path = this.value;
			var service_id = last_used_service_id;

			var baseUrl = OC.generateUrl("/apps/geoblocker");
			fetch(baseUrl + "/service/getUniqueServiceString/" + service_id, {
				method: "GET",
				headers: {
					requesttoken: OC.requestToken,
				},
			})
				.then(function (resp) {
					if (!resp.ok) {
						throw new Error(
							"Request failed with status " + resp.status,
						);
					}
					return resp.json();
				})
				.then(function (response) {
					OCP.AppConfig.setValue(
						"geoblocker",
						response + "_DatabaseFileLocation",
						path,
					);
					setTimeout(function () {
						document
							.getElementById("choose-service")
							.dispatchEvent(new Event("change"));
					}, 1000);
				})
				.catch(function (err) {
					console.error("Cannot save database file location!");
				});
		});
	document
		.getElementById("choose-service")
		.addEventListener("change", function () {
			var service_id = this.value;
			last_used_service_id = service_id;
			OCP.AppConfig.setValue("geoblocker", "chosenService", service_id);
			updateAllServiceInformation(service_id);
		});
	document
		.getElementById("choose-service")
		.dispatchEvent(new Event("change"));
	document
		.getElementById("choose-countries")
		.addEventListener("click", function () {
			var countryList = "";
			for (var i = 0; i < this.options.length; i++) {
				if (this.options[i].selected == true) {
					countryList += this.options[i].value + ", ";
				}
			}
			OCP.AppConfig.setValue(
				"geoblocker",
				"choosenCountries",
				countryList,
			);
			document.getElementById("countryList").innerHTML = countryList;
		});
	document
		.getElementById("choose-white-black-list")
		.addEventListener("click", function () {
			OCP.AppConfig.setValue(
				"geoblocker",
				"choosenWhiteBlackList",
				this.value,
			);
		});
	document
		.getElementById("database-update-button")
		.addEventListener("click", function () {
			var service_id = last_used_service_id;
			var baseUrl = OC.generateUrl("/apps/geoblocker");
			fetch(baseUrl + "/service/updateDatabase/" + service_id, {
				method: "GET",
				headers: {
					requesttoken: OC.requestToken,
				},
			})
				.then(function (resp) {
					if (!resp.ok) {
						throw new Error(
							"Request failed with status " + resp.status,
						);
					}
					console.log("Update sucessful.");
				})
				.catch(function (err) {
					console.error("Update not sucessful.");
				});
			setTimeout(function () {
				updateAllServiceInformation(service_id);
			}, 1000);
		});
});

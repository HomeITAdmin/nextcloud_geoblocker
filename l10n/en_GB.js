OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Update not possible. ",
    "Update possible. " : "Update possible. ",
    "Update running. " : "Update running. ",
    "Update undefined. " : "Update undefined. ",
    "Status of the service cannot be determined." : "Status of the service cannot be determined.",
    "No database date available." : "No database date available.",
    "Database file location not available!" : "Database file location not available!",
    "Update Status not available!" : "Update Status not available!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "OK. This service always returns \"%s\" for \"Country not found\".",
    "OK." : "OK.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini.",
    "Date of the database cannot be determined!" : "Date of the database cannot be determined!",
    "local" : "local",
    "default" : "default",
    "ERROR: There is an unknown problem with the service." : "ERROR: There is an unknown problem with the service.",
    "ERROR: Country cannot be found." : "ERROR: Country cannot be found.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s.",
    "ERROR: Invalid Argument." : "ERROR: Invalid Argument.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights.",
    "No entries in the database. Please run update." : "No entries in the database. Please run update.",
    "ERROR:" : "ERROR:",
    "OK" : "OK",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "The database is currently updating. During the update the service can be used with the last valid data.",
    "The last update try ended in an error but the service can be used with the last valid data." : "The last update try ended in an error but the service can be used with the last valid data.",
    "Last error message:" : "Last error message:",
    "PHP GMP Extension needs to be installed." : "PHP GMP Extension needs to be installed.",
    "The database is not initialized. Please run update." : "The database is not initialized. Please run update.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "The database is currently initializing. Please wait until update is finished. This may take several minutes.",
    "The database is corrupted. Please run update again." : "The database is corrupted. Please run update again.",
    "Something is missing." : "Something is missing.",
    "No database available!" : "No database available!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d.",
    "Exception caught during Update for region \"%s\": %s" : "Exception caught during Update for region \"%s\": %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" needs to be allowed in php.ini.",
    "Internet connection needs to be available." : "Internet connection needs to be available.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 is not included on systems with less than 64-bit.",
    "Current number of entries:" : "Current number of entries:",
    "Update in undefined state. Please complain to the developer." : "Update in undefined state. Please complain to the developer.",
    "GeoBlocker" : "GeoBlocker",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side).",
    "Loading" : "Loading",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. ",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Login attempts from local network IP addresses are never blocked, delayed or logged.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address.",
    "If you are accessing from external network, this should be an external IP address:" : "If you are accessing from external network, this should be an external IP address:",
    "is local." : "is local.",
    "is external." : "is external.",
    "Determination of the country from IP address is only as good as the chosen service." : "Determination of the country from IP address is only as good as the chosen service.",
    "For help how to setup the localization services, have a look into the Readme in the" : "For help how to setup the localization services, have a look into the Readme in the",
    "repository" : "repository",
    "Service" : "Service",
    "Choose the service you want to use to determine the country from the IP Address:" : "Choose the service you want to use to determine the country from the IP Address:",
    "Status of the chosen service: " : "Status of the chosen service: ",
    "Date of the database: " : "Date of the database: ",
    "Configuration of the chosen service: " : "Configuration of the chosen service: ",
    "Location of the database (full path including the file name):" : "Location of the database (full path including the file name):",
    "Update Database" : "Update Database",
    "Country Selection" : "Country Selection",
    "Choose the selection mode" : "Choose the selection mode",
    "No country is blocked but the selected ones (blocklist)" : "No country is blocked but the selected ones (blocklist)",
    "All countries are blocked but the selected ones (allowlist)" : "All countries are blocked but the selected ones (allowlist)",
    "Select countries from list" : "Select countries from list",
    "The following countries were selected in the list above: " : "The following countries were selected in the list above: ",
    "Reaction" : "Reaction",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "If a login attempt is detected from the chosen countries, the attempt is logged with the following information",
    "( be aware of data protection issues depending on your logging strategy)" : "( be aware of data protection issues depending on your logging strategy)",
    "with IP Address" : "with IP Address",
    "with Country Code" : "with Country Code",
    "with username" : "with username",
    "In addition, the login attempt can also be delayed and blocked." : "In addition, the login attempt can also be delayed and blocked.",
    "(beta version)" : "(beta version)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Activate delaying of login attempts from IP addresses of the specified countries.",
    "(30 seconds)" : "(30 seconds)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Activate blocking of login attempts from IP addresses of the specified countries.",
    "Test" : "Test",
    "Possibilities to test if the Geoblocker is working as expected:" : "Possibilities to test if the Geoblocker is working as expected:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "Next login attempt of user \"%s\" will be simulated to come from the following IP address:",
    "COUNTRY NOT FOUND" : "COUNTRY NOT FOUND",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "United Arab Emirates",
    "Afghanistan" : "Afghanistan",
    "Antigua and Barbuda" : "Antigua and Barbuda",
    "Anguilla" : "Anguilla",
    "Albania" : "Albania",
    "Armenia" : "Armenia",
    "Angola" : "Angola",
    "Antarctica" : "Antarctica",
    "Argentina" : "Argentina",
    "American Samoa" : "American Samoa",
    "Austria" : "Austria",
    "Australia" : "Australia",
    "Aruba" : "Aruba",
    "Åland Islands" : "Åland Islands",
    "Azerbaijan" : "Azerbaijan",
    "Bosnia and Herzegovina" : "Bosnia and Herzegovina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladesh",
    "Belgium" : "Belgium",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgaria",
    "Bahrain" : "Bahrain",
    "Burundi" : "Burundi",
    "Benin" : "Benin",
    "Saint Barthélemy" : "Saint Barthélemy",
    "Bermuda" : "Bermuda",
    "Brunei Darussalam" : "Brunei Darussalam",
    "Bolivia (Plurinational State of)" : "Bolivia (Plurinational State of)",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, Sint Eustatius and Saba",
    "Brazil" : "Brazil",
    "Bahamas" : "Bahamas",
    "Bhutan" : "Bhutan",
    "Bouvet Island" : "Bouvet Island",
    "Botswana" : "Botswana",
    "Belarus" : "Belarus",
    "Belize" : "Belize",
    "Canada" : "Canada",
    "Cocos (Keeling) Islands" : "Cocos (Keeling) Islands",
    "Congo, Democratic Republic of the" : "Congo, Democratic Republic of the",
    "Central African Republic" : "Central African Republic",
    "Congo" : "Congo",
    "Switzerland" : "Switzerland",
    "Côte d'Ivoire" : "Côte d'Ivoire",
    "Cook Islands" : "Cook Islands",
    "Chile" : "Chile",
    "Cameroon" : "Cameroon",
    "China" : "China",
    "Colombia" : "Colombia",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Cuba",
    "Cabo Verde" : "Cabo Verde",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Christmas Island",
    "Cyprus" : "Cyprus",
    "Czechia" : "Czechia",
    "Germany" : "Germany",
    "Djibouti" : "Djibouti",
    "Denmark" : "Denmark",
    "Dominica" : "Dominica",
    "Dominican Republic" : "Dominican Republic",
    "Algeria" : "Algeria",
    "Ecuador" : "Ecuador",
    "Estonia" : "Estonia",
    "Egypt" : "Egypt",
    "Western Sahara" : "Western Sahara",
    "Eritrea" : "Eritrea",
    "Spain" : "Spain",
    "Ethiopia" : "Ethiopia",
    "Finland" : "Finland",
    "Fiji" : "Fiji",
    "Falkland Islands (Malvinas)" : "Falkland Islands (Malvinas)",
    "Micronesia (Federated States of)" : "Micronesia (Federated States of)",
    "Faroe Islands" : "Faroe Islands",
    "France" : "France",
    "Gabon" : "Gabon",
    "United Kingdom of Great Britain and Northern Ireland" : "United Kingdom of Great Britain and Northern Ireland",
    "Grenada" : "Grenada",
    "Georgia" : "Georgia",
    "French Guiana" : "French Guiana",
    "Guernsey" : "Guernsey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Greenland",
    "Gambia" : "Gambia",
    "Guinea" : "Guinea",
    "Guadeloupe" : "Guadeloupe",
    "Equatorial Guinea" : "Equatorial Guinea",
    "Greece" : "Greece",
    "South Georgia and the South Sandwich Islands" : "South Georgia and the South Sandwich Islands",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinea-Bissau",
    "Guyana" : "Guyana",
    "Hong Kong" : "Hong Kong",
    "Heard Island and McDonald Islands" : "Heard Island and McDonald Islands",
    "Honduras" : "Honduras",
    "Croatia" : "Croatia",
    "Haiti" : "Haiti",
    "Hungary" : "Hungary",
    "Indonesia" : "Indonesia",
    "Ireland" : "Ireland",
    "Israel" : "Israel",
    "Isle of Man" : "Isle of Man",
    "India" : "India",
    "British Indian Ocean Territory" : "British Indian Ocean Territory",
    "Iraq" : "Iraq",
    "Iran (Islamic Republic of)" : "Iran (Islamic Republic of)",
    "Iceland" : "Iceland",
    "Italy" : "Italy",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamaica",
    "Jordan" : "Jordan",
    "Japan" : "Japan",
    "Kenya" : "Kenya",
    "Kyrgyzstan" : "Kyrgyzstan",
    "Cambodia" : "Cambodia",
    "Kiribati" : "Kiribati",
    "Comoros" : "Comoros",
    "Saint Kitts and Nevis" : "Saint Kitts and Nevis",
    "Korea (Democratic People's Republic of)" : "Korea (Democratic People's Republic of)",
    "Korea, Republic of" : "Korea, Republic of",
    "Kuwait" : "Kuwait",
    "Cayman Islands" : "Cayman Islands",
    "Kazakhstan" : "Kazakhstan",
    "Lao People's Democratic Republic" : "Lao People's Democratic Republic",
    "Lebanon" : "Lebanon",
    "Saint Lucia" : "Saint Lucia",
    "Liechtenstein" : "Liechtenstein",
    "Sri Lanka" : "Sri Lanka",
    "Liberia" : "Liberia",
    "Lesotho" : "Lesotho",
    "Lithuania" : "Lithuania",
    "Luxembourg" : "Luxembourg",
    "Latvia" : "Latvia",
    "Libya" : "Libya",
    "Morocco" : "Morocco",
    "Monaco" : "Monaco",
    "Moldova, Republic of" : "Moldova, Republic of",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "Saint Martin (French part)",
    "Madagascar" : "Madagascar",
    "Marshall Islands" : "Marshall Islands",
    "North Macedonia" : "North Macedonia",
    "Mali" : "Mali",
    "Myanmar" : "Myanmar",
    "Mongolia" : "Mongolia",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Northern Mariana Islands",
    "Martinique" : "Martinique",
    "Mauritania" : "Mauritania",
    "Montserrat" : "Montserrat",
    "Malta" : "Malta",
    "Mauritius" : "Mauritius",
    "Maldives" : "Maldives",
    "Malawi" : "Malawi",
    "Mexico" : "Mexico",
    "Malaysia" : "Malaysia",
    "Mozambique" : "Mozambique",
    "Namibia" : "Namibia",
    "New Caledonia" : "New Caledonia",
    "Niger" : "Niger",
    "Norfolk Island" : "Norfolk Island",
    "Nigeria" : "Nigeria",
    "Nicaragua" : "Nicaragua",
    "Netherlands" : "Netherlands",
    "Norway" : "Norway",
    "Nepal" : "Nepal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "New Zealand",
    "Oman" : "Oman",
    "Panama" : "Panama",
    "Peru" : "Peru",
    "French Polynesia" : "French Polynesia",
    "Papua New Guinea" : "Papua New Guinea",
    "Philippines" : "Philippines",
    "Pakistan" : "Pakistan",
    "Poland" : "Poland",
    "Saint Pierre and Miquelon" : "Saint Pierre and Miquelon",
    "Pitcairn" : "Pitcairn",
    "Puerto Rico" : "Puerto Rico",
    "Palestine, State of" : "Palestine, State of",
    "Portugal" : "Portugal",
    "Palau" : "Palau",
    "Paraguay" : "Paraguay",
    "Qatar" : "Qatar",
    "Réunion" : "Réunion",
    "Romania" : "Romania",
    "Serbia" : "Serbia",
    "Russian Federation" : "Russian Federation",
    "Rwanda" : "Rwanda",
    "Saudi Arabia" : "Saudi Arabia",
    "Solomon Islands" : "Solomon Islands",
    "Seychelles" : "Seychelles",
    "Sudan" : "Sudan",
    "Sweden" : "Sweden",
    "Singapore" : "Singapore",
    "Saint Helena, Ascension and Tristan da Cunha" : "Saint Helena, Ascension and Tristan da Cunha",
    "Slovenia" : "Slovenia",
    "Svalbard and Jan Mayen" : "Svalbard and Jan Mayen",
    "Slovakia" : "Slovakia",
    "Sierra Leone" : "Sierra Leone",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somalia",
    "Suriname" : "Suriname",
    "South Sudan" : "South Sudan",
    "Sao Tome and Principe" : "Sao Tome and Principe",
    "El Salvador" : "El Salvador",
    "Sint Maarten (Dutch part)" : "Sint Maarten (Dutch part)",
    "Syrian Arab Republic" : "Syrian Arab Republic",
    "Eswatini" : "Eswatini",
    "Turks and Caicos Islands" : "Turks and Caicos Islands",
    "Chad" : "Chad",
    "French Southern Territories" : "French Southern Territories",
    "Togo" : "Togo",
    "Thailand" : "Thailand",
    "Tajikistan" : "Tajikistan",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Timor-Leste",
    "Turkmenistan" : "Turkmenistan",
    "Tunisia" : "Tunisia",
    "Tonga" : "Tonga",
    "Turkey" : "Turkey",
    "Trinidad and Tobago" : "Trinidad and Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taiwan, Province of China",
    "Tanzania, United Republic of" : "Tanzania, United Republic of",
    "Ukraine" : "Ukraine",
    "Uganda" : "Uganda",
    "United States Minor Outlying Islands" : "United States Minor Outlying Islands",
    "United States of America" : "United States of America",
    "Uruguay" : "Uruguay",
    "Uzbekistan" : "Uzbekistan",
    "Holy See" : "Holy See",
    "Saint Vincent and the Grenadines" : "Saint Vincent and the Grenadines",
    "Venezuela (Bolivarian Republic of)" : "Venezuela (Bolivarian Republic of)",
    "Virgin Islands (British)" : "Virgin Islands (British)",
    "Virgin Islands (U.S.)" : "Virgin Islands (U.S.)",
    "Viet Nam" : "Viet Nam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis and Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Yemen",
    "Mayotte" : "Mayotte",
    "South Africa" : "South Africa",
    "Zambia" : "Zambia",
    "Zimbabwe" : "Zimbabwe"
},
"nplurals=2; plural=(n != 1);");

OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Aktualisierung nicht möglich.",
    "Update possible. " : "Aktualisierung möglich.",
    "Update running. " : "Aktualisierung läuft.",
    "Update undefined. " : "Aktualisierung undefiniert.",
    "Status of the service cannot be determined." : "Der Status des Dienstes konnte nicht festgestellt werden.",
    "No database date available." : "Kein Datenbank-Datum vorhanden.",
    "Database file location not available!" : "Speicherort der Datenbank ist nicht verfügbar!",
    "Update Status not available!" : "Status der Aktualisierung nicht verfügbar!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Dein Versuch, Dich aus dem Land \"%s\" anzumelden, wird von der Nextcloud GeoBlocker App blockiert. Wenn dies für Dich ein Problem darstellt, wende Dich bitte an Deinen Administrator.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "OK. Dieser Dienst gibt immer \"%s\" für \"Land nicht gefunden\" zurück.",
    "OK." : "OK",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "FEHLER: Der Dienst scheint auf dem Host des Nextcloud-Servers nicht installiert, für den Webserver nicht erreichbar zu sein oder ist falsch konfiguriert (ist die Datenbank für IPv4 und IPv6 verfügbar?). Möglicherweise ist die Verwendung der PHP-Funktion exec () in der php.ini deaktiviert. ",
    "Date of the database cannot be determined!" : "Das Datenbank-Datum konnte nicht ermittelt werden.",
    "local" : "Lokal",
    "default" : "Standard",
    "ERROR: There is an unknown problem with the service." : "FEHLER: Es liegt ein unbekanntes Problem mit dem Dienst vor.",
    "ERROR: Country cannot be found." : "FEHLER: Land kann nicht gefunden werden. ",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "FEHLER: Die Datenbank ist nicht gültig, hat nicht die richtigen Zugriffsrechte oder ist nicht auf %s platziert.",
    "ERROR: Invalid Argument." : "FEHLER: Ungültiges Argument",
    "ERROR: \"geoip2.phar\" does not seem to be place correctly or do not have the correct access rights." : "FEHLER: \"geoip2.phar\" scheint nicht richtig platziert zu sein oder die Datei hat nicht die richtigen Zugriffsrechte.",
    "No entries in the database. Please run update." : "Keine Einträge in der Datenbank. Bitte Aktualisierung starten.",
    "ERROR:" : "Fehler:",
    "OK" : "OK",
    "The database is currently updating. During the update the service can be used with the last valid data." : "Die Datenbank wird derzeit aktualisiert, der Dienst kann jedoch während der Aktualisierung mit den zuletzt gültigen Daten verwendet werden.",
    "The last update try ended in an error but the service can be used with the last valid data." : "Der letzte Aktualisierungsversuch endete mit einem Fehler, der Dienst kann jedoch mit den letzten gültigen Daten verwendet werden.",
    "Last error message:" : "Letzte Fehlermeldung:",
    "PHP GMP Extension needs to be installed." : "PHP GMP-Erweiterung muss installiert werden.",
    "The database is not initialized. Please run update." : "Die Datenbank ist nicht initialisiert. Bitte die Aktualisierung erneut ausführen.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "Die Datenbank wird gerade initialisiert. Bitte abwarten, bis die Aktualisierung abgeschlossen ist. Dies kann einige Minuten dauern.",
    "The database is corrupted. Please run update again." : "Die Datenbank ist beschädigt. Bitte die Aktualisierung erneut ausführen.",
    "Something is missing." : "Etwas fehlt.",
    "No database available!" : "Keine Datenbank vorhanden!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "Für die Region %s konnten keine gültigen Einträge gelesen werden. Möglicherweise hat das RIR das Dateiformat geändert.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "Nicht die richtige Anzahl von Einträgen für IPv4 in der Region \"%s\". Sollte %dsein, war ist aber %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "Nicht die richtige Anzahl von Einträgen für IPv6 in der Region \"%s\". Sollte %dsein, war ist aber %d.",
    "Exception caught during Update for region \"%s\": %s" : "Bei der Aktualisierung für Region \"%s\": %sist ein Ausnahmefehler aufgetreten ",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Ungültiges Dateihandle für die Region \"%s\". Wahrscheinlich ist die Internetverbindung während der Aktualisierung abgebrochen.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" muss in php.ini zugelassen werden.",
    "Internet connection needs to be available." : "Internetverbindung muss verfügbar sein.",
    "Current number of entries:" : "Aktuelle Anzahl von Einträgen:",
    "Update in undefined state. Please complain to the developer." : "Aktualisierung hat einen unbekannten Zustand. Bitte kontaktiere den Entwickler.",
    "GeoBlocker" : "GeoBlocker",
    "Blocks user depending on the estimated country of thier IP address." : "Blockt Benutzer abhängig von dem ungefähren Standort seiner IP-Adresse.",
    "Loading" : "Lade",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Dies ist ein Front-End für Geolokalisierungsdienste, mit dem Anmeldeversuche aus bestimmten Ländern blockiert (Beta), verzögert (Beta) und protokolliert werden können.",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Anmeldeversuche von IP-Adressen im lokalen Netzwerk werden nicht blockiert, verzögert oder protokolliert.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Falsche Konfiguration der Nextcloud (insbesondere in Containern) kann dazu führen, dass alle Zugriffe scheinbar von der IP-Adresse des lokalen Netzwerks kommen.",
    "If you are accessing from external network, this should be an external IP address: " : "Wenn Du von einem externen Netzwerk aus zugreifst, sollte dies eine externe Adresse sein: ",
    "is local." : "ist lokal.",
    "is external." : "ist extern.",
    "Determination of the country from IP address is only as good as the chosen service." : "Die Bestimmung des Landes aus der IP-Adresse ist nur so gut wie der gewählte Dienst.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Weitere Informationen zum Einrichten der Lokalisierungsdienste findest Du in der Readme-Datei unter",
    "repository" : "Repository",
    "Service" : "Dienst",
    "Choose the service you want to use to determine the country from the IP Address:" : "Wähle den Dienst, mit dem Du das Land aus der IP-Adresse ermitteln möchtest:",
    "Status of the chosen service: " : "Status des ausgewählten Dienstes: ",
    "Date of the database: " : "Datum der Datenbank:",
    "Configuration of the chosen service: " : "Einrichtung des ausgewählten Dienstes:",
    "Location of the database: " : "Ort der Datenbank:",
    "Update Database" : "Datenbank aktualisieren",
    "Country Selection" : "Länderauswahl",
    "Choose the selection mode" : "Auswahlmethode wählen",
    "No country is blocked but the selected ones (blocklist)" : "Kein Land außer den ausgewählten Ländern ist blockiert (Blockierliste)",
    "All countries are blocked but the selected ones (allowlist)" : "Alle Länder außer den ausgewählten Ländern sind blockiert (Erlaubnisliste)",
    "Select countries from list" : "Länder aus Liste auswählen",
    "The following countries were selected in the list above: " : "Die folgenden Länder wurden in der obigen Liste ausgewählt: ",
    "Reaction" : "Reaktion",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Wenn ein Anmeldeversuch aus den ausgewählten Ländern erkannt wird, wird der Versuch mit den folgenden Informationen protokolliert",
    "( be aware of data protection issues depending on your logging strategy)" : "(Datenschutzprobleme abhängig von der Protokollierungsstrategie beachten) ",
    "with IP Address" : "mit IP-Adresse",
    "with Country Code" : "mit Länderkennung",
    "with username" : "mit Benutzername",
    "In addition, the login attempt can also be delayed and blocked." : "Darüber hinaus kann der Anmeldeversuch auch verzögert und blockiert werden.",
    "(beta version)" : "(Beta-Version)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Verzögerung der Anmeldung von IP-Adressen der angegebenen Länder aktivieren.",
    "(30 seconds)" : "(30 Sekunden)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Sperrung der Anmeldung von IP-Adressen der angegebenen Länder aktivieren.",
    "Test" : "Test",
    "Possibilities to test if the Geoblocker is working as expected:" : "Möglichkeiten um zu Überprüfen, ob der Geoblocker wie erwartet funktioniert:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "Der nächste Login-Versuch des Benutzers \"%s\" wird so simuliert, dass er von der folgenden IP-Adresse kommt:",
    "COUNTRY NOT FOUND" : "LAND NICHT GEFUNDEN",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "Vereinigte Arabische Emirate",
    "Afghanistan" : "Afghanistan",
    "Antigua and Barbuda" : "Antigua und Barbuda",
    "Anguilla" : "Anguilla",
    "Albania" : "Albanien",
    "Armenia" : "Armenien",
    "Angola" : "Angola",
    "Antarctica" : "Antarktis",
    "Argentina" : "Argentinien",
    "American Samoa" : "Amerikanisch-Samoa",
    "Austria" : "Österreich",
    "Australia" : "Australien",
    "Aruba" : "Aruba",
    "Åland Islands" : "Åland Inseln",
    "Azerbaijan" : "Aserbaidschan",
    "Bosnia and Herzegovina" : "Bosnien und Herzegowina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladesch",
    "Belgium" : "Belgien",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgarien",
    "Bahrain" : "Bahrain",
    "Burundi" : "Burundi",
    "Benin" : "Benin",
    "Saint Barthélemy" : "Saint Barthélemy",
    "Bermuda" : "Bermuda",
    "Brunei Darussalam" : "Brunei",
    "Bolivia (Plurinational State of)" : "Bolivien",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, Saba und Sint Eustatius",
    "Brazil" : "Brasilien",
    "Bahamas" : "Bahamas",
    "Bhutan" : "Bhutan",
    "Bouvet Island" : "Bouvetinsel",
    "Botswana" : "Botswana",
    "Belarus" : "Belarus",
    "Belize" : "Belize",
    "Canada" : "Kanada",
    "Cocos (Keeling) Islands" : "Kokosinseln",
    "Congo, Democratic Republic of the" : "Kongo (Demokratische Republik)",
    "Central African Republic" : "Zentralafrikanische Republik",
    "Congo" : "Kongo",
    "Switzerland" : "Schweiz",
    "Côte d'Ivoire" : "Elfenbeinküste",
    "Cook Islands" : "Cookinseln",
    "Chile" : "Chile",
    "Cameroon" : "Kamerun",
    "China" : "China",
    "Colombia" : "Kolumbien",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Kuba",
    "Cabo Verde" : "Kap Verde",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Weihnachtsinsel",
    "Cyprus" : "Zypern",
    "Czechia" : "Tschechien",
    "Germany" : "Deutschland",
    "Djibouti" : "Dschibuti",
    "Denmark" : "Dänemark",
    "Dominica" : "Dominica",
    "Dominican Republic" : "Dominikanische Republik",
    "Algeria" : "Algerien",
    "Ecuador" : "Ekuador",
    "Estonia" : "Estland",
    "Egypt" : "Ägypten",
    "Western Sahara" : "Westsahara",
    "Eritrea" : "Eritrea",
    "Spain" : "Spanien",
    "Ethiopia" : "Äthiopien",
    "Finland" : "Finnland",
    "Fiji" : "Fidschi",
    "Falkland Islands (Malvinas)" : "Falklandinseln",
    "Micronesia (Federated States of)" : "Mikronesien (Föderierte Staaten)",
    "Faroe Islands" : "Färöer",
    "France" : "Frankreich",
    "Gabon" : "Gabun",
    "United Kingdom of Great Britain and Northern Ireland" : "Vereinigtes Königreich Großbritannien und Nordirland",
    "Grenada" : "Grenada",
    "Georgia" : "Georgien",
    "French Guiana" : "Französisch-Guinea",
    "Guernsey" : "Guernsey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Grönland",
    "Gambia" : "Gambia",
    "Guinea" : "Guinea",
    "Guadeloupe" : "Guadeloupe",
    "Equatorial Guinea" : "Äquatorialguinea",
    "Greece" : "Griechenland",
    "South Georgia and the South Sandwich Islands" : "Südgeorgien und die Südlichen Sandwichinseln",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinea-Bissau",
    "Guyana" : "Guyana",
    "Hong Kong" : "Hongkong",
    "Heard Island and McDonald Islands" : "Heard und die McDonaldinseln",
    "Honduras" : "Honduras",
    "Croatia" : "Kroatien",
    "Haiti" : "Haiti",
    "Hungary" : "Ungarn",
    "Indonesia" : "Indonesien",
    "Ireland" : "Irland",
    "Israel" : "Israel",
    "Isle of Man" : "Isle of Man",
    "India" : "Indien",
    "British Indian Ocean Territory" : "Britisches Territorium im Indischen Ozean",
    "Iraq" : "Irak",
    "Iran (Islamic Republic of)" : "Iran",
    "Iceland" : "Island",
    "Italy" : "Italien",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamaika",
    "Jordan" : "Jordanien",
    "Japan" : "Japan",
    "Kenya" : "Kenia",
    "Kyrgyzstan" : "Kirgistan",
    "Cambodia" : "Kambodscha",
    "Kiribati" : "Kiribati",
    "Comoros" : "Komoren",
    "Saint Kitts and Nevis" : "St. Kitts und Nevis",
    "Korea (Democratic People's Republic of)" : "Nordkorea",
    "Korea, Republic of" : "Korea, Republik",
    "Kuwait" : "Kuwait",
    "Cayman Islands" : "Kaimaninseln",
    "Kazakhstan" : "Kasachstan",
    "Lao People's Democratic Republic" : "Laos",
    "Lebanon" : "Libanon",
    "Saint Lucia" : "St. Lucia",
    "Liechtenstein" : "Liechtenstein",
    "Sri Lanka" : "Sri Lanka",
    "Liberia" : "Liberia",
    "Lesotho" : "Lesotho",
    "Lithuania" : "Litauen",
    "Luxembourg" : "Luxemburg",
    "Latvia" : "Lettland",
    "Libya" : "Libyen",
    "Morocco" : "Marokko",
    "Monaco" : "Monaco",
    "Moldova, Republic of" : "Moldawien (Republik)",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "St. Martin",
    "Madagascar" : "Madagaskar",
    "Marshall Islands" : "Marshallinseln",
    "North Macedonia" : "Nordmazedonien",
    "Mali" : "Mali",
    "Myanmar" : "Myanmar",
    "Mongolia" : "Mongolei",
    "Macao" : "Macau",
    "Northern Mariana Islands" : "Nördliche Marianen",
    "Martinique" : "Martinique",
    "Mauritania" : "Mauretanien",
    "Montserrat" : "Montserrat",
    "Malta" : "Malta",
    "Mauritius" : "Mauritius",
    "Maldives" : "Malediven",
    "Malawi" : "Malawi",
    "Mexico" : "Mexiko",
    "Malaysia" : "Malaysia",
    "Mozambique" : "Mosambik",
    "Namibia" : "Namibia",
    "New Caledonia" : "Neukaledonien",
    "Niger" : "Niger",
    "Norfolk Island" : "Norfolkinsel",
    "Nigeria" : "Nigeria",
    "Nicaragua" : "Nicaragua",
    "Netherlands" : "Niederlande",
    "Norway" : "Norwegen",
    "Nepal" : "Nepal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Neuseeland",
    "Oman" : "Oman",
    "Panama" : "Panama",
    "Peru" : "Peru",
    "French Polynesia" : "Französisch-Polynesien",
    "Papua New Guinea" : "Papua-Neuguinea",
    "Philippines" : "Philippinen",
    "Pakistan" : "Pakistan",
    "Poland" : "Polen",
    "Saint Pierre and Miquelon" : "Saint-Pierre und Miquelon",
    "Pitcairn" : "Pitcairninseln",
    "Puerto Rico" : "Puerto Rico",
    "Palestine, State of" : "Palästina",
    "Portugal" : "Portugal",
    "Palau" : "Palau",
    "Paraguay" : "Paraguay",
    "Qatar" : "Katar",
    "Réunion" : "Réunion",
    "Romania" : "Rumänien",
    "Serbia" : "Serbien",
    "Russian Federation" : "Russland",
    "Rwanda" : "Ruanda",
    "Saudi Arabia" : "Saudi-Arabien",
    "Solomon Islands" : "Salomonen",
    "Seychelles" : "Seychellen",
    "Sudan" : "Sudan",
    "Sweden" : "Schweden",
    "Singapore" : "Singapur",
    "Saint Helena, Ascension and Tristan da Cunha" : "St. Helena, Ascension und Tristan da Cunha",
    "Slovenia" : "Slowenien",
    "Svalbard and Jan Mayen" : "Spitzbergen und Jan Mayen",
    "Slovakia" : "Slowakei",
    "Sierra Leone" : "Sierra Leone",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somalia",
    "Suriname" : "Surinam",
    "South Sudan" : "Südsudan",
    "Sao Tome and Principe" : "São Tomé und Príncipe",
    "El Salvador" : "El Salvador",
    "Sint Maarten (Dutch part)" : "Sint Maarten",
    "Syrian Arab Republic" : "Syrien",
    "Eswatini" : "Eswatini",
    "Turks and Caicos Islands" : "Turks- und Caicosinseln",
    "Chad" : "Tschad",
    "French Southern Territories" : "Französische Süd- und Antarktisgebiete",
    "Togo" : "Togo",
    "Thailand" : "Thailand",
    "Tajikistan" : "Tadschikistan",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Osttimor",
    "Turkmenistan" : "Turkmenistan",
    "Tunisia" : "Tunesien",
    "Tonga" : "Tonga",
    "Turkey" : "Türkei",
    "Trinidad and Tobago" : "Trinidad und Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taiwan, Provinz von China",
    "Tanzania, United Republic of" : "Tansania",
    "Ukraine" : "Ukraine",
    "Uganda" : "Uganda",
    "United States Minor Outlying Islands" : "United States Minor Outlying Islands",
    "United States of America" : "Vereinigte Staaten von Amerika",
    "Uruguay" : "Uruguay",
    "Uzbekistan" : "Usbekistan",
    "Holy See" : "Vatikanstadt",
    "Saint Vincent and the Grenadines" : "St. Vincent und die Grenadinen",
    "Venezuela (Bolivarian Republic of)" : "Venezuela",
    "Virgin Islands (British)" : "Jungferninseln (britisch)",
    "Virgin Islands (U.S.)" : "Jungferninseln (U.S.)",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis und Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Jemen",
    "Mayotte" : "Mayotte",
    "South Africa" : "Südafrika",
    "Zambia" : "Sambia",
    "Zimbabwe" : "Simbabwe"
},
"nplurals=2; plural=(n != 1);");

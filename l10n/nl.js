OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Update niet mogelijk.",
    "Update possible. " : "Update mogelijk.",
    "Update running. " : "Update bezig.",
    "Update undefined. " : "Update niet gedefinieerd.. ",
    "Status of the service cannot be determined." : "Status van de dienst kan niet worden bepaald",
    "No database date available." : "Geen database datum beschikbaar",
    "Database file location not available!" : "De bestandslocatie van de database is niet beschikbaar!",
    "Update Status not available!" : "Update Status niet beschikbaar!",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "OK. deze service geeft altijd  \"%s\" terug voor \"Land niet gevonden\".",
    "OK." : "OK.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "FOUT: Service lijkt niet te zijn geïnstalleerd op de host van de Nextcloudserver, of kan niet door de webserver bereikt worden of dat is verkeerd geconfigureerd (is de database met IPv4 en IPv6 bereikbaar?!). Misschien is het gebruik van de php-functie exec() uitgeschakeld in php.ini.",
    "Date of the database cannot be determined!" : "Datum van de database kan niet worden bepaald!",
    "local" : "lokaal",
    "default" : "standaard",
    "No entries in the database. Please run update." : "Geen gegevens in de database. Voer alstublieft een update uit.",
    "ERROR:" : "FOUT:",
    "OK" : "OK",
    "PHP GMP Extension needs to be installed." : "PHP GMP Extensie moet worden geïnstalleerd.",
    "The database is not initialized. Please run update." : "De database is niet geïnitialiseerd. Start de update.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "De database wordt momenteel geïnitialiseerd. Wacht tot de update is voltooid. Dit kan enkele minuten duren.",
    "The database is corrupted. Please run update again." : "De database is corrupt. Start de update opnieuw.",
    "Last error message:" : "Laatste foutmelding:",
    "The database is currently updating, but the service can be used during the update." : "De database wordt momenteel bijgewerkt, maar de service kan worden gebruikt tijdens de update.",
    "Something is missing." : "Er mist iets.",
    "No database available!" : "Geen database beschikbaar",
    "RIR seems to have changed the file format." : "RIR lijkt het bestandsformaat te hebben gewijzigd.",
    "Exception caught during Update:" : "Uitzondering opgetreden tijdens Update:",
    "Invalid file handle. Probably the internet connection got lost during the update." : "Ongeldige bestandsingang. Waarschijnlijk is de internetverbinding verbroken tijdens de update.",
    "Database contains old version information. Reset the database using the command line tool." : "Database bevat oude versie-informatie. Reset de database met behulp van het commandoregelprogramma.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" moet worden toegestaan in php.ini.",
    "Internet connection needs to be available." : "Internetverbinding moet beschikbaar zijn.",
    "Current number of entries:" : "Huidig ​​aantal inzendingen:",
    "Update in undefined state. Please complain to the developer." : "Updatestatus onbekend. Klaag bij de ontwikkelaar.",
    "GeoBlocker" : "GeoBlocker",
    "Blocks user depending on the estimated country of thier IP address." : "Blokkeert een gebruiker op basis van het geschatte land van hun IP-adres.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Dit is een front-end voor geolokalisatiediensten, waarmee inlogpogingen uit gespecificeerde landen kunnen worden geblokkeerd (beta), vertraagd (beta) en geregistreerd.\n\nLanden kunnen worden gespecificeerd met behulp van statoe-lijsten of blokkeerlijsten.\n\nMomenteel beschikbare lokalisatiediensten zijn:\n- Geoiplookup (lokaal programma op de host)\n- MaxMind GeoLite2 (lokale database toegankelijk via PHP API)\n- Gegevens van Regionale Internet Registers (Nextcloud SQL-database opgebouwd met gegevens gedownload van de RIRs FTP-servers)\n\nVoor hulp bij het opzetten van de lokalisatiediensten, lees de GitHub-repository (startpagina aan de rechterkant).",
    "Loading" : "Laden",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Dit is een front-end voor geolokalisatiediensten, waarmee inlogpogingen uit gespecificeerde landen kunnen worden geblokkeerd (beta), vertraagd (beta) en geregistreerd.",
    "Login attempts from local network IP addresses are not reacted on at all." : "Er wordt niet gereageerd op inlogpogingen van lokale netwerkadressen.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Een verkeerde Nextcloud-configuratie (vooral in een container) kan ervoor zorgen dat alle toegangen lijken te komen vanaf een IP-adres uit het lokale netwerk.",
    "If you are accessing from external network, this should be an external IP address: " : "Als je dit benaderd vanaf een extern netwerk, zou dit een extern IP-adres moeten zijn:",
    "is local." : "is lokaal.",
    "is external." : "is extern.",
    "Determination of the country from IP address is only as good as the chosen service." : "Het bepalen van het land met behulp van het IP-adres is slechts zo goed als de gekozen service.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Voor hulp bij het instellen van de lokalisatieservices is er het Leesmij-bestand in het",
    "repository" : "repository",
    "Service" : "Service",
    "Choose the service you want to use to determine the country from the IP Address:" : "Kies de service die je wil gebruiken om het land te bepalen met behulp van het IP-adres:",
    "Status of the chosen service: " : "Status van de gekozen service:",
    "Date of the database: " : "Datum van de database: ",
    "Configuration of the chosen service: " : "Configuratie van de gekozen service:",
    "Location of the database: " : "Locatie van de database:",
    "Update Database" : "Update Database",
    "Country Selection" : "Landselectie",
    "Choose the selection mode" : "Kies de selectiemodus",
    "No country is blocked but the selected ones (blocklist)" : "Geen enkel land is geblokkeerd behalve de geselecteerde (blokkeerlijst)",
    "All countries are blocked but the selected ones (allowlist)" : "Alle landen zijn geblokkeerd behalve de geselecteerde (toegestane lijst)",
    "Select countries from list" : "Selecteer landen uit de lijst",
    "The following countries were selected in the list above: " : "De volgende landen zijn geselecteerd in de bovenstaande lijst:",
    "Reaction" : "Reactie",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Indien een inlogpoging vanuit de gekozen landen wordt gedetecteerd, zal de poging gelogd worden met de volgende informatie",
    "( be aware of data protection issues depending on your logging strategy)" : "(pas op voor problemen met gegevensbescherming afhankelijk van de gekozen loggingstrategie)",
    "with IP Address" : "met IP-adres",
    "with Country Code" : "met landcode",
    "with username" : "met gebruikersnaam",
    "In addition, the login attempt can also be delayed and blocked." : "Bovendien kunnen inlogpogingen worden vertraagd en geblokkeerd.",
    "(beta version)" : "(betaversie)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Inschakelen inlogvertraging voor IP-adressen uit de opgegeven landen.",
    "(Delaying is enforced for 30s before password check.)" : "(Vertraging van 30s vóór de wachtwoordcontrole.)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Inschakelen inlogblokkering voor IP-adressen uit de opgegeven landen.",
    "(Blocking is enforced after password check!)" : "(Blokkade vindt plaats na de wachtwoordcontrole!)",
    "(Blocking is enforced before password check by throwing an \"login denied\" exception!)" : "(Blokkering wordt afgedwongen vóór de wachtwoordcontrole door een uitzondering \"aanmelding geweigerd\" te geven!)",
    "Test" : "Test",
    "Possibilities to test if the Geoblocker is working as expected:" : "Mogelijkheden om te testen of de Geoblocker werkt zoals verwacht:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "Bij de volgende inlogpoging van de gebruiker \"%s\" zal gesimuleerd worden dat deze van het volgende IP-adres komt:",
    "COUNTRY NOT FOUND" : "LAND NIET GEVONDEN",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "Verenigde Arabische Emiraten",
    "Afghanistan" : "Afghanistan",
    "Antigua and Barbuda" : "Antigua en Barbuda",
    "Anguilla" : "Anguilla",
    "Albania" : "Albanië",
    "Armenia" : "Armenië",
    "Angola" : "Angola",
    "Antarctica" : "Antarctica",
    "Argentina" : "Argentinië",
    "American Samoa" : "Amerikaans Samoa",
    "Austria" : "Oostenrijk",
    "Australia" : "Australië",
    "Aruba" : "Aruba",
    "Åland Islands" : "Åland",
    "Azerbaijan" : "Azerbeidjan",
    "Bosnia and Herzegovina" : "Bosnië en Herzegovina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladesh",
    "Belgium" : "België",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgarije",
    "Bahrain" : "Bahrein",
    "Burundi" : "Burundi",
    "Benin" : "Benin",
    "Saint Barthélemy" : "Saint Barthélemy",
    "Bermuda" : "Bermuda",
    "Brunei Darussalam" : "Brunei",
    "Bolivia (Plurinational State of)" : "Bolivia",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, Sint Eustatius en Saba",
    "Brazil" : "Brazilië",
    "Bahamas" : "Bahama's",
    "Bhutan" : "Bhutan",
    "Bouvet Island" : "Bouveteiland",
    "Botswana" : "Botswana",
    "Belarus" : "Wit-Rusland",
    "Belize" : "Belize",
    "Canada" : "Canada",
    "Cocos (Keeling) Islands" : "Cocoseilanden",
    "Congo, Democratic Republic of the" : "Congo, Democratische Republiek",
    "Central African Republic" : "Centraal Afrikaanse Republiek",
    "Congo" : "Congo",
    "Switzerland" : "Zwitserland",
    "Côte d'Ivoire" : "Ivoorkust",
    "Cook Islands" : "Cookeilanden",
    "Chile" : "Chili",
    "Cameroon" : "Kameroen",
    "China" : "China",
    "Colombia" : "Colombia",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Cuba",
    "Cabo Verde" : "Kaapverdië",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Christmaseiland",
    "Cyprus" : "Cyprus",
    "Czechia" : "Tsjechië",
    "Germany" : "Duitsland",
    "Djibouti" : "Djibouti",
    "Denmark" : "Denemarken",
    "Dominica" : "Dominica",
    "Dominican Republic" : "Dominicaanse Republiek",
    "Algeria" : "Algerije",
    "Ecuador" : "Ecuador",
    "Estonia" : "Estland",
    "Egypt" : "Egypte",
    "Western Sahara" : "Westelijke Sahara",
    "Eritrea" : "Eritrea",
    "Spain" : "Spanje",
    "Ethiopia" : "Ethiopië",
    "Finland" : "Finland",
    "Fiji" : "Fiji",
    "Falkland Islands (Malvinas)" : "Falklandeilanden",
    "Micronesia (Federated States of)" : "Micronesië",
    "Faroe Islands" : "Faeröer",
    "France" : "Frankrijk",
    "Gabon" : "Gabon",
    "United Kingdom of Great Britain and Northern Ireland" : "Verenigd Koninkrijk",
    "Grenada" : "Grenada",
    "Georgia" : "Georgië",
    "French Guiana" : "Frans-Guyana",
    "Guernsey" : "Guernsey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Groenland",
    "Gambia" : "Gambia",
    "Guinea" : "Guinea",
    "Guadeloupe" : "Guadeloupe",
    "Equatorial Guinea" : "Equatoriaal Guinea",
    "Greece" : "Griekenland",
    "South Georgia and the South Sandwich Islands" : "Zuid-Georgia en de Zuidelijke Sandwicheilanden",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinea-Bissau",
    "Guyana" : "Guyana",
    "Hong Kong" : "Hong Kong",
    "Heard Island and McDonald Islands" : "Heard en McDonaldeilanden",
    "Honduras" : "Honduras",
    "Croatia" : "Kroatië",
    "Haiti" : "Haïti",
    "Hungary" : "Hongarije",
    "Indonesia" : "Indonesië",
    "Ireland" : "Ierland",
    "Israel" : "Israel",
    "Isle of Man" : "Man (eiland)",
    "India" : "India",
    "British Indian Ocean Territory" : "Brits Indische Oceaanterritorium",
    "Iraq" : "Irak",
    "Iran (Islamic Republic of)" : "Iran",
    "Iceland" : "IJsland",
    "Italy" : "Italië",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamaica",
    "Jordan" : "Jordanië",
    "Japan" : "Japan",
    "Kenya" : "Kenia",
    "Kyrgyzstan" : "Kirgizië",
    "Cambodia" : "Cambodja",
    "Kiribati" : "Kiribati",
    "Comoros" : "Komoren",
    "Saint Kitts and Nevis" : "Saint Kitts and Nevis",
    "Korea (Democratic People's Republic of)" : "Noord-Korea",
    "Korea, Republic of" : "Korea, Republiek",
    "Kuwait" : "Koeweit",
    "Cayman Islands" : "Kaaimaneilanden",
    "Kazakhstan" : "Kazachstan",
    "Lao People's Democratic Republic" : "Laos",
    "Lebanon" : "Libanon",
    "Saint Lucia" : "Saint Lucia",
    "Liechtenstein" : "Liechtenstein",
    "Sri Lanka" : "Sri Lanka",
    "Liberia" : "Liberia",
    "Lesotho" : "Lesotho",
    "Lithuania" : "Litouwen",
    "Luxembourg" : "Luxemburg",
    "Latvia" : "Letland",
    "Libya" : "Libië",
    "Morocco" : "Marokko",
    "Monaco" : "Monaco",
    "Moldova, Republic of" : "Moldavië, Republiek",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "Saint Martin",
    "Madagascar" : "Madagascar",
    "Marshall Islands" : "Marshalleilanden",
    "North Macedonia" : "Noord-Macedonië",
    "Mali" : "Mali",
    "Myanmar" : "Myanmar",
    "Mongolia" : "Mongolië",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Noordelijke Marianen",
    "Martinique" : "Martinique",
    "Mauritania" : "Mauretanië",
    "Montserrat" : "Montserrat",
    "Malta" : "Malta",
    "Mauritius" : "Mauritius",
    "Maldives" : "Malediven",
    "Malawi" : "Malawi",
    "Mexico" : "Mexico",
    "Malaysia" : "Maleisië",
    "Mozambique" : "Mozambique",
    "Namibia" : "Namibië",
    "New Caledonia" : "Nieuw Caledonië",
    "Niger" : "Niger",
    "Norfolk Island" : "Norfolk {eiland)",
    "Nigeria" : "Nigeria",
    "Nicaragua" : "Nicaragua",
    "Netherlands" : "Nederland",
    "Norway" : "Noorwegen",
    "Nepal" : "Nepal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Nieuw Zeeland",
    "Oman" : "Oman",
    "Panama" : "Panama",
    "Peru" : "Peru",
    "French Polynesia" : "Frans-Polynesië",
    "Papua New Guinea" : "Papoea-Nieuw-Guinea",
    "Philippines" : "Filippijnen",
    "Pakistan" : "Pakistan",
    "Poland" : "Polen",
    "Saint Pierre and Miquelon" : "Saint-Pierre en Miquelon",
    "Pitcairn" : "Pitcairn",
    "Puerto Rico" : "Puerto Rico",
    "Palestine, State of" : "Palestina",
    "Portugal" : "Portugal",
    "Palau" : "Palau",
    "Paraguay" : "Paraguay",
    "Qatar" : "Katar",
    "Réunion" : "Réunion",
    "Romania" : "Roemenië",
    "Serbia" : "Servië",
    "Russian Federation" : "Russische Federatie",
    "Rwanda" : "Rwanda",
    "Saudi Arabia" : "Saoedi-Arabië",
    "Solomon Islands" : "Salomonseilanden",
    "Seychelles" : "Seychellen",
    "Sudan" : "Soedan",
    "Sweden" : "Zweden",
    "Singapore" : "Singapore",
    "Saint Helena, Ascension and Tristan da Cunha" : "Sint-Helena, Ascension en Tristan da Cunha",
    "Slovenia" : "Slovenië",
    "Svalbard and Jan Mayen" : "Spitsbergen en Jan Mayen",
    "Slovakia" : "Slowakije",
    "Sierra Leone" : "Sierra Leone",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somalië",
    "Suriname" : "Suriname",
    "South Sudan" : "Zuid-Soedan",
    "Sao Tome and Principe" : "Sao Tomé en Principe",
    "El Salvador" : "El Salvador",
    "Sint Maarten (Dutch part)" : "Sint Maarten",
    "Syrian Arab Republic" : "Syrië",
    "Eswatini" : "Eswatini",
    "Turks and Caicos Islands" : "Turks- en Caicoseilanden",
    "Chad" : "Tsjaad",
    "French Southern Territories" : "Franse Zuidelijke en Antarctische Gebieden",
    "Togo" : "Togo",
    "Thailand" : "Thailand",
    "Tajikistan" : "Tadzjikistan",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Oost-Timor",
    "Turkmenistan" : "Turkmenistan",
    "Tunisia" : "Tunisië",
    "Tonga" : "Tonga",
    "Turkey" : "Turkije",
    "Trinidad and Tobago" : "Trinidad en Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taiwan",
    "Tanzania, United Republic of" : "Tanzania",
    "Ukraine" : "Oekraine",
    "Uganda" : "Oeganda",
    "United States Minor Outlying Islands" : "Kleine afgelegen eilanden van de Verenigde Staten",
    "United States of America" : "Verenigde Staten van Amerika",
    "Uruguay" : "Uruguay",
    "Uzbekistan" : "Oezbekistan",
    "Holy See" : "Heilige Stoel",
    "Saint Vincent and the Grenadines" : "Saint Vincent en de Grenadines",
    "Venezuela (Bolivarian Republic of)" : "Venezuela",
    "Virgin Islands (British)" : "Britse Maagdeneilanden",
    "Virgin Islands (U.S.)" : "Amerikaanse Maagdeneilanden",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis en Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Jemen",
    "Mayotte" : "Mayotte",
    "South Africa" : "Zuid-Afrika",
    "Zambia" : "Zambia",
    "Zimbabwe" : "Zimbabwe"
},
"nplurals=2; plural=(n != 1);");

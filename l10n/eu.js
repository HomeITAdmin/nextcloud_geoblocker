OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Eguneratzea ez da posible.",
    "Update possible. " : "Eguneratzea egin daiteke.",
    "Update running. " : "Eguneratzea exekutatzen.",
    "Update undefined. " : "Eguneratzea zehaztu gabe.",
    "Status of the service cannot be determined." : "Ezin da zehaztu zerbitzuaren egoera.",
    "No database date available." : "Ez dago datu-baserik eskuragarri.",
    "Database file location not available!" : "Datu-base fitxategiaren kokalekua ez dago eskuragarri!",
    "Update Status not available!" : "Eguneratze egoera ez dago eskuragarri!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Nextcloud Geoblocker App bidez blokeatu egin da  \"%s\" herrialdetik saioa hasteko egin duzun saiakera. Hau zuretzat arazo baldin bada, jakinarazi administratzaileari.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "ADOS. Zerbitzu honek beti \"%s\" ematen dio \"Ez da aurkitu herrialdea\"-ri.",
    "OK." : "Ados.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ERROREA: Zerbitzua antza denez ez dago Nextcloud zerbitzarian ostalarian instalatuta, ezin da atzitu edo gaizki konfiguratuta dago (IPv4 eta IPv6-(r)entzako datu-basea erabilgarri al dago?). Beharbada php funtzioaren exec() desgaituta dago php.ini -(a)n.",
    "Date of the database cannot be determined!" : "Ezin da zehaztu datu-basearen data!",
    "local" : "lokala",
    "default" : "lehenetsia",
    "ERROR: There is an unknown problem with the service." : "ERROREA: arazo ezezagun bat dago zerbitzuarekin.",
    "ERROR: Country cannot be found." : "ERROREA: herrialdea ezin da aurkitu.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "ERROREA: datu-basea baliogabea da, beharrezko sarbide baimenak falta zaizkio edo ez dago %s(e)n kokatuta. ",
    "ERROR: Invalid Argument." : "ERROREA: argumentu baliogabea.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "ERROREA: \"geoip2.phar\" ez dago kokaleku egokian edo ez dauzka beharrezko sarbide baimenak.",
    "No entries in the database. Please run update." : "Ez dago sarrerarik datu-basean. Exekutatu eguneratzea. ",
    "ERROR:" : "ERROREA:",
    "OK" : "Ados",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 soilik 64-bit sistemetan (edo handiagoetan) dabil. Sistema 64-bitera bertsio-berritzean, gogoratu DB berriro eguneratzeaz.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "Datu-basea une honetan eguneratzen ari da. Zerbitzua eguneraketaren zehar erabili daiteke azken baliozko datuekin.",
    "The last update try ended in an error but the service can be used with the last valid data." : "Azken eguneraketa errore batekin amaitu zen, baina zerbitzua erabil daiteke azken baliozko datuekin.",
    "Last error message:" : "Azken errore mezua:",
    "PHP GMP Extension needs to be installed." : "PHP GMP luzapena instalatu behar da.",
    "The database is not initialized. Please run update." : "Datu-basea abiarazi gabe dago. Exekutatu eguneratzea.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "Datu-basea abiarazten ari da orain. Itxaron eguneratzea amaitzen den arte. Baliteke minutu batzuk behar izatea.",
    "The database is corrupted. Please run update again." : "Datu-basea hondatuta dago. Exekutatu eguneratzea berriro.",
    "Something is missing." : "Zerbait falta da.",
    "No database available!" : "Ez dago datu-baserik eskuragarri!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "Ezin da \"%s\" eremuan baliozko sarrerarik irakurri. Beharbada RIR-ak fitxategi formatu aldaketa bat egin du.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "Ez da IPv4 zenbaki kopuru zuzena irakurri \"%s\" eremuan. %d izan behar zuten eta %d zeuden.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "Ez da IPv6 zenbaki kopuru zuzena irakurri \"%s\" eremuan. %d izan behar zuten eta %d zeuden.",
    "Exception caught during Update for region \"%s\": %s" : "Salbuespena topatu da \"%s\" eremua eguneratzean: %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Fitxategi helduleku baliogabea \"%s\" atalerako. Seguru aski internet konexioa galdu egin da eguneraketaren zehar.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" onartu behar da php.ini -(a)n.",
    "Internet connection needs to be available." : "Internet konexioa erabilgarri egotea beharrezkoa da.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 ez da onartzen 64-bit baino txikiagoko sistemetan.",
    "Current number of entries:" : "Une honetako sarrera kopurua:",
    "Update in undefined state. Please complain to the developer." : "Eguneratzea egoera zehaztugabean. Bidali kexa garatzaileari, mesedez.",
    "GeoBlocker" : "GeoBlocker",
    "Blocks user depending on the estimated country of thier IP address." : "Erabiltzailea blokeatzen du, bere IP helbideari suposatzen zaion herrialdearen arabera.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Geokokatze zerbitzuetarako front-end bat da hau, aukera ematen duena zehazturiko herrialdeetako saio-haste saiakerak blokeatzeko (beta), atzeratzeko (beta) eta saiakeren erregistroa gordetzeko.\nSare lokaleko IP helbideen saio haste saiakerak ez dira inoiz blokeatu, atzeratu edo erregistratzen.\nUneko inplementazioan, saioa hasteko orria berdin agertzen zaio jende guztiari, dagoen herrialdean dagoela. Existitzen ez den erabiltzaile batekin saioa hasteko saiakerek ere modu arruntean ematen dute errorea.\nNextcloud gaizki konfiguratzeak (bereziki edukitzaile batean) eragin dezake atzitze guztiak hartzea sare lokaleko IP helbideak balira bezala.\nIP helbideen herrialdeak zehazteko kalitatea, aukeratu den zerbitzuaren araberakoa izango da.\n\nHerrialdeak allowlist edo blocklist bidez zehaztu daitezke.\n\nUne honetan eskuragarri dauden kokatze zerbitzuak hauek dira:\n- Geoiplookup (programa lokala ostalarian)\n- MaxMind GeoLite2 (datu-base lokala PHP API bidez atzitua)\n- Regional Internet Registries bidezko datuak (Nextcloud SQL datu-basea, RIR-en FTP zerbitzarietatik deskargatutako datuekin eraikia)\n\nGeo-kokatze zerbitzuak nola konfiguratu ikasteko joan GitHub biltegira (hasiera orrian, eskuinean).",
    "Loading" : "Kargatzen",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Geokokatze zerbitzuetarako front-end bat da hau, aukera ematen duena zehazturiko herrialdeetako saio-haste saiakerak blokeatzeko (beta), atzeratzeko (beta) eta saiakeren erregistroa gordetzeko.",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Sare lokaleko IP helbideen saio hasteak ez dira inoiz blokeatzen, luzetzen edo erregistratzen.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "Uneko inplementazioan, saioa hasteko orria berdin agertzen zaio jende guztiari, dagoen herrialdean dagoela. Existitzen ez den erabiltzaile batekin saioa hasteko saiakerek ere modu arruntean ematen dute errorea.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Nextcloud gaizki konfiguratzeak (bereziki edukitzaile batean) eragin dezake atzitze guztiak hartzea sare lokaleko IP helbideak balira bezala.",
    "If you are accessing from external network, this should be an external IP address:" : "Kanpoko sare batetik sartzen ari bazara, kanpoko IP helbidea izan beharko luke:",
    "is local." : "lokala da.",
    "is external." : "kanpokoa da.",
    "Determination of the country from IP address is only as good as the chosen service." : "IP helbideen herrialdeak ondo zehaztea, aukeratu den zerbitzuaren araberakoa izango da.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Kokatze zerbitzuak konfiguratzeko laguntza lortzeko, begiratu Readme",
    "repository" : "biltegian",
    "Service" : "Zerbitzua",
    "Choose the service you want to use to determine the country from the IP Address:" : "Aukeratu zein zerbitzu nahi duzun, IP helbidearen baitan herrialdea zehazteko:",
    "Status of the chosen service: " : "Aukeratu den zerbitzuaren egoera:",
    "Date of the database: " : "Datu-basearen data:",
    "Configuration of the chosen service: " : "Aukeratu den zerbitzuaren konfigurazioa:",
    "Location of the database (full path including the file name):" : "Datu-basearen kokapena (bide izen osoa fitxategi izena barne):",
    "Update Database" : "Eguneratu datu-basea",
    "Country Selection" : "Herrialde hautaketa",
    "Choose the selection mode" : "Aukeratu hautaketa modua",
    "No country is blocked but the selected ones (blocklist)" : "Ez dago herrialderik blokeatuta, hautatu direnak izan ezik (blocklist)",
    "All countries are blocked but the selected ones (allowlist)" : "Herrialde guztiak daude blokeatuta, onartzen direnak izan ezik (allowlist)",
    "Select countries from list" : "Aukeratu herrialdeak zerrendatik",
    "The following countries were selected in the list above: " : "Ondorengo herrialdeak hautatu dira goiko zerrendan:",
    "Reaction" : "Erreakzioa",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Hautaturiko herrialde batetik saioa hasteko saiakera baldin badago, erregistratu egiten da ondorengo informazioarekin",
    "( be aware of data protection issues depending on your logging strategy)" : "(kontuz datu babes arazoekin, zure saio-hasiera estrategiaren arabera)",
    "with IP Address" : "IP helbidearekin",
    "with Country Code" : "Herrialde-kodearekin",
    "with username" : "erabiltzaile-izenarekin",
    "In addition, the login attempt can also be delayed and blocked." : "Gainera, saioa hasteko saiakera atzeratu edo blokeatu egin daiteke.",
    "(beta version)" : "(beta bertsioa)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Aktibatu saio-hasiera atzerapena zehazturiko herrialdeetako IP helbideei.",
    "(30 seconds)" : "(30 segundo)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Aktibatu saio-hasiera blokeatzea zehazturiko herrialdeetako IP helbideei.",
    "Test" : "Proba",
    "Possibilities to test if the Geoblocker is working as expected:" : "Geoblocker espero bezala dabilen aztertzeko aukerak:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "\"%s\" erabiltzailearen saioa hasteko hurrengo saiakera IP helbide honetatik datorrela simulatuko da:",
    "COUNTRY NOT FOUND" : "EZ DA HERRIALDEA AURKITU",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "Arabiar Emirerri Batuak",
    "Afghanistan" : "Afganistan",
    "Antigua and Barbuda" : "Antigua eta Barbuda",
    "Anguilla" : "Aingira",
    "Albania" : "Albaniera",
    "Armenia" : "Armenia",
    "Angola" : "Angola",
    "Antarctica" : "Antartika",
    "Argentina" : "Argentina",
    "American Samoa" : "Samoa Estatubatuarra",
    "Austria" : "Austria",
    "Australia" : "Australia",
    "Aruba" : "Aruba",
    "Åland Islands" : "Aland Uharteak",
    "Azerbaijan" : "Azerbaijan",
    "Bosnia and Herzegovina" : "Bosnia-Herzegovina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladesh",
    "Belgium" : "Belgika",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgaria",
    "Bahrain" : "Bahrain",
    "Burundi" : "Burundi",
    "Benin" : "Benin",
    "Saint Barthélemy" : "Saint Barthélemy",
    "Bermuda" : "Bermuda",
    "Brunei Darussalam" : "Brunei",
    "Bolivia (Plurinational State of)" : "Boliviako Estatu Plurinazionala",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, San Eustakio eta Saba",
    "Brazil" : "Brasil",
    "Bahamas" : "Bahamak",
    "Bhutan" : "Bhutan",
    "Bouvet Island" : "Bouvet uhartea",
    "Botswana" : "Botswana",
    "Belarus" : "Bielorrusia",
    "Belize" : "Belize",
    "Canada" : "Kanada",
    "Cocos (Keeling) Islands" : "Cocos (Keeling) uharteak",
    "Congo, Democratic Republic of the" : "Kongoko Errepublika Demokratikoa",
    "Central African Republic" : "Afrika Erdiko Errepublika",
    "Congo" : "Kongo",
    "Switzerland" : "Suitza",
    "Côte d'Ivoire" : "Boli Kosta",
    "Cook Islands" : "Cook uharteak",
    "Chile" : "Txile",
    "Cameroon" : "Kamerun",
    "China" : "Txina",
    "Colombia" : "Kolombia",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Kuba",
    "Cabo Verde" : "Cabo Verde",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Christmas uhartea",
    "Cyprus" : "Zipre",
    "Czechia" : "Txekia",
    "Germany" : "Alemania",
    "Djibouti" : "Djibuti",
    "Denmark" : "Danimarka",
    "Dominica" : "Dominika",
    "Dominican Republic" : "Dominikar Errepublika",
    "Algeria" : "Algeria",
    "Ecuador" : "Ekuador",
    "Estonia" : "Estonia",
    "Egypt" : "Egipto",
    "Western Sahara" : "Mendebaldeko Sahara",
    "Eritrea" : "Eritrea",
    "Spain" : "Espainia",
    "Ethiopia" : "Etiopia",
    "Finland" : "Finlandia",
    "Fiji" : "Fiji",
    "Falkland Islands (Malvinas)" : "Falkland uharteak (Malvinak)",
    "Micronesia (Federated States of)" : "Mikronesiako Estatu Federatuak",
    "Faroe Islands" : "Faroe uharteak",
    "France" : "Frantzia",
    "Gabon" : "Gabon",
    "United Kingdom of Great Britain and Northern Ireland" : "Britainia Handiko eta Ipar Irlandako Erresuma Batua",
    "Grenada" : "Grenada",
    "Georgia" : "Georgia",
    "French Guiana" : "Guyana Frantsesa",
    "Guernsey" : "Guernesey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Groenlandia",
    "Gambia" : "Gambia",
    "Guinea" : "Ginea",
    "Guadeloupe" : "Guadalupe",
    "Equatorial Guinea" : "Ekuatore Ginea",
    "Greece" : "Grezia",
    "South Georgia and the South Sandwich Islands" : "Hegoaldeko Georgia eta Hegoaldeko Sandwich uharteak",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Ginea Bissau",
    "Guyana" : "Guyana",
    "Hong Kong" : "Hong Kong",
    "Heard Island and McDonald Islands" : "Heard eta McDonald uharteak",
    "Honduras" : "Honduras",
    "Croatia" : "Kroazia",
    "Haiti" : "Haiti",
    "Hungary" : "Hungaria",
    "Indonesia" : "Indonesia",
    "Ireland" : "Irlanda",
    "Israel" : "Israel",
    "Isle of Man" : "Man uhartea",
    "India" : "India",
    "British Indian Ocean Territory" : "Indiako Ozeanoko Britainiar Lurraldea",
    "Iraq" : "Irak",
    "Iran (Islamic Republic of)" : "Irango Islamiar Errepublika",
    "Iceland" : "Islandia",
    "Italy" : "Itali",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamaika",
    "Jordan" : "Jordania",
    "Japan" : "Japonia",
    "Kenya" : "Kenya",
    "Kyrgyzstan" : "Kirgizistan",
    "Cambodia" : "Kanbodia",
    "Kiribati" : "Kiribati",
    "Comoros" : "Komoreak",
    "Saint Kitts and Nevis" : "Saint Kitts eta Nevis",
    "Korea (Democratic People's Republic of)" : "Koreako Herri Errepublika Demokratikoa",
    "Korea, Republic of" : "Koreako Errepublika",
    "Kuwait" : "Kuwait",
    "Cayman Islands" : "Kaiman uharteak",
    "Kazakhstan" : "Kazakhstan",
    "Lao People's Democratic Republic" : "Laosko Herri Errepublika Demokratikoa",
    "Lebanon" : "Libano",
    "Saint Lucia" : "Santa Luzia",
    "Liechtenstein" : "Liechtestein",
    "Sri Lanka" : "Sri Lanka",
    "Liberia" : "Liberia",
    "Lesotho" : "Lesotho",
    "Lithuania" : "Lituania",
    "Luxembourg" : "Luxemburg",
    "Latvia" : "Letonia",
    "Libya" : "Libia",
    "Morocco" : "Maroko",
    "Monaco" : "Monako",
    "Moldova, Republic of" : "Moldaviako Errepublika",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "San Martin (Frantziako eremua)",
    "Madagascar" : "Madagaskar",
    "Marshall Islands" : "Marshall uharteak",
    "North Macedonia" : "Ipar Mazedonia",
    "Mali" : "Mali",
    "Myanmar" : "Myanmar",
    "Mongolia" : "Mongolia",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Mariana uharteak",
    "Martinique" : "Martinika",
    "Mauritania" : "Mauritania",
    "Montserrat" : "Montserrat",
    "Malta" : "Malta",
    "Mauritius" : "Maurizio",
    "Maldives" : "Maldivak",
    "Malawi" : "Malawi",
    "Mexico" : "Mexiko",
    "Malaysia" : "Malaysia",
    "Mozambique" : "Mozambike",
    "Namibia" : "Namibia",
    "New Caledonia" : "Kaledonia Berria",
    "Niger" : "Niger",
    "Norfolk Island" : "Norfolk uhartea",
    "Nigeria" : "Nigeria",
    "Nicaragua" : "Nikaragua",
    "Netherlands" : "Herbehereak",
    "Norway" : "Norvegia",
    "Nepal" : "Nepal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Zeelanda berria",
    "Oman" : "Oman",
    "Panama" : "Panama",
    "Peru" : "Peru",
    "French Polynesia" : "Polinesia Frantsesa",
    "Papua New Guinea" : "Papua Ginea Berria",
    "Philippines" : "Filipinak",
    "Pakistan" : "Pakistan",
    "Poland" : "Polonia",
    "Saint Pierre and Miquelon" : "Saint-Pierre eta Mikelune",
    "Pitcairn" : "Pitcairn uharteak",
    "Puerto Rico" : "Puerto Rico",
    "Palestine, State of" : "Palestinako Estatua",
    "Portugal" : "Portugal",
    "Palau" : "Palau",
    "Paraguay" : "Paraguai",
    "Qatar" : "Qatar",
    "Réunion" : "Réunion",
    "Romania" : "Errumania",
    "Serbia" : "Serbia",
    "Russian Federation" : "Errusiar Federakundea",
    "Rwanda" : "Ruanda",
    "Saudi Arabia" : "Saudi Arabia",
    "Solomon Islands" : "Salomon Uharteak",
    "Seychelles" : "Seychelleak",
    "Sudan" : "Sudan",
    "Sweden" : "Suedia",
    "Singapore" : "Singapur",
    "Saint Helena, Ascension and Tristan da Cunha" : "Santa Helena, Ascension eta Tristan da Cunha",
    "Slovenia" : "Eslovenia",
    "Svalbard and Jan Mayen" : "Svalbard eta Jan Mayen uharteak",
    "Slovakia" : "Eslovakia",
    "Sierra Leone" : "Sierra Leona",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somalia",
    "Suriname" : "Surinam",
    "South Sudan" : "Hego Sudan",
    "Sao Tome and Principe" : "Sao Tome eta Principe",
    "El Salvador" : "El Salvador",
    "Sint Maarten (Dutch part)" : "Sint Maarten (Alemaniako eremua)",
    "Syrian Arab Republic" : "Siriako Arabiar Errepublika",
    "Eswatini" : "Eswatini",
    "Turks and Caicos Islands" : "Turk eta Caico uharteak",
    "Chad" : "Txad",
    "French Southern Territories" : "Hegoaldeko lurralde frantsesak",
    "Togo" : "Togo",
    "Thailand" : "Thailandia",
    "Tajikistan" : "Tajikistan",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Ekialdeko Timor",
    "Turkmenistan" : "Turkmenistan",
    "Tunisia" : "Tunisia",
    "Tonga" : "Tonga",
    "Turkey" : "Turkia",
    "Trinidad and Tobago" : "Trinidad eta Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taiwan",
    "Tanzania, United Republic of" : "Tanzaniako Errepublika Batua",
    "Ukraine" : "Ukraina",
    "Uganda" : "Uganda",
    "United States Minor Outlying Islands" : "Ameriketako Estatu Batuetako itsasoz haraindiko uharteak",
    "United States of America" : "Ameriketako Estatu Batuak",
    "Uruguay" : "Uruguai",
    "Uzbekistan" : "Uzbekistan",
    "Holy See" : "Vatikanoa",
    "Saint Vincent and the Grenadines" : "Saint Vincent eta Grenadinak",
    "Venezuela (Bolivarian Republic of)" : "Venezuelako Bolibartar Errepublika",
    "Virgin Islands (British)" : "Birjina uharteak (britainiarrak)",
    "Virgin Islands (U.S.)" : "Birjina uharteak (amerikarrak)",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis eta Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Yemen",
    "Mayotte" : "Mayotte",
    "South Africa" : "Hegoafrika",
    "Zambia" : "Zambia",
    "Zimbabwe" : "Zimbabwe"
},
"nplurals=2; plural=(n != 1);");

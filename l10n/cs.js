OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Aktualizace není možná.",
    "Update possible. " : "Aktualizace možná.",
    "Update running. " : "Spuštěna aktualizace. ",
    "Update undefined. " : "Aktualizace nedefinována.",
    "Status of the service cannot be determined." : "Stav služby se nedaří zjistit.",
    "No database date available." : "Není k dispozici žádné datum databáze.",
    "Database file location not available!" : "Umístění souboru s databází není dostupné.",
    "Update Status not available!" : "Stav aktualizace není k dispozici!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Váš pokus o přihlášení ze země „%s“ je blokován Nextcloud aplikací GeoBlocker. Pokud s tím máte problém, obraťte se na správce.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "OK. Tato služba vždy vrátí „%s“ pro „Země nebyla nalezena“.",
    "OK." : "OK.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "CHYBA: zdá se, že služba není nainstalována na hostiteli Nextcloud serveru nebo není dosažitelná pro webový server nebo není správně nastavená (je k dispozici databáze pro IPv4 a IPv6?!). Možná je také v souboru s nastaveními php.ini vypnutá funkce exec().",
    "Date of the database cannot be determined!" : "Datum databáze se nedaří zjistit!",
    "local" : "místní",
    "default" : "výchozí",
    "ERROR: There is an unknown problem with the service." : "CHYBA: Neznámý problém se službou.",
    "ERROR: Country cannot be found." : "CHYBA: Země nenalezena.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "CHYBA: Problém s databází. Nejsou nastavená potřebná oprávnění nebo není uložena na %s.",
    "ERROR: Invalid Argument." : "CHYBA: Neplatný argument.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "CHYBY: zdá se, že soubor „geoip2.phar“ není správně umístěn nebo k němu nejsou nastavena správně přístupová práva.",
    "No entries in the database. Please run update." : "Žádné položky v databázi. Prosím spusťte aktualizaci.",
    "ERROR:" : "CHYBA:",
    "OK" : "OK",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 funguje pouze na 64bit (nebo vyšším) systémech. Při aktualizaci systému na 64bit nezapomeňte znovu aktualizovat databázi.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "Databáze se nyní aktualizuje. V průběhu aktualizace je možné službu používat s naposledy platnými daty.",
    "The last update try ended in an error but the service can be used with the last valid data." : "Minulý pokus o aktualizaci skončil chybou, ale službu je možné používat s posledními platnými daty.",
    "Last error message:" : "Poslední chybová zpráva:",
    "PHP GMP Extension needs to be installed." : "Je třeba, aby bylo nainstalované rozšíření PHP GMP.",
    "The database is not initialized. Please run update." : "Databáze není inicializována. Prosím spusťte aktualizaci.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "Databáze se v tuto chvíli inicializuje. Prosím vyčkejte do dokončení aktualizace. To může trvat několik minut.",
    "The database is corrupted. Please run update again." : "Databáze je poškozená. Prosím spusťte aktualizaci znovu.",
    "Something is missing." : "Něco chybí.",
    "No database available!" : "Není k dispozici žádná databáze!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "Pro oblast „%s“ nebyly nalezeny žádné platné položky. Možná RIR změnilo formát souboru.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "Načten nesprávný počet položek pro IPv4 v oblasti „%s“. Mělo být %d ale bylo %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "Načten nesprávný počet položek pro IPv6 v oblasti „%s“. Mělo být %d ale bylo %d.",
    "Exception caught during Update for region \"%s\": %s" : "Zachycena výjimka v průběhu aktualizace pro oblast „%s“: %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Neplatná obsluha souboru pro oblast „%s“. Pravděpodobně při aktualizaci došlo k výpadku připojení k Internetu.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "v php.ini je třeba povolit „allow_url_fopen“.",
    "Internet connection needs to be available." : "Je třeba, aby bylo k dispozici připojení k Internetu.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 není obsaženo na systémech, které jsou méně než 64-bit.",
    "Current number of entries:" : "Stávající počet položek:",
    "Update in undefined state. Please complain to the developer." : "Aktualizace v nedefinovaném stavu. Prosím obraťte se na vývojáře.",
    "GeoBlocker" : "Geoblokace",
    "Blocks user depending on the estimated country of their IP address." : "Blokuje uživatele v závislosti na odhadované zemi podle jejich IP adresy.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Toto je rozhraní pro geo lokalizační služby, které umožňuje blokování (beta), zpoždění (beta) a protokolování pokusů o přihlášení ze zadaných zemí.\nPokusy o přihlášení z IP adres z místní sítě nejsou nikdy blokovány, pozdrženy či zaznamenány.\nVe stávající implementaci je přihlašovací stránka zobrazeno komukoliv, nezávisle na státu. Také pokusy o přihlášení neexistujícím uživatelským účtem se nezdaří jako obvykle, nezávisle na státu.\nNesprávná nastavení Nextcloud (hlavně v kontejneru) mohou vést k tomu, že veškerý přístup se bude jevit jako přicházející z IP adres z místní sítě.\nZjišťování státu z IP adresy funguje jen tak dobře, jak kvalitní údaje poskytuje zvolená služba.\n\nZemě lze určit pomocí seznamu povolených nebo blokovaných.\n\nAktuálně dostupné lokalizační služby jsou:\n- Geoiplookup (místní program na hostiteli)\n- MaxMind GeoLite2 (lokální databáze přístupná přes PHP API)\n- Data z regionálních internetových registrů (databáze SQL Nextcloud se vytváří s daty staženými ze serverů RIRs FTP)\n\nNápovědu k nastavení lokalizačních služeb najdete v úložišti GitHub (domovská stránka na pravé straně).",
    "Loading" : "Načítání",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Toto je nadstavba nad geolokačními službami, která umožňuje blokování (ve zkušebním režimu), prodlužování (dtto) a zaznamenávání pokusů o přihlašování z určených zemí..",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Pokusy o přihlášení z IP adres v místní síti nejsou nikdy blokovány, zpožďovány nebo zaznamenávány.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "Ve stávající implementaci je přihlašovací stránka běžně zobrazeno komukoliv, nezávisle na státu. Také pokusy o přihlášení s neexistujícím uživatelem se nezdaří jako obvykle, nezávisle na státu.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Nesprávné nastavení Nextcloud (zejména v kontejneru) může vést k tomu, že veškerý přístup se bude jevit přicházet z IP adresy v místní síti.",
    "If you are accessing from external network, this should be an external IP address:" : "Pokud přistupujete z vnější sítě, toto by měla být externí IP adresa:",
    "is local." : "je místní.",
    "is external." : "je vnější.",
    "Determination of the country from IP address is only as good as the chosen service." : "Zjišťování země na základě IP adresy je pouze tak dobré, jaká je pro to zvolená služba.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Pokyny k tomu, jak nastavit služby pro určování polohy, naleznete v souboru Readme v",
    "repository" : "repozitář",
    "Service" : "Služba",
    "Choose the service you want to use to determine the country from the IP Address:" : "Zvolte službu, kterou chcete použít pro zjištění země na základě IP adresy:",
    "Status of the chosen service: " : "Stav zvolené služby: ",
    "Date of the database: " : "Datum databáze: ",
    "Configuration of the chosen service: " : "Nastavení zvolené služby:",
    "Location of the database (full path including the file name):" : "Umístění databáze (úplný popis umístění včetně názvu souboru):",
    "Update Database" : "Zaktualizovat databázi",
    "Country Selection" : "Výběr země",
    "Choose the selection mode" : "Zvolte režim výběru",
    "No country is blocked but the selected ones (blocklist)" : "Není blokována žádná země kromě těch, které jste označili (seznam vyloučených)",
    "All countries are blocked but the selected ones (allowlist)" : "Blokovány jsou všechny země kromě těch, které jste označili (seznam povolených)",
    "Select countries from list" : "Vyberte země ze seznamu",
    "The following countries were selected in the list above: " : "Ve výše uvedeném seznamu byly vybrány následující země:",
    "Reaction" : "Reakce",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Pokud je zjištěn pokus o přihlášení ze zvolených zemí, pokus je zaznamenán společně s následující informací",
    "( be aware of data protection issues depending on your logging strategy)" : "(pozor na problémy s ochranou osobních údajů v závislosti na tom, jak zaznamenáváte údaje)",
    "with IP Address" : "s IP adresou",
    "with Country Code" : "s kódem země",
    "with username" : "s uživatelským jménem",
    "In addition, the login attempt can also be delayed and blocked." : "Krom toho, může být pokus o přihlášení také zpožděn a zablokován.",
    "(beta version)" : "(beta verze)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Aktivovat zpožďování pokusů o přihlášení z IP adres patřících vybraným zemím.",
    "(30 seconds)" : "(30 sekund)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Aktivovat blokování pokusů o přihlášení z IP adres patřících vybraným zemím.",
    "Test" : "Vyzkoušet",
    "Possibilities to test if the Geoblocker is working as expected:" : "Možnosti jak vyzkoušet, zda Geoblocker funguje dle očekávání:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "Příští pokus o přihlášení uživatele „%s“ bude simulován jako by přicházel z následující IP adresy:",
    "COUNTRY NOT FOUND" : "ZEMĚ NENALEZENA",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "Spojené Arabské Emiráty",
    "Afghanistan" : "Afgánistán",
    "Antigua and Barbuda" : "Antigua a Barbuda",
    "Anguilla" : "Anguilla",
    "Albania" : "Albánie",
    "Armenia" : "Arménie",
    "Angola" : "Angola",
    "Antarctica" : "Antarktida",
    "Argentina" : "Argentina",
    "American Samoa" : "Americká Samoa",
    "Austria" : "Rakousko",
    "Australia" : "Austrálie",
    "Aruba" : "Aruba",
    "Åland Islands" : "Alandy",
    "Azerbaijan" : "Ázerbájdžán",
    "Bosnia and Herzegovina" : "Bosna a Hercegovina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladéš",
    "Belgium" : "Belgie",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulharsko",
    "Bahrain" : "Bahrajn",
    "Burundi" : "Burundi",
    "Benin" : "Benin",
    "Saint Barthélemy" : "Svatý Bartoloměj",
    "Bermuda" : "Bermudy",
    "Brunei Darussalam" : "Brunej",
    "Bolivia (Plurinational State of)" : "Bolívie",
    "Bonaire, Sint Eustatius and Saba" : "Karibské Nizozemsko",
    "Brazil" : "Brazílie",
    "Bahamas" : "Bahamy",
    "Bhutan" : "Bhútán",
    "Bouvet Island" : "Bouvetův ostrov",
    "Botswana" : "Botswana",
    "Belarus" : "Bělorusko",
    "Belize" : "Belize",
    "Canada" : "Kanada",
    "Cocos (Keeling) Islands" : "Kokosové ostrovy",
    "Congo, Democratic Republic of the" : "Kongo",
    "Central African Republic" : "Středoafrická republika",
    "Congo" : "Kongo",
    "Switzerland" : "Švýcarsko",
    "Côte d'Ivoire" : "Pobřeží slonoviny",
    "Cook Islands" : "Cookovy ostrovy",
    "Chile" : "Chile",
    "Cameroon" : "Kamerun",
    "China" : "Čína",
    "Colombia" : "Kolumbie",
    "Costa Rica" : "Kostarika",
    "Cuba" : "Kuba",
    "Cabo Verde" : "Kapverdy",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Vánoční ostrov",
    "Cyprus" : "Kypr",
    "Czechia" : "Česko",
    "Germany" : "Německo",
    "Djibouti" : "Džibutsko",
    "Denmark" : "Dánsko",
    "Dominica" : "Dominika",
    "Dominican Republic" : "Dominikánská republika",
    "Algeria" : "Alžír",
    "Ecuador" : "Ekvádor",
    "Estonia" : "Estonsko",
    "Egypt" : "Egypt",
    "Western Sahara" : "Západní Sahara",
    "Eritrea" : "Eritrea",
    "Spain" : "Španělsko",
    "Ethiopia" : "Etiopie",
    "Finland" : "Finsko",
    "Fiji" : "Fidži",
    "Falkland Islands (Malvinas)" : "Falklandské ostrovy (Malvíny)",
    "Micronesia (Federated States of)" : "Mikronésie",
    "Faroe Islands" : "Faerské ostrovy",
    "France" : "Francie",
    "Gabon" : "Gabon",
    "United Kingdom of Great Britain and Northern Ireland" : "Spojené království Velké Británie a Severního Irska",
    "Grenada" : "Grenada",
    "Georgia" : "Gruzie",
    "French Guiana" : "Francouzská Guyana",
    "Guernsey" : "Guernsey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Grónsko",
    "Gambia" : "Gambie",
    "Guinea" : "Guinea",
    "Guadeloupe" : "Guadeloupe",
    "Equatorial Guinea" : "Rovníková Guinea",
    "Greece" : "Řecko",
    "South Georgia and the South Sandwich Islands" : "Jižní Georgie a Jižní Sandwichovy ostrovy",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinea-Bissau",
    "Guyana" : "Guyana",
    "Hong Kong" : "Hongkong",
    "Heard Island and McDonald Islands" : "Heardův ostrov a McDonaldovy ostrovy",
    "Honduras" : "Honduras",
    "Croatia" : "Chorvatsko",
    "Haiti" : "Haiti",
    "Hungary" : "Maďarsko",
    "Indonesia" : "Indonézie",
    "Ireland" : "Irsko",
    "Israel" : "Izrael",
    "Isle of Man" : "Man",
    "India" : "Indie",
    "British Indian Ocean Territory" : "Britské indickooceánské území",
    "Iraq" : "Irák",
    "Iran (Islamic Republic of)" : "Írán",
    "Iceland" : "Island",
    "Italy" : "Itálie",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamajka",
    "Jordan" : "Jordánsko",
    "Japan" : "Japonsko",
    "Kenya" : "Keňa",
    "Kyrgyzstan" : "Kyrgyzstán",
    "Cambodia" : "Kambodža",
    "Kiribati" : "Kiribati",
    "Comoros" : "Komory",
    "Saint Kitts and Nevis" : "Svatý Kryštof a Nevis",
    "Korea (Democratic People's Republic of)" : "Severní Korea (KLDR)",
    "Korea, Republic of" : "Jižní Korea",
    "Kuwait" : "Kuvajt",
    "Cayman Islands" : "Kajmanské ostrovy",
    "Kazakhstan" : "Kazachstán",
    "Lao People's Democratic Republic" : "Laos",
    "Lebanon" : "Libanon",
    "Saint Lucia" : "Svatá Lucie",
    "Liechtenstein" : "Lichnštejnsko",
    "Sri Lanka" : "Srí Lanka",
    "Liberia" : "Libérie",
    "Lesotho" : "Lesotho",
    "Lithuania" : "Litva",
    "Luxembourg" : "Lucembursko",
    "Latvia" : "Lotyšsko",
    "Libya" : "Libye",
    "Morocco" : "Maroko",
    "Monaco" : "Monako",
    "Moldova, Republic of" : "Moldávie",
    "Montenegro" : "Černá Hora",
    "Saint Martin (French part)" : "Svatý Martin (francouzská část)",
    "Madagascar" : "Madagaskar",
    "Marshall Islands" : "Maršalovy ostrovy",
    "North Macedonia" : "Severní Makedonie",
    "Mali" : "Mali",
    "Myanmar" : "Barma",
    "Mongolia" : "Mongolsko",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Severní Mariany",
    "Martinique" : "Martinik",
    "Mauritania" : "Mauritánie",
    "Montserrat" : "Montserrat",
    "Malta" : "Malta",
    "Mauritius" : "Maurícius",
    "Maldives" : "Maledivy",
    "Malawi" : "Malawi",
    "Mexico" : "Mexiko",
    "Malaysia" : "Malajsie",
    "Mozambique" : "Mozambik",
    "Namibia" : "Nambie",
    "New Caledonia" : "Nová Kaledonie",
    "Niger" : "Niger",
    "Norfolk Island" : "Norfolk",
    "Nigeria" : "Nigérie",
    "Nicaragua" : "Nikaragua",
    "Netherlands" : "Nizozemí",
    "Norway" : "Norsko",
    "Nepal" : "Nepál",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Nový Zéland",
    "Oman" : "Omán",
    "Panama" : "Panama",
    "Peru" : "Peru",
    "French Polynesia" : "Francouzská Polynésie",
    "Papua New Guinea" : "Papua-Nová Guinea",
    "Philippines" : "Filipíny",
    "Pakistan" : "Pakistán",
    "Poland" : "Polsko",
    "Saint Pierre and Miquelon" : "Saint-Pierre a Miquelon",
    "Pitcairn" : "Pitcairnovy ostrovy",
    "Puerto Rico" : "Portoriko",
    "Palestine, State of" : "Palestina",
    "Portugal" : "Portugalsko",
    "Palau" : "Palau",
    "Paraguay" : "Paraguay",
    "Qatar" : "Katar",
    "Réunion" : "Réunion",
    "Romania" : "Rumunsko",
    "Serbia" : "Srbsko",
    "Russian Federation" : "Ruská federace",
    "Rwanda" : "Rwanda",
    "Saudi Arabia" : "Saudská Arábie",
    "Solomon Islands" : "Šalamounovy ostrovy",
    "Seychelles" : "Seychely",
    "Sudan" : "Súdán",
    "Sweden" : "Švédsko",
    "Singapore" : "Singapur",
    "Saint Helena, Ascension and Tristan da Cunha" : "Svatá Helena",
    "Slovenia" : "Slovinsko",
    "Svalbard and Jan Mayen" : "Špicberky a Jan Mayen",
    "Slovakia" : "Slovensko",
    "Sierra Leone" : "Sierra Leone",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somálsko",
    "Suriname" : "Surinam",
    "South Sudan" : "Jižní Súdán",
    "Sao Tome and Principe" : "Svatý Tomáš a Princův ostrov",
    "El Salvador" : "Salvador",
    "Sint Maarten (Dutch part)" : "Svatý Martin (nizozemská část)",
    "Syrian Arab Republic" : "Sýrie",
    "Eswatini" : "Svazijsko",
    "Turks and Caicos Islands" : "Turks a Caicos",
    "Chad" : "Čad",
    "French Southern Territories" : "Francouzská jižní a antarktická území",
    "Togo" : "Togo",
    "Thailand" : "Thajsko",
    "Tajikistan" : "Tádžikistán",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Východní Timor",
    "Turkmenistan" : "Turkmenistán",
    "Tunisia" : "Tunisko",
    "Tonga" : "Tonga",
    "Turkey" : "Turecko",
    "Trinidad and Tobago" : "Trinidad a Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Tchaj-wan (provincie)",
    "Tanzania, United Republic of" : "Tanzanie",
    "Ukraine" : "Ukrajina",
    "Uganda" : "Uganda",
    "United States Minor Outlying Islands" : "Menší odlehlé ostrovy Spojených států amerických",
    "United States of America" : "Spojené státy americké",
    "Uruguay" : "Uruguay",
    "Uzbekistan" : "Uzbekistán",
    "Holy See" : "Svatý stolec",
    "Saint Vincent and the Grenadines" : "Svatý Vincenc a Grenadiny",
    "Venezuela (Bolivarian Republic of)" : "Venezuela",
    "Virgin Islands (British)" : "Britské Panenské ostrovy",
    "Virgin Islands (U.S.)" : "Americké Panenské ostrovy",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis a Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Jemen",
    "Mayotte" : "Mayotte",
    "South Africa" : "Jihoafrická republika",
    "Zambia" : "Zambie",
    "Zimbabwe" : "Zimbabwe"
},
"nplurals=4; plural=(n == 1 && n % 1 == 0) ? 0 : (n >= 2 && n <= 4 && n % 1 == 0) ? 1: (n % 1 != 0 ) ? 2 : 3;");

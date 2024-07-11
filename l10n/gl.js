OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Non é posíbel actualizar.",
    "Update possible. " : "É posíbel a actualización.",
    "Update running. " : "Executando a actualización.",
    "Update undefined. " : "Sen definir a actualización.",
    "Status of the service cannot be determined." : "Non foi posíbel determinar o estado do servizo.",
    "No database date available." : "Non está dispoñíbel a data da base de datos.",
    "Database file location not available!" : "Non está dispoñíbel a localización do ficheiro da base de datos.",
    "Update Status not available!" : "Non está dispoñíbel o estado da actualización!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "O seu intento de iniciar sesión dende «%s»  está bloqueado pola aplicación Nextcloud GeoBlocker. Se isto é un problema para Vde. póñase en contacto coa administración desta instancia..",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "De acordo. Este servizo sempre devolve «%s» para «País non atopado».",
    "OK." : "Aceptar",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ERRO: Semella que o servizo non está instalado no servidor de Nextcloud ou non é accesíbel para o servidor web ou está mal configurado (está dispoñíbel a base de datos para IPv4 e IPv6 ?!). Quizais estea desactivado o uso da función de PHP exec() en php.ini.",
    "Date of the database cannot be determined!" : "Non foi posíbel determinar a data da base datos!",
    "local" : "local",
    "default" : "predeterminado",
    "ERROR: There is an unknown problem with the service." : "ERRO: hai un problema descoñecido co servizo.",
    "ERROR: Country cannot be found." : "ERRO: non é posíbel atopar o país.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "ERRO: a base de datos non é válida, non ten os permisos de acceso correctos ou non está situada en %s.",
    "ERROR: Invalid Argument." : "ERRO: Argumento incorrecto.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "ERRO: «geoip2.phar» non parece estar colocado correctamente ou non ten os permisos de acceso correctos.",
    "No entries in the database. Please run update." : "Non hai entradas na base de datos. Execute a actualización.",
    "ERROR:" : "ERRO:",
    "OK" : "Aceptar",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 só funciona en sistemas de 64 bits (ou superior). Ao actualizar o sistema a 64 bits, lembre volver actualizar a base de datos.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "A base de datos está a actualizarse. Durante a actualización o servizo pódese utilizar cos últimos datos válidos.",
    "The last update try ended in an error but the service can be used with the last valid data." : "O último intento de actualización rematou cun erro, mais o servizo pódese utilizar cos últimos datos válidos.",
    "Last error message:" : "Última mensaxe de erro:",
    "PHP GMP Extension needs to be installed." : "É necesario instalar a extensión PHP GMP.",
    "The database is not initialized. Please run update." : "A base de datos non está iniciada. Execute a actualización.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "A base de datos está iniciándose. Agarde ata que remate a actualización. Pode levar varios minutos.",
    "The database is corrupted. Please run update again." : "Abase de datos está estragada. Volva executar a actualización.",
    "Something is missing." : "Falta algo.",
    "No database available!" : "Non hai ningunha base de datos dispoñíbel!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "Non foi posíbel ler entradas válidas para a rexión «%s». Quizais o RIR cambiou o formato do ficheiro.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "Non é o número correcto de entradas lidas para IPv4 na rexión «%s». Debería ser %d mais foi %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "Non é o número correcto de entradas lidas para IPv6 na rexión «%s». Debería ser %d mais foi %d.",
    "Exception caught during Update for region \"%s\": %s" : "Excepción capturada durante a actualización para a rexión «%s»: %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Non hai un controlador de ficheiro válido para a rexión «%s». Probabelmente se perdeu a conexión a Internet durante a actualización.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "Ten que estar permitido «allow_url_fopen» en php.ini.",
    "Internet connection needs to be available." : "Debe estar dispoñíbel a conexión a Internet.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 non está incluído nos sistemas con menos de 64 bits.",
    "Current number of entries:" : "Número actual de entradas:",
    "Update in undefined state. Please complain to the developer." : "A actualización atopase nun estado sen definir. Reclame ao desenvolvedor.",
    "GeoBlocker" : "GeoBlocker",
    "Blocks user depending on the estimated country of thier IP address." : "Bloquea o usuario segundo o país estimado do seu enderezo IP.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Esta é unha interface para servizos de xeolocalización, que permite bloquear (beta), atrasar (beta) e rexistrar intentos de acceso de países especificados.\nOs intentos de acceso dende os enderezos IP da rede local nunca se bloquean, se atrasan nin se rexistran.\nNa implementación actual, a páxina de acceso amosase normalmente a todos, independentemente do país. Tamén os intentos de acceso cun usuario non existente están a fallar como é habitual independentemente do país.\nUnha configuración incorrecta de Nextcloud (especialmente no contedor) pode provocar que todo o acceso pareza proceder do enderezo IP da rede local.\nA determinación do país a partir do enderezo IP só é tan boa como o servizo escollido.\n\nOs países pódense especificar mediante listas permitidas ou listas bloqueadas.\n\nOs servizos de localización dispoñíbeis actualmente son:\n– Geoiplookup (programa local na máquina do servidor)\n– MaxMind GeoLite2 (base de datos local accesíbel a través da API de PHP)\n– Datos dos rexistros rexionais de Internet (base de datos SQL de Nextcloud creada con datos descargados dos servidores FTP de RIR)\n\nPara obter axuda sobre como configurar os servizos de localización, bótelle unha ollada ao repositorio de GitHub (páxina do proxecto no lado dereito).",
    "Loading" : "Cargando",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Esta é unha interface para os servizos de localización xeográfica, que permite o bloqueo (beta), o atraso (beta) e o rexistro dos intentos de acceso de países especificados.",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Os intentos de acceso dende os enderezos IP da rede local nunca se bloquean, se atrasan nin se rexistran.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "Na implementación actual, a páxina de acceso amosase normalmente a todos, independentemente do país. Tamén os intentos de acceso cun usuario non existente están a fallar como é habitual independentemente do país.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "A configuración errónea  de Nextcloud (especialmente nun contedor) pode levar a que todo o acceso poida proceder do enderezo IP da rede local.",
    "If you are accessing from external network, this should be an external IP address:" : "Se está accedendo dende a rede externa, este debería ser un enderezo IP externo:",
    "is local." : "é local.",
    "is external." : "é externo.",
    "Determination of the country from IP address is only as good as the chosen service." : "A determinación do país a partir do enderezo IP é tan bo como o servizo escollido.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Para obter axuda sobre como configurar os servizos de localización, bótelle unha ollada ao ficheiro Léeme (Readme) no",
    "repository" : "repositorio",
    "Service" : "Servizo",
    "Choose the service you want to use to determine the country from the IP Address:" : "Escolla o servizo que quere usar para determinar o país a partir do enderezo IP:",
    "Status of the chosen service: " : "Estado do servizo escollido:",
    "Date of the database: " : "Data da base de datos:",
    "Configuration of the chosen service: " : "Configuración do servizo escollido:",
    "Location of the database (full path including the file name):" : "Localización da base de datos (ruta completa incluíndo o nome do ficheiro):",
    "Update Database" : "Actualizar a base de datos",
    "Country Selection" : "Selección do país",
    "Choose the selection mode" : "Escoller o modo de selección",
    "No country is blocked but the selected ones (blocklist)" : "Non se bloqueou ningún país agás os seleccionados (lista de bloqueo)",
    "All countries are blocked but the selected ones (allowlist)" : "Bloquéanse todos os países, agás os seleccionados (lista permitida)",
    "Select countries from list" : "Seleccionar países da lista",
    "The following countries were selected in the list above: " : "Na lista anterior foron seleccionados os seguintes países:",
    "Reaction" : "Reacción",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Se se detecta un intento de acceso dende os países escollidos, o intento rexístrase coa seguinte información",
    "( be aware of data protection issues depending on your logging strategy)" : "(teña en conta os problemas de protección de datos dependendo da súa estratexia de rexistro)",
    "with IP Address" : "co enderezo IP",
    "with Country Code" : "co código de país",
    "with username" : "co nome de usuario",
    "In addition, the login attempt can also be delayed and blocked." : "Ademais, tamén se pode atrasar e bloquear o intento de acceso.",
    "(beta version)" : "(versión beta)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Activar o atraso do intento de acceso dende os enderezos IP dos países especificados.",
    "(30 seconds)" : "(30 segundos)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Activar o bloqueo dos intentos de acceso dende os enderezos IP dos países especificados.",
    "Test" : "Proba",
    "Possibilities to test if the Geoblocker is working as expected:" : "Posibilidades de probar se GeoBlocker funciona tal e como se agarda:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "O seguinte intento de acceso de «%s» vai ser simulado como procedente do seguinte enderezo IP:",
    "COUNTRY NOT FOUND" : "PAÍS NON ATOPADO",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "Emiratos Árabes Unidos",
    "Afghanistan" : "Afganistán",
    "Antigua and Barbuda" : "Antiga e Barbuda",
    "Anguilla" : "Anguila",
    "Albania" : "Albania",
    "Armenia" : "Armenia",
    "Angola" : "Angola",
    "Antarctica" : "Antártida",
    "Argentina" : "Arxentina",
    "American Samoa" : "Samoa americana",
    "Austria" : "Austria",
    "Australia" : "Australia",
    "Aruba" : "Aruba",
    "Åland Islands" : "Illas de Åland",
    "Azerbaijan" : "Acerbaixán",
    "Bosnia and Herzegovina" : "Bosnia e Hercegovina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladesh",
    "Belgium" : "Bélxica",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgaria",
    "Bahrain" : "Barein",
    "Burundi" : "Burundi",
    "Benin" : "Benín",
    "Saint Barthélemy" : "San Bartolomeu",
    "Bermuda" : "Bermudas",
    "Brunei Darussalam" : "Sultanato de Brunei",
    "Bolivia (Plurinational State of)" : "Bolivia (Estado plurinacional de)",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, San Eustaquio e Saba",
    "Brazil" : "Brasil",
    "Bahamas" : "Bahamas",
    "Bhutan" : "Bután",
    "Bouvet Island" : "Illa Bouvet",
    "Botswana" : "Botsuana",
    "Belarus" : "Belarús",
    "Belize" : "Belice",
    "Canada" : "Canadá",
    "Cocos (Keeling) Islands" : "Illas Cocos (Keeling)",
    "Congo, Democratic Republic of the" : "Congo, República democrática do",
    "Central African Republic" : "República Centro Africana",
    "Congo" : "Congo",
    "Switzerland" : "Suíza",
    "Côte d'Ivoire" : "Costa do Marfin",
    "Cook Islands" : "Illas Cook",
    "Chile" : "Chile",
    "Cameroon" : "Camerún",
    "China" : "China",
    "Colombia" : "Colombia",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Cuba",
    "Cabo Verde" : "Cabo Verde",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Illa Nadal",
    "Cyprus" : "Chipre",
    "Czechia" : "República Checa",
    "Germany" : "Alemaña",
    "Djibouti" : "Xibutí",
    "Denmark" : "Dinamarca",
    "Dominica" : "Dominica",
    "Dominican Republic" : "República Dominicana",
    "Algeria" : "Alxeria",
    "Ecuador" : "Ecuador",
    "Estonia" : "Estonia",
    "Egypt" : "Exipto",
    "Western Sahara" : "Sáhara Ocidental",
    "Eritrea" : "Eritrea",
    "Spain" : "España",
    "Ethiopia" : "Etiopía",
    "Finland" : "Finlandia",
    "Fiji" : "Fidxi",
    "Falkland Islands (Malvinas)" : "Illas Malvinas (Falkland)",
    "Micronesia (Federated States of)" : "Micronesia (Estados Federados da)",
    "Faroe Islands" : "Illas Feroe",
    "France" : "Francia",
    "Gabon" : "Gabón",
    "United Kingdom of Great Britain and Northern Ireland" : "Reino Unido da Gran Bretaña e Irlanda do Norte",
    "Grenada" : "Granada",
    "Georgia" : "Xeorxia",
    "French Guiana" : "Guaiana Francesa",
    "Guernsey" : "Guernsey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Xibraltar",
    "Greenland" : "Grenlandia",
    "Gambia" : "Gambia",
    "Guinea" : "Guinea",
    "Guadeloupe" : "Guadalupe",
    "Equatorial Guinea" : "Guinea Ecuatorial",
    "Greece" : "Grecia",
    "South Georgia and the South Sandwich Islands" : "Illas Xeorxia do Sur e Sandwich do Sur",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinea-Bisau",
    "Guyana" : "Guiana",
    "Hong Kong" : "Hong Kong",
    "Heard Island and McDonald Islands" : "Illa Heard e Illas McDonald",
    "Honduras" : "Honduras",
    "Croatia" : "Croacia",
    "Haiti" : "Haití",
    "Hungary" : "Hungría",
    "Indonesia" : "Indonesia",
    "Ireland" : "Irlanda",
    "Israel" : "Israel",
    "Isle of Man" : "Illa de Man",
    "India" : "India",
    "British Indian Ocean Territory" : "Territorio Británico do Océano Índico",
    "Iraq" : "Iraq",
    "Iran (Islamic Republic of)" : "Irán (República Islámica do)",
    "Iceland" : "Islandia",
    "Italy" : "Italia",
    "Jersey" : "Xersei",
    "Jamaica" : "Xamaica",
    "Jordan" : "Xordania",
    "Japan" : "Xapón",
    "Kenya" : "Kenya",
    "Kyrgyzstan" : "Quirguistán",
    "Cambodia" : "Camboxa",
    "Kiribati" : "Kiribatí",
    "Comoros" : "Comores",
    "Saint Kitts and Nevis" : "San Cristovo e Nevis",
    "Korea (Democratic People's Republic of)" : "Corea (República democrática popular de)",
    "Korea, Republic of" : "Corea, República de",
    "Kuwait" : "Kuvait",
    "Cayman Islands" : "Illas Caimán",
    "Kazakhstan" : "Cazaquistán",
    "Lao People's Democratic Republic" : "República Popular Democrática de Laos",
    "Lebanon" : "Líbano",
    "Saint Lucia" : "Santa Lucía",
    "Liechtenstein" : "Liechtenstein",
    "Sri Lanka" : "Sri Lanka",
    "Liberia" : "Liberia",
    "Lesotho" : "Lesoto",
    "Lithuania" : "Lituania",
    "Luxembourg" : "Luxemburgo",
    "Latvia" : "Letonia",
    "Libya" : "Libia",
    "Morocco" : "Marrocos",
    "Monaco" : "Mónaco",
    "Moldova, Republic of" : "Moldavia, República da",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "San Martín (parte francesa)",
    "Madagascar" : "Madagascar",
    "Marshall Islands" : "Illas Marshall",
    "North Macedonia" : "Macedonia do Norte",
    "Mali" : "Malí",
    "Myanmar" : "Mianmar",
    "Mongolia" : "Mongolia",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Illas Marianas do Norte",
    "Martinique" : "Martinica",
    "Mauritania" : "Mauritania",
    "Montserrat" : "Montserrat",
    "Malta" : "Malta",
    "Mauritius" : "Mauricio",
    "Maldives" : "Maldivas",
    "Malawi" : "Malawi",
    "Mexico" : "México",
    "Malaysia" : "Malasia",
    "Mozambique" : "Mozambique",
    "Namibia" : "Namibia",
    "New Caledonia" : "Nova Caledonia",
    "Niger" : "Níxer",
    "Norfolk Island" : "Illa Norfolk",
    "Nigeria" : "Nixeria",
    "Nicaragua" : "Nicaragua",
    "Netherlands" : "Países Baixos",
    "Norway" : "Noruega",
    "Nepal" : "Nepal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Nova Celandia",
    "Oman" : "Omán",
    "Panama" : "Panamá",
    "Peru" : "Perú",
    "French Polynesia" : "Polinesia Francesa",
    "Papua New Guinea" : "Papúa Nova Guinea",
    "Philippines" : "Filipinas",
    "Pakistan" : "Paquistán",
    "Poland" : "Polonia",
    "Saint Pierre and Miquelon" : "San Pedro e Miquelón",
    "Pitcairn" : "Pitcairn",
    "Puerto Rico" : "Porto Rico",
    "Palestine, State of" : "Palestina, Estado de",
    "Portugal" : "Portugal",
    "Palau" : "Palau",
    "Paraguay" : "Paraguai",
    "Qatar" : "Catar",
    "Réunion" : "Reunión",
    "Romania" : "Romanía",
    "Serbia" : "Serbia",
    "Russian Federation" : "Federación Rusa",
    "Rwanda" : "Ruanda",
    "Saudi Arabia" : "Arabia Saudita",
    "Solomon Islands" : "Illas Salomón",
    "Seychelles" : "Seychelles",
    "Sudan" : "Sudán",
    "Sweden" : "Suecia",
    "Singapore" : "Singapur",
    "Saint Helena, Ascension and Tristan da Cunha" : "Santa Helena, Ascension e Tristán da Cuña",
    "Slovenia" : "Eslovenia",
    "Svalbard and Jan Mayen" : "Illas Svalbard e Jan Mayen",
    "Slovakia" : "Eslovaquia",
    "Sierra Leone" : "Serra Leoa",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somalia",
    "Suriname" : "Suriname",
    "South Sudan" : "Sudán do Sur",
    "Sao Tome and Principe" : "San Tomé e Príncipe",
    "El Salvador" : "O Salvador",
    "Sint Maarten (Dutch part)" : "San Martín (parte neerlandesa)",
    "Syrian Arab Republic" : "República Árabe de Siria",
    "Eswatini" : "Eswatini",
    "Turks and Caicos Islands" : "Illas Turcas e Caicos",
    "Chad" : "Chad",
    "French Southern Territories" : "Territorios Franceses do Sur",
    "Togo" : "Togo",
    "Thailand" : "Tailandia",
    "Tajikistan" : "Taxiquistán",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Timor do Leste",
    "Turkmenistan" : "Turquemenistán",
    "Tunisia" : "Tunisia",
    "Tonga" : "Tonga",
    "Turkey" : "Turquia",
    "Trinidad and Tobago" : "Trinidade e Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taiwan, Provincia de China",
    "Tanzania, United Republic of" : "Tanzania, República Unida de",
    "Ukraine" : "Ucraína",
    "Uganda" : "Uganda",
    "United States Minor Outlying Islands" : "Illas exteriores menores dos Estados Unidos",
    "United States of America" : "Estados Unidos de America",
    "Uruguay" : "Uruguai",
    "Uzbekistan" : "Uzbekuistán",
    "Holy See" : "Santa Sé",
    "Saint Vincent and the Grenadines" : "San Vicente e as Granadinas",
    "Venezuela (Bolivarian Republic of)" : "Venezuela (República Bolivariana de)",
    "Virgin Islands (British)" : "Illas Virxes (Británicas)",
    "Virgin Islands (U.S.)" : "Illas Virxes (EE.UU.)",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Illas Wallis e Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Iemen",
    "Mayotte" : "Maiote",
    "South Africa" : "Suráfrica",
    "Zambia" : "Zambia",
    "Zimbabwe" : "Cimbabue"
},
"nplurals=2; plural=(n != 1);");

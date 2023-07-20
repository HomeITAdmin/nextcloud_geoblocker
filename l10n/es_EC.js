OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Actualización no posible.",
    "Update possible. " : "Actualización posible.",
    "Update running. " : "Actualización en curso.",
    "Update undefined. " : "Actualización no definida.",
    "Status of the service cannot be determined." : "No se puede determinar el estado del servicio.",
    "No database date available." : "No hay fecha disponible de la base de datos.",
    "Database file location not available!" : "¡Ubicación del archivo de la base de datos no disponible!",
    "Update Status not available!" : "¡Estado de actualización no disponible!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Tu intento de inicio de sesión desde el país \"%s\" está bloqueado por la aplicación Nextcloud GeoBlocker. Si esto es un problema para ti, por favor, contacta a tu administrador.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "OK. Este servicio siempre devuelve \"%s\" para \"País no encontrado\".",
    "OK." : "OK.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ERROR: Parece que el servicio no está instalado en el host del servidor Nextcloud o no es accesible para el servidor web o está mal configurado (¿está disponible la base de datos para IPv4 e IPv6?). Puede ser que el uso de la función PHP exec() esté deshabilitado en php.ini.",
    "Date of the database cannot be determined!" : "La fecha de la base de datos no se puede determinar.",
    "local" : "local",
    "default" : "predeterminado",
    "ERROR: There is an unknown problem with the service." : "ERROR: Hay un problema desconocido con el servicio.",
    "ERROR: Country cannot be found." : "ERROR: No se puede encontrar el país.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "ERROR: La base de datos no es válida, no tiene los permisos de acceso correctos o no está ubicada en %s.",
    "ERROR: Invalid Argument." : "ERROR: Argumento inválido.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "ERROR: \"geoip2.phar\" parece no estar ubicado correctamente o no tiene los permisos de acceso correctos.",
    "No entries in the database. Please run update." : "No hay entradas en la base de datos. Por favor, ejecuta la actualización.",
    "ERROR:" : "ERROR:",
    "OK" : "OK",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 solo funciona en sistemas de 64 bits (o superiores). Cuando actualices el sistema a 64 bits, recuerda actualizar la base de datos de nuevo.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "La base de datos se está actualizando actualmente. Durante la actualización, el servicio se puede utilizar con los últimos datos válidos.",
    "The last update try ended in an error but the service can be used with the last valid data." : "El último intento de actualización terminó en un error, pero el servicio se puede utilizar con los últimos datos válidos.",
    "Last error message:" : "Último mensaje de error:",
    "PHP GMP Extension needs to be installed." : "La Extensión GMP de PHP debe estar instalada.",
    "The database is not initialized. Please run update." : "La base de datos no está inicializada. Por favor, ejecuta la actualización.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "La base de datos se está inicializando actualmente. Por favor, espera hasta que se complete la actualización. Esto puede llevar varios minutos.",
    "The database is corrupted. Please run update again." : "La base de datos está dañada. Por favor, ejecuta la actualización de nuevo.",
    "Something is missing." : "Falta algo.",
    "No database available!" : "¡Base de datos no disponible!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "No se pudieron leer entradas válidas para la región \"%s\". Tal vez el RIR ha cambiado el formato del archivo.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "No se ha leído el número correcto de entradas para IPv4 en la región \"%s\". Deberían haber sido %d, pero fueron %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "No se ha leído el número correcto de entradas para IPv6 en la región \"%s\". Deberían haber sido %d, pero fueron %d.",
    "Exception caught during Update for region \"%s\": %s" : "Error detectado durante la actualización de la región \"%s\": %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Identificador de archivo no válido para la región \"%s\". Probablemente la conexión a Internet se perdió durante la actualización.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" debe estar permitido en php.ini.",
    "Internet connection needs to be available." : "La conexión a Internet debe estar disponible.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 no está incluido en sistemas con menos de 64 bits.",
    "Current number of entries:" : "Número actual de entradas:",
    "Update in undefined state. Please complain to the developer." : "Actualización en un estado no definido. Por favor, quejarse al desarrollador.",
    "GeoBlocker" : "GeoBlocker",
    "Blocks user depending on the estimated country of thier IP address." : "Bloquea usuarios dependiendo del país estimado de su dirección IP.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Esta es una interfaz para servicios de geolocalización que permite bloquear (beta), retrasar (beta) y registrar intentos de inicio de sesión desde países específicos.\n      Los intentos de inicio de sesión desde direcciones IP de la red local nunca se bloquearán, retrasarán o registrarán.\n      En la implementación actual, la página de inicio de sesión se muestra normalmente a todos, independientemente del país. También los intentos de inicio de sesión con un usuario que no existe fallan como de costumbre, independientemente del país.\n      La configuración incorrecta de Nextcloud (especialmente en contenedores) puede hacer que todos los accesos parezcan venir de una dirección IP de red local.\n      La determinación del país a partir de la dirección IP es tan buena como el servicio elegido.\n      \n      Los países se pueden especificar mediante listas de permisos o listas de bloqueo.\n      \n      Los servicios de localización actualmente disponibles son:\n      - Geoiplookup (programa local en el host)\n      - MaxMind GeoLite2 (base de datos local accedida a través de la API de PHP)\n      - Datos de los Registros Regionales de Internet (base de datos SQL de Nextcloud creada con datos descargados de los servidores FTP de RIRs)\n      \n      Para obtener ayuda sobre cómo configurar los servicios de localización, consulta el repositorio de GitHub (página principal en el lado derecho).",
    "Loading" : "Cargando",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Esta es una interfaz para servicios de geolocalización que permite bloquear (beta), retrasar (beta) y registrar intentos de inicio de sesión desde países específicos.",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Los intentos de inicio de sesión desde direcciones IP de la red local nunca se bloquearán, retrasarán oregistrarán.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "En la implementación actual, la página de inicio de sesión se muestra normalmente a todos, independientemente del país. También los intentos de inicio de sesión con un usuario que no existe fallan como de costumbre, independientemente del país.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "La configuración incorrecta de Nextcloud (especialmente en contenedores) puede hacer que todos los accesos parezcan venir de una dirección IP de red local.",
    "If you are accessing from external network, this should be an external IP address:" : "Si estás accediendo desde una red externa, esta debería ser una dirección IP externa:",
    "is local." : "es local.",
    "is external." : "es externa.",
    "Determination of the country from IP address is only as good as the chosen service." : "La determinación del país a partir de la dirección IP es tan buena como el servicio elegido.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Para obtener ayuda sobre cómo configurar los servicios de localización, consulta el archivo Léame en el",
    "repository" : "repositorio",
    "Service" : "Servicio",
    "Choose the service you want to use to determine the country from the IP Address:" : "Elige el servicio que deseas utilizar para determinar el país a partir de la dirección IP:",
    "Status of the chosen service: " : "Estado del servicio elegido: ",
    "Date of the database: " : "Fecha de la base de datos: ",
    "Configuration of the chosen service: " : "Configuración del servicio elegido: ",
    "Location of the database (full path including the file name):" : "Ubicación de la base de datos (ruta completa, incluido el nombre del archivo):",
    "Update Database" : "Actualizar base de datos",
    "Country Selection" : "Selección de país",
    "Choose the selection mode" : "Elige el modo de selección",
    "No country is blocked but the selected ones (blocklist)" : "Ningún país está bloqueado excepto los seleccionados (lista de bloqueo)",
    "All countries are blocked but the selected ones (allowlist)" : "Todos los países están bloqueados excepto los seleccionados (lista de permisos)",
    "Select countries from list" : "Seleccionar países de la lista",
    "The following countries were selected in the list above: " : "Los siguientes países fueron seleccionados en la lista de arriba: ",
    "Reaction" : "Reacción",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Si se detecta un intento de inicio de sesión desde los países elegidos, el intento se registra con la siguiente información",
    "( be aware of data protection issues depending on your logging strategy)" : "( ten en cuenta problemas de protección de datos según tu estrategia de registro)",
    "with IP Address" : "con dirección IP",
    "with Country Code" : "con código de país",
    "with username" : "con nombre de usuario",
    "In addition, the login attempt can also be delayed and blocked." : "Además, el intento de inicio de sesión también se puede retrasar y bloquear.",
    "(beta version)" : "(versión beta)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Activar el retraso de los intentos de inicio de sesión desde las direcciones IP de los países seleccionados.",
    "(30 seconds)" : "(30 segundos)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Activar el bloqueo de los intentos de inicio de sesión desde las direcciones IP de los países seleccionados.",
    "Test" : "Prueba",
    "Possibilities to test if the Geoblocker is working as expected:" : "Posibilidades para comprobar si el Geoblocker funciona como se espera:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "El siguiente intento de inicio de sesión del usuario \"%s\" se simulará que proviene de la siguiente dirección IP:",
    "COUNTRY NOT FOUND" : "PAÍS NO ENCONTRADO",
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
    "Congo, Democratic Republic of the" : "República Democrática del Congo",
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
    "Korea, Republic of" : "Corea del Sur",
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
    "Moldova, Republic of" : "Moldavia, República de",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "Saint Martin (French part)",
    "Madagascar" : "Madagascar",
    "Marshall Islands" : "Marshall Islands",
    "North Macedonia" : "Macedonia del Norte",
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
    "Eswatini" : "Esuatini",
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
    "Taiwan, Province of China" : "Taiwán, Provincia de China",
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
"nplurals=3; plural=n == 1 ? 0 : n != 0 && n % 1000000 == 0 ? 1 : 2;");

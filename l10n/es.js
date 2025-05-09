OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "No es posible actualizar.",
    "Update possible. " : "Es posible actualizar.",
    "Update running. " : "Actualización ejecutándose.",
    "Update undefined. " : "Actualización sin definir.",
    "Status of the service cannot be determined." : "El estado del servicio no se puede ser determinado.",
    "No database date available." : "No hay base de datos disponible.",
    "Database file location not available!" : "¡La localización del archivo de base de datos no está disponible!",
    "Update Status not available!" : "¡Estado de Actualización no disponible!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Su intento de iniciar sesión desde el país \"%s\" está bloqueado por la aplicación Nextcloud GeoBlocker. Si esto le supone un problema, póngase en contacto con su administrador.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "OK. Este servicio siempre devuelve \"%s\" para \"País no encontrado\"",
    "OK." : "Aceptar.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ERROR: el servicio parece no estar instalado en el host del servidor Nextcloud, o no es accesible por el servidor web o está mal configurado (¿Está disponible la base de datos para IPv4 e IPv6?). Es posible que la función exec() de php esté deshabilitada en el php.ini.",
    "Date of the database cannot be determined!" : "¡La fecha de la base de datos no se puede determinar!",
    "local" : "local",
    "default" : "predeterminado",
    "ERROR: There is an unknown problem with the service." : "ERROR: Hay un problema desconocido con el servicio.",
    "ERROR: Country cannot be found." : "ERROR: No se puede encontrar el país.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "ERROR: La base de datos no es válida, no tienes los derechos de acceso correctos o no está colocada en %s.",
    "ERROR: Invalid Argument." : "ERROR: Argumento no válido",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "ERROR: \"geoip2.phar\" no parece estar ubicado correctamente o no tiene los derecho de acceso correctos.",
    "No entries in the database. Please run update." : "No hay entradas en la base de datos. Por favor, ejecute una actualización.",
    "ERROR:" : "ERROR:",
    "OK" : "OK",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 solo funciona en sistemas de 64-bit (o más). Al actualizar el sistema a 64-bit recuerda actualizar la BD otra vez.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "La base de datos se está actualizando en este momento. Durante la actualización se podrá usar el servicio con los últimos datos válidos.",
    "The last update try ended in an error but the service can be used with the last valid data." : "El último intento de actualización finalizó con un error, pero el servicio puede ser usado con los últimos datos válidos.",
    "Last error message:" : "Último mensaje de error:",
    "PHP GMP Extension needs to be installed." : "La extensión PHP GMP necesita ser instalada.",
    "The database is not initialized. Please run update." : "La base de datos no está inicializada. Por favor, ejecute la actualización.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "La base de datos se está inicializando. Por favor, espere hasta que la actualización termine. Esto podría tomar varios minutos.",
    "The database is corrupted. Please run update again." : "La base de datos está corrupta. Por favor, ejecute  de nuevo la actualización.",
    "Something is missing." : "Falta algo.",
    "No database available!" : "¡Base de datos no disponible!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "No se han podido leer entradas válidas para la región \"%s\". Tal vez el RIR ha cambiado el formato del archivo.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "El número de entradas para IPv4 leídas de la región \"%s\" no es correcta. Deberían haber sido %d pero fue %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "El número de entradas para IPv6 leídas de la región \"%s\" no es correcta. Deberían haber sido %d pero fue %d.",
    "Exception caught during Update for region \"%s\": %s" : "Detectada una excepción durante la actualización de la región \"%s\": %s: ",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Identificador de archivo no válido para la región \"%s\". Probablemente se perdió la conexión a internet durante la actualización.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" debe estar permitido en php.ini.",
    "Internet connection needs to be available." : "Se necesita tener disponible una conexión a Internet.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 no está incluido en sistemas con menos de 64-bits.",
    "Current number of entries:" : "Número actual de entradas:",
    "Update in undefined state. Please complain to the developer." : "La actualización está en un estado indefinido. Por favor, quéjese al desarrollador.",
    "GeoBlocker" : "GeoBlocker",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Esto es una interfaz de usuario para servicios de geolocalización, que permite el bloqueo (beta), retraso (beta) y registro de intentos de inicio de sesión desde países específicos.\nLos intentos de inicio de sesión desde direcciones IP de redes locales nunca son bloqueadas, retrasadas o registradas.\nEn la implementación actual la página de inicio de sesión se muestra por igual a todo el mundo, independientemente del país. Además, los intentos de inicio de sesión con un usuario inexistente fallan igual que antes, independientemente del país.\nSi la configuración de Nextcloud es errónea (especialmente en contenedores), es posible que todos los accesos parezcan provenir de direcciones IP de redes locales.\nEl determinar el país al que corresponde una dirección IP es tan preciso como el servicio escogido.\n\nLos países se pueden especificar según una lista de permitidos o bloqueados.\n\nActualmente, los servicios de localización disponibles son:\n- Geoiplookup (programa local en el servidor)\n- MaxMind GeoLite2 (base de datos local a la que se accede por una API PHP)\n- Datos de los Registros Regionales de Internet (una base de datos SQL de Nextcloud generada a partir de los servidores FTP de los RRIs)\n\nPara obtener ayuda sobre la configuración de los servicios de localización, consulta el repositorio de GitHub, por favor (en el lado derecho de la página principal).",
    "Loading" : "Cargando",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Esto es una interfaz de servicios de geolocalización, que permite bloquear (beta), retrasar (beta) y registrar los intentos de inicio de sesión desde países específicos.",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Los intentos de acceso desde las direcciones IP de la red local nunca serán bloqueados, retrasados o registrados.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "En la implementación actual la página de inicio de sesión se muestra por igual a todo el mundo, independientemente del país. Además, los intentos de inicio de sesión con un usuario inexistente fallan igual que antes, independientemente del país.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Una mala configuración de Nextcloud (especialmente en contenedor) puede hacer que todos los accesos parezcan provenir de una dirección IP de red local.",
    "If you are accessing from external network, this should be an external IP address:" : "Si accedes desde una red externa, esta debería ser una dirección IP externa:",
    "is local." : "es local.",
    "is external." : "es externo.",
    "Determination of the country from IP address is only as good as the chosen service." : "Determinar la procedencia de una dirección IP dependerá de lo bueno que sea el servicio elegido.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Para obtener ayuda sobre cómo configurar los servicios de localización, eche un vistazo al Léame en el ",
    "repository" : "repositorio",
    "Service" : "Servicio",
    "Choose the service you want to use to determine the country from the IP Address:" : "Elija el servicio que desea utilizar para determinar el país a partir de la dirección IP:",
    "Status of the chosen service: " : "Estado del servicio elegido: ",
    "Date of the database: " : "Fecha de la base de datos: ",
    "Configuration of the chosen service: " : "Configuración del servicio elegido: ",
    "Location of the database (full path including the file name):" : "Ubicación de la base de datos (ruta completa, incluyendo el nombre del archivo):",
    "Update Database" : "Actualiza la Base de Datos",
    "Country Selection" : "Selección del país",
    "Choose the selection mode" : "Elija el modo de funcionamiento",
    "No country is blocked but the selected ones (blocklist)" : "Ningún país está bloqueado excepto los seleccionados (lista de bloqueo)",
    "All countries are blocked but the selected ones (allowlist)" : "Todos los países bloqueados excepto los seleccionados (lista permitida)",
    "Select countries from list" : "Seleccione países de la lista",
    "The following countries were selected in the list above: " : "Los siguientes paises fueron seleccionados en la lista anterior: ",
    "Reaction" : "Reacción",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Si se detecta un intento de inicio de sesión desde los países seleccionados, el intento se registra con la siguiente información",
    "( be aware of data protection issues depending on your logging strategy)" : "(ten en cuenta los problemas de la protección de datos dependiendo de la estrategia de registro)",
    "with IP Address" : "La dirección IP",
    "with Country Code" : "El Código Postal",
    "with username" : "El nombre de usuario",
    "In addition, the login attempt can also be delayed and blocked." : "Además, el intento de inicio de sesión puede ser retrasado y bloqueado.",
    "(beta version)" : "(versión beta)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Activar el retardo de bloqueo de intentos de inicio de sesión desde direcciones IP desde los países indicados.",
    "(30 seconds)" : "(30 segundos)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Activar el bloqueo de intentos de inicio de sesión de las direcciones IP desde los países indicados.",
    "Test" : "Prueba",
    "Possibilities to test if the Geoblocker is working as expected:" : "Opciones para probar si el Geoblocker está funcionando como se espera:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "El próximo intento de inicio del usuario \"%s\" se simulará que proviene desde la siguiente dirección IP:",
    "COUNTRY NOT FOUND" : "PAÍS NO ENCONTRADO",
    "Andorra" : "Andorra",
    "United Arab Emirates" : "Emiratos Árabes Unidos",
    "Afghanistan" : "Afganistán",
    "Antigua and Barbuda" : "Antigua y Barbuda",
    "Anguilla" : "Anguila",
    "Albania" : "Albania",
    "Armenia" : "Armenia",
    "Angola" : "Angola",
    "Antarctica" : "Antártida",
    "Argentina" : "Argentina",
    "American Samoa" : "Samoa Estadounidense",
    "Austria" : "Austria",
    "Australia" : "Australia",
    "Aruba" : "Aruba",
    "Åland Islands" : "Islas Åland",
    "Azerbaijan" : "Azerbaiyán",
    "Bosnia and Herzegovina" : "Bosnia y Herzegovina",
    "Barbados" : "Barbados",
    "Bangladesh" : "Bangladesh",
    "Belgium" : "Bélgica",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgaria",
    "Bahrain" : "Baréin",
    "Burundi" : "Burundi",
    "Benin" : "Benín",
    "Saint Barthélemy" : "San Bartolomé",
    "Bermuda" : "Bermudas",
    "Brunei Darussalam" : "Brunéi Darusalam",
    "Bolivia (Plurinational State of)" : "Bolivia (Estado Plurinacional de)",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, San Eustaquio y Saba",
    "Brazil" : "Brasil",
    "Bahamas" : "Bahamas",
    "Bhutan" : "Bután",
    "Bouvet Island" : "Isla Bouvet",
    "Botswana" : "Botsuana",
    "Belarus" : "Bielorrusia",
    "Belize" : "Belice",
    "Canada" : "Canadá",
    "Cocos (Keeling) Islands" : "Islas Cocos (Keeling)",
    "Congo, Democratic Republic of the" : "Congo, República Democrática del",
    "Central African Republic" : "República Centroafricana",
    "Congo" : "Congo",
    "Switzerland" : "Suiza",
    "Côte d'Ivoire" : "Costa de Marfil",
    "Cook Islands" : "Islas Cook",
    "Chile" : "Chile",
    "Cameroon" : "Camerún",
    "China" : "China",
    "Colombia" : "Colombia",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Cuba",
    "Cabo Verde" : "Cabo Verde",
    "Curaçao" : "Curazao",
    "Christmas Island" : "Isla de Navidad",
    "Cyprus" : "Chipre",
    "Czechia" : "Chequia",
    "Germany" : "Alemania",
    "Djibouti" : "Yibuti",
    "Denmark" : "DInamarca",
    "Dominica" : "Dominica",
    "Dominican Republic" : "República Dominicana",
    "Algeria" : "Argelia",
    "Ecuador" : "Ecuador",
    "Estonia" : "Estonia",
    "Egypt" : "Egipto",
    "Western Sahara" : "Sáhara Occidental",
    "Eritrea" : "Eritrea",
    "Spain" : "España",
    "Ethiopia" : "Etiopía",
    "Finland" : "Finlandia",
    "Fiji" : "Fiyi",
    "Falkland Islands (Malvinas)" : "Islas Malvinas (Falkland)",
    "Micronesia (Federated States of)" : "Micronesia (Estados Federados de)",
    "Faroe Islands" : "Islas Faroe",
    "France" : "Francia",
    "Gabon" : "Gabón",
    "United Kingdom of Great Britain and Northern Ireland" : "Reino Unido de la Gran Bretaña e Irlanda del Norte",
    "Grenada" : "Granada",
    "Georgia" : "Georgia",
    "French Guiana" : "Guyana Francesa",
    "Guernsey" : "Guernsey",
    "Ghana" : "Gana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Groenlandia",
    "Gambia" : "Gambia",
    "Guinea" : "Guinea",
    "Guadeloupe" : "Guadalupe",
    "Equatorial Guinea" : "Guinea Ecuatorial",
    "Greece" : "Grecia",
    "South Georgia and the South Sandwich Islands" : "Islas Georgias del Sur y Sandwich del Sur",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinea Bissau",
    "Guyana" : "Guyana",
    "Hong Kong" : "Hong Kong",
    "Heard Island and McDonald Islands" : "Isla Heard e Islas McDonald",
    "Honduras" : "Honduras",
    "Croatia" : "Croacia",
    "Haiti" : "Haiti",
    "Hungary" : "Hungría",
    "Indonesia" : "Indonesia",
    "Ireland" : "Irlanda",
    "Israel" : "Israel",
    "Isle of Man" : "Isla de Man",
    "India" : "India",
    "British Indian Ocean Territory" : "Territorio Británico del Océano Índico",
    "Iraq" : "Iraq",
    "Iran (Islamic Republic of)" : "Irán (República Islámica de)",
    "Iceland" : "Islandia",
    "Italy" : "Italia",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamaica",
    "Jordan" : "Jordania",
    "Japan" : "Japón",
    "Kenya" : "Kenia",
    "Kyrgyzstan" : "Kirguizistán",
    "Cambodia" : "Camboya",
    "Kiribati" : "Kiribati",
    "Comoros" : "Comoras",
    "Saint Kitts and Nevis" : "Saint Kitts y Nevis",
    "Korea (Democratic People's Republic of)" : "Corea (República Democrática Popular de)",
    "Korea, Republic of" : "Corea, República de",
    "Kuwait" : "Kuwait",
    "Cayman Islands" : "Islas Caimán",
    "Kazakhstan" : "Kazajistán",
    "Lao People's Democratic Republic" : "República Democrática Popular de Laos",
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
    "Morocco" : "Marruecos",
    "Monaco" : "Mónaco",
    "Moldova, Republic of" : "Moldavia, República de",
    "Montenegro" : "Montenegro",
    "Saint Martin (French part)" : "San Martín (parte francesa)",
    "Madagascar" : "Madagascar",
    "Marshall Islands" : "Islas Marshall",
    "North Macedonia" : "Macedonia del norte",
    "Mali" : "Mali",
    "Myanmar" : "Mianmar",
    "Mongolia" : "Mongolia",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Islas Marianas del Norte",
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
    "New Caledonia" : "Nueva Caledonia",
    "Niger" : "Níger",
    "Norfolk Island" : "Isla Norfolk",
    "Nigeria" : "Nigeria",
    "Nicaragua" : "Nicaragua",
    "Netherlands" : "Países Bajos",
    "Norway" : "Noruega",
    "Nepal" : "Nepal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Nueva Zelanda",
    "Oman" : "Omán",
    "Panama" : "Panamá",
    "Peru" : "Perú",
    "French Polynesia" : "Polinesia Francesa",
    "Papua New Guinea" : "Papúa Nueva Guinea",
    "Philippines" : "Filipinas",
    "Pakistan" : "Pakistán",
    "Poland" : "Polonia",
    "Saint Pierre and Miquelon" : "Saint Pierre y Miquelon",
    "Pitcairn" : "Pitcairn",
    "Puerto Rico" : "Puerto Rico",
    "Palestine, State of" : "Palestina, Estado de",
    "Portugal" : "Portugal",
    "Palau" : "Palau",
    "Paraguay" : "Paraguay",
    "Qatar" : "Catar",
    "Réunion" : "Reunión",
    "Romania" : "Rumanía",
    "Serbia" : "Serbia",
    "Russian Federation" : "Rusia, Federación",
    "Rwanda" : "Ruanda",
    "Saudi Arabia" : "Arabia Saudí",
    "Solomon Islands" : "Islas Salomón",
    "Seychelles" : "Seychelles",
    "Sudan" : "Sudán",
    "Sweden" : "Suecia",
    "Singapore" : "Singapur",
    "Saint Helena, Ascension and Tristan da Cunha" : "Santa Helena, Ascensión y Tristán de Acuña",
    "Slovenia" : "Eslovenia",
    "Svalbard and Jan Mayen" : "Svalbard y Jan Mayen",
    "Slovakia" : "Eslovaquia",
    "Sierra Leone" : "Sierra Leona",
    "San Marino" : "San Marino",
    "Senegal" : "Senegal",
    "Somalia" : "Somalia",
    "Suriname" : "Surinam",
    "South Sudan" : "Sudán del Sur",
    "Sao Tome and Principe" : "Santo Tomé y Príncipe",
    "El Salvador" : "El Salvador",
    "Sint Maarten (Dutch part)" : "San Martín (parte Holandesa)",
    "Syrian Arab Republic" : "República Árabe Siria",
    "Eswatini" : "Swazilandia",
    "Turks and Caicos Islands" : "Islas Turcos y Caicos",
    "Chad" : "Chad",
    "French Southern Territories" : "Territorios Franceses del Sur",
    "Togo" : "Togo",
    "Thailand" : "Tailandia",
    "Tajikistan" : "Tayikistán",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Timor Oriental",
    "Turkmenistan" : "Turkmenistán",
    "Tunisia" : "Túnez",
    "Tonga" : "Tonga",
    "Turkey" : "Turquía",
    "Trinidad and Tobago" : "Trinidad y Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taiwán, Provincia de China",
    "Tanzania, United Republic of" : "Tanzania, República Unida de",
    "Ukraine" : "Ucrania",
    "Uganda" : "Uganda",
    "United States Minor Outlying Islands" : "Islas Ultramarinas Menores Estadounidenses",
    "United States of America" : "Estados Unidos de América",
    "Uruguay" : "Uruguay",
    "Uzbekistan" : "Uzbekistán",
    "Holy See" : "Estado Vaticano",
    "Saint Vincent and the Grenadines" : "San Vicente y Granadinas",
    "Venezuela (Bolivarian Republic of)" : "Venezuela, República Bolivariana de",
    "Virgin Islands (British)" : "Islas Vírgenes (británicas)",
    "Virgin Islands (U.S.)" : "Islas Vírgenes (estadounidenses)",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis y Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Yemen",
    "Mayotte" : "Mayotte",
    "South Africa" : "Sudáfrica",
    "Zambia" : "Zambia",
    "Zimbabwe" : "Zimbabue"
},
"nplurals=3; plural=n == 1 ? 0 : n != 0 && n % 1000000 == 0 ? 1 : 2;");

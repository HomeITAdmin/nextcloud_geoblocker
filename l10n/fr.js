OC.L10N.register(
    "geoblocker",
    {
    "Status of the service cannot be determined." : "Impossible de déterminer le statut du service.",
    "No database date available." : "Aucune date de base de données n'est disponible.",
    "Database file location not available!" : "L'emplacement du fichier de la base de données n'est pas disponible !",
    "The user \"%s\" logged in with an invalid IP address \"%s\"." : "L'utilisateur \"%s\" est connecté avec une adresse IP non valable \"%s\".",
    "The user \"%s\" logged in with IP address \"%s\" from blocked country \"%s\"." : "L'utilisateur \"%s\" est connecté avec l'adresse IP \"%s\" depuis ce pays bloqué \"%s\".",
    "The login of user \"%s\" with IP address \"%s\" could not be checked due to problems with location service." : "La connexion de l'utilisateur \"%s\" avec l'adresse IP \"%s\" n'a pas pu être vérifiée à cause d'un problème avec le service de localisation.",
    "OK." : "OK.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ERREUR : le service ne semble pas être installé sur le serveur Nextcloud ou il n'est pas accessible pour le serveur web ou il est mal configuré (la base de données pour IPv4 et IPv6 est-elle disponible ?!). Peut-être que l'utilisation de la fonction PHP exec() est désactivée dans le fichier php.ini.",
    "Date of the database cannot be determined!" : "Impossible de déterminer la date de la base de données.",
    "local" : "local",
    "default" : "défaut",
    "ERROR: Service does not seem to be installed correctly or database is not available at %s." : "ERREUR : Le service ne semble pas être installé correctement ou la base de données n’est pas disponible à %s.",
    "ERROR: Something is missing." : "ERREUR : Il manque quelque chose.",
    "GeoBlocker" : "Bloqueur géographique",
    "Blocks user depending on the estimated country of thier IP address." : "Bloque un utilisateur en fonction du pays estimé par leur adresse IP.",
    "This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries. (Early Version)" : "Interface des services de géolocalisation, qui permet de bloquer (enregistrement uniquement pour le moment!) des tentatives de connexion provenant de pays spécifiques. (Version préliminaire)",
    "Loading" : "Chargement",
    "This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries. " : "Interface des services de géolocalisation, qui permet de bloquer (enregistrement uniquement pour le moment!) des tentatives de connexion provenant de pays spécifiques.",
    "Login attempts from local network IP addresses are not blocked (or logged)." : "Les tentatives de connexions depuis les adresses IP locales ne sont pas bloquées (ou enregistrées).",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Une mauvaise configuration de Nextcloud (spécifiquement dans un conteneur) peut faire croire que tous les accès viennent d'adresses IP locales.",
    "If you are accessing from external network, this should be an external IP address: " : "Si vous accédez depuis un réseau externe, cela peut-être une adresse IP externe :",
    "is local." : "est local.",
    "is external." : "est externe.",
    "Determination of the country from IP address is only as good as the chosen service." : "La qualité de la détection du pays en fonction de l'adresse IP dépend du service choisi.",
    "Service" : "Service",
    "Choose the service you want to use to determine the country from the IP Address:" : "Choisissez le service que vous voulez utiliser pour déterminer le pays en fonction de l'adresse IP:",
    "Status of the chosen service: " : "Statut du service choisi:",
    "Date of the database: " : "Date de la base de données :",
    "Configuration of the chosen service: " : "Configuration du service choisis :",
    "Location of the database: " : "Emplacement de la base de données :",
    "Update Database" : "Mise à jour de la base de données",
    "Country Selection" : "Choix du pays",
    "Choose the selection mode" : "Choisissez le mode de sélection",
    "No country is blocked but the selected ones (blacklist)" : "Aucun pays n'est bloqué sauf ceux sélectionnés (liste noire)",
    "All countries are blocked but the selected ones (whitelist)" : "Tous les pays sont bloqués sauf ceux sélectionnés (liste blanche)",
    "Select countries from list" : "Sélectionner les pays dans la liste",
    "The following countries were selected in the list above: " : "Les pays suivants ont été sélectionnés dans la liste ci-dessus :",
    "Reaction" : "Réaction",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Si une tentative de connexion est détectée depuis un pays choisi, la tentative est enregistrée avec les informations suivantes",
    "( be aware of data protection issues depending on your logging strategy)" : "(attention aux problèmes de protection des données en fonction de la méthode de connexion)",
    "with IP Address" : "avec l'adresse IP",
    "with Country Code" : "avec le code pays",
    "with username" : "avec le nom d'utilisateur",
    "In addition, the login attempt can also be blocked" : "En complément, la tentative de connexion peut être bloquée.",
    "(in a future version)" : "(dans une prochaine version)",
    "Activate blocking of the login attempt from IP addresses of the specified countries." : "Activer le blocage des tentatives de connexion depuis les adresses IP des pays indiqués.",
    "Test" : "Test",
    "Possibilities to test if the Geoblocker is working as expected:" : "Possibilités de tester si Geoblocker fonctionne correctement :",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "La prochaine tentative de connexion pour l'utilisateur \"%s\" simulera  l’utilisation de l'adresse IP suivante :",
    "COUNTRY NOT FOUND" : "PAYS NON TROUVÉ",
    "Andorra" : "Andorre",
    "United Arab Emirates" : "Émirats Arabes Unis",
    "Afghanistan" : "Afghanistan",
    "Antigua and Barbuda" : "Antigua et Barbuda",
    "Anguilla" : "Anguilla",
    "Albania" : "Albanie",
    "Armenia" : "Arménie",
    "Angola" : "Angola",
    "Antarctica" : "Antarctique",
    "Argentina" : "Argentine",
    "American Samoa" : "Samoa américaines",
    "Austria" : "Autriche",
    "Australia" : "Australie",
    "Aruba" : "Aruba",
    "Åland Islands" : "Îles Åland",
    "Azerbaijan" : "Azerbaïdjan",
    "Bosnia and Herzegovina" : "Bosnie-Herzégovine",
    "Barbados" : " La Barbade",
    "Bangladesh" : "Bangladesh",
    "Belgium" : "Belgique",
    "Burkina Faso" : "Burkina Faso",
    "Bulgaria" : "Bulgarie",
    "Bahrain" : "Bahreïn",
    "Burundi" : "Burundi",
    "Benin" : "Bénin",
    "Saint Barthélemy" : "Saint Barthélemy",
    "Bermuda" : " Les Bermudes",
    "Brunei Darussalam" : "Brunei",
    "Bolivia (Plurinational State of)" : "Bolivie (État plurinational de)",
    "Bonaire, Sint Eustatius and Saba" : "Bonaire, Saint-Eustache et Saba",
    "Brazil" : "Brésil",
    "Bahamas" : "Bahamas",
    "Bhutan" : "Bhoutan",
    "Bouvet Island" : "Île Bouvet",
    "Botswana" : "Botswana",
    "Belarus" : "Biélorussie",
    "Belize" : "Bélize",
    "Canada" : "Canada",
    "Cocos (Keeling) Islands" : "Îles Cocos (Keeling)",
    "Congo, Democratic Republic of the" : "Congo, République démocratique du",
    "Central African Republic" : "République centrafricaine",
    "Congo" : "Congo",
    "Switzerland" : "Suisse",
    "Côte d'Ivoire" : "Côte d'Ivoire",
    "Cook Islands" : "Îles Cook",
    "Chile" : "Chili",
    "Cameroon" : "Cameroun",
    "China" : "Chine",
    "Colombia" : "Colombie",
    "Costa Rica" : "Costa Rica",
    "Cuba" : "Cuba",
    "Cabo Verde" : "Cap-Vert",
    "Curaçao" : "Curaçao",
    "Christmas Island" : "Île Christmas",
    "Cyprus" : "Chypre",
    "Czechia" : "République tchèque",
    "Germany" : "Allemagne",
    "Djibouti" : "Djibouti",
    "Denmark" : "Danemark",
    "Dominica" : "Dominique",
    "Dominican Republic" : "République Dominicaine",
    "Algeria" : "Algérie",
    "Ecuador" : "Équateur",
    "Estonia" : "Estonie",
    "Egypt" : "Égypte",
    "Western Sahara" : "Sahara occidental",
    "Eritrea" : "Érythrée",
    "Spain" : "Espagne",
    "Ethiopia" : "Éthiopie",
    "Finland" : "Finlande",
    "Fiji" : "Fidji",
    "Falkland Islands (Malvinas)" : "Îles Malouines (ou Falkland)",
    "Micronesia (Federated States of)" : "Micronésie (États fédérés de)",
    "Faroe Islands" : "Îles Féroé",
    "France" : "France",
    "Gabon" : "Gabon",
    "United Kingdom of Great Britain and Northern Ireland" : "Royaume-Uni",
    "Grenada" : "Grenade",
    "Georgia" : "Géorgie",
    "French Guiana" : "Guyane française",
    "Guernsey" : "Guernesey",
    "Ghana" : "Ghana",
    "Gibraltar" : "Gibraltar",
    "Greenland" : "Groenland",
    "Gambia" : "Gambie",
    "Guinea" : "Guinée",
    "Guadeloupe" : "Guadeloupe",
    "Equatorial Guinea" : "Guinée Équatoriale",
    "Greece" : "Grèce",
    "South Georgia and the South Sandwich Islands" : "Géorgie du Sud et les îles Sandwich du Sud",
    "Guatemala" : "Guatemala",
    "Guam" : "Guam",
    "Guinea-Bissau" : "Guinée-Bissau",
    "Guyana" : "Guyane",
    "Hong Kong" : "Hong Kong",
    "Heard Island and McDonald Islands" : "Îles Heard et MacDonald",
    "Honduras" : "Honduras",
    "Croatia" : "Croatie",
    "Haiti" : "Haïti",
    "Hungary" : "Hongrie",
    "Indonesia" : "Indonésie",
    "Ireland" : "Irlande",
    "Israel" : "Israël",
    "Isle of Man" : "Île de Man",
    "India" : "Inde",
    "British Indian Ocean Territory" : "Territoire britannique de l'océan Indien",
    "Iraq" : "Irak",
    "Iran (Islamic Republic of)" : "Iran (République islamique d')",
    "Iceland" : "Islande",
    "Italy" : "Italie",
    "Jersey" : "Jersey",
    "Jamaica" : "Jamaïque",
    "Jordan" : "Jordanie",
    "Japan" : "Japon",
    "Kenya" : "Kenya",
    "Kyrgyzstan" : "Kirghizstan",
    "Cambodia" : "Cambodge",
    "Kiribati" : "Kiribati",
    "Comoros" : "Comores",
    "Saint Kitts and Nevis" : "Saint Christophe et Niévès",
    "Korea (Democratic People's Republic of)" : "Corée du Nord",
    "Korea, Republic of" : "Corée, République de",
    "Kuwait" : "Koweït",
    "Cayman Islands" : "Îles Caïmans",
    "Kazakhstan" : "Kazakhstan",
    "Lao People's Democratic Republic" : "République démocratique populaire du Laos",
    "Lebanon" : "Liban",
    "Saint Lucia" : "Sainte Lucie",
    "Liechtenstein" : "Liechtenstein",
    "Sri Lanka" : "Sri Lanka",
    "Liberia" : "Liberia",
    "Lesotho" : "Lesotho",
    "Lithuania" : "Lituanie",
    "Luxembourg" : "Luxembourg",
    "Latvia" : "Lettonie",
    "Libya" : "Libye",
    "Morocco" : "Maroc",
    "Monaco" : "Monaco",
    "Moldova, Republic of" : "Moldavie, République de",
    "Montenegro" : "Monténégro",
    "Saint Martin (French part)" : "Saint Martin (Partie française)",
    "Madagascar" : "Madagascar",
    "Marshall Islands" : "Îles Marshall",
    "North Macedonia" : "Macédoine du Nord",
    "Mali" : "Mali",
    "Myanmar" : "Birmanie",
    "Mongolia" : "Mongolie",
    "Macao" : "Macao",
    "Northern Mariana Islands" : "Îles Mariannes du Nord",
    "Martinique" : "Martinique",
    "Mauritania" : "Mauritanie",
    "Montserrat" : "Montserrat",
    "Malta" : "Malte",
    "Mauritius" : "Île Maurice",
    "Maldives" : "Maldives",
    "Malawi" : "Malawi",
    "Mexico" : "Mexique",
    "Malaysia" : "Malaisie",
    "Mozambique" : "Mozambique",
    "Namibia" : "Namibie",
    "New Caledonia" : "Nouvelle-Calédonie",
    "Niger" : "Niger",
    "Norfolk Island" : "Île Norfolk",
    "Nigeria" : "Nigeria",
    "Nicaragua" : "Nicaragua",
    "Netherlands" : "Pays-Bas",
    "Norway" : "Norvège",
    "Nepal" : "Népal",
    "Nauru" : "Nauru",
    "Niue" : "Niue",
    "New Zealand" : "Nouvelle-Zélande",
    "Oman" : "Oman",
    "Panama" : "Panama",
    "Peru" : "Pérou",
    "French Polynesia" : "Polynésie française",
    "Papua New Guinea" : "Papouasie-Nouvelle-Guinée",
    "Philippines" : "Philippines",
    "Pakistan" : "Pakistan",
    "Poland" : "Pologne",
    "Saint Pierre and Miquelon" : "Saint Pierre et Miquelon",
    "Pitcairn" : "Île Pitcairn",
    "Puerto Rico" : "Porto Rico",
    "Palestine, State of" : "Palestine (État de la)",
    "Portugal" : "Portugal",
    "Palau" : "Palaos",
    "Paraguay" : "Paraguay",
    "Qatar" : "Qatar",
    "Réunion" : "Réunion",
    "Romania" : "Roumanie",
    "Serbia" : "Serbie",
    "Russian Federation" : "Russie (Fédération de)",
    "Rwanda" : "Rwanda",
    "Saudi Arabia" : "Arabie Saoudite",
    "Solomon Islands" : "Îles Salomon",
    "Seychelles" : "Seychelles",
    "Sudan" : "Soudan",
    "Sweden" : "Suède",
    "Singapore" : "Singapour",
    "Saint Helena, Ascension and Tristan da Cunha" : "Sainte-Hélène, Ascension et Tristan da Cunha",
    "Slovenia" : "Slovénie",
    "Svalbard and Jan Mayen" : "Svalbard et Jan Mayen",
    "Slovakia" : "Slovaquie",
    "Sierra Leone" : "Sierra Leone",
    "San Marino" : "Saint Marin",
    "Senegal" : "Sénégal",
    "Somalia" : "Somalie",
    "Suriname" : "Suriname",
    "South Sudan" : "Soudan du Sud",
    "Sao Tome and Principe" : "Sao Tomé et Principe",
    "El Salvador" : "Salvador",
    "Sint Maarten (Dutch part)" : "Saint Martin (Partie néerlandaise)",
    "Syrian Arab Republic" : "République Arabe Syrienne",
    "Eswatini" : "Eswatini",
    "Turks and Caicos Islands" : "Îles Turques et Caïques",
    "Chad" : "Tchad",
    "French Southern Territories" : "Terres australes et antarctiques françaises",
    "Togo" : "Togo",
    "Thailand" : "Thaïlande",
    "Tajikistan" : "Tadjikistan",
    "Tokelau" : "Tokelau",
    "Timor-Leste" : "Timor oriental",
    "Turkmenistan" : "Turkménistan",
    "Tunisia" : "Tunisie",
    "Tonga" : "Tonga",
    "Turkey" : "Turquie",
    "Trinidad and Tobago" : "Trinidad et Tobago",
    "Tuvalu" : "Tuvalu",
    "Taiwan, Province of China" : "Taïwan, Province de Chine",
    "Tanzania, United Republic of" : "Tanzanie (République unie de)",
    "Ukraine" : "Ukraine",
    "Uganda" : "Ouganda",
    "United States Minor Outlying Islands" : "Îles mineures éloignées des États-Unis",
    "United States of America" : "États-Unis",
    "Uruguay" : "Uruguay",
    "Uzbekistan" : "Ouzbékistan",
    "Holy See" : "Vatican",
    "Saint Vincent and the Grenadines" : "Saint Vincent et les Grenadines",
    "Venezuela (Bolivarian Republic of)" : "Venezuela (République bolivarienne du)",
    "Virgin Islands (British)" : "Îles Vierges Britanniques",
    "Virgin Islands (U.S.)" : "Îles Vierges des États-Unis",
    "Viet Nam" : "Vietnam",
    "Vanuatu" : "Vanuatu",
    "Wallis and Futuna" : "Wallis et Futuna",
    "Samoa" : "Samoa",
    "Yemen" : "Yémen",
    "Mayotte" : "Mayotte",
    "South Africa" : "Afrique du Sud",
    "Zambia" : "Zambie",
    "Zimbabwe" : "Zimbabwe"
},
"nplurals=2; plural=(n > 1);");

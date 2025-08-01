OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "Неможливо оновити.",
    "Update possible. " : "Можливе оновлення.",
    "Update running. " : "Запускається оновлення.",
    "Update undefined. " : "Оновлення не визначено.",
    "Status of the service cannot be determined." : "Статус служби визначити неможливо.",
    "No database date available." : "База даних відсутня.",
    "Database file location not available!" : "Розташування файлу бази даних недоступне!",
    "Update Status not available!" : "Статус оновлення недоступний!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "Вашу спробу входу з країни \"%s\" заблоковано застосунком Nextcloud GeoBlocker. Якщо це помилкове блокування, будь ласка, повідомте адміністратора.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "Гаразд. Ця служба завжди повертає \"%s\" для \"Країну не знайдено\".",
    "OK." : "Гаразд.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "ПОМИЛКА: Ймовірно службу не встановлена на хості сервера Nextcloud або служба недоступна для вебсервера, або її неправильно налаштовано (перевірте, чи доступна база даних для даних IPv4 та IPv6?!). Також, можливо, використання функції php exec() вимкнено у файлі  php.ini.",
    "Date of the database cannot be determined!" : "Неможливо визначити дату створення бази!",
    "local" : "локальна",
    "default" : "типово",
    "ERROR: There is an unknown problem with the service." : "ПОМИЛКА: Виникла невідома проблема зі службою.",
    "ERROR: Country cannot be found." : "ПОМИЛКА: Країну не знайдено",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "ПОМИЛКА: База даних недійсна, не має правильних прав доступу або не розміщена в %s.",
    "ERROR: Invalid Argument." : "ПОМИЛКА: Неправильний аргумент.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "ПОМИЛКА: \"geoip2.phar\", здається, розміщено неправильно або не має належних прав доступу.",
    "No entries in the database. Please run update." : "В базі даних немає записів. Будь ласка, запустіть оновлення. ",
    "ERROR:" : "ПОМИЛКА:",
    "OK" : "Гаразд",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6 працює тільки на 64-бітних (або вище) системах. При оновленні системи до 64-бітної не забудьте оновити БД. ",
    "The database is currently updating. During the update the service can be used with the last valid data." : "Наразі база даних оновлюється. Під час оновлення, сервісом можна користуватися з останніми дійсними даними.",
    "The last update try ended in an error but the service can be used with the last valid data." : "Остання спроба оновлення завершилася помилкою, але послугу можна використовувати з останніми дійсними даними.",
    "Last error message:" : "Останнє повідомлення про помилку:",
    "PHP GMP Extension needs to be installed." : "Необхідно встановити PHP GMP Extension.",
    "The database is not initialized. Please run update." : "База даних не ініціалізована. Будь ласка, запустіть оновлення. ",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "Наразі відбувається ініціалізація бази даних. Будь ласка, зачекайте до завершення оновлення. Це може зайняти декілька хвилин. ",
    "The database is corrupted. Please run update again." : "База даних пошкоджена. Будь ласка, запустіть оновлення ще раз. ",
    "Something is missing." : "Чогось не вистачає.",
    "No database available!" : "База даних відсутня! ",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "Для регіону \"%s\" не вдалося прочитати жодного правильного запису. Можливо, RIR змінив формат файлу.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "Неправильна кількість прочитаних записів для IPv4 у регіоні \"%s\". Мало бути %d, але було %d.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "Неправильна кількість прочитаних записів для IPv6 у регіоні \"%s\". Мало бути %d, але було %d.",
    "Exception caught during Update for region \"%s\": %s" : "Виняток виявлено під час оновлення для регіону \"%s\": %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "Неправильний дескриптор файлу для регіону \"%s\". Ймовірно, під час оновлення було втрачено інтернет-з'єднання.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "\"allow_url_fopen\" потрібно дозволити у php.ini.",
    "Internet connection needs to be available." : "Необхідно мати доступ до Інтернету.",
    "IPv6 is not included on systems with less than 64-bit." : "IPv6 не підтримується в системах з розрядністю менше 64 біт.",
    "Current number of entries:" : "Поточна кількість записів:",
    "Update in undefined state. Please complain to the developer." : "Оновлення в невизначеному стані. Будь ласка, зверніться зі скаргою до розробника. ",
    "GeoBlocker" : "Географічне блокування",
    "Blocks user depending on the estimated country of their IP address." : "Блокує користувача залежно від країни, з якої, за оцінками, походить його IP-адреса.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "Це фронт-енд для служб геолокалізації, який дає змогу блокувати (beta), затримувати (beta) і реєструвати спроби входу в систему із зазначених країн.\nСпроби входу з IP-адрес локальної мережі ніколи не блокуються, не затримуються і не реєструються.\nУ поточній реалізації сторінка входу в систему нормально відображається всім, незалежно від країни. Також спроби входу в систему з неіснуючим користувачем, як зазвичай, зазнають невдачі незалежно від країни.\nНеправильна конфігурація Nextcloud (особливо в контейнері) може призвести до того, що весь доступ здається вихідним з IP-адреси локальної мережі.\nВизначення країни за IP-адресою буде настільки точним, наскільки точним є обраний сервіс.\n\nКраїни можуть бути визначені за допомогою дозвільного списку або блокувального списку.\n\nНаразі доступні такі сервіси локалізації:\n- Geoiplookup (локальна програма на хості)\n- MaxMind GeoLite2 (локальна база даних, доступ до якої здійснюється через PHP API)\n- Дані з регіональних інтернет-реєстраторів (база даних Nextcloud SQL створюється на основі даних, завантажених з FTP-серверів RIR).\n\nЩоб дізнатися, як налаштувати сервіси локалізації, будь ласка, зазирніть у репозиторій GitHub (головна сторінка праворуч).",
    "Loading" : "Завантаження",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "Це фронт-енд до сервісів геолокалізації, який дозволяє блокувати (бета-версія), затримувати (бета-версія) та реєструвати спроби входу в систему з визначених країн.",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "Спроби входу з IP-адрес локальної мережі ніколи не блокуються, не затримуються і не реєструються. ",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "У поточній реалізації сторінка входу зазвичай відображається всім незалежно від країни. Крім того, спроби входу з неіснуючим користувачем завершуються невдачею, незалежно від країни.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "Неправильна конфігурація Nextcloud (особливо в контейнері) може призвести до того, що всі доступи відбуватимуться з IP-адреси локальної мережі.",
    "If you are accessing from external network, this should be an external IP address:" : "Якщо ви отримуєте доступ із зовнішньої мережі, це має бути зовнішня IP-адреса:",
    "is local." : "внутрішній.",
    "is external." : "зовнішній.",
    "Determination of the country from IP address is only as good as the chosen service." : "Визначення країни за IP-адресою залежить від вибраної послуги.",
    "For help how to setup the localization services, have a look into the Readme in the" : "Щоб дізнатися, як налаштувати служби локалізації, ознайомтеся з файлом Readme в",
    "repository" : "репозиторій",
    "Service" : "Сервіс ",
    "Choose the service you want to use to determine the country from the IP Address:" : "Виберіть сервіс, яким ви хочете скористатися для визначення країни за IP-адресою:",
    "Status of the chosen service: " : "Статус обраного сервісу:",
    "Date of the database: " : "Дата створення бази даних: ",
    "Configuration of the chosen service: " : "Налаштування обраного сервісу:",
    "Location of the database (full path including the file name):" : "Розташування бази даних (повний шлях, включно з ім'ям файлу):",
    "Update Database" : "Оновити базу даних",
    "Country Selection" : "Вибір країни",
    "Choose the selection mode" : "Виберіть режим вибору",
    "No country is blocked but the selected ones (blocklist)" : "Блокувати тільки обрані країни (чорний список)",
    "All countries are blocked but the selected ones (allowlist)" : "Не блокувати тільки обрані країни (білий список)",
    "Select countries from list" : "Виберіть країни зі списку",
    "The following countries were selected in the list above: " : "До переліку, наведеного вище, було відібрано такі країни:",
    "Reaction" : "Реакція",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "Якщо виявлено спробу входу з обраних країн, ця спроба реєструється з наступною інформацією",
    "( be aware of data protection issues depending on your logging strategy)" : "(пам'ятайте про проблеми захисту даних залежно від вашої стратегії ведення журналу)",
    "with IP Address" : "IP-адреса",
    "with Country Code" : "код країни",
    "with username" : "ім'я користувача",
    "In addition, the login attempt can also be delayed and blocked." : "Крім того, спроба входу також може бути відкладена та заблокована.",
    "(beta version)" : "(бета-версія) ",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "Увімкнути уповільнення спроб входу з IP-адрес зазначених країн. ",
    "(30 seconds)" : "(30 секунд) ",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "Увімкнути блокування входу з IP-адрес зазначених країн. ",
    "Test" : "Тест ",
    "Possibilities to test if the Geoblocker is working as expected:" : "Можливості перевірити, чи працює Geoblocker належним чином:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "Наступна спроба входу користувача \"%s\" буде зімітована як вхід з наступної IP-адреси:",
    "COUNTRY NOT FOUND" : "КРАЇНА НЕ ЗНАЙДЕНА",
    "Andorra" : "Андорра",
    "United Arab Emirates" : "Об'єднані Арабські Емірати",
    "Afghanistan" : "Афганістан",
    "Antigua and Barbuda" : "Антигуа та Барбуда",
    "Anguilla" : "Ангілья ",
    "Albania" : "Албанія ",
    "Armenia" : "Вірменія",
    "Angola" : "Ангола ",
    "Antarctica" : "Антарктида",
    "Argentina" : "Аргентина ",
    "American Samoa" : "Американське Самоа ",
    "Austria" : "Австрія ",
    "Australia" : "Австралія ",
    "Aruba" : "Аруба ",
    "Åland Islands" : "Аландські острови ",
    "Azerbaijan" : "Азербайджан",
    "Bosnia and Herzegovina" : "Боснія і Герцеговина",
    "Barbados" : "Барбадос",
    "Bangladesh" : "Бангладеш",
    "Belgium" : "Бельгія ",
    "Burkina Faso" : "Буркіна-Фасо",
    "Bulgaria" : "Болгарія ",
    "Bahrain" : "Бахрейн ",
    "Burundi" : "Бурунді ",
    "Benin" : "Бенін",
    "Saint Barthélemy" : "Сен-Бартелемі ",
    "Bermuda" : "Бермудські острови",
    "Brunei Darussalam" : "Бруней",
    "Bolivia (Plurinational State of)" : "Болівія",
    "Bonaire, Sint Eustatius and Saba" : "Бонайре, Сінт-Естатіус і Саба",
    "Brazil" : "Бразилія ",
    "Bahamas" : "Багамські острови",
    "Bhutan" : "Бутан ",
    "Bouvet Island" : "Острів Буве",
    "Botswana" : "Ботсвана ",
    "Belarus" : "Білорусь",
    "Belize" : "Беліз ",
    "Canada" : "Канада",
    "Cocos (Keeling) Islands" : "Кокосові (Кілінгові) острови ",
    "Congo, Democratic Republic of the" : "Демократична Республіка Конго",
    "Central African Republic" : "Центральноафриканська Республіка ",
    "Congo" : "Конго ",
    "Switzerland" : "Швейцарія ",
    "Côte d'Ivoire" : "Кот-д'Івуар ",
    "Cook Islands" : "Острови Кука",
    "Chile" : "Чилі ",
    "Cameroon" : "Камерун ",
    "China" : "Китай ",
    "Colombia" : "Колумбія ",
    "Costa Rica" : "Коста-Ріка ",
    "Cuba" : "Куба ",
    "Cabo Verde" : "Кабо-Верде",
    "Curaçao" : "Кюрасао",
    "Christmas Island" : "Острів Різдва ",
    "Cyprus" : "Кіпр ",
    "Czechia" : "Чехія ",
    "Germany" : "Німеччина ",
    "Djibouti" : "Джибуті ",
    "Denmark" : "Данія ",
    "Dominica" : "Домініка ",
    "Dominican Republic" : "Домініканська Республіка ",
    "Algeria" : "Алжир",
    "Ecuador" : "Еквадор",
    "Estonia" : "Естонія",
    "Egypt" : "Єгипет",
    "Western Sahara" : "Західна Сахара ",
    "Eritrea" : "Еритрея",
    "Spain" : "Іспанія",
    "Ethiopia" : "Ефіопія",
    "Finland" : "Фінляндія",
    "Fiji" : "Фіджі",
    "Falkland Islands (Malvinas)" : "Фолклендські (Мальвінські) острови ",
    "Micronesia (Federated States of)" : "Мікронезія (Федеративні Штати) ",
    "Faroe Islands" : "Фарерські острови ",
    "France" : "Франція",
    "Gabon" : "Габон",
    "United Kingdom of Great Britain and Northern Ireland" : "Велика Британія",
    "Grenada" : "Гренада",
    "Georgia" : "Грузія",
    "French Guiana" : "Французька Гвіана ",
    "Guernsey" : "Гернсі",
    "Ghana" : "Гана",
    "Gibraltar" : "Гібралтар",
    "Greenland" : "Гренландія",
    "Gambia" : "Гамбія",
    "Guinea" : "Гвінея",
    "Guadeloupe" : "Гваделупа",
    "Equatorial Guinea" : "Екваторіальна Гвінея ",
    "Greece" : "Греція",
    "South Georgia and the South Sandwich Islands" : "Південна Джорджія і Південні Сандвічеві Острови",
    "Guatemala" : "Гватемала",
    "Guam" : "Гуам",
    "Guinea-Bissau" : "Гвінея-Бісау ",
    "Guyana" : "Гайана",
    "Hong Kong" : "Гонконг",
    "Heard Island and McDonald Islands" : "Острови Герд і Макдональд",
    "Honduras" : "Гондурас",
    "Croatia" : "Хорватія",
    "Haiti" : "Гаїті",
    "Hungary" : "Угорщина",
    "Indonesia" : "Індонезія",
    "Ireland" : "Ірландія",
    "Israel" : "Ізраїль",
    "Isle of Man" : "Острів Мен",
    "India" : "Індія",
    "British Indian Ocean Territory" : "Британська територія в Індійському океані ",
    "Iraq" : "Ірак",
    "Iran (Islamic Republic of)" : "Іран (Ісламська Республіка) ",
    "Iceland" : "Ісландія",
    "Italy" : "Італія",
    "Jersey" : "Джерсі",
    "Jamaica" : "Ямайка",
    "Jordan" : "Йорданія",
    "Japan" : "Японія",
    "Kenya" : "Кенія",
    "Kyrgyzstan" : "Киргизстан",
    "Cambodia" : "Камбоджа",
    "Kiribati" : "Кірибаті",
    "Comoros" : "Коморські острови",
    "Saint Kitts and Nevis" : "Сент-Кіттс і Невіс",
    "Korea (Democratic People's Republic of)" : "Корея (Корейська Народно-Демократична Республіка) ",
    "Korea, Republic of" : "Корея, Республіка ",
    "Kuwait" : "Кувейт",
    "Cayman Islands" : "Кайманові острови ",
    "Kazakhstan" : "Казахстан",
    "Lao People's Democratic Republic" : "Лаоська Народно-Демократична Республіка",
    "Lebanon" : "Ліван",
    "Saint Lucia" : "Сент-Люсія ",
    "Liechtenstein" : "Ліхтенштейн",
    "Sri Lanka" : "Шрі-Ланка ",
    "Liberia" : "Ліберія",
    "Lesotho" : "Лесото",
    "Lithuania" : "Литва",
    "Luxembourg" : "Люксембург",
    "Latvia" : "Латвія",
    "Libya" : "Лівія",
    "Morocco" : "Марокко",
    "Monaco" : "Монако",
    "Moldova, Republic of" : "Молдова",
    "Montenegro" : "Чорногорія",
    "Saint Martin (French part)" : "Сен-Мартен (французька частина) ",
    "Madagascar" : "Мадагаскар",
    "Marshall Islands" : "Маршаллові острови",
    "North Macedonia" : "Північна Македонія ",
    "Mali" : "Малі",
    "Myanmar" : "М'янма",
    "Mongolia" : " Монголія ",
    "Macao" : "Макао",
    "Northern Mariana Islands" : "Північні Маріанські острови",
    "Martinique" : "Мартиніка",
    "Mauritania" : "Мавританія",
    "Montserrat" : "Монтсеррат",
    "Malta" : "Мальта",
    "Mauritius" : "Маврикій",
    "Maldives" : "Мальдіви",
    "Malawi" : "Малаві",
    "Mexico" : "Мексика",
    "Malaysia" : "Малайзія",
    "Mozambique" : "Мозамбік",
    "Namibia" : "Намібія",
    "New Caledonia" : "Нова Каледонія ",
    "Niger" : "Нігер",
    "Norfolk Island" : "Острів Норфолк ",
    "Nigeria" : "Нігерія",
    "Nicaragua" : "Нікарагуа",
    "Netherlands" : "Нідерланди",
    "Norway" : "Норвегія",
    "Nepal" : "Непал",
    "Nauru" : "Науру",
    "Niue" : "Ніуе",
    "New Zealand" : "Нова Зеландія ",
    "Oman" : "Оман",
    "Panama" : "Панама",
    "Peru" : "Перу",
    "French Polynesia" : "Французька Полінезія ",
    "Papua New Guinea" : "Папуа-Нова Гвінея",
    "Philippines" : "Філіппіни",
    "Pakistan" : "Пакистан",
    "Poland" : "Польща",
    "Saint Pierre and Miquelon" : "Сен-П'єр і Мікелон ",
    "Pitcairn" : "Піткерн",
    "Puerto Rico" : "Пуерто-Ріко ",
    "Palestine, State of" : "Палестина",
    "Portugal" : "Португалія",
    "Palau" : "Палау",
    "Paraguay" : "Парагвай",
    "Qatar" : "Катар",
    "Réunion" : "Реюньйон",
    "Romania" : "Румунія",
    "Serbia" : "Сербія",
    "Russian Federation" : "Російська Федерація ",
    "Rwanda" : "Руанда",
    "Saudi Arabia" : "Саудівська Аравія ",
    "Solomon Islands" : "Соломонові острови ",
    "Seychelles" : "Сейшельські острови ",
    "Sudan" : "Судан",
    "Sweden" : "Швеція",
    "Singapore" : "Сингапур",
    "Saint Helena, Ascension and Tristan da Cunha" : "Острови Святої Єлени, Вознесіння та Тристан-да-Кунья ",
    "Slovenia" : "Словенія",
    "Svalbard and Jan Mayen" : "Шпіцберген і Ян-Майєн ",
    "Slovakia" : "Словаччина",
    "Sierra Leone" : "Сьєрра-Леоне ",
    "San Marino" : "Сан-Марино ",
    "Senegal" : "Сенегал",
    "Somalia" : "Сомалі",
    "Suriname" : "Суринам",
    "South Sudan" : "Південний Судан ",
    "Sao Tome and Principe" : "Сан-Томе і Принсіпі ",
    "El Salvador" : "Сальвадор ",
    "Sint Maarten (Dutch part)" : "Сінт-Мартен (нідерландська частина) ",
    "Syrian Arab Republic" : "Сирійська Арабська Республіка ",
    "Eswatini" : "Есватіні",
    "Turks and Caicos Islands" : "Острови Теркс і Кайкос ",
    "Chad" : "Чад",
    "French Southern Territories" : "Французькі Південні й Антарктичні Території",
    "Togo" : "Того",
    "Thailand" : "Таїланд",
    "Tajikistan" : "Таджикистан",
    "Tokelau" : "Токелау",
    "Timor-Leste" : "Тимор-Лешті ",
    "Turkmenistan" : "Туркменістан",
    "Tunisia" : "Туніс",
    "Tonga" : "Тонга",
    "Turkey" : "Туреччина",
    "Trinidad and Tobago" : "Тринідад і Тобаго ",
    "Tuvalu" : "Тувалу",
    "Taiwan, Province of China" : "Тайвань",
    "Tanzania, United Republic of" : "Танзанія",
    "Ukraine" : "Україна",
    "Uganda" : "Уганда",
    "United States Minor Outlying Islands" : "Малі Віддалені Острови Сполучених Штатів Америки ",
    "United States of America" : "Сполучені Штати Америки ",
    "Uruguay" : "Уругвай",
    "Uzbekistan" : "Узбекистан",
    "Holy See" : "Святий Престол ",
    "Saint Vincent and the Grenadines" : "Сент-Вінсент і Гренадини ",
    "Venezuela (Bolivarian Republic of)" : "Венесуела (Боліваріанська Республіка) ",
    "Virgin Islands (British)" : "Віргінські острови (Британські) ",
    "Virgin Islands (U.S.)" : "Віргінські острови (США) ",
    "Viet Nam" : "В'єтнам ",
    "Vanuatu" : "Вануату",
    "Wallis and Futuna" : "Волліс і Футуна",
    "Samoa" : "Самоа",
    "Yemen" : "Ємен",
    "Mayotte" : "Майотта",
    "South Africa" : "Півде́нно-Африка́нська Респу́бліка",
    "Zambia" : "Замбія",
    "Zimbabwe" : "Зімбабве"
},
"nplurals=4; plural=(n % 1 == 0 && n % 10 == 1 && n % 100 != 11 ? 0 : n % 1 == 0 && n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 12 || n % 100 > 14) ? 1 : n % 1 == 0 && (n % 10 ==0 || (n % 10 >=5 && n % 10 <=9) || (n % 100 >=11 && n % 100 <=14 )) ? 2: 3);");

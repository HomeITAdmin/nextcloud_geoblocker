OC.L10N.register(
    "geoblocker",
    {
    "Update not possible. " : "업데이트가 불가능함.",
    "Update possible. " : "업데이트가 가능함.",
    "Update running. " : "업데이트가 실행중.",
    "Update undefined. " : "업데이트가 정의되지 않음.",
    "Status of the service cannot be determined." : "서비스 상태를 판단할 수 없음.",
    "No database date available." : "데이터베이스 사용할 수 없음",
    "Database file location not available!" : "데이터베이스 위치를 사용할 수 없음!",
    "Update Status not available!" : "업데이트 상태를 사용할 수 없음!",
    "Your attempt to login from country \"%s\" is blocked by the Nextcloud GeoBlocker App. If this is a problem for you, please contact your administrator." : "\"%s\"(으)로부터의 로그인 시도는 Nextcloud GeoBlocker 앱에 의해 차단되었습니다. 이것이 문제일 경우, 관리자에게 문의하십시오.",
    "OK. This service always returns \"%s\" for \"Country not found\"." : "확인. 본 서비스는 항상 \"국가를 찾을 수 없음\"에 대해 \"%s'을(를) 출력합니다.",
    "OK." : "확인.",
    "ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "오류: 서비스가 Nextcloud 서버 호스트에 설치되지 않았거나 서비스가 웹 서버에 접근 할 수 없거나 서비스가 잘못 설정된 것 같습니다 (IPv4와 IPv6에 대한 데이터베이스를 제대로 사용 가능합니까?!). 아마 php 기능 exec()의 사용이 php.ini에서 disabled로 설정된 것 같습니다.",
    "Date of the database cannot be determined!" : "데이터베이스의 날짜를 판단할 수 없습니다!",
    "local" : "로컬",
    "default" : "기본값",
    "ERROR: There is an unknown problem with the service." : "오류: 서비스에서 알려지지 않은 문제가 발생했습니다.",
    "ERROR: Country cannot be found." : "오류: 국가를 찾을 수 없습니다.",
    "ERROR: Database is not valid, does not have the correct access rights or is not placed at %s." : "오류: 데이터베이스가 올바르지 않습니다. 데이터베이스에 올바른 접근 권한이 설정되지 않았거나 %s에 위치하지 않습니다.",
    "ERROR: Invalid Argument." : "오류: 인자가 올바르지 않습니다.",
    "ERROR: \"geoip2.phar\" does not seem to be placed correctly or does not have the correct access rights." : "오류: \"geoip2.phar\"가 제대로 위치하지 않거나 올바른 접근 권한을 가지고 있지 않습니다. ",
    "No entries in the database. Please run update." : "데이터베이스에 항목이 없습니다. 업데이트를 실행하십시오.",
    "ERROR:" : "오류: ",
    "OK" : "확인",
    "IPv6 works only on 64-bit (or higher) systems. When upgrading the system to 64-bit remember to update the DB again." : "IPv6은 64비트 이상의 시스템에서만 동작합니다. 시스템을 64비트로 업그레이드 할 때 데이터베이스를 다시 업데이트 하십시오.",
    "The database is currently updating. During the update the service can be used with the last valid data." : "데이터베이스가 업데이트 중입니다. 업데이트가 진행될 때 서비스는 최근의 유효한 데이터를 사용할 수 있습니다.",
    "The last update try ended in an error but the service can be used with the last valid data." : "마지막 업데이트가 오류로 끝났습니다. 서비스는 최근의 유효한 데이터를 이용합니다.",
    "Last error message:" : "최근 오류 메시지:",
    "PHP GMP Extension needs to be installed." : "PHP GMP 확장이 설치되어야 합니다.",
    "The database is not initialized. Please run update." : "데이터베이스가 초기화되지 않았습니다. 업데이트를 실행하십시오.",
    "The database is currently initializing. Please wait until update is finished. This may take several minutes." : "데이터베이스가 초기화 중입니다. 업데이트를 마칠 때 까지 기다리십시오. 몇 분이 걸릴 수 있습니다.",
    "The database is corrupted. Please run update again." : "데이터베이스가 잘못되었습니다. 업데이트를 다시 실행하십시오.",
    "Something is missing." : "무엇인가 유실된 것 같습니다.",
    "No database available!" : "데이터베이스를 사용할 수 없음!",
    "No valid entries could be read for region \"%s\". Maybe the RIR has changed the file format." : "\"%s\" 지역에서 읽을 수 있는 올바른 항목이 없습니다. RIR이 파일 형식을 변경한 것 같습니다.",
    "Not the right number of entries read for IPv4 in region \"%s\". Should have been %d but was %d." : "\"%s\" 지역에서 IPv4로 읽을 수 있는 항목의 수가 아닙니다. %d이(가) 옳고 %d은(는) 옳지 않습니다.",
    "Not the right number of entries read for IPv6 in region \"%s\". Should have been %d but was %d." : "\"%s\" 지역에서 IPv6로 읽을 수 있는 항목의 수가 아닙니다. %d이(가) 옳고 %d은(는) 옳지 않습니다.",
    "Exception caught during Update for region \"%s\": %s" : "\"%s\" 지역에 대한 업데이트 중 예외 사항이 발견되었습니다 : %s",
    "Invalid file handle for region \"%s\". Probably the internet connection got lost during the update." : "\"%s\" 지역에 대한 잘못된 파일 핸들입니다. 업데이트 도중 인터넷 연결이 끊어진 것 같습니다.",
    "\"allow_url_fopen\" needs to be allowed in php.ini." : "php.ini에서 \"allow_url_fopen\"을 허용해야합니다.",
    "Internet connection needs to be available." : "인터넷 연결이 필요합니다.",
    "IPv6 is not included on systems with less than 64-bit." : "64비트 미만의 시스템은 IPv6를 포함하지 않습니다.",
    "Current number of entries:" : "현재 항목의 수:",
    "Update in undefined state. Please complain to the developer." : "정의되지 않은 국가에 대한 업데이트입니다. 개발자에게 문의하십시오.",
    "GeoBlocker" : "GeoBlocker",
    "Blocks user depending on the estimated country of thier IP address." : "IP 주소로 사용자의 국가를 추측하여 차단하십시오.",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries.\nLogin attempts from local network IP addresses are never blocked, delayed or logged.\nIn the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country.\nWrong Nextcloud configuration (especially in container) can lead to all access seems to come from local network IP address.\nDetermination of the country from IP address is only as good as the chosen service.\n\nCountries can be specified using allowlisting or blocklisting.\n\nCurrently available localization services are:\n- Geoiplookup (local programm on the host)\n- MaxMind GeoLite2 (local database accessed via PHP API)\n- Data from Regional Internet Registries (Nextcloud SQL database build up with data downloaded from the RIRs FTP servers)\n\nFor help how to set up the localization services please have a look at the GitHub repository (homepage on the right side)." : "본 서비스는 특정 국가로부터의 로그인 시도를 차단 (베타), 지연 (베타), 기록할 수 있도록 해주는 위치 기반 프론트 엔트 서비스입니다. \n로컬 네트워크 IP 주소로부터 시도하는 로그인을 차단, 지연, 기록 하지는 않습니다.\n현재, 로그인 페이지는 국가와 상관 없이 모두에게 보여집니다. 존재하지 않는 사용자에 대한 로그인 시도 또한 국가와 상관 없이 실패합니다.\n잘못된 Nextcloud 설정 (특히, container에서)은 모든 접근을 로컬 네트워크 IP 주소로부터 이뤄지는 것 처럼 보이도록 합니다.\nIP 주소로부터 국가를 판단하는 것은 선택한 위치 서비스에 따라 달라집니다.\n\n허용 목록과 차단 목록을 사용하여 접속 국가를 특정할 수 있습니다.\n\n현재 사용 가능한 위치 서비스는 다음과 같습니다:\n- Geoiplookup (호스트 상의 로컬 프로그램)\n- MaxMind GeoLite2 (PHP API를 통한 로컬 데이터베이스 접근)\n- Data from Regional Internet Registries (RIRs FTP 서버에서 다운로드된 데이터로 구축된 Nextcloud SQL 데이터베이스)\n\n위치 서비스를 설정하는 방법에 대해 도움이 필요할 경우, GitHub repository (우측 홈페이지)를 참조하십시오.",
    "Loading" : "불러오는 중",
    "This is a front end to geo localization services, that allows blocking (beta), delaying (beta) and logging of login attempts from specified countries. " : "본 서비스는 특정 국가로부터의 로그인 시도를 차단 (베타), 지연 (베타), 기록할 수 있도록 해주는 위치 기반 프론트 엔트 서비스입니다. ",
    "Login attempts from local network IP addresses are never blocked, delayed or logged." : "로컬 네트워크 IP 주소로부터 시도하는 로그인을 차단, 지연, 기록 하지는 않습니다.",
    "In the current implementation the login page is normally shown to everybody independent of the country. Also login attempts with a non existing user are failing as usual independent of the country." : "현재, 로그인 페이지는 국가와 상관 없이 모두에게 보여집니다. 존재하지 않는 사용자에 대한 로그인 시도 또한 국가와 상관 없이 실패합니다.",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "잘못된 Nextcloud 설정 (특히, container에서)은 모든 접근을 로컬 네트워크 IP 주소로부터 이뤄지는 것 처럼 보이도록 합니다.",
    "If you are accessing from external network, this should be an external IP address:" : "외부 네트워크로부터 접속하려는 경우, 외부 IP 주소일 것입니다:",
    "is local." : "은(는) 로컬입니다.",
    "is external." : "은(는) 외부입니다.",
    "Determination of the country from IP address is only as good as the chosen service." : "IP 주소로부터 국가를 판단하는 것은 선택한 서비스에 따라 달라집니다.",
    "For help how to setup the localization services, have a look into the Readme in the" : "위치 서비스를 설정하는 방법에 대해 도움이 필요할 경우, 다음 Readme 파일을 참조하십시오: ",
    "repository" : "repository",
    "Service" : "서비스",
    "Choose the service you want to use to determine the country from the IP Address:" : "IP 주소로 국가를 특정할 때 사용할 서비스를 고르십시오:",
    "Status of the chosen service: " : "선택한 서비스의 상태:",
    "Date of the database: " : "데이터베이스의 날짜:",
    "Configuration of the chosen service: " : "선택한 서비스의 설정:",
    "Location of the database (full path including the file name):" : "데이터베이스의 위치 (파일명을 포함한 전체 경로):",
    "Update Database" : "데이터 베이스 최신화",
    "Country Selection" : "국가 선택",
    "Choose the selection mode" : "선택 모드를 고르십시오",
    "No country is blocked but the selected ones (blocklist)" : "선택한 국가를 차단합니다. (차단 목록 방식)",
    "All countries are blocked but the selected ones (allowlist)" : "선택한 국가만 접속을 허용합니다. (허용 목록 방식)",
    "Select countries from list" : "목록에서 국가를 선택하기",
    "The following countries were selected in the list above: " : "위 목록에서 다음의 국가가 선택되었습니다:",
    "Reaction" : "반응",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "선택한 국가에서 로그인 시도가 감지되었을 경우, 해당 사항은 다음의 정보와 함께 기록됩니다",
    "( be aware of data protection issues depending on your logging strategy)" : "(기록 데이터 보호에 주의하십시오)",
    "with IP Address" : "IP 주소",
    "with Country Code" : "국가 코드",
    "with username" : "사용자 이름",
    "In addition, the login attempt can also be delayed and blocked." : "또한, 로그인 시도를 지연시키거나 차단할 수 있습니다.",
    "(beta version)" : "(베타 버전)",
    "Activate delaying of login attempts from IP addresses of the specified countries." : "지정한 국가의 IP 주소로 이뤄지는 로그인을 지연하십시오.",
    "(30 seconds)" : "(30 초)",
    "Activate blocking of login attempts from IP addresses of the specified countries." : "지정한 국가의 IP 주소로 이뤄지는 로그인을 차단하십시오.",
    "Test" : "테스트",
    "Possibilities to test if the Geoblocker is working as expected:" : "Geoblocker의 정상 동작을 시험할 상황:",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "사용자 \"%s\"의 다음 로그인은 이 IP 주소로 로그인 하는 상황을 시험합니다:",
    "COUNTRY NOT FOUND" : "국가를 찾을 수 없음",
    "Andorra" : "안도라",
    "United Arab Emirates" : "아랍에미리트",
    "Afghanistan" : "아프가니스탄",
    "Antigua and Barbuda" : "앤티가바부다",
    "Anguilla" : "앵귈라",
    "Albania" : "알바니아",
    "Armenia" : "아르메니아",
    "Angola" : "앙골라",
    "Antarctica" : "남극",
    "Argentina" : "아르헨티나",
    "American Samoa" : "미국령 사모아",
    "Austria" : "오스트리아",
    "Australia" : "오스트레일리아",
    "Aruba" : "아루바",
    "Åland Islands" : "올란드 제도",
    "Azerbaijan" : "아제르바이잔",
    "Bosnia and Herzegovina" : "보스니아 헤르체고비나",
    "Barbados" : "바베이도스",
    "Bangladesh" : "방글라데시",
    "Belgium" : "벨기에",
    "Burkina Faso" : "부르키나 파소",
    "Bulgaria" : "불가리아",
    "Bahrain" : "바레인",
    "Burundi" : "부룬디",
    "Benin" : "베냉",
    "Saint Barthélemy" : "성 바르텔레미",
    "Bermuda" : "버뮤다",
    "Brunei Darussalam" : "브루나이",
    "Bolivia (Plurinational State of)" : "볼리비아",
    "Bonaire, Sint Eustatius and Saba" : "보나이러",
    "Brazil" : "브라질",
    "Bahamas" : "바하마",
    "Bhutan" : "부탄",
    "Bouvet Island" : "부베 섬",
    "Botswana" : "보츠와나",
    "Belarus" : "벨라루스",
    "Belize" : "벨리즈",
    "Canada" : "캐나다",
    "Cocos (Keeling) Islands" : "코코스 킬링 제도",
    "Congo, Democratic Republic of the" : "콩고민주공화국",
    "Central African Republic" : "중앙아프리카공화국",
    "Congo" : "콩고",
    "Switzerland" : "스위스",
    "Côte d'Ivoire" : "코트디부아르",
    "Cook Islands" : "쿡 제도",
    "Chile" : "칠레",
    "Cameroon" : "카메룬",
    "China" : "중국",
    "Colombia" : "콜롬비아",
    "Costa Rica" : "코스타리카",
    "Cuba" : "쿠바",
    "Cabo Verde" : "카보베르데",
    "Curaçao" : "퀴라소",
    "Christmas Island" : "크리스마스 섬",
    "Cyprus" : "사이프러스",
    "Czechia" : "체코",
    "Germany" : "독일",
    "Djibouti" : "지부티",
    "Denmark" : "덴마크",
    "Dominica" : "도미니카",
    "Dominican Republic" : "도미니카공화국",
    "Algeria" : "알제리",
    "Ecuador" : "에콰도르",
    "Estonia" : "에스토니아",
    "Egypt" : "이집트",
    "Western Sahara" : "서사하라",
    "Eritrea" : "에리트레아",
    "Spain" : "스페인",
    "Ethiopia" : "에티오피아",
    "Finland" : "핀란드",
    "Fiji" : "피지",
    "Falkland Islands (Malvinas)" : "포클랜드제도",
    "Micronesia (Federated States of)" : "미크로네시아",
    "Faroe Islands" : "패로제도",
    "France" : "프랑스",
    "Gabon" : "가봉",
    "United Kingdom of Great Britain and Northern Ireland" : "영국",
    "Grenada" : "그레나다",
    "Georgia" : "조지아",
    "French Guiana" : "프랑스령 기아나",
    "Guernsey" : "건지",
    "Ghana" : "가나",
    "Gibraltar" : "지브롤터",
    "Greenland" : "그린랜드",
    "Gambia" : "잠비아",
    "Guinea" : "기니",
    "Guadeloupe" : "과들루프",
    "Equatorial Guinea" : "적도 기니",
    "Greece" : "그리스",
    "South Georgia and the South Sandwich Islands" : "사우스조지아 사우스샌드위치 제도",
    "Guatemala" : "과테말라",
    "Guam" : "괌",
    "Guinea-Bissau" : "기니비사우",
    "Guyana" : "가이아나",
    "Hong Kong" : "홍콩",
    "Heard Island and McDonald Islands" : "허드 맥도널드 제도",
    "Honduras" : "온두라스",
    "Croatia" : "크로아티아",
    "Haiti" : "아이티",
    "Hungary" : "헝가리",
    "Indonesia" : "인도네시아",
    "Ireland" : "아일랜드",
    "Israel" : "이스라엘",
    "Isle of Man" : "맨섬",
    "India" : "인도",
    "British Indian Ocean Territory" : "영국령인도양식민지",
    "Iraq" : "이라크",
    "Iran (Islamic Republic of)" : "이란",
    "Iceland" : "아이슬란드",
    "Italy" : "이탈리아",
    "Jersey" : "저지",
    "Jamaica" : "자메이카",
    "Jordan" : "요르단",
    "Japan" : "일본",
    "Kenya" : "케냐",
    "Kyrgyzstan" : "키르기스스탄",
    "Cambodia" : "캄보디아",
    "Kiribati" : "키리바시",
    "Comoros" : "코모로",
    "Saint Kitts and Nevis" : "세인트키츠 네비스",
    "Korea (Democratic People's Republic of)" : "조선민주주의인민공화국(북한)",
    "Korea, Republic of" : "대한민국",
    "Kuwait" : "쿠웨이트",
    "Cayman Islands" : "케이맨 제도",
    "Kazakhstan" : "카자흐스탄",
    "Lao People's Democratic Republic" : "라오스",
    "Lebanon" : "레바논",
    "Saint Lucia" : "세인트루시아",
    "Liechtenstein" : "리히텐슈타인",
    "Sri Lanka" : "스리랑카",
    "Liberia" : "라이베리아",
    "Lesotho" : "레소토",
    "Lithuania" : "리투아니아",
    "Luxembourg" : "룩셈부르크",
    "Latvia" : "라트비아",
    "Libya" : "리비아",
    "Morocco" : "모로코",
    "Monaco" : "모나코",
    "Moldova, Republic of" : "몰도바",
    "Montenegro" : "몬테네그로",
    "Saint Martin (French part)" : "세인트마틴섬",
    "Madagascar" : "마다가스카르",
    "Marshall Islands" : "마셜제도",
    "North Macedonia" : "북마케도니아",
    "Mali" : "말리",
    "Myanmar" : "미얀마",
    "Mongolia" : "몽골",
    "Macao" : "마카오",
    "Northern Mariana Islands" : "북마리아나제도",
    "Martinique" : "마르티니크",
    "Mauritania" : "모리타니",
    "Montserrat" : "몬세라트",
    "Malta" : "몰타",
    "Mauritius" : "모리셔스",
    "Maldives" : "몰디브",
    "Malawi" : "말라위",
    "Mexico" : "멕시코",
    "Malaysia" : "말레이시아",
    "Mozambique" : "모잠비크",
    "Namibia" : "나미비아",
    "New Caledonia" : "뉴칼레도니아",
    "Niger" : "니제르",
    "Norfolk Island" : "노퍽 섬",
    "Nigeria" : "나이지리아",
    "Nicaragua" : "니카라과",
    "Netherlands" : "네덜란드",
    "Norway" : "노르웨이",
    "Nepal" : "네팔",
    "Nauru" : "나우루",
    "Niue" : "니우에 섬",
    "New Zealand" : "뉴질랜드",
    "Oman" : "오만",
    "Panama" : "파나마",
    "Peru" : "페루",
    "French Polynesia" : "프랑스령폴리네시아",
    "Papua New Guinea" : "파푸아뉴기니",
    "Philippines" : "필리핀",
    "Pakistan" : "파키스탄",
    "Poland" : "폴란드",
    "Saint Pierre and Miquelon" : "생피에르 미클롱",
    "Pitcairn" : "핏케언 제도",
    "Puerto Rico" : "푸에르토리코",
    "Palestine, State of" : "팔레스타인",
    "Portugal" : "포르투갈",
    "Palau" : "팔라우",
    "Paraguay" : "파라과이",
    "Qatar" : "카타르",
    "Réunion" : "레위니옹",
    "Romania" : "루마니아",
    "Serbia" : "세르비아",
    "Russian Federation" : "러시아",
    "Rwanda" : "르완다",
    "Saudi Arabia" : "사우디아라비아",
    "Solomon Islands" : "솔로몬제도",
    "Seychelles" : "세이셸",
    "Sudan" : "수단",
    "Sweden" : "스웨덴",
    "Singapore" : "싱가포르",
    "Saint Helena, Ascension and Tristan da Cunha" : "세인트헬레나 어센션 트리스탄다쿠냐",
    "Slovenia" : "슬로베니아",
    "Svalbard and Jan Mayen" : "스발바르 얀마옌 제도",
    "Slovakia" : "슬로바키아",
    "Sierra Leone" : "시에라리온",
    "San Marino" : "산마리노",
    "Senegal" : "세네갈",
    "Somalia" : "소말리아",
    "Suriname" : "수리남",
    "South Sudan" : "남수단",
    "Sao Tome and Principe" : "상투메 프린시페 민주 공화국",
    "El Salvador" : "엘살바도르",
    "Sint Maarten (Dutch part)" : "신트마르턴",
    "Syrian Arab Republic" : "시리아",
    "Eswatini" : "에스와티니",
    "Turks and Caicos Islands" : "터크스카이코스 제도",
    "Chad" : "차드",
    "French Southern Territories" : "프랑스령 남부와 남극지역",
    "Togo" : "토고",
    "Thailand" : "타이",
    "Tajikistan" : "타지키스탄",
    "Tokelau" : "토켈라우",
    "Timor-Leste" : "동티모르",
    "Turkmenistan" : "투르크메니스탄",
    "Tunisia" : "튀니지",
    "Tonga" : "통가",
    "Turkey" : "터키",
    "Trinidad and Tobago" : "트리니다드토바고",
    "Tuvalu" : "투발루",
    "Taiwan, Province of China" : "대만",
    "Tanzania, United Republic of" : "탄자니아",
    "Ukraine" : "우크라이나",
    "Uganda" : "우간다",
    "United States Minor Outlying Islands" : "미국령 군소 제도",
    "United States of America" : "미국",
    "Uruguay" : "우루과이",
    "Uzbekistan" : "우즈베키스탄",
    "Holy See" : "바티칸시국",
    "Saint Vincent and the Grenadines" : "세인트빈센트 그레나딘",
    "Venezuela (Bolivarian Republic of)" : "베네수엘라",
    "Virgin Islands (British)" : "영국령 버진 아일랜드",
    "Virgin Islands (U.S.)" : "미국령 버진 아일랜드",
    "Viet Nam" : "베트남",
    "Vanuatu" : "바누아투",
    "Wallis and Futuna" : "왈리스에푸투나",
    "Samoa" : "사모아",
    "Yemen" : "예멘",
    "Mayotte" : "마요트섬",
    "South Africa" : "남아프리카공화국",
    "Zambia" : "잠비아",
    "Zimbabwe" : "짐바브웨"
},
"nplurals=1; plural=0;");

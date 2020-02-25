OC.L10N.register(
    "geoblocker",
    {
    "The user \"%s\" logged in with IP address \"%s\" from blocked country \"%s\"." : "用户 “%s” 使用一个被封锁的国家“%s”的 IP 地址“%s”登录。",
    "The login of user \"%s\" with IP address \"%s\" could not be checked due to problems with location service." : "由于位置服务出现的问题，无法检查 IP 地址为 “%s” 的用户 “%s”的登录。",
    "The user \"%s\" logged in with an invalid IP address \"%s\"." : "用户“%s”以非法IP地址“%s”登录。",
    "OK.  (Please make sure the databases are up to date. This is currently not checked here.)" : "好的。（请确保数据库是最新的，当前未在此处选中。）",
    "ERROR: \"geoiplookup\" seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini." : "错误：Nextcloud服务器的主机上似乎未安装“ geoiplookup”，Web服务器无法访问或配置错误（IPv4和IPv6的数据库是否可用？！）。也许在php.ini中禁用了php函数exec()的使用。",
    "GeoBlocker" : "地理阻止器",
    "Blocks user depending on the estimated country of thier IP address." : "根据其IP地址对应的国家来封锁用户。",
    "This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries. (Early Version)" : "这是地理定位服务的一个前端，允许阻止（目前仅是记录！）来自指定国家的登录尝试。（早期版本）",
    "This is a front end to geo localization services, that allows blocking (currently only logging!) of login attempts from specified countries. " : "这是地理定位服务的一个前端，它允许阻止（目前仅是记录！）来自指定国家的登录尝试。",
    "Login attempts from local network IP addresses are not blocked (or logged)." : "来自本地网络的IP地址的登录尝试不会被阻止（或记录）。",
    "Wrong Nextcloud configuration (especially in container) can lead to all accesses seem to come from a local network IP address." : "错误的Nextcloud配置（尤其是在容器中）可能导致所有访问似乎都来自本地网络IP地址。",
    "If you are accessing from external network, this should be an external IP address: " : "如果要从外部网络访问，则该地址应该是外部IP地址。",
    "is local." : "是本地",
    "is external." : "是外部",
    "Determination of the country from IP address is only as good as the chosen service." : "从IP地址到国家定位的准确性取决于所选择的服务。",
    "Service" : "服务",
    "Choose the service you want to use to determine the country from the IP Address:" : "选择您想使用的由IP地址确定国家的服务：",
    "local" : "本地",
    "default" : "默认",
    "Status of the chosen service: " : "被选中服务的状态：",
    "Country Selection" : "国家选择",
    "No country is blocked but the selected ones" : "除被选中的国家外，其它国家都不会被阻止。",
    "All countries are blocked but the selected ones" : "除了被选中的国家，其它国家都会被阻止",
    "The following countries were selected in the list above: " : "在上面的列表中选择了以下国家：",
    "Reaction" : "响应",
    "If a login attempt is detected from the chosen countries, the attempt is logged with the following information" : "如果从选定的国家/地区检测到登录尝试，则会使用以下信息记录该尝试",
    "( be aware of data protection issues depending on your logging strategy)" : "（请注意数据保护问题，具体取决于您的日志记录策略）",
    "with IP Address" : "IP地址为",
    "with Country Code" : "带上国家编码",
    "with username" : "用户名为",
    "In addition, the login attempt can also be blocked" : "另外，登录尝试也可被阻止。",
    "(in a future version)" : "（在未来版本中）",
    "Activate blocking of the login attempt from IP addresses of the specified countries." : "激活阻止来自指定国家 / 地区的 IP 地址的登录尝试。",
    "Test" : "测试",
    "Next login attempt of user \"%s\" will be simulated to come from the following IP address:" : "用户 “%s” 的下一次登录尝试将被模拟为来自以下 IP 地址：",
    "COUNTRY NOT FOUND" : "未找到国家",
    "Andorra" : "安道尔",
    "United Arab Emirates" : "阿拉伯联合酋长国",
    "Afghanistan" : "阿富汗",
    "Antigua and Barbuda" : "安提瓜和巴布达",
    "Anguilla" : "安圭拉",
    "Albania" : "阿尔巴尼亚",
    "Armenia" : "亚美尼亚共和国",
    "Angola" : "安哥拉",
    "Antarctica" : "南极洲",
    "Argentina" : "阿根廷",
    "American Samoa" : "美属萨摩亚",
    "Austria" : "奥地利",
    "Australia" : "澳大利亚",
    "Aruba" : "阿鲁巴",
    "Åland Islands" : "奥兰",
    "Azerbaijan" : "阿塞拜疆",
    "Bosnia and Herzegovina" : "波斯尼亚和黑塞哥维那",
    "Barbados" : "巴巴多斯",
    "Bangladesh" : "孟加拉国",
    "Belgium" : "比利时",
    "Burkina Faso" : "布基纳法索",
    "Bulgaria" : "保加利亚",
    "Bahrain" : "巴林",
    "Burundi" : "布隆迪",
    "Benin" : "贝宁",
    "Saint Barthélemy" : "圣巴泰勒米",
    "Bermuda" : "百慕大",
    "Brunei Darussalam" : "文莱达鲁萨兰国",
    "Bolivia (Plurinational State of)" : "玻利维亚（多民族国家）",
    "Bonaire, Sint Eustatius and Saba" : "博内尔岛，圣尤斯特歇斯岛和萨巴岛",
    "Brazil" : "巴西",
    "Bahamas" : "巴哈马",
    "Bhutan" : "不丹",
    "Bouvet Island" : "布维岛",
    "Botswana" : "博茨瓦纳",
    "Belarus" : "白俄罗斯",
    "Belize" : "伯利兹",
    "Canada" : "加拿大",
    "Cocos (Keeling) Islands" : "科科斯（基林）群岛",
    "Congo, Democratic Republic of the" : "刚果（民主共和国）",
    "Central African Republic" : "中非共和国",
    "Congo" : "刚果",
    "Switzerland" : "瑞士",
    "Côte d'Ivoire" : "科特迪瓦",
    "Cook Islands" : "库克群岛",
    "Chile" : "智利",
    "Cameroon" : "喀麦隆",
    "China" : "中国",
    "Colombia" : "哥伦比亚",
    "Costa Rica" : "哥斯达黎加",
    "Cuba" : "古巴",
    "Cabo Verde" : "佛得角",
    "Curaçao" : "库拉索",
    "Christmas Island" : "圣诞岛",
    "Cyprus" : "赛浦路斯",
    "Czechia" : "捷克",
    "Germany" : "德国",
    "Djibouti" : "吉布提",
    "Denmark" : "丹麦",
    "Dominica" : "多米尼加",
    "Dominican Republic" : "多明尼加共和国",
    "Algeria" : "阿尔及利亚",
    "Ecuador" : "厄瓜多尔",
    "Estonia" : "爱沙尼亚",
    "Egypt" : "埃及",
    "Western Sahara" : "西撒哈拉",
    "Eritrea" : "厄立特里亚",
    "Spain" : "西班牙",
    "Ethiopia" : "埃塞俄比亚",
    "Finland" : "芬兰",
    "Fiji" : "斐济",
    "Falkland Islands (Malvinas)" : "福克兰群岛（马尔维纳斯群岛）",
    "Micronesia (Federated States of)" : "密克罗尼西亚（联邦）",
    "Faroe Islands" : "法罗群岛",
    "France" : "法国",
    "Gabon" : "加蓬",
    "United Kingdom of Great Britain and Northern Ireland" : "大不列颠及北爱尔兰联合王国",
    "Grenada" : "格林纳达",
    "Georgia" : "格鲁吉亚",
    "French Guiana" : "法属圭亚那",
    "Guernsey" : "根西岛",
    "Ghana" : "加纳",
    "Gibraltar" : "直布罗陀",
    "Greenland" : "格陵兰",
    "Gambia" : "冈比亚",
    "Guinea" : "几内亚",
    "Guadeloupe" : "瓜德罗普岛",
    "Equatorial Guinea" : "赤道几内亚",
    "Greece" : "希腊",
    "South Georgia and the South Sandwich Islands" : "南乔治亚岛和南桑威奇群岛",
    "Guatemala" : "危地马拉",
    "Guam" : "关岛",
    "Guinea-Bissau" : "几内亚-比绍",
    "Guyana" : "圭亚那",
    "Hong Kong" : "香港",
    "Heard Island and McDonald Islands" : "赫德岛和麦当劳群岛",
    "Honduras" : "洪都拉斯",
    "Croatia" : "克罗地亚",
    "Haiti" : "海地",
    "Hungary" : "匈牙利",
    "Indonesia" : "印度尼西亚",
    "Ireland" : "爱尔兰",
    "Israel" : "以色列",
    "Isle of Man" : "马恩岛",
    "India" : "印度",
    "British Indian Ocean Territory" : "英属印度洋领地",
    "Iraq" : "伊拉克",
    "Iran (Islamic Republic of)" : "伊朗（伊斯兰共和国）",
    "Iceland" : "冰岛",
    "Italy" : "意大利",
    "Jersey" : "泽西",
    "Jamaica" : "牙买加",
    "Jordan" : "约旦",
    "Japan" : "日本",
    "Kenya" : "肯尼亚",
    "Kyrgyzstan" : "吉尔吉斯斯坦",
    "Cambodia" : "柬埔寨",
    "Kiribati" : "基里巴斯",
    "Comoros" : "科摩罗",
    "Saint Kitts and Nevis" : "圣基茨和尼维斯",
    "Korea (Democratic People's Republic of)" : "朝鲜（民主主义人民共和国）",
    "Korea, Republic of" : "韩国（共和国）",
    "Kuwait" : "科威特",
    "Cayman Islands" : "开曼群岛",
    "Kazakhstan" : "哈萨克斯坦",
    "Lao People's Democratic Republic" : "老挝",
    "Lebanon" : "黎巴嫩",
    "Saint Lucia" : "圣卢西亚",
    "Liechtenstein" : "列支敦士登",
    "Sri Lanka" : "斯里兰卡",
    "Liberia" : "利比里亚",
    "Lesotho" : "莱索托",
    "Lithuania" : "立陶宛",
    "Luxembourg" : "卢森堡",
    "Latvia" : "拉脱维亚",
    "Libya" : "利比亚",
    "Morocco" : "摩洛哥",
    "Monaco" : "摩纳哥",
    "Moldova, Republic of" : "摩尔多瓦（共和国）",
    "Montenegro" : "黑山",
    "Saint Martin (French part)" : "圣马丁（法国部分）",
    "Madagascar" : "马达加斯加",
    "Marshall Islands" : "马绍尔群岛",
    "North Macedonia" : "北马其顿",
    "Mali" : "马里",
    "Myanmar" : "缅甸",
    "Mongolia" : "蒙古",
    "Macao" : "澳门",
    "Northern Mariana Islands" : "北马里亚纳群岛",
    "Martinique" : "马提尼克",
    "Mauritania" : "毛里塔尼亚",
    "Montserrat" : "蒙特塞拉特",
    "Malta" : "马耳他",
    "Mauritius" : "毛里求斯",
    "Maldives" : "马尔代夫",
    "Malawi" : "马拉维",
    "Mexico" : "墨西哥",
    "Malaysia" : "马来西亚",
    "Mozambique" : "莫桑比克",
    "Namibia" : "纳米比亚",
    "New Caledonia" : "新喀里多尼亚",
    "Niger" : "尼日尔",
    "Norfolk Island" : "诺福克岛",
    "Nigeria" : "尼日利亚",
    "Nicaragua" : "尼加拉瓜",
    "Netherlands" : "荷兰",
    "Norway" : "挪威",
    "Nepal" : "尼泊尔",
    "Nauru" : "瑙鲁",
    "Niue" : "纽埃",
    "New Zealand" : "新西兰",
    "Oman" : "阿曼",
    "Panama" : "巴拿马",
    "Peru" : "秘鲁",
    "French Polynesia" : "法属波利尼西亚",
    "Papua New Guinea" : "巴布亚新几内亚",
    "Philippines" : "菲律宾",
    "Pakistan" : "巴基斯坦",
    "Poland" : "波兰",
    "Saint Pierre and Miquelon" : "圣皮埃尔和密克隆",
    "Pitcairn" : "皮特凯恩",
    "Puerto Rico" : "波多黎各",
    "Palestine, State of" : "巴勒斯坦",
    "Portugal" : "葡萄牙",
    "Palau" : "帕劳",
    "Paraguay" : "巴拉圭",
    "Qatar" : "卡塔尔",
    "Réunion" : "留尼汪",
    "Romania" : "罗马尼亚",
    "Serbia" : "塞尔维亚",
    "Russian Federation" : "俄罗斯联邦",
    "Rwanda" : "卢旺达",
    "Saudi Arabia" : "沙特阿拉伯",
    "Solomon Islands" : "所罗门群岛",
    "Seychelles" : "塞舌尔",
    "Sudan" : "苏丹",
    "Sweden" : "瑞典",
    "Singapore" : "新加坡",
    "Saint Helena, Ascension and Tristan da Cunha" : "圣赫勒拿，阿森松岛和特里斯坦达库尼亚",
    "Slovenia" : "斯洛文尼亚",
    "Svalbard and Jan Mayen" : "斯瓦尔巴和扬马延",
    "Slovakia" : "斯洛伐克",
    "Sierra Leone" : "塞拉利昂",
    "San Marino" : "圣马力诺",
    "Senegal" : "塞内加尔",
    "Somalia" : "索马里",
    "Suriname" : "苏里南",
    "South Sudan" : "南苏丹",
    "Sao Tome and Principe" : "圣多美和普林西比",
    "El Salvador" : "萨尔瓦多",
    "Sint Maarten (Dutch part)" : "圣马丁（荷兰部分）",
    "Syrian Arab Republic" : "阿拉伯叙利亚共和国",
    "Eswatini" : "斯威士兰",
    "Turks and Caicos Islands" : "特克斯和凯科斯群岛",
    "Chad" : "乍得",
    "French Southern Territories" : "法国南部领地",
    "Togo" : "多哥",
    "Thailand" : "泰国",
    "Tajikistan" : "塔吉克斯坦",
    "Tokelau" : "托克劳",
    "Timor-Leste" : "东帝汶",
    "Turkmenistan" : "土库曼斯坦",
    "Tunisia" : "突尼斯",
    "Tonga" : "汤加",
    "Turkey" : "土耳其",
    "Trinidad and Tobago" : "特立尼达和多巴哥",
    "Tuvalu" : "图瓦卢",
    "Taiwan, Province of China" : "台湾",
    "Tanzania, United Republic of" : "坦桑尼亚联合共和国",
    "Ukraine" : "乌克兰",
    "Uganda" : "乌干达",
    "United States Minor Outlying Islands" : "美国本土外小岛屿",
    "United States of America" : "美利坚合众国",
    "Uruguay" : "乌拉圭",
    "Uzbekistan" : "乌兹别克斯坦",
    "Holy See" : "教廷",
    "Saint Vincent and the Grenadines" : "圣文森特和格林纳丁斯",
    "Venezuela (Bolivarian Republic of)" : "委内瑞拉（玻利瓦尔共和国）",
    "Virgin Islands (British)" : "维尔京群岛（英国）",
    "Virgin Islands (U.S.)" : "维尔京群岛（美国）",
    "Viet Nam" : "越南",
    "Vanuatu" : "瓦努阿图",
    "Wallis and Futuna" : "瓦利斯和富图纳群岛",
    "Samoa" : "萨摩亚",
    "Yemen" : "也门",
    "Mayotte" : "马约特",
    "South Africa" : "南非",
    "Zambia" : "赞比亚",
    "Zimbabwe" : "津巴布韦"
},
"nplurals=1; plural=0;");

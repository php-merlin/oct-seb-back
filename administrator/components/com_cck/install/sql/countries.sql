
CREATE TABLE IF NOT EXISTS `#__cck_more_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `code2` varchar(5) NOT NULL,
  `code3` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=247 ;


-- --------------------------------------------------------


INSERT IGNORE INTO `#__cck_more_countries` (`id`, `name_en`, `name_fr`, `name_de`, `name_ru`, `code2`, `code3`) VALUES
	(1, 'Afghanistan', 'Afghanistan', 'Afghanistan', 'Афганистан', 'AF', 'AFG'),
	(2, 'Aland Islands', 'Åland, îles', 'Åland', 'Аландские острова', 'AX', 'ALA'),
	(3, 'Albania', 'Albanie', 'Albanien', 'Албания', 'AL', 'ALB'),
	(4, 'Algeria', 'Algérie', 'Algerien', 'Алжир', 'DZ', 'DZA'),
	(5, 'American Samoa', 'Samoa américaines', 'Amerikanisch Samoa', 'Американское Самоа', 'AS', 'ASM'),
	(6, 'Andorra', 'Andorre', 'Andorra', 'Андорра', 'AD', 'AND'),
	(7, 'Angola', 'Angola', 'Angola', 'Ангола', 'AO', 'AGO'),
	(8, 'Anguilla', 'Anguilla', 'Anguilla', 'Ангилья', 'AI', 'AIA'),
	(9, 'Antarctica', 'Antarctique', 'Antarktis', 'Антарктида', 'AQ', 'ATA'),
	(10, 'Antigua and Barbuda', 'Antigua-et-barbuda', 'Antigua und Barbuda', 'Антигуа и Барбуда', 'AG', 'ATG'),
	(11, 'Argentina', 'Argentine', 'Argentinien', 'Аргентина', 'AR', 'ARG'),
	(12, 'Armenia', 'Arménie', 'Armenien', 'Армения', 'AM', 'ARM'),
	(13, 'Aruba', 'Aruba', 'Aruba', 'Аруба', 'AW', 'ABW'),
	(14, 'Australia', 'Australie', 'Australien', 'Австралия', 'AU', 'AUS'),
	(15, 'Austria', 'Autriche', 'Österreich', 'Австрия', 'AT', 'AUT'),
	(16, 'Azerbaijan', 'Azerbaïdjan', 'Aserbaidschan', 'Азербайджан', 'AZ', 'AZE'),
	(17, 'Bahamas', 'Bahamas', 'Bahamas', 'Багамские острова', 'BS', 'BHS'),
	(18, 'Bahrain', 'Bahreïn', 'Bahrain', 'Бахрейн', 'BH', 'BHR'),
	(19, 'Bangladesh', 'Bangladesh', 'Bangladesch', 'Бангладеш', 'BD', 'BGD'),
	(20, 'Barbados', 'Barbade', 'Barbados', 'Барбадос', 'BB', 'BRB'),
	(21, 'Belarus', 'Bélarus', 'Weißrussland', 'Беларусь', 'BY', 'BLR'),
	(22, 'Belgium', 'Belgique', 'Belgien', 'Бельгия', 'BE', 'BEL'),
	(23, 'Belize', 'Belize', 'Belize', 'Белиз', 'BZ', 'BLZ'),
	(24, 'Benin', 'Bénin', 'Benin', 'Бенин', 'BJ', 'BEN'),
	(25, 'Bermuda', 'Bermudes', 'Bermuda', 'Бермудские острова', 'BM', 'BMU'),
	(26, 'Bhutan', 'Bhoutan', 'Bhutan', 'Бутан', 'BT', 'BTN'),
	(27, 'Bolivia, Plurinational State of', 'Bolivie, l\'état plurinational de', 'Bolivien', 'Боливия', 'BO', 'BOL'),
	(28, 'Bosnia and Herzegovina', 'Bosnie-herzégovine', 'Bosnien und Herzegowina', 'Босния и Герцеговина', 'BA', 'BIH'),
	(29, 'Botswana', 'Botswana', 'Botsuana', 'Ботсвана', 'BW', 'BWA'),
	(30, 'Bouvet Island', 'Bouvet, île', 'Bouvetinsel', 'Остров Буве', 'BV', 'BVT'),
	(31, 'Brazil', 'Brésil', 'Brasilien', 'Бразилия', 'BR', 'BRA'),
	(32, 'British Indian Ocean Territory', 'Océan indien, territoire britannique de l\'', 'Britische Territorien im Indischen Ozean', 'Британская Территория В Индийском Океане', 'IO', 'IOT'),
	(33, 'Brunei Darussalam', 'Brunéi darussalam', 'Brunei Darussalam', 'Бруней', 'BN', 'BRN'),
	(34, 'Bulgaria', 'Bulgarie', 'Bulgarien', 'Болгария', 'BG', 'BGR'),
	(35, 'Burkina Faso', 'Burkina faso', 'Burkina Faso', 'Буркина-Фасо', 'BF', 'BFA'),
	(36, 'Burundi', 'Burundi', 'Burundi', 'Бурунди', 'BI', 'BDI'),
	(37, 'Cambodia', 'Cambodge', 'Kambodscha', 'Камбоджа', 'KH', 'KHM'),
	(38, 'Cameroon', 'Cameroun', 'Kamerun', 'Камерун', 'CM', 'CMR'),
	(39, 'Canada', 'Canada', 'Kanada', 'Канада', 'CA', 'CAN'),
	(40, 'Cape Verde', 'Cap-vert', 'Kap Verde', 'Кабо Верде', 'CV', 'CPV'),
	(41, 'Cayman Islands', 'Caïmanes, îles', 'Kaimaninseln', 'Каймановы острова', 'KY', 'CYM'),
	(42, 'Central African Republic', 'Centrafricaine, république', 'Zentralafrikanische Republik', 'Центральноафриканская Республика', 'CF', 'CAF'),
	(43, 'Chad', 'Tchad', 'Tschad', 'Чад', 'TD', 'TCD'),
	(44, 'Chile', 'Chili', 'Chile', 'Чили', 'CL', 'CHL'),
	(45, 'China', 'Chine', 'China', 'Китай', 'CN', 'CHN'),
	(46, 'Christmas Island', 'Christmas, île', 'Weihnachtsinsel', 'Остров Рождества', 'CX', 'CXR'),
	(47, 'Cocos (Keeling) Islands', 'Cocos (keeling), îles', 'Kokosinseln', 'Кокосовые Острова', 'CC', 'CCK'),
	(48, 'Colombia', 'Colombie', 'Kolumbien', 'Колумбия', 'CO', 'COL'),
	(49, 'Comoros', 'Comores', 'Komoren', 'Коморские острова', 'KM', 'COM'),
	(50, 'Congo', 'Congo', 'Kongo', 'Конго', 'CG', 'COG'),
	(51, 'Congo, the Democratic Republic of the', 'Congo, la république démocratique du', 'Kongo, Dem. Rep.', 'Конго, Демократическая республика', 'CD', 'COD'),
	(52, 'Cook Islands', 'Cook, îles', 'Cookinseln', 'Острова Кука', 'CK', 'COK'),
	(53, 'Costa Rica', 'Costa rica', 'Costa Rica', 'Коста-Рика', 'CR', 'CRI'),
	(54, 'Cote d\'Ivoire', 'Côte d\'ivoire', 'Elfenbeinküste', 'Кот-д\'Ивуар', 'CI', 'CIV'),
	(55, 'Croatia', 'Croatie', 'Kroatien', 'Хорватия', 'HR', 'HRV'),
	(56, 'Cuba', 'Cuba', 'Kuba', 'Куба', 'CU', 'CUB'),
	(57, 'Cyprus', 'Chypre', 'Zypern', 'Кипр', 'CY', 'CYP'),
	(58, 'Czech Republic', 'Tchèque, république', 'Tschechische Republik', 'Чехия', 'CZ', 'CZE'),
	(59, 'Denmark', 'Danemark', 'Dänemark', 'Дания', 'DK', 'DNK'),
	(60, 'Djibouti', 'Djibouti', 'Republik Dschibuti', 'Джибути', 'DJ', 'DJI'),
	(61, 'Dominica', 'Dominique', 'Dominica', 'Доминика', 'DM', 'DMA'),
	(62, 'Dominican Republic', 'Dominicaine, république', 'Dominikanische Republik', 'Доминиканская республика', 'DO', 'DOM'),
	(63, 'Ecuador', 'Équateur', 'Ecuador', 'Эквадор', 'EC', 'ECU'),
	(64, 'Egypt', 'Égypte', 'Ägypten', 'Египет', 'EG', 'EGY'),
	(65, 'El Salvador', 'El salvador', 'El Salvador', 'Сальвадор', 'SV', 'SLV'),
	(66, 'Equatorial Guinea', 'Guinée équatoriale', 'Äquatorialguinea', 'Экваториальная Гвинея', 'GQ', 'GNQ'),
	(67, 'Eritrea', 'Érythrée', 'Eritrea', 'Эритрея', 'ER', 'ERI'),
	(68, 'Estonia', 'Estonie', 'Estland', 'Эстония', 'EE', 'EST'),
	(69, 'Ethiopia', 'Éthiopie', 'Äthiopien', 'Эфиопия', 'ET', 'ETH'),
	(70, 'Falkland Islands (Malvinas)', 'Falkland, îles (malvinas)', 'Falklandinseln', 'Фолклендские Острова (Мальвинские)', 'FK', 'FLK'),
	(71, 'Faroe Islands', 'Féroé, îles', 'Färöer', 'Фарерские Острова', 'FO', 'FRO'),
	(72, 'Fiji', 'Fidji', 'Fidschi', 'Фиджи', 'FJ', 'FJI'),
	(73, 'Finland', 'Finlande', 'Finnland', 'Финляндия', 'FI', 'FIN'),
	(74, 'France', 'France', 'Frankreich', 'Франция', 'FR', 'FRA'),
	(75, 'French Guiana', 'Guyane française', 'Französisch-Guayana', 'Французская Гвиана', 'GF', 'GUF'),
	(76, 'French Polynesia', 'Polynésie française', 'Französisch-Polynesien', 'Французская Полинезия', 'PF', 'PYF'),
	(77, 'French Southern Territories', 'Terres australes françaises', 'Französische Südgebiete', 'Французские Южные Территории', 'TF', 'ATF'),
	(78, 'Gabon', 'Gabon', 'Gabun', 'Габон', 'GA', 'GAB'),
	(79, 'Gambia', 'Gambie', 'Gambia', 'Гамбия', 'GM', 'GMB'),
	(80, 'Georgia', 'Géorgie', 'Georgien', 'Грузия', 'GE', 'GEO'),
	(81, 'Germany', 'Allemagne', 'Deutschland', 'Германия', 'DE', 'DEU'),
	(82, 'Ghana', 'Ghana', 'Ghana', 'Гана', 'GH', 'GHA'),
	(83, 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Гибралтар', 'GI', 'GIB'),
	(84, 'Greece', 'Grèce', 'Griechenland', 'Греция', 'GR', 'GRC'),
	(85, 'Greenland', 'Groenland', 'Grönland', 'Гренландия', 'GL', 'GRL'),
	(86, 'Grenada', 'Grenade', 'Grenada', 'Гренада', 'GD', 'GRD'),
	(87, 'Guadeloupe', 'Guadeloupe', 'Guadeloupe', 'Гваделупа', 'GP', 'GLP'),
	(88, 'Guam', 'Guam', 'Guam', 'Гуам ', 'GU', 'GUM'),
	(89, 'Guatemala', 'Guatemala', 'Guatemala', 'Гватемала', 'GT', 'GTM'),
	(90, 'Guernsey', 'Guernesey', 'Guernsey', 'Гернси', 'GG', 'GGY'),
	(91, 'Guinea', 'Guinée', 'Guinea', 'Гвинея', 'GN', 'GIN'),
	(92, 'Guinea-Bissau', 'Guinée-bissau', 'Guinea-Bissau', 'Гвинея-Бисау', 'GW', 'GNB'),
	(93, 'Guyana', 'Guyana', 'Guyana', 'Гайана', 'GY', 'GUY'),
	(94, 'Haiti', 'Haïti', 'Haiti', 'Гаити', 'HT', 'HTI'),
	(95, 'Heard Island and McDonald Islands', 'Heard, île et mcdonald, îles', 'Heard Insel und McDonald Inseln', 'Остров Херд и острова Макдональд', 'HM', 'HMD'),
	(96, 'Holy See (Vatican City State)', 'Saint-siège (état de la cité du vatican)', 'Vatikanstadt', 'Ватикан', 'VA', 'VAT'),
	(97, 'Honduras', 'Honduras', 'Honduras', 'Гондурас', 'HN', 'HND'),
	(98, 'Hong Kong', 'Hong-kong', 'Hong Kong', 'Гонконг', 'HK', 'HKG'),
	(99, 'Hungary', 'Hongrie', 'Ungarn', 'Венгрия', 'HU', 'HUN'),
	(100, 'Iceland', 'Islande', 'Island', 'Исландия', 'IS', 'ISL'),
	(101, 'India', 'Inde', 'Indien', 'Индия', 'IN', 'IND'),
	(102, 'Indonesia', 'Indonésie', 'Indonesien', 'Индонезия', 'ID', 'IDN'),
	(103, 'Iran, Islamic Republic of', 'Iran, république islamique d\'', 'Iran, Islam. Rep.', 'Иран', 'IR', 'IRN'),
	(104, 'Iraq', 'Iraq', 'Irak', 'Ирак', 'IQ', 'IRQ'),
	(105, 'Ireland', 'Irlande', 'Irland', 'Ирландия', 'IE', 'IRL'),
	(106, 'Isle of Man', 'Île de man', 'Isle of Man', 'Остров Мэн', 'IM', 'IMN'),
	(107, 'Israel', 'Israël', 'Israel', 'Израиль', 'IL', 'ISR'),
	(108, 'Italy', 'Italie', 'Italien', 'Италия', 'IT', 'ITA'),
	(109, 'Jamaica', 'Jamaïque', 'Jamaika', 'Ямайка', 'JM', 'JAM'),
	(110, 'Japan', 'Japon', 'Japan', 'Япония', 'JP', 'JPN'),
	(111, 'Jersey', 'Jersey', 'Jersey', 'Джерси', 'JE', 'JEY'),
	(112, 'Jordan', 'Jordanie', 'Jordanien', 'Иордания', 'JO', 'JOR'),
	(113, 'Kazakhstan', 'Kazakhstan', 'Kasachstan', 'Казахстан', 'KZ', 'KAZ'),
	(114, 'Kenya', 'Kenya', 'Kenia', 'Кения', 'KE', 'KEN'),
	(115, 'Kiribati', 'Kiribati', 'Kiribati', 'Кирибати', 'KI', 'KIR'),
	(116, 'Korea, Democratic People\'s Republic of', 'Corée, république populaire démocratique de', 'Korea, Dem. Volksrep.', 'Корейская Народно-Демократическая Республика', 'KP', 'PRK'),
	(117, 'South Korea', 'Corée du Sud', 'Korea, Rep.', 'Южная Корея', 'KR', 'KOR'),
	(118, 'Kuwait', 'Koweït', 'Kuwait', 'Кувейт', 'KW', 'KWT'),
	(119, 'Kyrgyzstan', 'Kirghizistan', 'Kirgisistan', 'Киргизстан', 'KG', 'KGZ'),
	(120, 'Lao People\'s Democratic Republic', 'Lao, république démocratique populaire', 'Laos, Dem. Volksrep.', 'Лаос', 'LA', 'LAO'),
	(121, 'Latvia', 'Lettonie', 'Lettland', 'Латвия', 'LV', 'LVA'),
	(122, 'Lebanon', 'Liban', 'Libanon', 'Ливан', 'LB', 'LBN'),
	(123, 'Lesotho', 'Lesotho', 'Lesotho', 'Лесото', 'LS', 'LSO'),
	(124, 'Liberia', 'Libéria', 'Liberia', 'Либерия', 'LR', 'LBR'),
	(125, 'Libyan Arab Jamahiriya', 'Libyenne, jamahiriya arabe', 'Libysch-Arabische Dschamahirija', 'Ливия', 'LY', 'LBY'),
	(126, 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Лихтенштейн', 'LI', 'LIE'),
	(127, 'Lithuania', 'Lituanie', 'Litauen', 'Литва', 'LT', 'LTU'),
	(128, 'Luxembourg', 'Luxembourg', 'Luxemburg', 'Люксембург', 'LU', 'LUX'),
	(129, 'Macao', 'Macao', 'Macao', 'Аомынь (Макао)', 'MO', 'MAC'),
	(130, 'Macedonia, the former Yugoslav Republic of', 'Macédoine, l\'ex-république yougoslave de', 'Mazedonien, ehemalige jugoslawische Republik ', 'Македония', 'MK', 'MKD'),
	(131, 'Madagascar', 'Madagascar', 'Madagaskar', 'Мадагаскар', 'MG', 'MDG'),
	(132, 'Malawi', 'Malawi', 'Malawi', 'Малави', 'MW', 'MWI'),
	(133, 'Malaysia', 'Malaisie', 'Malaysia', 'Малайзия', 'MY', 'MYS'),
	(134, 'Maldives', 'Maldives', 'Malediven', 'Мальдивы', 'MV', 'MDV'),
	(135, 'Mali', 'Mali', 'Mali', 'Мали', 'ML', 'MLI'),
	(136, 'Malta', 'Malte', 'Malta', 'Мальта', 'MT', 'MLT'),
	(137, 'Marshall Islands', 'Marshall, îles', 'Marshallinseln', 'Маршалловы Острова', 'MH', 'MHL'),
	(138, 'Martinique', 'Martinique', 'Martinique', 'Мартиника', 'MQ', 'MTQ'),
	(139, 'Mauritania', 'Mauritanie', 'Mauretanien', 'Мавритания', 'MR', 'MRT'),
	(140, 'Mauritius', 'Maurice', 'Mauritius', 'Маврикий', 'MU', 'MUS'),
	(141, 'Mayotte', 'Mayotte', 'Mayotte', 'Майотта', 'YT', 'MYT'),
	(142, 'Mexico', 'Mexique', 'Mexiko', 'Мексика', 'MX', 'MEX'),
	(143, 'Micronesia, Federated States of', 'Micronésie, états fédérés de', 'Mikronesien, Föderierte Staaten von', 'Микронезия, Федеративные Штаты', 'FM', 'FSM'),
	(144, 'Moldova, Republic of', 'Moldova, république de', 'Moldau, Rep.', 'Молдова', 'MD', 'MDA'),
	(145, 'Monaco', 'Monaco', 'Monaco', 'Монако', 'MC', 'MCO'),
	(146, 'Mongolia', 'Mongolie', 'Mongolei', 'Монголия', 'MN', 'MNG'),
	(147, 'Montenegro', 'Monténégro', 'Montenegro', 'Черногория', 'ME', 'MNE'),
	(148, 'Montserrat', 'Montserrat', 'Montserrat', 'Монсеррат', 'MS', 'MSR'),
	(149, 'Morocco', 'Maroc', 'Marokko', 'Марокко', 'MA', 'MAR'),
	(150, 'Mozambique', 'Mozambique', 'Mosambik', 'Мозамбик', 'MZ', 'MOZ'),
	(151, 'Myanmar', 'Myanmar', 'Myanmar', 'Мьянма', 'MM', 'MMR'),
	(152, 'Namibia', 'Namibie', 'Namibia', 'Намибия', 'NA', 'NAM'),
	(153, 'Nauru', 'Nauru', 'Nauru', 'Науру', 'NR', 'NRU'),
	(154, 'Nepal', 'Népal', 'Nepal', 'Непал', 'NP', 'NPL'),
	(155, 'Netherlands', 'Pays-bas', 'Niederlande', 'Нидерланды', 'NL', 'NLD'),
	(156, 'Netherlands Antilles', 'Antilles néerlandaises', 'Niederländische Antillen', 'Нидерландские Антильские острова', 'AN', 'ANT'),
	(157, 'New Caledonia', 'Nouvelle-calédonie', 'Neukaledonien', 'Новая Каледония', 'NC', 'NCL'),
	(158, 'New Zealand', 'Nouvelle-zélande', 'Neuseeland', 'Новая Зеландия', 'NZ', 'NZL'),
	(159, 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Никарагуа', 'NI', 'NIC'),
	(160, 'Niger', 'Niger', 'Niger', 'Нигер', 'NE', 'NER'),
	(161, 'Nigeria', 'Nigéria', 'Nigeria', 'Нигерия', 'NG', 'NGA'),
	(162, 'Niue', 'Niué', 'Niue', 'Ниуэ', 'NU', 'NIU'),
	(163, 'Norfolk Island', 'Norfolk, île', 'Norfolk Insel', 'Остров Норфолк', 'NF', 'NFK'),
	(164, 'Northern Mariana Islands', 'Mariannes du nord, îles', 'Nördliche Marianen', 'Северные Марианские Острова', 'MP', 'MNP'),
	(165, 'Norway', 'Norvège', 'Norwegen', 'Норвегия', 'NO', 'NOR'),
	(166, 'Oman', 'Oman', 'Oman', 'Оман', 'OM', 'OMN'),
	(167, 'Pakistan', 'Pakistan', 'Pakistan', 'Пакистан', 'PK', 'PAK'),
	(168, 'Palau', 'Palaos', 'Palau', 'Палау', 'PW', 'PLW'),
	(169, 'Palestinian Territory, Occupied', 'Palestinien occupé, territoire', 'Palästinensische Autonomiegebiete', 'Палестинской Территории, Оккупированные', 'PS', 'PSE'),
	(170, 'Panama', 'Panama', 'Panama', 'Панама', 'PA', 'PAN'),
	(171, 'Papua New Guinea', 'Papouasie-nouvelle-guinée', 'Papua-Neuguinea', 'Папуа-Новая Гвинея', 'PG', 'PNG'),
	(172, 'Paraguay', 'Paraguay', 'Paraguay', 'Парагвай', 'PY', 'PRY'),
	(173, 'Peru', 'Pérou', 'Peru', 'Перу', 'PE', 'PER'),
	(174, 'Philippines', 'Philippines', 'Philippinen', 'Филиппины', 'PH', 'PHL'),
	(175, 'Pitcairn', 'Pitcairn', 'Pitcairn', 'Питкэрн', 'PN', 'PCN'),
	(176, 'Poland', 'Pologne', 'Polen', 'Польша', 'PL', 'POL'),
	(177, 'Portugal', 'Portugal', 'Portugal', 'Португалия', 'PT', 'PRT'),
	(178, 'Puerto Rico', 'Porto rico', 'Puerto Rico', 'Пуэрто-Рико', 'PR', 'PRI'),
	(179, 'Qatar', 'Qatar', 'Katar', 'Катар', 'QA', 'QAT'),
	(180, 'Reunion', 'Réunion', 'Réunion', 'Реюньон', 'RE', 'REU'),
	(181, 'Romania', 'Roumanie', 'Rum', 'Румыния', 'RO', 'ROU'),
	(182, 'Russian Federation', 'Russie, fédération de', 'Russland', 'Россия', 'RU', 'RUS'),
	(183, 'Rwanda', 'Rwanda', 'Ruanda', 'Руанда', 'RW', 'RWA'),
	(184, 'Saint Barthelemy', 'Saint-barthélemy', 'St. Barth', 'Сен-Бартельми', 'BL', 'BLM'),
	(185, 'Saint Helena', 'Sainte-hélène, ascension et tristan da cunha', 'Saint Helena', 'Святая Елена, Остров вознесения, Тристан-да-Кунья', 'SH', 'SHN'),
	(186, 'Saint Kitts and Nevis', 'Saint-kitts-et-nevis', 'St. Kitts und Nevis', 'Сент-Китс и Невис', 'KN', 'KNA'),
	(187, 'Saint Lucia', 'Sainte-lucie', 'St. Lucia', 'Сент-Люсия', 'LC', 'LCA'),
	(188, 'Saint Martin (French part)', 'Saint-martin', 'St. Martin', 'Сен-Мартен', 'MF', 'MAF'),
	(189, 'Saint Pierre and Miquelon', 'Saint-pierre-et-miquelon', 'Saint Pierre und Miquelon', 'Сен-Пьер и Микелон', 'PM', 'SPM'),
	(190, 'Saint Vincent and the Grenadines', 'Saint-vincent-et-les grenadines', 'St. Vincent und die Grenadinen', 'Сент-Винсент и Гренадины', 'VC', 'VCT'),
	(191, 'Samoa', 'Samoa', 'Samoa', 'Самоа', 'WS', 'WSM'),
	(192, 'San Marino', 'Saint-marin', 'San Marino', 'Сан-Марино', 'SM', 'SMR'),
	(193, 'Sao Tome and Principe', 'Sao tomé-et-principe', 'São Tomé und Príncipe', 'Сан-Томе и Принсипи', 'ST', 'STP'),
	(194, 'Saudi Arabia', 'Arabie saoudite', 'Saudi-Arabien', 'Саудовская Аравия', 'SA', 'SAU'),
	(195, 'Senegal', 'Sénégal', 'Senegal', 'Сенегал', 'SN', 'SEN'),
	(196, 'Serbia', 'Serbie', 'Serbien', 'Сербия', 'RS', 'SRB'),
	(197, 'Seychelles', 'Seychelles', 'Seychellen', 'Сейшельские острова', 'SC', 'SYC'),
	(198, 'Sierra Leone', 'Sierra leone', 'Sierra Leone', 'Сьерра-Леоне', 'SL', 'SLE'),
	(199, 'Singapore', 'Singapour', 'Singapur', 'Сингапур', 'SG', 'SGP'),
	(200, 'Slovakia', 'Slovaquie', 'Slowakei', 'Словакия', 'SK', 'SVK'),
	(201, 'Slovenia', 'Slovénie', 'Slowenien', 'Словения', 'SI', 'SVN'),
	(202, 'Solomon Islands', 'Salomon, îles', 'Salomonen', 'Соломоновы острова', 'SB', 'SLB'),
	(203, 'Somalia', 'Somalie', 'Somalia', 'Сомали', 'SO', 'SOM'),
	(204, 'South Africa', 'Afrique du sud', 'Südafrika', 'Южно-Африканская Республика', 'ZA', 'ZAF'),
	(205, 'South Georgia and South Sandwich Islands', 'Géorgie du sud et les îles sandwich du sud', 'Südgeorgien und die Südlichen Sandwichinseln', 'Южная Георгия и южные Сандвичевы острова', 'GS', 'SGS'),
	(206, 'Spain', 'Espagne', 'Spanien', 'Испания', 'ES', 'ESP'),
	(207, 'Sri Lanka', 'Sri lanka', 'Sri Lanka', 'Шри-Ланка', 'LK', 'LKA'),
	(208, 'Sudan', 'Soudan', 'Sudan', 'Судан', 'SD', 'SDN'),
	(209, 'Suriname', 'Suriname', 'Suriname', 'Суринам', 'SR', 'SUR'),
	(210, 'Svalbard and Jan Mayen', 'Svalbard et île jan mayen', 'Svalbard und Jan Mayen', 'Шпицберген и Ян-Майен', 'SJ', 'SJM'),
	(211, 'Swaziland', 'Swaziland', 'Swasiland', 'Свазиленд', 'SZ', 'SWZ'),
	(212, 'Sweden', 'Suède', 'Schweden', 'Швеция', 'SE', 'SWE'),
	(213, 'Switzerland', 'Suisse', 'Schweiz', 'Швейцария', 'CH', 'CHE'),
	(214, 'Syrian Arab Republic', 'Syrienne, république arabe', 'Syrien, Arab. Rep.', 'Сирия', 'SY', 'SYR'),
	(215, 'Taiwan, Province of China', 'Taïwan, province de chine', 'Taiwan', 'Тайвань, провинция Китая', 'TW', 'TWN'),
	(216, 'Tajikistan', 'Tadjikistan', 'Tadschikistan', 'Таджикистан', 'TJ', 'TJK'),
	(217, 'Tanzania, United Republic of', 'Tanzanie, république-unie de', 'Tansania, Vereinigte Rep.', 'Танзания', 'TZ', 'TZA'),
	(218, 'Thailand', 'Thaïlande', 'Thailand', 'Таиланд', 'TH', 'THA'),
	(219, 'Timor-Leste', 'Timor-leste', 'Timor-Leste', 'Восточный Тимор', 'TL', 'TLS'),
	(220, 'Togo', 'Togo', 'Togo', 'Того', 'TG', 'TGO'),
	(221, 'Tokelau', 'Tokelau', 'Tokelau', 'Токелау', 'TK', 'TKL'),
	(222, 'Tonga', 'Tonga', 'Tonga', 'Тонга', 'TO', 'TON'),
	(223, 'Trinidad and Tobago', 'Trinité-et-tobago', 'Trinidad und Tobago', 'Тринидад и Тобаго', 'TT', 'TTO'),
	(224, 'Tunisia', 'Tunisie', 'Tunesien', 'Тунис', 'TN', 'TUN'),
	(225, 'Turkey', 'Turquie', 'Türkei', 'Турция', 'TR', 'TUR'),
	(226, 'Turkmenistan', 'Turkménistan', 'Turkmenistan', 'Туркменистан', 'TM', 'TKM'),
	(227, 'Turks and Caicos Islands', 'Turks et caïques, îles', 'Turks- und Caicosinseln', 'Архипелаг Тёркс и Кайкас', 'TC', 'TCA'),
	(228, 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Тувалу', 'TV', 'TUV'),
	(229, 'Uganda', 'Ouganda', 'Uganda', 'Уганда', 'UG', 'UGA'),
	(230, 'Ukraine', 'Ukraine', 'Ukraine', 'Украина', 'UA', 'UKR'),
	(231, 'United Arab Emirates', 'Émirats arabes unis', 'Vereinigte Arabische Emirate', 'Объединенные Арабские Эмираты', 'AE', 'ARE'),
	(232, 'United Kingdom', 'Royaume-uni', 'Vereinigtes Königreich', 'Великобритания', 'GB', 'GBR'),
	(233, 'United States', 'États-unis', 'Vereinigte Staaten von Amerika', 'США', 'US', 'USA'),
	(234, 'United States Minor Outlying Islands', 'Îles mineures éloignées des états-unis', 'United States Minor Outlying Islands', 'Соединенные Штаты Америки Внешние Малые Острова', 'UM', 'UMI'),
	(235, 'Uruguay', 'Uruguay', 'Uruguay', 'Уругвай', 'UY', 'URY'),
	(236, 'Uzbekistan', 'Ouzbékistan', 'Usbekistan', 'Узбекистан', 'UZ', 'UZB'),
	(237, 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Вануату', 'VU', 'VUT'),
	(238, 'Venezuela, Bolivarian Republic of', 'Venezuela, république bolivarienne du', 'Venezuela', 'Венесуэла', 'VE', 'VEN'),
	(239, 'Viet Nam', 'Viet nam', 'Vietnam', 'Вьетнам', 'VN', 'VNM'),
	(240, 'Virgin Islands, British', 'Îles vierges britanniques', 'Britische Jungferninseln', 'Британские Виргинские острова', 'VG', 'VGB'),
	(241, 'Virgin Islands, U.S.', 'Îles vierges des états-unis', 'Amerikanische Jungferninseln', 'Виргинские острова', 'VI', 'VIR'),
	(242, 'Wallis and Futuna', 'Wallis et futuna', 'Wallis und Futuna', 'Уоллис и Футуна', 'WF', 'WLF'),
	(243, 'Western Sahara', 'Sahara occidental', 'Westsahara', 'Западная Сахара', 'EH', 'ESH'),
	(244, 'Yemen', 'Yémen', 'Jemen', 'Йемен', 'YE', 'YEM'),
	(245, 'Zambia', 'Zambie', 'Sambia', 'Замбия', 'ZM', 'ZMB'),
	(246, 'Zimbabwe', 'Zimbabwe', 'Simbabwe', 'Зимбабве', 'ZW', 'ZWE');
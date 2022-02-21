-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21-Fev-2022 às 06:52
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetodb_fake`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

DROP TABLE IF EXISTS `assunto`;
CREATE TABLE IF NOT EXISTS `assunto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('admin', '2', NULL),
('fornecedor', '11', NULL),
('fornecedor', '12', NULL),
('fornecedor', '13', NULL),
('fornecedor', '14', NULL),
('instalador', '10', NULL),
('instalador', '3', NULL),
('instalador', '4', NULL),
('instalador', '5', NULL),
('instalador', '6', NULL),
('instalador', '7', NULL),
('instalador', '8', NULL),
('instalador', '9', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'admin', NULL, NULL, NULL, NULL),
('fornecedor', 1, 'fornecedor', NULL, NULL, NULL, NULL),
('instalador', 1, 'instalador', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('admin', NULL, NULL, NULL),
('fornecedor', NULL, NULL, NULL),
('instalador', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `nif` int(11) NOT NULL,
  `telefone` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `empresa`, `morada`, `nif`, `telefone`, `email`, `user_id`) VALUES
(1, 'Row Fenelon', 'Beer, Harvey and Kiehn', '36 Lakeland Drive', 199575727, 1445442486, 'rfenelon0@t.co', 3),
(2, 'Kattie Nye', 'Reichel and Sons', '6 Independence Drive', 400841475, 4063542106, 'knye1@disqus.com', 3),
(3, 'Harriot Sivil', 'Hegmann-O\'Reilly', '702 Waywood Drive', 514318602, 5627930452, 'hsivil2@princeton.edu', 3),
(4, 'Tate Shellum', 'Herman-Franecki', '37893 Westridge Drive', 433394798, 3571025169, 'tshellum3@cbslocal.com', 3),
(5, 'Robby Kleinbaum', 'Fahey-Swaniawski', '0942 Texas Park', 680939100, 5016827104, 'rkleinbaum4@studiopress.com', 3),
(6, 'Fionna Menhenitt', 'Kuhn, O\'Connell and Greenholt', '4 Gateway Point', 184407335, 2246381055, 'fmenhenitt5@tripadvisor.com', 3),
(7, 'Murdock Jerome', 'West-Kub', '10674 Jenifer Crossing', 302161529, 7929276278, 'mjerome6@intel.com', 4),
(8, 'Andy Bosanko', 'Sipes, O\'Connell and Walker', '34502 Monica Drive', 889363874, 9432022085, 'abosanko7@liveinternet.ru', 4),
(9, 'Chloette Astill', 'Ryan LLC', '371 Union Pass', 903528866, 6104370104, 'castill8@themeforest.net', 4),
(10, 'Min Cotter', 'Lakin-Hegmann', '2 Morning Pass', 202139479, 1809788649, 'mcotter9@twitpic.com', 4),
(11, 'Edouard Sickert', 'Kuvalis, Kohler and Abshire', '8419 Bashford Center', 427955515, 1278557276, 'esickerta@ucsd.edu', 3),
(12, 'Reinhard Rooms', 'Langosh, Jaskolski and Howell', '17185 Melby Place', 876597941, 5755332744, 'rroomsb@technorati.com', 4),
(13, 'Garrott Riggott', 'Rodriguez-Davis', '2 Ludington Drive', 101937910, 9555058582, 'griggottc@facebook.com', 4),
(14, 'Hunter Huguet', 'Donnelly-Kub', '0 Magdeline Street', 981785089, 7832653457, 'hhuguetd@paginegialle.it', 4),
(15, 'Missy Moxon', 'Homenick, Okuneva and Larson', '2062 Esch Drive', 552863443, 8101904425, 'mmoxone@tiny.cc', 3),
(16, 'Pattie Ledgard', 'Yost-Hermiston', '8 Division Center', 231040185, 2854685516, 'pledgardf@paginegialle.it', 16),
(17, 'Trude Ricson', 'Yundt-Jacobson', '8771 Ohio Junction', 564509278, 2333849854, 'tricsong@ning.com', 17),
(18, 'Armin MacCheyne', 'Wilderman Inc', '56425 Mayfield Park', 617428588, 7049901434, 'amaccheyneh@tamu.edu', 18),
(19, 'Albertine Tegeller', 'Goldner-Pfeffer', '8503 Butterfield Junction', 235451918, 1152872755, 'ategelleri@yale.edu', 19),
(20, 'Barde Bernaciak', 'Ledner, Marquardt and Predovic', '8637 Lotheville Plaza', 601418381, 6733373780, 'bbernaciakj@ehow.com', 20),
(21, 'Harley Benza', 'Hagenes, Cummings and Murazik', '21 Old Gate Place', 674860399, 2234029359, 'hbenzak@tinyurl.com', 21),
(22, 'Eartha Kilbee', 'Feil, Towne and Hane', '3 Norway Maple Plaza', 862077167, 3437753305, 'ekilbeel@rakuten.co.jp', 22),
(23, 'Erna Tuminini', 'Williamson, Weimann and Breitenberg', '334 Duke Drive', 771210491, 7814881751, 'etumininim@ca.gov', 23),
(24, 'Constantine Bayly', 'Marks-Walsh', '92 Lawn Way', 342583774, 4221036920, 'cbaylyn@google.es', 24),
(25, 'Betsey Scopes', 'Brown, Kautzer and Streich', '049 Dixon Place', 568451916, 3668003057, 'bscopeso@admin.ch', 25),
(26, 'Ethelind Westhead', 'Feest and Sons', '2583 3rd Road', 199666773, 7152614428, 'ewestheadp@ocn.ne.jp', 26),
(27, 'Maximilianus Rickhuss', 'Wintheiser, Hermann and Murazik', '59 Oriole Court', 617394273, 6555591045, 'mrickhussq@gnu.org', 27),
(28, 'Paolina Stile', 'Flatley and Sons', '47116 Vidon Avenue', 162998226, 2363608870, 'pstiler@state.gov', 28),
(29, 'Stevana Paye', 'Ernser, Daniel and Emmerich', '0 Calypso Drive', 221929966, 9728066574, 'spayes@ehow.com', 29),
(30, 'Shelden O\'Boyle', 'Will, Stamm and Feest', '3 Porter Terrace', 349916154, 7669639363, 'soboylet@rakuten.co.jp', 30),
(31, 'Storm Okenfold', 'Predovic Group', '25893 Green Ridge Alley', 204629880, 1209982168, 'sokenfoldu@google.com', 31),
(32, 'Ewart Petti', 'Turner, Thiel and Sporer', '80 Holy Cross Terrace', 659639577, 7201313713, 'epettiv@hugedomains.com', 32),
(33, 'Warden Pitts', 'Monahan, Sipes and Schaefer', '623 Fordem Trail', 810944431, 7669962926, 'wpittsw@purevolume.com', 33),
(34, 'Gabriele Worral', 'Maggio, Marquardt and Mosciski', '5089 Northridge Road', 761490547, 3675567967, 'gworralx@edublogs.org', 34),
(35, 'Court Blooman', 'Von LLC', '3246 Pepper Wood Lane', 457381202, 9142940248, 'cbloomany@weebly.com', 35),
(36, 'Vanessa Tryhorn', 'Schimmel, Trantow and Kemmer', '5479 Claremont Crossing', 788809074, 7969693198, 'vtryhornz@wikimedia.org', 36),
(37, 'Payton Donlon', 'Spencer Group', '253 Spaight Point', 586036592, 9309393862, 'pdonlon10@sogou.com', 37),
(38, 'Kellie Kneebone', 'Russel LLC', '2814 Pearson Trail', 690170342, 8181582158, 'kkneebone11@latimes.com', 38),
(39, 'Amble Cowl', 'Predovic, Maggio and Feest', '10 Bluestem Plaza', 582564831, 8636319885, 'acowl12@quantcast.com', 39),
(40, 'Kennedy McCrohon', 'Langworth, Baumbach and Schinner', '3678 Warner Road', 622824809, 8368046307, 'kmccrohon13@hp.com', 40),
(41, 'Sidney Pierpoint', 'O\'Conner, Murazik and Johnson', '1 Vera Road', 672663507, 2343510724, 'spierpoint14@hexun.com', 41),
(42, 'Nolan Morrow', 'Corwin-Zulauf', '4 Leroy Center', 306572712, 8551079255, 'nmorrow15@cmu.edu', 42),
(43, 'Kris Oram', 'Labadie LLC', '963 Bayside Center', 744128936, 3801036376, 'koram16@goo.ne.jp', 43),
(44, 'Cristionna Dugget', 'Gutkowski Inc', '3101 Mayfield Road', 439223788, 5972891371, 'cdugget17@hp.com', 44),
(45, 'Daphne Dever', 'Funk-McGlynn', '01111 Cottonwood Junction', 937962045, 5274173769, 'ddever18@merriam-webster.com', 45),
(46, 'Tripp Beenham', 'Schmeler and Sons', '88801 Quincy Plaza', 695120634, 5879343702, 'tbeenham19@drupal.org', 46),
(47, 'Drud Beagrie', 'Mante-O\'Conner', '2 Mcguire Crossing', 954121928, 5023716109, 'dbeagrie1a@sohu.com', 47),
(48, 'Diana M\'cowis', 'Bartell, Wisozk and Schamberger', '6 Rigney Crossing', 244212317, 8713264696, 'dmcowis1b@netlog.com', 48),
(49, 'Leonore Castleton', 'Kilback, Klocko and Stoltenberg', '493 Linden Avenue', 162388583, 6491412379, 'lcastleton1c@live.com', 49),
(50, 'Wells Malling', 'Kihn-Breitenberg', '53071 Shelley Point', 490422086, 9613481784, 'wmalling1d@google.com.au', 50),
(52, 'hdjsu', 'jsks', 'jaja', 646449, 4664, 'jsja@ahak.s', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadospessoais`
--

DROP TABLE IF EXISTS `dadospessoais`;
CREATE TABLE IF NOT EXISTS `dadospessoais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomecompleto` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `telefone` bigint(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dadospessoais`
--

INSERT INTO `dadospessoais` (`id`, `nomecompleto`, `empresa`, `pais`, `cidade`, `morada`, `telefone`, `user_id`) VALUES
(1, 'Paulita Simeon', 'Nicolas, Bauch and Botsford', 'France', 'Niort', '874 Lillian Street', 7198988406, 1),
(2, 'Morry Kings', 'Kohler, Raynor and Schamberger', 'Japan', 'Hanyu', '373 Westrge Trail', 7962551430, 2),
(3, 'Sybila Posselow', 'West-Thiel', 'Canada', 'Sainte-Martine', '9647 Alpine Place', 5757177990, 3),
(4, 'Peggie Branchett', 'Larson-Gleichner', 'Portugal', 'Torre do Pinhão', '5616 Texas Parkway', 7255278988, 4),
(5, 'Carlie Reek', 'Reichel, Moen and Klein', 'China', 'Tiyuguan', '358 Eastlawn Trail', 8591059528, 5),
(6, 'Ardis Sneddon', 'Kovacek, Crooks and Leuschke', 'China', 'Boshan', '8 Everett Road', 6208276982, 6),
(7, 'Nessie Angus', 'Bechtelar, VonRueden and Mitchell', 'Brazil', 'São Francisco', '364 Tony Court', 3812950712, 7),
(8, 'Catie Grindrod', 'Corwin, Crist and Marvin', 'China', 'Toutai', '9 Old Shore Center', 7453516361, 8),
(9, 'Augustin Blanc', 'Zulauf and Sons', 'Sweden', 'Sundbyberg', '54 Melvin Drive', 5486362240, 9),
(10, 'Roslyn Dudill', 'Greenfelder Group', 'Sweden', 'Spånga', '344 Artisan Avenue', 3543000569, 10),
(11, 'Evangelina Tivnan', 'Fahey-Crist', 'France', 'Rennes', '3491 Thierer Junction', 5371772423, 11),
(12, 'Marcelle Monelle', 'Daniel Inc', 'China', 'Wushan', '6 Quincy Point', 9563612047, 12),
(13, 'Bradly Anselmi', 'White, Dach and Watsica', 'Brazil', 'Barreiro do Jaíba', '495 Merry Crossing', 2785114274, 13),
(14, 'Ted Polland', 'Jaskolski-Ondricka', 'Sweden', 'Uppsala', '135 Browning Parkway', 1079540473, 14),
(15, 'Kimberlee Joddins', 'Leuschke, Sporer and Bauch', 'Brazil', 'Boa Vista', '90890 Kingsford Alley', 9468335601, 15),
(16, 'Frannie Daley', 'Rempel, Trantow and Batz', 'Sweden', 'Stockholm', '6 Spaight Hill', 7593833177, 16),
(17, 'Krisha Wollers', 'Mills Group', 'France', 'Lens', '070 Thierer Avenue', 9794498632, 17),
(18, 'Angelle Groucutt', 'Raynor and Sons', 'China', 'Xinbu', '8148 Valley Edge Trail', 7013695170, 18),
(19, 'Ricki Moodie', 'Heller Inc', 'Italy', 'Bergamo', '55 Lyons Center', 5476579428, 19),
(20, 'Pedro Rolling', 'King-Goyette', 'China', 'Fengjiang', '1478 Everett Place', 8192854137, 20),
(21, 'Madelyn Bewley', 'Jaskolski Group', 'France', 'Saint-Égrève', '090 Butternut Avenue', 2157037995, 21),
(22, 'Lela Shillingford', 'Corwin-Kunze', 'France', 'Arras', '243 Northwestern Trail', 2553881905, 22),
(23, 'Kristos Urian', 'Wiegand LLC', 'China', 'Hongmen', '0051 Merchant Court', 4455918211, 23),
(24, 'Emmy Carnachen', 'Romaguera-Aufderhar', 'China', 'Huqiu', '13 Utah Way', 4393644804, 24),
(25, 'Vitia O\'Spillane', 'Heaney-Ankunding', 'France', 'Issy-les-Moulineaux', '8769 Grasskamp Way', 2881469146, 25),
(26, 'Stewart Espie', 'Deckow and Sons', 'Russia', 'Olonets', '90274 Rigney Court', 3008775094, 26),
(27, 'West Fruish', 'Fritsch and Sons', 'Brazil', 'Cruz Alta', '5 Rgeway Alley', 4931673542, 27),
(28, 'Martainn Jurasz', 'Volkman Inc', 'Brazil', 'Nova Viçosa', '4 Ilene Alley', 1424152844, 28),
(29, 'Travers Ambrogi', 'Kihn, Ernser and Streich', 'China', 'Dalazi', '5645 Park Meadow Way', 7124366491, 29),
(30, 'Chad Beesley', 'West, Zieme and Kuphal', 'United States', 'San Jose', '8 Arapahoe Court', 4084577694, 30),
(31, 'Annette MacScherie', 'Rutherford-Macejkovic', 'China', 'Liangzeng', '73 Morrow Circle', 1794927326, 31),
(32, 'Briant Lockwood', 'Streich-Hettinger', 'France', 'Strasbourg', '161 Bobwhite Road', 5194815588, 32),
(33, 'Loralie Pdle', 'Nienow-Adams', 'China', 'Tangpu', '77724 Granby Way', 3964154590, 33),
(34, 'Conan Archibold', 'Predovic and Sons', 'China', 'Dungang', '2993 East Circle', 6426990139, 34),
(35, 'Ameline Sturley', 'Cummings-Hoppe', 'China', 'Youxikou', '135 Memorial Court', 8886840006, 35),
(36, 'Che Vasyatkin', 'Rolfson-Greenholt', 'Russia', 'Turki', '373 Westerfield Alley', 5326763469, 36),
(37, 'Hugues Skrine', 'Huels Inc', 'Russia', 'Vorontsovka', '9 Hollow Rge Plaza', 8529875499, 37),
(38, 'Beaufort Rist', 'Kovacek Inc', 'China', 'Shenzhong', '2 Columbus Point', 7142338691, 38),
(39, 'Cyndy Ordemann', 'Okuneva-Hilpert', 'China', 'Puyang', '8 Jackson Way', 3738872878, 39),
(40, 'Elli Kaiser', 'Sawayn LLC', 'Sweden', 'Älvdalen', '50363 Milwaukee Drive', 3726828445, 40),
(41, 'Duane Hanway', 'Koch Group', 'Sweden', 'Askersund', '86 Fallview Junction', 2333148045, 41),
(42, 'Tamar Ginnell', 'Reilly-Windler', 'China', 'Linjiang', '962 Truax Alley', 4223328304, 42),
(43, 'Lezlie Jenson', 'Schaefer-Willms', 'Russia', 'Semënov', '88648 Londonderry Place', 7442497351, 43),
(44, 'Gertie Gherardi', 'Raynor-Boyer', 'China', 'Shimen', '69 Fallview Drive', 4441304940, 44),
(45, 'Hedda Hinckesman', 'Kunde Group', 'Russia', 'Churovichi', '70 Shelley Street', 8499949326, 45),
(46, 'Barn Grigorushkin', 'Pollich and Sons', 'Russia', 'Bogoroditsk', '07696 Sheran Center', 7565771956, 46),
(47, 'Wolfgang Jennison', 'Mitchell-Zemlak', 'France', 'Beaune', '7063 Schlimgen Drive', 2889547285, 47),
(48, 'Clim Smale', 'Quitzon Group', 'United States', 'Pittsburgh', '91240 Welch Pass', 4123174828, 48),
(49, 'Fabiano Shutler', 'Littel, Turcotte and Abernathy', 'China', 'Damao', '529 Victoria Pass', 7347261065, 49),
(50, 'Cesaro MacKellar', 'Hyatt Inc', 'Brazil', 'São Pedro', '10 Harper Road', 3315535622, 50),
(51, 'Neil Rendbaek', 'Stanton, Beer and Steuber', 'Sweden', 'Vetlanda', '1 Lakewood Point', 2922988726, 51),
(52, 'Jodie Baudacci', 'Hansen, Sawayn and Schiller', 'Portugal', 'Santo Amaro', '8842 Heath Avenue', 6844020114, 52),
(53, 'Bronson Hincham', 'Kulas-Ziemann', 'Japan', 'Kan’onjicho', '5323 Ludington Center', 6885958118, 53),
(54, 'Beret Paradis', 'Towne Inc', 'Russia', 'Ust’-Abakan', '24 Red Cloud Avenue', 2489472663, 54),
(55, 'Coleen Dirkin', 'Ondricka Inc', 'Portugal', 'Espinho', '5 Gulseth Street', 3991972584, 55),
(56, 'Lorin Follen', 'Gaylord and Sons', 'China', 'Longgang', '0 Fuller Parkway', 9505120535, 56),
(57, 'Dania Clowser', 'Flatley Inc', 'Russia', 'Pallasovka', '785 Cardinal Junction', 6112316400, 57),
(59, 'Liv Pollack', 'Gerhold-Bednar', 'Portugal', 'Arnelas', '83177 Elgar Alley', 2229087916, 59),
(60, 'Agnes Forshaw', 'Fisher-Emard', 'China', 'Nanlü', '31931 Northport Point', 5026661016, 60),
(61, 'Holmes Nunn', 'Auer LLC', 'China', 'Haocun', '95 Sachs Junction', 9184789457, 61),
(62, 'Emily Hunston', 'Lehner-Blick', 'Portugal', 'Seixezelo', '8796 Leroy Terrace', 2596517842, 62),
(63, 'Allayne Varne', 'Wisoky, Brown and Schmt', 'Brazil', 'Uarini', '0 Holmberg Alley', 6658688974, 63),
(64, 'Nanette Dulen', 'Gaylord Group', 'Brazil', 'Pitangueiras', '34597 Transport Hill', 9777589307, 64),
(65, 'Jeffrey Buss', 'Brown, Quigley and Roberts', 'China', 'Huayuan', '6277 American Ash Road', 5392975602, 65),
(67, 'Mirilla Ortsmann', 'Consine LLC', 'China', 'Jingtan', '11576 Darwin Crossing', 2558483054, 67),
(68, 'Cindie Bonafant', 'Howe and Sons', 'Sweden', 'Lilla Edet', '83319 Jay Avenue', 8034935820, 68),
(69, 'Constancia Phillipps', 'Mertz, Keebler and Parker', 'Brazil', 'Juru', '41204 Burning Wood Crossing', 6204284997, 69),
(70, 'Brinn Brakewell', 'Kreiger-Ernser', 'China', 'Liuzuo', '95975 Von Terrace', 1106905166, 70),
(71, 'Miguelita Lamzed', 'Ritchie, Nienow and Ruecker', 'Sweden', 'Avesta', '0675 Harper Place', 9012194800, 71),
(72, 'Almire Kinforth', 'Wolff, Wehner and Dickinson', 'Belarus', 'Vawkavysk', '9963 Logan Parkway', 3907550669, 72),
(73, 'Ealasa Grizard', 'Sporer and Sons', 'China', 'Zhangjia', '2651 Dakota Court', 3356086675, 73),
(74, 'Samaria Shackle', 'Wiegand, Schaefer and Wolff', 'Japan', 'Iwatsuki', '116 Pleasure Point', 9411244830, 74),
(75, 'Georgeanne Kennedy', 'Hartmann, Lehner and Keebler', 'China', 'Nanhai', '0125 Ludington Plaza', 6155226261, 75),
(76, 'Ram Saffell', 'Koss, Wisozk and Waelchi', 'Japan', 'Kadoma', '06 Dennis Park', 1794943542, 76),
(77, 'Verla Jimeno', 'Larkin-Buckrge', 'Japan', 'Shiraoka', '17717 Huxley Crossing', 7054586632, 77),
(78, 'Daffy Nesbit', 'Tillman and Sons', 'China', 'Shetan', '12007 Lotheville Street', 6799098602, 78),
(80, 'Ashlen Fenney', 'Olson-Abernathy', 'France', 'Wissembourg', '896 Rusk Street', 4775073953, 80),
(81, 'Igor Hayen', 'Dare-Volkman', 'South Africa', 'Germiston', '40 Heffernan Drive', 1893002126, 81),
(82, 'Marigold Fenny', 'Schmt LLC', 'Russia', 'Yeysk', '31370 Portage Avenue', 5739282606, 82),
(83, 'Jase Arnolds', 'Kutch and Sons', 'China', 'Gengcheng', '5072 Esker Way', 3185124941, 83),
(84, 'Tamarah Smolan', 'Emmerich, Murazik and Tromp', 'South Africa', 'Louis Trichardt', '0987 Longview Way', 7194356737, 84),
(85, 'Kimmie Pike', 'Kerluke and Sons', 'Russia', 'Staraya Stanitsa', '7 Anhalt Junction', 6562780851, 85),
(86, 'Cherice Lukes', 'Hackett Group', 'Brazil', 'Inhumas', '71 Bunting Pass', 5588222688, 86),
(87, 'Aila Tourle', 'Beer, Stanton and Metz', 'Brazil', 'Limoeiro do Norte', '8 Del Mar Road', 7903613693, 87),
(88, 'Aubert Delgaty', 'Witting-Dietrich', 'New Zealand', 'Red Hill', '09 Transport Hill', 3843272706, 88),
(89, 'Kayne Segoe', 'Ondricka-Gerlach', 'China', 'Liuliping', '208 Wayrge Crossing', 4852085477, 89),
(93, 'Elsa Raynton', 'Hauck-Satterfield', 'China', 'Darong', '946 Lerdahl Parkway', 7558593221, 93),
(94, 'Brigham Deacon', 'Mann, Lowe and Hintz', 'Brazil', 'São Miguel do Araguaia', '60682 Toban Crossing', 9726103185, 94),
(95, 'Geri Codman', 'Dare-Robel', 'France', 'Paris 11', '4392 Golf Crossing', 2933877320, 95),
(96, 'Shurwood Bagwell', 'Okuneva and Sons', 'China', 'Dongfanghong', '5050 Lakewood Gardens Alley', 8008049884, 96),
(97, 'Klarrisa Pedley', 'Sauer Group', 'China', 'Heshan', '90 Quincy Street', 1316507579, 97),
(98, 'Tammi Portugal', 'Goodwin LLC', 'Russia', 'Tselinnoye', '7 Sachtjen Parkway', 9938337059, 98),
(99, 'Allard Halsall', 'Fritsch Inc', 'Japan', 'Obihiro', '3842 Tennessee Crossing', 6867941292, 99),
(100, 'Doti Gallimore', 'Denesik Group', 'China', 'Zhengdonglu', '7 Rowland Street', 8751549001, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1641417020),
('m130524_201442_init', 1641417022),
('m190124_110200_add_verification_token_column_to_user_table', 1641417022),
('m140506_102106_rbac_init', 1641417428),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1641417428),
('m180523_151638_rbac_updates_indexes_without_prefix', 1641417428),
('m200409_110543_rbac_update_mssql_trigger', 1641417429);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
CREATE TABLE IF NOT EXISTS `orcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `data` datetime DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `randomString` (`uid`),
  KEY `cliente_id` (`cliente_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`id`, `nome`, `descricao`, `total`, `data`, `uid`, `cliente_id`, `user_id`) VALUES
(1, 'jsnssjam', 'snan', 0, '2022-02-21 03:41:36', 'jsnssjam20220221034136', 1, 3),
(2, 'zbn', 'NN', 0, '2022-02-21 03:41:58', 'zbn20220221034158', 2, 3),
(3, 'snnsaban', '\nzhj', 0, '2022-02-21 03:43:11', 'snnsaban20220221034311', 2, 3),
(4, 'sbsmanana', 'aj', 0, '2022-02-21 03:44:10', 'sbsmanana20220221034410', 2, 3),
(5, 'bsna', 'anam', 0, '2022-02-21 03:48:53', 'bsna20220221034853', 52, 3),
(6, 'sbmMANN', 'bn', 0, '2022-02-21 03:51:28', 'sbmMANN20220221035128', 2, 3),
(7, 'nsma', 'anana', 0, '2022-02-21 03:52:34', 'nsma20220221035234', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_produto`
--

DROP TABLE IF EXISTS `orcamento_produto`;
CREATE TABLE IF NOT EXISTS `orcamento_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  KEY `orcamento_id` (`orcamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` float NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `tipologia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-produto-fornecedor_id` (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `referencia`, `descricao`, `preco`, `fornecedor_id`, `tipologia_id`) VALUES
(1, 'Válvula Clic clac', '882021', 'A válvula clic-clac cromada Equation com fecho arredondado permite-lhe com apenas 1 clique manter ou evacuar a água do lavatório da casa de banho.', 9.99, 11, 2),
(2, 'Sifão Lavatório', '882022', '882022', 19.99, 11, 2),
(3, 'Rolo Multicamada', '882023', '', 21.99, 11, 2),
(4, 'Termo Acumulador', '882024', 'Termoacumulador elétrico de forma cilíndrica da marca Equation com capacidade para 80 litros de água, potência de 1500 W e uma classe energética C. Instalação na vertical. Indicado para duas pessoas. ', 159, 11, 2),
(5, 'Sofá', '882041', 'Sofá 3 Lugares com Almofadas KASA Camel', 300, 12, 8),
(6, 'Tapete', '882042', 'Tapete de Atividades HOMCOM 320-006 (36 Peças)', 55, 12, 8),
(7, 'Quadro', '882043', 'Quadro HOMEMANIA HIO8681847133360 Natureza (95x0,3x60 cm)', 30, 12, 8),
(8, 'Mesa de Centro de Mesa', '882044', 'Mesa de Centro THINIA HOME Storage (Bege e Cinzento - Madeira e Metal - 40x41 cm)', 250, 12, 8),
(9, 'Candeeiro', '882045', 'Candeeiro de Teto LEDKIA Lesane (Alumínio)', 35, 12, 8),
(10, 'Placa poliéster ondulada', '882051', 'Placa poliéster onduladaPEQUENA ONDA NATURAL 1520X900MM', 11.99, 13, 7),
(11, 'Barrote de Madeira', '882052', 'Barrote madeira 250X10X7 CM', 10, 13, 7),
(12, 'Andaime', '882053', 'Andaime STANDERS COMBI 3.8M', 30, 13, 7),
(13, 'Betoneira', '882054', 'Betoneira elétrica MIRAL PRO 190', 489, 13, 7),
(14, 'Detetor', '882061', 'Detetor digitalEINHELL TC-MD 50', 25, 14, 6),
(15, 'Temporizador', '882062', 'Temporizador electrónicoGEOLIA 1 VIA', 10, 14, 6),
(16, 'Contador', '882063', 'Contador águaGEOLIA CAUDAL ÁGUA', 12.99, 14, 6),
(17, 'Regulador', '882064', 'Regulador rotativoNOVA UNICA WISER ANTRACITE', 9.99, 14, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

DROP TABLE IF EXISTS `questao`;
CREATE TABLE IF NOT EXISTS `questao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assunto_id` int(11) NOT NULL,
  `mensagem` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `respondida` tinyint(2) DEFAULT '0',
  `concluida` tinyint(2) NOT NULL,
  `data` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-contacto-assunto` (`assunto_id`),
  KEY `idx-contacto-utilizador` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questao_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `texto` varchar(250) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-resposta-contacto` (`questao_id`) USING BTREE,
  KEY `idx-resposta-user` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipologia`
--

DROP TABLE IF EXISTS `tipologia`;
CREATE TABLE IF NOT EXISTS `tipologia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipologia`
--

INSERT INTO `tipologia` (`id`, `nome`) VALUES
(1, 'Selecionar tipo'),
(2, 'Canalização'),
(3, 'Eletrônica'),
(4, 'Hidráulica'),
(5, 'Pneumática'),
(6, 'Eletricidade'),
(7, 'Construção'),
(8, 'Decoração');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'psimeon0', 'YSc5h3zNdmmx9NbxDCWMIsP9SXXzMjL3', '$2y$13$u5ZzOPT.Mbu8PJLfuITGguK/cVOpgzFIgrr6Nh6qvqBBn5I0aKuDa', 'oaCnheJ8lOLJ2JTh2K8f0qgV328dDdLJ_1643315332', 'psimeon0@a8.net', 10, 1643315332, 1643315332, '6wIdViWoLy1vcE3cOkuCgbBqLjyY0i8e_1643315332'),
(2, 'mkings1', 'iGN640edHomX5zpHVsdya3MEDHWyIZsS', '$2y$13$5VqNRoy/v45CmY9Gbj9HqOYpMh2geIqdSP.hU/ZdLyQNefd6/Wgry', 'drPMsFSdhJweRHXjIVG67yJIROo3ui2r_1643315333', 'mkings1@fema.gov', 10, 1643315333, 1643315333, 'CqlR1M4tZ9ApK5SUipBhH5GhxD67cCaa_1643315333'),
(3, 'sposselow2', '_HBTG0FtkQZxlMIbkdzvnicmUm5EEDKJ', '$2y$13$ax2qscvt6eTkCdhWxV6Go.RUkAqGHheStjhLWIUTx/bXzADGhE9n6', 'kxATUferGdJODJQ9GXH4xlwDeG0oFPeT_1643315333', 'sposselow2@joomla.org', 10, 1643315333, 1643315333, 'cciB-IurHRsNRZfcmn2w-i5vpprnyae-_1643315333'),
(4, 'pbranchett3', '3BkWZniRcHPI_QrcjqY-DILge32Ef0Pw', '$2y$13$Ul3LZdE3KDtCjGmoUX8LFekTqv6QvGL59YhfeVoQy.4WME1z3t0By', 'krFP6fS6SlQ70rych7bZ2j1V9u1O6waX_1643315334', 'pbranchett3@infoseek.co.jp', 10, 1643315334, 1643315334, 'R0jFiE-FQZ37eAo8ueemYN9qKRLqtekL_1643315334'),
(5, 'creek4', 'DT9S7XMdfwY5prllULKsT1L9gD9r7QiP', '$2y$13$lelzCR4RtoIuyCv9X5HDLudjTC4KcJooj6nlq2rVo2l2P31k.oWmi', '6uiQkbbnUKuXGu44aURBmTWgNuyU_Jo0_1643315334', 'creek4@usgs.gov', 10, 1643315334, 1643315334, 'qrPI80aa3uSqjFKK8E7Zp3O8wHwOPdo6_1643315334'),
(6, 'asneddon5', 'rt-AHQdrvky1CRyu6Q5NBhHkcObrGyQb', '$2y$13$TA5e3RRpDt8KyUVdUfC8/ef7jtP/dHJHHWGbICFf6i73uF3XOScZm', 'Bac5GZAH2fqpNDFKBQ4oXavhsC21JcBf_1643315335', 'asneddon5@unc.edu', 10, 1643315335, 1643315335, 'tPOsvBfGsmGKHzlRXzXJcOgOP3MmxxJe_1643315335'),
(7, 'nangus6', 'njqDgS07sXjta83Ya6gfQONmsgttkBvS', '$2y$13$gtRKL4JqCQqS2O9Vj71KbOdIb6Ro2XPXZzw8hbWf2n7lY5ruKEYHy', '0WegKg7DZh2qbqNe33Q4d3tNu0K1kd94_1643315335', 'nangus6@google.ca', 10, 1643315335, 1643315335, 'u0dY6JYQ1Xk2mc3cB57pyFrPS1s7T8qj_1643315335'),
(8, 'cgrindrod7', 'ccdMr6pqzIxCDnLk3cunIhURJQwQ2tbg', '$2y$13$yoGLtPTlwSFXj2w3nZLlc.dJ5pkqMFg2.0nL69NF87DaX7HoIh.Ri', 'uS82-pZfoLURyoiCpatRHzuot_7iXtLM_1643315336', 'cgrindrod7@google.it', 10, 1643315336, 1643315336, '5zkvkSR0DvYkz4QYQ3X9mM3KyddTBQAC_1643315336'),
(9, 'ablanc8', '_B6I5RcvKxoWHGftHI8b5LHf5PvCApqN', '$2y$13$NHxvon1h3yerT2aSxylITun4JZ/xxt6hfu2LpHTXgMV.PFI336jlG', 'wZ40z3YHZf3oMC1sejf7GekNBz1gS_lx_1643315336', 'ablanc8@oaic.gov.au', 10, 1643315336, 1643315336, '_Mit33s-50kzImEyBHJEp2Ipwb3jOi3N_1643315336'),
(10, 'rdudill9', '9ynkYKUQFY-mUL1Skirr102qHJoePd0W', '$2y$13$mmG4Y9kVHAFcKwuu0s4mp.xumJjewi7yP5BCfK1u.c85.hbw/5BOW', 'oARN4Qzw3tb2ENyo_tYFYdYL7BRluCaI_1643315336', 'rdudill9@mysql.com', 9, 1643315336, 1643315336, 'rQcqm_o0FbZpEfbxFzVkkB-6uSfFRPUo_1643315336'),
(11, 'etivnana', 'hJvkXcJK1a7YpVCfzpf6y3HevPPosoej', '$2y$13$OVVhAbGCRj.E9ACBQuUah.7lM5QgWwqvq0vd0ByoZp0r0yk/cc0ua', 'uygmSBIl7Elz7eHHagjBcigAyHSW_tp__1643315337', 'etivnana@fastcompany.com', 10, 1643315337, 1643315337, '6Nd321CaimbA9_cQa-usp_elbyfq82kC_1643315337'),
(12, 'mmonelleb', '02rpsHcgy799SQFPdUQcvGzkf6ZTHc1B', '$2y$13$4Kd3oJkL56MHS53YpCqCL.2kJ4OunboLLKHOXV1q25vSyDxNuTVL2', '-EyG3WWmurLNLLMc34KK6rwdJHe0FjWZ_1643315337', 'mmonelleb@1und1.de', 9, 1643315337, 1643315337, 'ujOHrxWVJqu2rffUsBq4_cboDYrgpdPk_1643315337'),
(13, 'banselmic', 'VtjrkFf8ASZUpcFNDXyncU36FyjM4X_2', '$2y$13$lDXvJoVLqNXmJ1zZlfkYe.JLa5oU3W8LpkditElw8Y0IzqQabpL3S', 'seEID0BTcnsTRfsnIKfmBsJeeE5ZVLuU_1643315338', 'banselmic@ca.gov', 9, 1643315338, 1643315338, '-WbNlp0Il_nv8ZRElJYvOwE7gKg3WRVF_1643315338'),
(14, 'tpollandd', 'VS-fHksH0KGJpFnYcSVQPr0gqk2ntnfk', '$2y$13$kHQLOiNxKdF/Qf3FAkOe5.4qz7BFOothJ4EdGisZz7GmJdPptDs.S', 'JiogKvr1lfdUAWRyVxhT8u8bdJ94nAB8_1643315338', 'tpollandd@ustream.tv', 9, 1643315338, 1643315338, 'Y5b9VXVhs571tzVw_WY08aUK0L4q8DrT_1643315338'),
(15, 'kjoddinse', 'N80QiGO6kI0pGFoVQsEriTziW3CY15uH', '$2y$13$pPJxN1yDAtgpbqugHEw.Buos1uPjg15rtf/arTR5pt5PiO8PgGOcm', 'SI6vi7-_FbxvKRevJcFKmyvzE1iVDPJl_1643315339', 'kjoddinse@ftc.gov', 9, 1643315339, 1643315339, 'w-JeNL1GQqiNNd8qmm_vFlnLR2QWFQtt_1643315339'),
(16, 'fdaleyf', 'nq5UaDpWccYYxFl-V5svNXzc8ljeW5Ap', '$2y$13$4MwBR7Qdm9AAj9XQL/fxr.k4cDXdKSHVw9YWbGhBu21Lw.Sdcz1Pm', 'C2PNZUBpxffjxtyoaF6ZKUSGF2HgqVGH_1643315339', 'fdaleyf@walmart.com', 9, 1643315339, 1643315339, 'p8hk6P_b94b_5U78DainvoPa5us4ecIY_1643315339'),
(17, 'kwollersg', 'SzqYgiGA8oIWgm-qFUYTGs1AF3kOWCk8', '$2y$13$2zstKCMISqnd..eV2qheE.78xGAAhYQ5Yh2iB5GUGZAiDNtzf.wWi', 'JfjlFGC3-4JW6SNdbkGHTB8B2MJVXorN_1643315339', 'kwollersg@nydailynews.com', 9, 1643315339, 1643315339, '_kYQjtPGypFJZeV5lu6JI5IssGQ-mM9J_1643315339'),
(18, 'agroucutth', 'E_POo98e1GuDihVtBcz7w408dWiakbA5', '$2y$13$taWBzPEhxlrdx2Q/sHx0yOaZdlcVF4ZwR/I5VnHZwYDCR.3Vej1Km', '0SbeRehsslPllaqA4NXCG7ZgwE96gGYE_1643315340', 'agroucutth@so-net.ne.jp', 9, 1643315340, 1643315340, '-yvfRk01tvu3BAlqo3XkyItqKAXu6Ytb_1643315340'),
(19, 'rmoodiei', 'ScqX27kaUKbrFBDYUgaH_cLqvvXrHCcm', '$2y$13$cFbYe5Qx7j/zxXl4AqYPY.LSzs3uA.2n.zyQNLk6NEZaTKCLMvTPq', 'oJq_Dw6giT6h6hJkUs-z7OlJN6XaKIOw_1643315340', 'rmoodiei@jiathis.com', 9, 1643315340, 1643315340, '6-axm93UI8SJ3_IA8JsJNLVM2M8RLAVL_1643315340'),
(20, 'prollingj', 'J7ub23wKI57kcwHx2l1LogLpbGfy3oD0', '$2y$13$HRjx8gZebmOAC1Fu7xo9OO4pWZh0woAEyxNACyL/FJlPbpinq/RsO', 'bFZYYPC6y7830b-HU1NTSdZ8KGVWm3LI_1643315341', 'prollingj@oracle.com', 9, 1643315341, 1643315341, 'eRLIfSokIpu6jpGxjeb0d6c8cAFIKyXG_1643315341'),
(21, 'mbewleyk', 'HrqzAv796rkcATH5kFHKzrUczohto-zb', '$2y$13$pvOdlDUckuAT2tYTeeuT5ueSlGoZwcRdz4VaUHFyL8xfwUPiTcQTS', 'ePi09oi5nn6TDXiCwaqcLhpgg-2s18aA_1643315341', 'mbewleyk@indiatimes.com', 9, 1643315341, 1643315341, 'diTZKdGFWBSD11y2WqDX49gbJyCHFUBG_1643315341'),
(22, 'lshillingfordl', '3n21Sp-q_v8OHPvQpgEd0xEYXNSkAVkH', '$2y$13$I8.yadnQ2HKiJ0A..ytW7eNbJcAgKTcVV9txDYzXTeBlCF0/sn3hG', 'OVGJ-49yXHVhKIIW5H_Ktqq60V67gEXk_1643315342', 'lshillingfordl@nps.gov', 9, 1643315342, 1643315342, 'wcsSU2QJt7MbKV13l5wVCZnQqgpqfPlj_1643315342'),
(23, 'kurianm', 'far284udByZOAzM9FAdcWa-CEZye86NV', '$2y$13$jGv0Nkp2vXKVNoK8onjGTuYEhlta8GiSgmElt3NY1aa5YUFdXjmla', 'T8Wsafp_vC1VdySamk_-o3hsRJOWZlOb_1643315342', 'kurianm@pagesperso-orange.fr', 9, 1643315342, 1643315342, 'oG0ca4-aWpx6zlgRwoqhluaOEj7sVbfW_1643315342'),
(24, 'ecarnachenn', 'Cm-nfFQQtLvTKu7pHwoQ03oQwj33xNrc', '$2y$13$iXPAMoIz8fYFMwTf9cr0qeYGH9EkWzGxYFJznh9JoBJVmLNfec4Ce', '_Q82hMoVFqpECx-_uaqApFCcbD_fpA4R_1643315342', 'ecarnachenn@omniture.com', 9, 1643315342, 1643315342, 'iOI5gameMjgHuCA0FvGdG7IVJGOYvcwJ_1643315342'),
(25, 'vospillaneo', 'JxQp9trLWTUkIcQNev7LcCNS_aFLdcbB', '$2y$13$nMTWu3A6pWZL/q2r49WWx.lzuPUr3/ntcdhmJaRP5RZcW.fFdD5sG', 'NJRy5orA2bOk0-j8rVzdMS7IUKekfEA-_1643315343', 'vospillaneo@google.nl', 9, 1643315343, 1643315343, '29V4VoTj-iEWCUY3nZLFkz-zPRfXxnah_1643315343'),
(26, 'sespiep', 'UabRqgKWXFVp1crSB0wjm9Fu4e0j96Y_', '$2y$13$2l3N8mizMHAP7XAnPj6O2uSMdDewTFABFV0k7yfsfmvMNjfqC6E0a', 'Xdsex5mynUffUBVFcPenc8kWZTkG8BqC_1643315343', 'sespiep@reddit.com', 9, 1643315343, 1643315343, 'yT4TSsweG5MgCUvMURjzbB6nQjn2Xyq8_1643315343'),
(27, 'wfruishq', 'L0nCbVM6dmNSPfipA08L8QDVDls2oBVK', '$2y$13$s5ay/fF/4hzdTh6NpMV66OLECUG/bwcQOCDIQ06ucnpYN3b5tcQX.', 'X7fLoFREmk8s86_Y4pTNfBaYq1e-VKcx_1643315344', 'wfruishq@businessweek.com', 9, 1643315344, 1643315344, 'Ql0-HQ2cN0sjedfll7maTOR0q6j8irWW_1643315344'),
(28, 'mjuraszr', 'R1d7HaDOdv-w1mSsZWxvM5MiXYL8aRu6', '$2y$13$0sNToCzzp4PhU7pgqg5SaOSQo4htsksOj7lVtQM.efCiMHZ.AYViS', 'Vos86z87azdu4Xf3GIfQjcANc2LZ3Nyd_1643315344', 'mjuraszr@craigslist.org', 9, 1643315344, 1643315344, 'tMTM3-7-JSirNrXYJ9AFetbD_LkQA6Ne_1643315344'),
(29, 'tambrogis', 'tkH-W3KUjVaVZDMKBLf5ooFHA3QYjC6U', '$2y$13$2izvpnSwS7uPGRDosS5l/eunCXXC4n3vSQOOHTSHqQ5cU1I7oBSd6', 'MJl8w9oELAL57cFxUhA609NWV90rHYzw_1643315345', 'tambrogis@europa.eu', 9, 1643315345, 1643315345, 'yl4O2VL7KOf00ZSlY7OobbNeJYpABBho_1643315345'),
(30, 'cbeesleyt', 'fctXs7YZuMizXP5w-y8hOS6IK7Nvu6LI', '$2y$13$QdnQKRgTAvUL6xpoy/A4oOaI2lJiY9JzWGr90ZXD4ubKz7m7AgtOm', 'JbYkcn_ebGaEjYWg_BxBaXvxnGqQBXb4_1643315345', 'cbeesleyt@studiopress.com', 9, 1643315345, 1643315345, 'HN_8BhOTTsE66ClZR-JUD8urHz8IC7nv_1643315345'),
(31, 'amacscherieu', '62wpVbB0gIaa-Yo2a8Xbla_PeW7aC-18', '$2y$13$bbkxpoK2Tb/2KofwNdsFbeCzy0fk16jZLufY/GrNPVHUNF40kKNYW', '6q2PrRZnHK3FSYDSvzcw4wJzIxqy8kE1_1643315345', 'amacscherieu@barnesandnoble.com', 9, 1643315345, 1643315345, 'RJT3mQhGDgU6GHA2J4rVkBl13b-STRiU_1643315345'),
(32, 'blockwoodv', 'LkNXmC4wWyAYnrFKgoarIbtk3bG80q9n', '$2y$13$6AePJ5ymCJgEVQptE7cw6e9It1OTpiTHTo.n/lbU8syg7aonSVaE2', 'mxkTGSGyjJdLpiV1Y5pRMZxOfI42x_wl_1643315346', 'blockwoodv@com.com', 0, 1643315346, 1645409655, 'ObUAgmIf3aJyEffGfVTd2pTPY1f5tKra_1643315346'),
(33, 'lpiddlew', 'p8JtXfK-IJlAhdj6J7wYAQ13W3yHbiqA', '$2y$13$/Xjyz.r5RnKp.ZCt1w8xBOGkqEKS58NbsC65Dy3GeP4XHzdJH/EfO', '6KKcDMXXU_jz0u-Zlw4ETitQSZS4cpd8_1643315346', 'lpiddlew@hugedomains.com', 9, 1643315346, 1643315346, '3isviDw1WE8Nng1z7hTuqvUtrKs7c7wK_1643315346'),
(34, 'carchiboldx', 'UQ6au9JZqsjL6FkcqPBISNoEsiEjoHCc', '$2y$13$vU.1mEAEtDp1Nttzwd7p0uBxLXGwG9K5CIe4tNlERC3IIlzQDrRLi', 'g2ZVQyRhPxi-8pkaoLgoiegPwprIYExE_1643315347', 'carchiboldx@printfriendly.com', 9, 1643315347, 1643315347, 'CqVKmbB-RpaAAOpuTGXaJfirYj8AmI8y_1643315347'),
(35, 'asturleyy', '7BvS_jrl2Xa3Ns7NzwhWR_UM8xQI4G0e', '$2y$13$Ud4rtiMzli9ptZ7Gqd9pmuMRXWCNKSJx91/OT9SzQNxE9Q54o4ck2', 'DtCVti0WiHFyFi_Srab0qERutI8Fuu0g_1643315347', 'asturleyy@infoseek.co.jp', 9, 1643315347, 1643315347, '3L9FPIcVzfUGIKw-jrmhdQmOtzsE0tQ4_1643315347'),
(36, 'cvasyatkinz', 'CEI080abQF7HBv0xuNZeGBaRdTMn1LCH', '$2y$13$r6xjOVOMnc5YOopekta3suF.Nm7tY7EuNj..BKZSG4VUBNCpZ8phS', 'FGpXbEwp8b8Q_12eLPnATitFTq6sLQy1_1643315348', 'cvasyatkinz@cloudflare.com', 9, 1643315348, 1643315348, 'BtE7NzQA0gUaCnVUmS-eITnNqka6zUY6_1643315348'),
(37, 'hskrine10', 'k1iV63iL8MMgKMhyii7UfV-K26veB3xN', '$2y$13$U5BGU7CI89nnOqjL2kbyHOWGyQvSy5uODaSGMz1PdbthTYwxd.zja', 'jwIjVT5DVdgf8JVGWUR93mwUfxZ4JeGO_1643315348', 'hskrine10@sciencedaily.com', 9, 1643315348, 1643315348, 'n3V7JWZTx1EneCWIv57UfEgpOrl4f2ls_1643315348'),
(38, 'brist11', 'NLzv-3S_dqytmTtZduj8usNLv0e072s8', '$2y$13$0gBucXdN/Br6hr3UCBAnoeAKCEtwvW6elfq9127ehDx.fF.CUBhnu', 'Fj2YWCUXsOcbfagHEDl_gRkHWRKwtbQ5_1643315348', 'brist11@reverbnation.com', 9, 1643315348, 1643315348, '63nbQRvmE56gXLtX3K3SWQod9L2QOcZi_1643315348'),
(39, 'cordemann12', 'm4PZfL28V5uNTt9fL_xD8bUeg62NeSY2', '$2y$13$Khm4lNWlLSQAm3VRVTwwBO3qhSYKctftWwtoJxjWSbPkraulhZj.i', 'xylibeXGbcLwYTpXj6JaCegJnrqAqRK6_1643315349', 'cordemann12@howstuffworks.com', 9, 1643315349, 1643315349, 'nnAsV3TV8vbttbeqjCxWTLunecIqP2EG_1643315349'),
(40, 'ekaiser13', '_vbZaihMmupY7dlfA1a_vxr14Aswq-09', '$2y$13$.rrZMJEYqbZBnxQi3zQfq.M1C7j/RQe5zhqGnWdRcPYerIxtvrvZe', 'zrTyUYbK4DAVCmaFFHMzJytxJYfMuDfn_1643315349', 'ekaiser13@de.vu', 9, 1643315349, 1643315349, '68WBaqLCA5nNdajQT8G9YQ9wfvdRIgRs_1643315349'),
(41, 'dhanway14', 'akZZD_e_qfkFS2kJ894cs8gIOM_FxaFO', '$2y$13$IxRNxQUCeXpxfoKrPjxequwhy0l036e/psFC3pJ2BFJGpndosIxAa', 'zWnt-xbrJZo8TbcOL9_Clr_0RqnOGo98_1643315350', 'dhanway14@simplemachines.org', 9, 1643315350, 1643315350, 'z6oyrJKXculro3uy7zFZZgXK5dacsVss_1643315350'),
(42, 'tginnell15', 'VOTVRSL2QsXnounknUv8PIw-b_OmLnDv', '$2y$13$6gj3d2rvxGUIt9oeoDfxoeZbNC0Uv0Bvi3enyQKEyU6eG481bYFa6', '72lIwEIFSSXCI8gDmlbiw9-iWD84YRjd_1643315350', 'tginnell15@chronoengine.com', 9, 1643315350, 1643315350, 'iGtDa20jfIKADu2gezfyzdTzc6w0faiO_1643315350'),
(43, 'ljenson16', 'syJTHtPp_MFVkt0vTb87OgzTAuKwweoY', '$2y$13$XzuPVFsP7qP4173vMQZ56OaOmdPCJFfFU38HQDAJdFZ1kAfSuXAli', '39Ltwe4SNlu4KhGvqNUEa6rip8q641Ga_1643315351', 'ljenson16@squidoo.com', 9, 1643315351, 1643315351, 'NuCzj03DmNFOZGGEjobcKHvz43NMJc0U_1643315351'),
(44, 'ggherardi17', 'xUdEa2LfYklnIsOk1Uu_qlKlJfioNQcw', '$2y$13$4vUpnmPn5yJ63AFQ/tUGAOX//m86qoGGXjpjz52UNKi/6vK1PhQ9i', 'hUA2VFpaEkbdhpQWwp0eXIxlg_D2BOwz_1643315351', 'ggherardi17@squarespace.com', 9, 1643315351, 1643315351, '0-kzgrnfzgzRmfyLOJOQkOdbmsfEac4o_1643315351'),
(45, 'hhinckesman18', '8A_I71kWnNQv8g6EJlvnI50dQMcI0ffQ', '$2y$13$4X.T8S1WiWpQomjZt8QCE.lg1J8.JeofhpOs1Jou1nvrZz5s2SqX2', '1_og72autHY3xUkuvaxo8hB5SP5Puxvj_1643315351', 'hhinckesman18@washington.edu', 9, 1643315351, 1643315351, 'DOUdENyAK8ixDooJ54AX-xMXO3BI4j7B_1643315351'),
(46, 'bgrigorushkin19', '6nJrxh-8EIQXtAv9WAcT_NL04phflSjQ', '$2y$13$Rc.0T4i.YWaHxSDZZTRyEuDQbdHpqp7rNvkrQcmU.OwDwDN4scAdq', '9XhRWBMRiPpTFAEpxTkCNxGiLYWf013D_1643315352', 'bgrigorushkin19@facebook.com', 9, 1643315352, 1643315352, 'tY_zPwUHVYatNrVkXJvfgWoeGAi8ut2M_1643315352'),
(47, 'wjennison1a', 'eawSuQCHmmOiVXh6IO0s2_6P_BhkiIdN', '$2y$13$yb/1jYDf/n9Tm/YaIcyaZe/Q78ryppTKAUXGigjjDnb/AYP5YxXJ.', 'v4l-EHtGK5x4NSeb7rAqPvvbgoKk5201_1643315352', 'wjennison1a@devhub.com', 9, 1643315352, 1643315352, 'eFJN2cl-eKXUJM8sYdjhvJ9HVn4t_FIS_1643315352'),
(48, 'csmale1b', 'CiEKeCaP5ek62bwDoF90LncP7mI3Ypyk', '$2y$13$GZIvtf.msDN5cp46IagFQuTvqT.RRlXxKVH8cdcIYY9f9BDWK.joq', 'MRabqUeAPd5YGgwn9VeClIHAcKprvODk_1643315353', 'csmale1b@nps.gov', 9, 1643315353, 1643315353, 'DDLSjtOTunnO26sMVmULh3Fa4NJBZC_8_1643315353'),
(49, 'fshutler1c', 'OHwrrndJRJe2hLQvLewzmEwsxcR3tRx1', '$2y$13$QVEr4lmRu3KbcYsLVCom5OTuyYsNVIQ6OoyP5KXrm08mfz9HU5en.', 'FpM21pnKCaA6etm3JafcY7pUrle9Krgh_1643315353', 'fshutler1c@sitemeter.com', 9, 1643315353, 1643315353, 'dNvcsWtdTtUuX1GIGx5X9Jn1U3UIu6mn_1643315353'),
(50, 'cmackellar1d', '-8laHXe1qSti6LVUetCBYXbwYHkDLb14', '$2y$13$8sYZid8PSf2xRQufYmYOlueZmqqvdaOp8SdkF992dJ0FnMsQLiNcK', '8zPg85KL9eMflHUfT4qBzNKIWQq3De3S_1643315354', 'cmackellar1d@guardian.co.uk', 9, 1643315354, 1643315354, 'HeWSaAv5OKUH6YNzIZ7MRBX0qRXnKYSp_1643315354'),
(51, 'nrendbaek1e', 'Bvd23cEMhLlfuSLqRpQIAYuTyUIqxolz', '$2y$13$HvdtZXUD6DutdxMDmPCDqeEWExCvVlrQULZEXW8NjPeyscsPj1Oxe', 'GtoW0dtITzt_BnsW-FE6bndF06jYzUrt_1643315354', 'nrendbaek1e@marriott.com', 9, 1643315354, 1643315354, 'LPMHdGn6a3ohK-zAKuIO4Eip1wOUmf8R_1643315354'),
(52, 'jbaudacci1f', 'nS4kyxmOdtXQRQHkQKv6cyyClNnSONmQ', '$2y$13$L/XyfvQcsC0Tdpq1zbOTc.MLVDzhvjFzsW9cUl5zoxnKHXPmtgiKq', 'PnWR1luVGIYaCBVjaLuRflwvOL-Mp9A6_1643315354', 'jbaudacci1f@ed.gov', 9, 1643315354, 1643315354, '384kDAL4wVg-JH4_GEI7kW468QDGPPEe_1643315354'),
(53, 'adacscs52', '6NJazuzT_S_DMpa-_uxH-v50nDqZ_0LO', '$2y$13$Pn7qyS75TAWlt3l8TlmAaOKSSr7Fwu2rmzVVvTcaVdv3M0HfNYDfi', 'res3x1bdsauHE_qrLhp6g9k7ngz0LjaM_1643315355', 'dd@fds.cas52', 9, 1643315355, 1643315355, 'zytIwSQ2BhCqc34Nhc5VNQfqQ6kgVJhF_1643315355'),
(54, 'bhincham1g', '2mVS4mBucFcE2TIHxcvkA0bRTNFSlLdC', '$2y$13$UGGDoOl972eotwTKNtiK3OjZTr/Bd05.wNYhhsObsTtntv5XrqNZu', 'WtBVd4RkpANJ2tUT9i7BnLTzBMhe_TuD_1643315355', 'bhincham1g@forbes.com', 9, 1643315355, 1643315355, 'BiiugVC6wCyIf64WKQZVAEXsfgXDj726_1643315355'),
(55, 'bparadis1h', 'TozJJVSIlRXP3ZsPC4RZdka9IJmoZOtm', '$2y$13$1ejJWSvyAYx/nRhCvQSKi.PE29RYIJlu3Ic.OdAE3B6UOnSsDCCZK', 'LdAfGvucc3idg_eP3Mwnm7RSmaHJP92G_1643315356', 'bparadis1h@ebay.co.uk', 9, 1643315356, 1643315356, '0zitQB_AT5BABKREzws68BiL17Tp4BSV_1643315356'),
(56, 'cdirkin1i', '3B98SARHG5FLTVua8kgBKPrJzDseomtt', '$2y$13$cec3sPvJNF1y0klx9mV.dOR9JSwNifABs/.LCVWQy4cRyei9mANBW', 'tWQ_DBcpe_fkOYpuCen5VWWKlBU0U1ie_1643315356', 'cdirkin1i@yelp.com', 9, 1643315356, 1643315356, '6cw7Dp3UBoMY_ooRDsuh1uULzGwJsVCU_1643315356'),
(57, 'lfollen1j', 'rChJE3jcM2_l5CSqfcw3zrlkzfhO-kiq', '$2y$13$PhbY9tX7xL83gGtGBd8C5e596GeC3784KG8tMYaBSZHEQL1z42tKC', 'IfsvOaTLUmcnbMUTzr4S4jxYhCJi1w9b_1643315357', 'lfollen1j@forbes.com', 9, 1643315357, 1643315357, 'NvgLUgh7UV2SCya1ea_R9zgIb2nuz1pZ_1643315357'),
(58, 'dclowser1k', '8TwQPMaCXXJvuQN2ZVNlvPUhD-qbUD-e', '$2y$13$NclysdUAmsRbmwgY7qzBj.Ksr7EAUaUEh4YcPH4ekW2.F3qjOMMZu', 'wVakveZ8HEPzOnfXxm3jBqFuQS7U3F4d_1643315357', 'dclowser1k@arstechnica.com', 9, 1643315357, 1643315357, 'EZNvnh8n8K0xmIAz__hplI-i_Ifhp0DH_1643315357'),
(59, 'athurber1l', 'u6p4oyuKibH-EENAYWWL0MZ44tDQWoD5', '$2y$13$Eko7ZESZd/J7spWZLtZSk.8JiSLmPFQ39PCyeqG/enft8EuH92/Pi', 'ZLtF0Z_fWNLy9VJtplVxxlFfLhhwsfj9_1643315357', 'athurber1l@msu.edu', 9, 1643315357, 1643315357, 'CsAbxiN6KB1c63tcbeF5_Z5xP-MM2G3I_1643315357'),
(60, 'lpollack1m', 'RLKEtkcMphVbkwrPybnuhkhmrOiFMnUf', '$2y$13$QViqqcFRCFrAvFcubJOLuOotSydBG7vBevcswBW5L8c/gWFhYmXci', 'rk0qClNS63ZEtobudeQYiCDOa1qO-z5G_1643315358', 'lpollack1m@homestead.com', 9, 1643315358, 1643315358, 'J8i5NaIQP7sIaGGexA8BYHtKxnFr-rWT_1643315358'),
(61, 'aforshaw1n', 'S6gSrNiunA23CgF3ga0zYQ9b4N4DIE5H', '$2y$13$27ELyCwVHfymbsWq0xLTzeSNY5RNIwuv6m3oQFCgckhV5vTn25sy6', 'tYuC1ML9HxE0ZFWdtFnVeNI-BMvIM43K_1643315358', 'aforshaw1n@vimeo.com', 9, 1643315358, 1643315358, '5MmKT0V4VPfu54NIA1jwBs4SNvytbOMQ_1643315358'),
(62, 'hnunn1o', '9DFbtfgCGoAdes5YbFc6vTHHEN7YrFph', '$2y$13$MCFz89sq6.9v8udB/JXs1uoTln8/sJlszY1DbU8RNBfxYNVkO8Ptq', 'DLOcWoDiL25nnDulk6ETPJrDZrCUOmy4_1643315359', 'hnunn1o@xing.com', 9, 1643315359, 1643315359, '7E6URnSODm5uK2MQwZIj_hX1ymS9ZFSg_1643315359'),
(63, 'ehunston1p', 'sCE6t-n-39zGCWt1niuo9PKwH1YdzZv-', '$2y$13$y97h3uur1G57zGiWALcEU.g3WbpvVkhyCq/cdym5ho8kFlXaN1poC', 'NZrQQPGvKUy-Xxt7yulGFZgvshAAzFBg_1643315359', 'ehunston1p@fema.gov', 9, 1643315359, 1643315359, 'iysAR4RXZz4M3WrNfnNJW3eTA3TrXSQw_1643315359'),
(64, 'avarne1q', '70Wl6m_4EVUVq2LHDYimtIZulMz9dspo', '$2y$13$1RVleQJnCIzkOi2o1oQ60eNv6DNj/aBluNeHnFHTUdVi9DK.By/Wq', 'xCU5wyzNEPIPDjcvvidVaeuY8IACcNys_1643315360', 'avarne1q@smh.com.au', 9, 1643315360, 1643315360, '00sxIBEesWrGEhOsnr7njx18_b0exfSq_1643315360'),
(65, 'ndulen1r', 'ivDOAnlW6iiNB0hzGrwf_aeKbNaVChLE', '$2y$13$sdiOntHW5sSKoNb82otjeufQTHf1jo69HkgRz4hYongYQ9RXMpZdS', 'JU_W3Wybl1d7BUQrZTbRvpKpsRanqBpQ_1643315360', 'ndulen1r@wsj.com', 9, 1643315360, 1643315360, 'NxsCecQi8gpN4Mhdh3uerTN1d_IsvznO_1643315360'),
(66, 'jbuss1s', '6xWSxoWnAddZA9FEOpj5fNZbJxxQdix8', '$2y$13$r.jfouhM2sYiiUBQ/qmJIeklhtYI5g8LVD9wEhdNwI.MkphAInQki', 'K7G8VSHnyWBvIcoHQ8Cw4asZUFG8N7jC_1643315360', 'jbuss1s@nydailynews.com', 9, 1643315360, 1643315360, 'pela_2AKgYi2GJfMggRbhYedSvSw0qR4_1643315360'),
(67, 'sbresner1t', 'uzZc3oKvK7xBj4x4bg-lQDjE1btaxe2r', '$2y$13$AR5yMhWqzLndqUZWRktA6eOLmGJVml0EBC9q8jxQsF/xHmtAmpX86', 'GQt2nrg2diKcVIMb4YaTbkSEITIMuiJ__1643315361', 'sbresner1t@xinhuanet.com', 9, 1643315361, 1643315361, 'YeEe5Q--aDsxb-iZuJDXcEkcmeYCs1l__1643315361'),
(68, 'mortsmann1u', 'nXCeNS3zeAiYnY1sIJIDxFrLXjnlCHxq', '$2y$13$zH6N69zMPKRBEajZ.KAzsuHraSpN1cSj6yDVCg80Bnl.AjDHHDTDi', 'GFoqpGePT3cp2bfpXAol4V8E4k-o4U-A_1643315361', 'mortsmann1u@squidoo.com', 9, 1643315361, 1643315361, 'HO3LvfxYAPbcbgz1Qs02A8MOjkvXVXUK_1643315361'),
(69, 'cbonafant1v', 'eQ8kPdi1U25yw5DwOKeZ-YZOEn0jCS1U', '$2y$13$1RAwdF0HntMvvTNFHmsyweNrRlfnUsoRyNO9dooaljeyX24AS723.', 'j8-zkubTwe_HcfN_1v7TpbCPSGHIFlBk_1643315362', 'cbonafant1v@shareasale.com', 9, 1643315362, 1643315362, 'oh9ab7lkcWTsXG8XeF-qPc60r2RSvDb4_1643315362'),
(70, 'cphillipps1w', '8bLXDjm5ZStQLKy0SgoV9VmTkMYbiDf7', '$2y$13$qBNacB7hM4pWWGtk97zeJOyG08RX1dWpWyuI1crIG0l0jI3gLPReS', 'vzjD3jxtzo9DHV2gWfDZ-OgFqYwzNQPK_1643315362', 'cphillipps1w@ted.com', 9, 1643315362, 1643315362, 'HKfBNCZBRZDxOLRZry6WkrwIrKP_VTxY_1643315362'),
(71, 'bbrakewell1x', '_qoHH-qoST_dy1z1Kkxh1qqSuYe6UDBH', '$2y$13$jzM.wOukUlph2XMpJckcMOfet2MqND0tXyvX1NVFNO9duKrxX8Yeu', 'K65gZuCw-oGfNr_htIT6qVXU-AMEm_Pt_1643315363', 'bbrakewell1x@dion.ne.jp', 9, 1643315363, 1643315363, '5UjeJe-v2GlUupVGjmgxqCW2qKftY0dw_1643315363'),
(72, 'mlamzed1y', 'wXtHq38SYHaBrJhhn2lWHMiCsQPb9Fhz', '$2y$13$fK1jExnh05wHKmZCuzSVOukgPfk3RspIl4vpHVaJuQ9.3gkLJghN6', 'AmUigkp_AO46ddMkGyuUMRWD6jm7pE-O_1643315363', 'mlamzed1y@trellian.com', 9, 1643315363, 1643315363, 'qanOhTYVF298eEQGdiEBf4ZBbCglX9pV_1643315363'),
(73, 'akinforth1z', 'zm_kodNdP1MXyHTUkV4A9iRxCc5dWmVX', '$2y$13$ET9m1dwmR166XC8fVySYZOQEbzitDzNxGi56Z5P63G6Mt4BZrTXna', 'XeGv6UsvCAtJjmnIBk6NmfQhk9x4Tto7_1643315363', 'akinforth1z@harvard.edu', 9, 1643315363, 1643315363, 'x8Sqid-WhMdIQnIsb4TXH0py4FYh3Oz7_1643315363'),
(74, 'egrizard20', 'ScArUf0NrdrE-yuk-Qn_n_EkSiimkXR5', '$2y$13$7fRiqxCdHSMDqR.gC3vXkuoOcZNDDVq8uyHA8h.eGb6sWj/zsgtC6', 'H3bBH8qAupFa7Y4f8xIOnh7LSM3ldm8k_1643315364', 'egrizard20@msn.com', 9, 1643315364, 1643315364, 'PV_yQFPGz_YQnVDapflCYnnojd93xNbP_1643315364'),
(75, 'sshackle21', 'j8vaMGcE_P1dXn_GJyhftBxHT2_QyKE4', '$2y$13$gOyuXanGuqQtDW5SZT/vOekBz9tI1q2hm4GoMpnGxqxs4nLHp40We', 'ixzn_Ym7Giio7pDoh3yJwINGIffsgL-v_1643315364', 'sshackle21@japanpost.jp', 9, 1643315364, 1643315364, 'ExxPIXWCAp48yqGs6amhu4KnZsRMKWUM_1643315364'),
(76, 'gkennedy22', 'WFPibYUDjieCtYqEdUm1yTAbz6K6NdEz', '$2y$13$PixsjEozhr.HUzOfBg1Kgu55Sjd5loOQjlIAWuR2PwXN9XxNKiEt.', 'z7VTHMxWW027m8_N8X-_MXAklDHj4Pl7_1643315365', 'gkennedy22@deviantart.com', 9, 1643315365, 1643315365, 'Psd7LnY09Gxns1xgIeLGnN0mMpcax3Ml_1643315365'),
(77, 'rsaffell23', 'bP6FB8uYMY98cdCuu6jLOHHj4zkoZqWq', '$2y$13$ZORYfRpcubFN1QHgiw.dzuFKutjL404LEQjUtRNGZfv7SKbZvRRle', 'SCdYF44nY7Cl9-UbCW3Ii4hk7xCH4jte_1643315365', 'rsaffell23@ed.gov', 9, 1643315365, 1643315365, 'btFvqn73kh8He21zfWHdokbSJ80NdaVm_1643315365'),
(78, 'vjimeno24', 'zuAq_zYkZUM-OzM6K2CsE63mS8xgQtSe', '$2y$13$aW7Uadugr7MEljWy7nTB6e7ttoyD.D5K9ws6MvdibqYqogm2fT.fm', 'Nv8BHMuFruGuOlAz7HeDAyJky1mjkaK2_1643315366', 'vjimeno24@ow.ly', 9, 1643315366, 1643315366, 'dYKHuOCLp5h06bbaUkWzYfSRxG4m2c7a_1643315366'),
(79, 'dnesbit25', 'LqcVrWMNveFuerJc-dZF1BsaL5xbcP8t', '$2y$13$VI8WEqRWsy0IyuqVXgxPpu.KcKB9sDC9WgLECQwlwzHD5GQYS0sWu', 'V8e7mv77KI6-fxzAacYf7VsoDiCpwA0k_1643315366', 'dnesbit25@indiatimes.com', 9, 1643315366, 1643315366, 'tu1SF5pv_fi-eeakg2x--WxufZM3T4A-_1643315366'),
(80, 'hscopham26', 'ReTasJwMF7x22DAWwpX6eWGt5OQJwMEU', '$2y$13$EQSsa5HBfw9rd0dNs1fnwO78Ngbh4sjfAkmnYdVsgbZ/o43Qi3BYu', 'iOI7SSzewoiSW4tXs9YUbQCD-02ZKZPy_1643315366', 'hscopham26@fc2.com', 9, 1643315366, 1643315366, '_vxk44m1VEsZ6k2GcbaJX_FRzPUuHqBr_1643315366'),
(81, 'ihayen28', 'PKpVXF1bmgm3e1cKwvdKU3EyhvSL9i67', '$2y$13$TdvqW/WoMk3X4E7U.rt89eteEHf2/JdhB4KQNK.QSd3SUdY72r07K', 'UY9FRL-n2x1I-Qoa4tCdlU4VkqIurZ7T_1643315367', 'ihayen28@posterous.com', 9, 1643315367, 1643315367, 'US9Gc-nfdKW3d0eoXTWkhZh6n3WKYUVl_1643315367'),
(82, 'mfenny29', 'QRRnN3YwY8WqL2DKt5aK3POF6fXvDw9m', '$2y$13$MCrf3qO/EdqMtX1UpvBn5.UOiyHddxcgsg9ezp2rL0KrVjzTVN6rm', 'FYB3q_AUKS0QohsbVLBtXlbiTJ27Q5eB_1643315367', 'mfenny29@microsoft.com', 9, 1643315367, 1643315367, '0ybqvtV6LQxEU91ql4JYB_mSlbpyDpAL_1643315367'),
(83, 'jarnolds2a', '1CfJyeUIRa33vrCnWU_tkkQ8X09Pn1FN', '$2y$13$Z.qqmxW/3UiyMNS8mjFSIuISM90BPPHqtfP8AgnWvg6i8grAOytru', 'HinxZ9l8XI8bOM6JRoM2g8JnDRfquSgu_1643315368', 'jarnolds2a@liveinternet.ru', 9, 1643315368, 1643315368, '_xJ_4e5rAzBhDJBYyUuSTVRm2mQWxO0r_1643315368'),
(84, 'tsmolan2b', 'tWoqZDrDoLL_EymmXgDNvv9yfA-E-kY9', '$2y$13$sPOTQJp/VFzVeO/f5mVscet5eHtxOLuNgTfySu0eZhFoX/UsiuU0i', '1Sj0ybgaxKwIKAXhFLvqb741fJfhgLAr_1643315368', 'tsmolan2b@imgur.com', 9, 1643315368, 1643315368, '2oqRAGR0JBr4Sgq6FbAvPso-Wd7jBS4l_1643315368'),
(85, 'kpike2c', 'QVuIs5lNGBf8ed3Ne0bDSOVsIGe4V0Ns', '$2y$13$tUDT9InFdRs8ZGO4GY.YgulXlL6sDCoa4oiHymQTVwyTzEmYYjcwe', 'bggEGh8tLNRYk8UPL0WSpVpYuLt-pcn9_1643315369', 'kpike2c@wiley.com', 9, 1643315369, 1643315369, 'tzFckOUsBJ1b_pM_FV8G46gYC77xna1P_1643315369'),
(86, 'clukes2d', '360rHmCVP8uGY8xXbSv8eHrxGaMt_SI5', '$2y$13$OyvCSfSRQ9JBLMYxLiJ6rOFsgBflyvm85Eb7wgR28Bk7hX9bvLt7O', 'H9dxfHDt2cwQE8GgcEH0t_75OCmBMVQI_1643315369', 'clukes2d@rambler.ru', 9, 1643315369, 1643315369, 'bq7VIi7Rjz9-9ZB6pCSHGXsfzxKo_GpU_1643315369'),
(87, 'atourle2e', 'vCLNJkviRw1fu_Gd3vvJaxW5LCqy5q0s', '$2y$13$SW8k8JaZaAcZFmxYLzas5ujAsnL/DGGEixV33R/ZFIRYj6s4v.akO', 'F1avipmgqDz98UfyginuL2AhqIhNx79n_1643315369', 'atourle2e@last.fm', 9, 1643315369, 1643315369, 'jgekIKMRlqsGFSTh9Dgg387NO5gS48PQ_1643315369'),
(88, 'adelgaty2f', 'BMmWFK-PsiW7MSZIZy2--PbXxf-KFmqX', '$2y$13$lEinH.8sJeQNt0qbjZgQFOd0ZD9lhv979kdl92XJj58Y596l5iae6', 'qOeCD6TZ7m7KF3IzLazt6ldUoJwSVANL_1643315370', 'adelgaty2f@loc.gov', 9, 1643315370, 1643315370, '7sgyXyTJtQ4bYlM3lk4oYCpueBi8UwEr_1643315370'),
(89, 'ksegoe2g', 'w4gU-S4Cx2nCf4lf5zkiZToJNKHOXi6S', '$2y$13$7fXvuhwnJz8OCDBSqdCIXeOz4J6hhQzIfUUZhD.lxwXiQBJY6Gpni', 'XU16YwhS7c2mdXkfmraBAdPHHAP8xXUE_1643315370', 'ksegoe2g@ihg.com', 9, 1643315370, 1643315370, 'Mbuxu6syWROTcXF3jaZfaZ5bSYyF98H5_1643315370'),
(90, 'hcollings2h', 'Kft1pUcyF3i2cLkdMH_w-9mrZ3PTmVfA', '$2y$13$2j7jdsoT8aOsiYuHykq6QOCF.8nt/47HMIe/TBjrfOC4aijWNnR12', 't4FBD5SUAf2HE3AVJII-j1lqsbK7AoVr_1643315371', 'hcollings2h@usnews.com', 9, 1643315371, 1643315371, 'KRpMBUXxZRU9GoJbQ7x_uKKmiIDyx-O0_1643315371'),
(91, 'fortas2i', 'J5jDvy_JYnGiqGnztZe9UFD1JFPt7_OZ', '$2y$13$yUDyzEEmUSiLrrcsOZelfufdLtzel/i.p.MMaIpTzBUGT7zXRq.tG', 'w-RRU2ESzpzQShmqguce-N8AvEQEr47G_1643315371', 'fortas2i@newyorker.com', 9, 1643315371, 1643315371, 'bOAydh0avKMSEU_czZt9vib_0Ny84iEo_1643315371'),
(92, 'elatty2j', '-CtZw9OniinzCmMUeG-1bC0wsjEewmqN', '$2y$13$ZzXtuLAMRPQGU2C6xatV1OUXRnME/2HZYUgZY3juldNm.MzyHbecS', 'tBkcbLmPdxCmqh9kKOS4MKeP6-MtSYYy_1643315372', 'elatty2j@illinois.edu', 9, 1643315372, 1643315372, 'GtRcQTB-2gGbj5c7sVjebc76cFc248ha_1643315372'),
(93, 'eraynton2k', 'ukvHo4S7m1V9E7xBvkWRG9NE9f67Nofv', '$2y$13$hQUoXVz5szENE9zrFBLFdebd1S6lFlWRUSWacyIQHR/9wd.eL3nI.', 'DSKQqjqnzSwrTANSPX594shfgIpqurVH_1643315372', 'eraynton2k@usgs.gov', 9, 1643315372, 1643315372, 'Rh4gBw7fmnbHDu1QLuYspPHfLumaQj4k_1643315372'),
(94, 'bdeacon2l', '1Fim3LFkxFvKGl-O8Yf4jip_kCGBSG-_', '$2y$13$vYypa4ZXLu49yWr68P77IOjaGQ.8OlTC3gc/H.vSfpGt6RlePlJku', 'Ca2-5eLFDkwBI_ELKndCOTsRGeP9hwz5_1643315372', 'bdeacon2l@histats.com', 9, 1643315372, 1643315372, 'kMjZBdl3E6eGFfm6SKq-QZpgzULGNH7d_1643315372'),
(95, 'gcodman2m', 'BRFsobvEVrW3YISHlnSaydF68nVxExQ4', '$2y$13$GkNwp5QGPRF6hOlRIQBjIekdhTBzKohSQJ8wSESvZmkmLm3HjkRGC', '5BNP1dtIMoDkSzx0RKTqtoH0vLVgUXJS_1643315373', 'gcodman2m@bizjournals.com', 9, 1643315373, 1643315373, '2mgp56_jSW3o_9BgbL7-tN9iSm-hyWyR_1643315373'),
(96, 'sbagwell2n', 'MySuGC29UjeVSAIpvkrgTrqDwR0u58f3', '$2y$13$LgO1/q7xupN0Wi3AvARZzuIvQKJl0FetF6olCSLmep3X0LJrHNJO.', 'R7icxtoBdx_V0rVDlvds5se4keKsO1MM_1643315373', 'sbagwell2n@bluehost.com', 9, 1643315373, 1643315373, 'ih39rd0tMPuEvcOctgPMU-Q02_N2pn6y_1643315373'),
(97, 'kpedley2o', '42bRGtRa02eC4yQPmUuOjuzC7XQdHv9V', '$2y$13$nzh9xvFGvEHqmIVyAeq2iOtVefriCW3JZnlLByv5Ts25ZLllOvZFC', 'hzxu3zkmUxv4PHw_ImZBcKwPHLJYfofc_1643315374', 'kpedley2o@answers.com', 9, 1643315374, 1643315374, 'ty-JEpAJb_Gc_JpqC7b04njsQV6xxZf3_1643315374'),
(98, 'tportugal2p', 'P0_SYqvM0Q2eaKleGcwsE3osd_kWEGvk', '$2y$13$NWG1lshNHgKlDcTdxlBUgOo3OMZTwtnDPgpfsjL0byvFwtDq4XbCi', 'WJ6D1ZFuAJch6cdFTWbu3oZ6Lr0EfJ6B_1643315374', 'tportugal2p@taobao.com', 9, 1643315374, 1643315374, 'JKwSsdwu1_Wriq5ZxeFQBr0jJLV4gRAI_1643315374'),
(99, 'ahalsall2q', 'szGTfp2GbjRUnP77j4h4PhrD4l5pvP00', '$2y$13$w3wjh0KXbg/izhIPoopg.O0rWMgKdolfp3PPvQ75xfgj7pxCdzxna', 'CicAF6Yl7HabM-c5vYdPFR0n1_00wm52_1643315375', 'ahalsall2q@cmu.edu', 9, 1643315375, 1643315375, 'eAGdN0POTyaEV5jvscJ72RCD9BEMRvBi_1643315375'),
(100, 'dgallimore2r', 'p1Q0pUpy-5BJzyUv4tvqXedxipowdx-2', '$2y$13$ZTOOTHem/74Rd6kmINEyveuOgLsW2mPFnbtJ70HwJkHbmV3FopQCi', '2i7mYHOc10IrQE1r4Sr0_GBm8JYjY5rp_1643315375', 'dgallimore2r@youtube.com', 9, 1643315375, 1643315375, 'KySONww5kP0-QhMl-9KeN9WHAA9dyPlA_1643315375');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk-cliente-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `fk-orcamento-cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

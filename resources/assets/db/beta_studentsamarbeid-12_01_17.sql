-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2017 at 03:35 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beta_studentsamarbeid`
--

-- --------------------------------------------------------

--
-- Table structure for table `bekreft`
--

CREATE TABLE `bekreft` (
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bruker_id` int(11) DEFAULT NULL,
  `bruker_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harsett`
--

CREATE TABLE `harsett` (
  `samarbeid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meldinger`
--

CREATE TABLE `meldinger` (
  `id` int(10) UNSIGNED NOT NULL,
  `fra_bruker_id` int(11) DEFAULT NULL,
  `til_bruker_id` int(11) DEFAULT NULL,
  `tittel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `innhold` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sett_av` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meldinger_svar`
--

CREATE TABLE `meldinger_svar` (
  `svar_id` int(10) UNSIGNED NOT NULL,
  `melding_id` int(11) DEFAULT NULL,
  `forfatter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `innhold` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sett_av` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2017_01_05_105306_create_bekreft_table', 1),
(13, '2017_01_05_111636_create_harsett_table', 1),
(14, '2017_01_05_111739_create_meldinger_table', 1),
(15, '2017_01_05_112303_create_meldinger_svar_table', 1),
(16, '2017_01_05_112632_create_oppgaver_table', 1),
(17, '2017_01_05_120655_create_samarbeid_table', 1),
(18, '2017_01_05_121130_create_stillinger_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oppgaver`
--

CREATE TABLE `oppgaver` (
  `id` int(10) UNSIGNED NOT NULL,
  `fil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrift_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tittel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samarbeid`
--

CREATE TABLE `samarbeid` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_samarbeid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrift_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `foreleser_id` int(11) DEFAULT NULL,
  `godkjent_av_foreleser` int(11) DEFAULT NULL,
  `godkjent_av_student` int(11) DEFAULT NULL,
  `godkjent_av_bedrift` int(11) DEFAULT NULL,
  `signert_av_student` int(11) DEFAULT NULL,
  `signert_av_bedrift` int(11) DEFAULT NULL,
  `kontrakt_godkjent_av_foreleser` int(11) DEFAULT NULL,
  `kontrakt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arbeidsbesk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startdato` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stillinger`
--

CREATE TABLE `stillinger` (
  `id` int(10) UNSIGNED NOT NULL,
  `bedrift_id` int(11) DEFAULT NULL,
  `sted` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `varighet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frist` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stilling_tittel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bransje` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bruker_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` int(1) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornavn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etternavn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` int(11) DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postnr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poststed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profilbilde` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forsidebilde` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_nr` int(11) DEFAULT NULL,
  `student_campus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_cv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_attester` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_studerer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrift_navn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrift_avdeling` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrift_fagfelt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrift_ser_etter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreleser_rom_nr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nettside` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sist_aktiv` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `bruker_type`, `verified`, `token`, `fornavn`, `etternavn`, `telefon`, `adresse`, `postnr`, `poststed`, `bio`, `dob`, `profilbilde`, `forsidebilde`, `student_nr`, `student_campus`, `student_cv`, `student_attester`, `student_studerer`, `bedrift_navn`, `bedrift_avdeling`, `bedrift_fagfelt`, `bedrift_ser_etter`, `foreleser_rom_nr`, `nettside`, `facebook`, `linkedin`, `sist_aktiv`, `remember_token`, `created_at`, `updated_at`) VALUES
(0, 'admin@studentsamarbeid.no', '8f1c539b8f046853f5264ed57c431e831756b59d', 'admin', 1, NULL, 'Admin', '', NULL, NULL, NULL, NULL, NULL, NULL, 'profilbilde.jpg', NULL, 0, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-11-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 'jorgen@jorgensolli.no', '$2y$10$CgeKQte8HdFhBKsegDPmOeFsHGF5nYx/ciLGYr4tA6FkyS4R1d0NG', 'student', 1, NULL, 'Jørgen', 'Solli', 90104220, 'haukåsen 8E', '3743', 'Skien', 'Studerer informatikk i Bø. Er praktikant hos Aplia i mitt siste semester frem til mai. Da blir det fest!', '16/01/1993', 'img/profilbilder/a5eb96fc1553756b3c3a1cff0db42670.jpeg', 'img/forsidebilder/student_forsidebilde.jpg', NULL, 'bø', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'www.jorgensolli.no', 'https://www.facebook.com/jorgen.sol', 'https://www.linkedin.com/in/j%C3%B8rgen-solli-a293b8b5?trk=hp-identity-name', NULL, 'InDV2JEZA3662rzKr0PYM5auyzkr8wXyjURrAG3BWY5GuQdiBMS26eomPqOf', '2017-01-06 06:21:37', '2017-01-07 19:35:39'),
(9, 'bedrift@gmail.com', '$2y$10$/nfIaz/KrV4SfIyT.Xj7ROq8MylUkFCFfgsIbiNAygCIdXBlhSL5S', 'bedrift', 1, NULL, 'Jørgen', 'Solli', 0, '', '', '', '', NULL, 'img/profilbilder/bedrift_profilbilde.png', 'img/forsidebilder/bedrift_forsidebilde.jpg', NULL, NULL, NULL, NULL, NULL, 'TestBedrift', '', NULL, 'Regnskap og Revisjon;Eiendomsmegling;Informatikk', NULL, '', '', '', NULL, NULL, '2017-01-12 07:47:43', '2017-01-12 12:31:18'),
(189, 'foreleser@hit.no', '8f1c539b8f046853f5264ed57c431e831756b59d', 'faglarer', 1, NULL, 'Test', 'Foreleser', 90104220, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/580f58b33ee76_id189IMG_0014.JPG', '', 0, 'Bø', NULL, NULL, 'Barnehagelærer', '', '', NULL, NULL, '1-131', '', '', '', '2016-12-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'sigurdssorensen@gmail.com', 'd1b1bb91a99de27cb44b35b8a9102a82979244a2', 'admin', 1, NULL, 'Sigurd', 'Sæther', 45519920, 'Bø i Telemark', '3800', 'Bøgata 44', '', '2013-01-08', 'img/profilbilder/57cff8c706228_id190BM5R1241.jpg', NULL, 0, 'Bø', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, '2016-11-04', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'bent@mtnu.no', '3d5bad2405ae7ca4e6da9830ffe01038a22c3f11', 'admin', 1, NULL, 'Bent', 'Gurholt', NULL, NULL, NULL, NULL, NULL, NULL, 'profilbilde.jpg', NULL, 0, 'Bø', NULL, NULL, NULL, 'Midt Telemark Næringsutvikling AS', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'jogex123@gmail.com', '8f1c539b8f046853f5264ed57c431e831756b59d', 'student', 1, NULL, 'Student', 'Studentum', 0, 'Bøgata', '44', '3800', '', '2013-01-08', 'img/profilbilder/580dd3307e2d5_id19414467162_1177027775692765_1602114232_o.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 141617, 'Bø', '50c14052341fbe76d2b486061c9c15d1.pdf', NULL, 'Informatikk:Campus Bø:2014:2017;Barnehagelærer:Campus Bø:2016:2019', '', '', 'Markedsføring og reklame; Markedsføring og reklame; Grafisk arbeid, design og dekorasjon; Journalistikk og media; Litteratur, kunst og illustrasjon; Musikk/lyd, foto og video; Sport og idrett; Underholdning, scene og teater; Forskningsarbeid; Universitet ', NULL, NULL, '', '', 'https://www.linkedin.com/in/magnuspw', '2016-12-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, '113852@student.hit.no', 'f864ef8cf1c75529efb75910af7f607eee73521f', 'student', 1, NULL, 'Lucille', 'Ang', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 113852, 'Porsgrunn', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, '2016-09-14', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, '141286@student.hit.no', '26dfe6910814744285faf3c54b37855a140ca40c', 'student', 1, NULL, 'Thomas Vincent', 'Saly', 47753723, 'Lektorvegen 45A', '3802', 'Bø i Telemark', '', '2013-01-08', 'img/profilbilder/580dd9c97b55d_id225Bilde_Meg.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 141286, 'Bø', 'ba4ed7ab93b3bab4105775c728fd82c4.pdf', 'b379d561fcf2761d924d5fe790d42202.pdf;b379d561fcf2761d924d5fe790d42202.pdf;', 'Internasjonal Markedsføring:Campus Bø:2014:2017', NULL, '', 'Ledelse, administrasjon og rådgivning; Logistikk, lagerarbeid og innkjøp; Markedsføring og reklame; Personal, arbeidsmiljø og rekruttering; Markedsføring og reklame; Musikk/lyd, foto og video; Underholdning, scene og teater; Logistikk, lagerarbeid og innk', NULL, NULL, '', 'https://www.facebook.com/thomas.v.saly', '', '2016-11-03', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, '141621@student.hit.no', 'a4712539a942fe91a7fb80ea393f68776944e50b', 'student', 1, NULL, 'Elise', 'Kristiansen', 94840688, 'Underhaugsveien', '2', '3800 Bø i Telemark', 'Informatikkstudent. Ferdig våren 2017. 21 år. Fokus på front-end', '2013-01-08', 'img/profilbilder/580c8f9d8c755_id24013942169_10153615168306761_2130460403_n.png', 'img/forsidebilder/student_forsidebilde.jpg', 141621, 'Bø', NULL, NULL, 'Informatikk:Campus Bø:2014:2017', NULL, '', 'Informasjons- og kommunikasjonsteknologi', NULL, NULL, '', 'https://www.facebook.com/elise.kristiansen.50', 'https://no.linkedin.com/in/elise-kristiansen-ab095496', '2016-11-03', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'lene031193@gmail.com', '668f0de3c11aaa6a386ef847210472921d0c96e9', 'student', 1, NULL, 'Lene', 'Rask Hagen', 47238419, 'Framstadvegen 39', '3800', 'Bø', '', '2013-01-08', 'img/profilbilder/57f3ad95c4589_id242selfiesmileeh.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 0, 'Bø', NULL, NULL, NULL, NULL, '', 'Ledelse, administrasjon og rådgivning; Logistikk, lagerarbeid og innkjøp; Markedsføring og reklame; Personal, arbeidsmiljø og rekruttering; Markedsføring og reklame; Reiseliv, hotell og overnatting; Grafisk arbeid, design og dekorasjon; Journalistikk og m', NULL, NULL, '', '', 'www.linkedin.com/in/lene-hagen-36a25683', '2016-10-04', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, '133134@student.hit.no', '80b67900d89d19bd11f3880144791a0362ac4a11', 'student', 1, NULL, 'Liv Karoline', 'Torp Olsen', 90521707, 'Kollskjeggveien ', '12', 'Porsgrunn', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 133134, 'Bø', NULL, NULL, 'Økonomi og Administrasjon:Campus Bø:2014:2018', NULL, '', NULL, NULL, NULL, '', 'https://www.facebook.com/livkaroline.t.olsen', 'https://www.linkedin.com/in/liv-karoline-t-olsen-8709b693?trk=nav_responsive_tab_profile_pic', '2016-10-18', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 'john.viflot@hit.no', 'c11ba5bbe7f9c9481aa38bed6cd5f51900e313c9', 'admin', 1, NULL, 'John William', 'Viflot', 91860035, '', '0', '', '', '0000-00-00', 'profilbilde.jpg', NULL, 0, NULL, NULL, NULL, '', NULL, '', '', NULL, 'K-209', '', NULL, NULL, '2016-10-18', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, '141298@student.hit.no', '93368110f60c33cd17b28ab61d282aa8f166b849', 'student', 1, NULL, 'Sigurd', 'Sæther Sørensen', 45519920, 'Bøgata 44', '3800', 'Bø i Telemark', 'Engasjert markedsføringsstudent med flere års akkumulert arbeidserfaring innen ulike felt som salgskonsulent, lag- og prosjektleder, samt styremedlem og styreleder.\r\nRelasjonorientert leder: Økte egenkapital med 195% fra fjoråret i rollen som styreleder i VIKO.\r\nRådgivende studentrepresentant i samspills-prosjekt for økt strategisk ressurstilførsel til regionens utviklingsarbeid knyttet til innovasjon- og næringsutvikling, arbeidskraft- og kompetanseutvikling.', '2013-01-08', 'img/profilbilder/58062548c6e2a_id276BM5R1241.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 141298, 'Bø', 'b98ec06b88b119d51b00b6d313ad45e5.pdf', '', 'Internasjonal Markedsføring:Campus Bø:2014:2017', NULL, '', 'Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Personal, arbeidsmiljø og rekruttering; Markedsføring og reklame', NULL, '', '', 'https://www.facebook.com/sssoeren', 'https://no.linkedin.com/in/sigurdsorensen', '2016-11-10', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, '141475@student.hit.no', '616381d6f20a54da48d8e25365954848cec12382', 'student', 1, NULL, 'Tom Nicklas Sanni', 'Iversen', 0, '', '0', '', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141475, 'Bø', NULL, NULL, NULL, NULL, '', 'Miljøvern; Forskningsarbeid', NULL, '', '', '', '', '2016-10-20', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, '122308@student.hit.no', 'f49603d931e694de45a1cdfbee99c76da3d973aa', 'student', 1, NULL, 'Kadja', 'Bless', 93409618, 'Rødsåsen, 55', '3928', 'Posrgrunn', '', '1984-05-29', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 122308, 'Porsgrunn', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-20', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, '141415@student.hit.no', 'ead9cf2824f4851bbcfe205f5f74ac07e79b544d', 'student', 1, NULL, 'Jonas ', 'Nygård', 95745944, 'Åsenvegen 1', '3825', 'Lunde', '', '1995-09-18', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141415, 'Bø', NULL, NULL, 'Økonomi og Administrasjon:Campus Bø:2014:2017', NULL, '', 'Bank, finans og forsikring; Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Økonomi, statistikk og regnskap; Markedsføring og reklame', NULL, '', '', '', '', '2016-11-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 'isaaf_10@hotmail.com', '791db35d9a75c22ba9c52bbb15f58035e31ce170', 'student', 1, NULL, 'Isaaf', 'Araji', 41238173, 'Gullbringvegen 28', '3800', 'Bø i telemark', 'Hei!\r\nMitt navn er Isaaf Araji. Jeg er 20 år og kommer fra Arendal, men studerer Turisme og ledelse på Høgskolen i Sørøst-Norge avd. Bø. Jeg er født og oppvokst i Arendal, men for litt over to år siden flyttet jeg til Bø for å starte på Høgskolen i Telemark. Jeg valgte Turisme og ledelse fordi jeg er veldig glad i å reise og fordi at jeg liker å bli kjent med nye mennesker og nye kulturer. ', '1995-12-14', 'img/profilbilder/580a050acb0d7_id28314333109_10209054342048839_732802045500173306_n.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 0, 'Bø', NULL, NULL, 'Turisme og Ledelse:Campus Bø:2014:2017', NULL, '', 'Markedsføring og reklame; Reiseliv, hotell og overnatting', NULL, '', '', 'https://www.facebook.com/fofa.araji ', '', '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, '141431@student.hit.no', '42234d22ccd7e9275aa5a00ae80fdf126e2d15a8', 'student', 1, NULL, 'Silje', 'Listaul', 95258803, 'Bergstuguvegen 43b', '3675', 'Notodden', '', '1988-07-29', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141431, 'Bø', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-11-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, '160813@student.hit.no', '580aeb220d3a56ea5e6aa53cdddae3a6cf116a5d', 'student', 1, NULL, 'Terje', 'Strand', 41651553, 'Gullbringveien 28, leil H0112', '3800', 'Bø', 'Har bachelor i idrett fra Tromsø. Har startet på master i Bø. Har spilt i eliteserien i volleyball i 5 år på Bk Tromsø. Har også god peiling på fotball, innebandy, langrenn, sving, og andre idretter', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 160813, 'Bø', NULL, NULL, NULL, NULL, '', 'Musikk/lyd, foto og video; Sport og idrett; Fritid', NULL, '', '', 'https://m.facebook.com/Strandemann?ref=bookmarks', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, '151344@student.hit.no', '15cb74335860cffe3cae1006e8f2800a26512b67', 'student', 1, NULL, 'Tore ', 'Versvik', 47626161, 'Skrivervegen ', '3946', 'Porsgrunn ', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151344, 'Bø', NULL, NULL, '', NULL, '', NULL, NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, '161082@student.hit.no', '745a4aa5d7128ba599f9e1c688a6fe7575500c42', 'student', 1, NULL, 'Shadi', 'Azari', 98660227, 'Vallemyrvegen 62 A', '3917', 'Porsgrunn', '', '1997-03-11', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 161082, 'Porsgrunn', NULL, NULL, NULL, NULL, '', 'Sosial-, omsorgs- og fritidsarbeid', NULL, NULL, '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, '150547@student.hit.no', '875a3a7eba628f407069f8e7bd5b535ff1a11111', 'student', 1, NULL, 'Malin', 'Kleppe', 0, '', '0', '', '', '1993-01-05', 'img/profilbilder/580a04bdbe727_id288Malin-vegg.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 150547, 'Porsgrunn', NULL, NULL, NULL, NULL, '', 'Markedsføring og reklame; Organisasjonsarbeid og politikk; Markedsføring og reklame; Sosial-, omsorgs- og fritidsarbeid; Barnehage, og grunnskole', NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 'helge.kaasin@hit.no', '9eea28d3dcccda035aa3db250082c5dd7db9212a', 'faglarer', 1, NULL, 'Helge', 'Kaasin', 90882350, '', '0', '', '', '0000-00-00', 'img/profilbilder/faglarer_profilbilde.png', '', 0, 'Bø', NULL, NULL, 'Internasjonal Markedsføring', NULL, '', '', NULL, '1-345', '', '', '', '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, '150702@student.hit.no', 'b63ebfe0a2f777f37d7fcfb39df85fa1a38f119c', 'student', 1, NULL, 'Serine', 'Sundgot', 47878353, 'Varpeåsen 5', '3728', 'Skien', 'Pliktoppfyllende og glad telemarksjente, med en litt unik utdanningsbakgrunn. Er nå sykepleierstudent, planlagt å være ferdig iløpet av 2018. ', '1994-02-15', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 150702, 'Porsgrunn', NULL, NULL, '', NULL, '', 'Helse- og pleiearbeid; Tekstil, kunsthåndverk og presisjonsarbeide; Sport og idrett; Universitet og høgskole', NULL, '', '', NULL, NULL, '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, '151345@student.hit.no', '4e9fc86eb8a4acd7214b276387419dc1cb19d91f', 'student', 1, NULL, 'Hamad Javed', 'Iqbal', 0, '', '0', 'Bø I Telemark', 'Mann fra Oslo som studerer Internasjonal markedsføring i Bø 2. året. Er engasjert utenom studiene med deltidsjobb og verv i studentorganisasjonen Start Telemark. Kan veldig mye som kan komme til nytte for bedrifter i næringslivet som Photoshop, After effects og Final Cut Pro.', '1995-05-21', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151345, 'Bø', NULL, NULL, '', NULL, '', 'Markedsføring og reklame; Markedsføring og reklame', NULL, '', '', '', 'https://no.linkedin.com/in/hamad-javed-iqbal-167679116', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, '141050@student.hit.no', 'efe49f1541e8aa0cb95b6c76391060ab41c504c9', 'student', 1, NULL, 'Line', 'Olsen', 95856061, 'Dronning Margretesvei 8', '3960', 'Stathelle', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141050, 'Bø', NULL, NULL, NULL, NULL, '', 'Bank, finans og forsikring; Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Markedsføring og reklame', NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, '152493@student.hit.no', 'c633f096903e15eeb2d0c67cbee578b5a0436ab3', 'student', 1, NULL, 'Pål Magnus', 'Hannisdal', 93452908, 'Vallermyrvegen 62B', '3918', 'Porsgrunn', 'Junior-Norgesmester i basketball to år på rad. Fagbrev som elektriker, totalt jobbet 4 år i bransjen. Jobbet som reiseguide i utlandet i 1 år. Studerer fortiden 2. året elkraftteknikk y-vei ved Høyskolen i Sørøst-Norge avd. Porsgrunn. Styremedlem og Stand- & Verveansvarlig i NITO Studentene. Sommeren 2016 jobbet jeg som driftsingeniør på driftssentralen til Hafslund Nett i Oslo.  ', '1992-09-14', 'img/profilbilder/580a10d42af1c_id29612626149_10153251627911050_444640237_n.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 152493, 'Porsgrunn', NULL, NULL, '', NULL, '', 'Elektro/elektronikk', NULL, '', '', NULL, NULL, '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(297, '142309@student.hit.no', '62c9d53e1bc36153943a0d7d55b7bfa4fd84b6ad', 'student', 1, NULL, 'Øystein', 'Gunneng', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142309, 'Porsgrunn', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, '141066@student.hit.no', '1e85db3f4c6e48831b09156baf06acfc1ca66b17', 'student', 1, NULL, 'Kenneth', 'Johansen', 94866535, 'Rødsåsen 12', '3928', 'Porsgrunn', '', '1994-05-30', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141066, 'Bø', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, '080270@student.hit.no', 'b40c6f5e51c4ba97b434b243aa6d257426eb863d', 'student', 1, NULL, 'Ihua', 'Peng', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 80270, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, '153095@student.hit.no', 'af8a05228d6f1c6f3808c85fefb73c2d3b7533d0', 'student', 1, NULL, 'Zaman', 'H', 98125210, 'Skistredets gaa', '3724', 'Skien', 'Jeg er en ung student som går på tredje semester på Plan & Infrastruktur. Jeg er  sosialt,lett å komme i kontakt med nye mennesker. Jeg kan takle godt både med å jobbe i grupper og gjøre selvstendige oppdrager. Jeg kan snakke farsi, Dari, norsk og engelsk. Jeg vil veldig gjerne være med å bidra by-samfunnets utvikling.   ', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 153095, 'Porsgrunn', NULL, NULL, '', NULL, '', 'Juridisk arbeid; Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning', NULL, '', '', 'Facebokk', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 'stig.andersen@hotmail.com', 'e5deacef73eaff3a5021d0b7e54695f85832e162', 'student', 1, NULL, 'Stig', 'Andersen', 95259984, 'Stathelleveien 27', '3970', 'Langesund', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 0, 'Porsgrunn', NULL, NULL, 'Barnevern i et Flerkulturelt Samfunn:Campus Porsgrunn:2016:2019', NULL, '', NULL, NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(302, 'torbjorg@stepmedia.no', '753d385a03956cf5260e6202f17f99af9e3b4aeb', 'bedrift', 1, NULL, 'Torbjørg Haugland', '', 41579515, 'Bøgata 33', '3800', 'Bø i Telemark ', 'STEP Media tilbyr tjenester innen digital markedsføring, og holder til i Bø i Telemark. Vi ønsker å være med på utviklingen i Telemark og løfte bedriftene til nye høyder.', '2013-01-08', 'img/profilbilder/bedrift_profilbilde.png', 'img/forsidebilder/bedrift_forsidebilde.jpg', 0, NULL, NULL, NULL, NULL, 'STEP Media ', '', 'Markedsføring og reklame;Markedsføring og reklame;Grafisk arbeid, design og dekorasjon;Informasjons- og kommunikasjonsteknologi', NULL, '', '', '', '', '2016-11-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(303, '121174@student.hit.no', 'fa0f22ee6035453a86a8e72354da8590175decba', 'student', 1, NULL, 'Alexander', 'Zhang Gjerseth ', 46419177, 'Asvallveien 26b', '3961', 'Stathelle', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 121174, 'Porsgrunn', NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', 'Alexanderzg', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(304, '140354@student.hit.no', 'dd5c2d38360ee41869ce92d9671b736f010ac94d', 'student', 1, NULL, 'peter alexander', 'smestad', 41305163, 'lauvrudevegen 10', '3580', 'geilo', '', '1988-07-14', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 140354, 'Porsgrunn', 'af86cf59184b117a47d17c6013bacb8b.pdf', '4333c7026767d4119d4afd5767c1d082.pdf;afb5272c1d4a18eccc34946a9c21b415.pdf;75bd01ebbaf4dd9ca912fa10bef2a818.pdf;', '', NULL, '', NULL, NULL, '', '', '', '', '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(305, '160210@student.hit.no', 'bd52e8e1685e292b1b74251da998f5f9bf3e9d41', 'student', 1, NULL, 'Tien Thanh', 'Nguyen', 94899981, 'Vallermyrvegen 50A, H0101', '3917', 'Porsgrunn', '', '2013-01-08', 'img/profilbilder/580a32fa5fa53_id305Profil2.JPG', 'img/forsidebilder/student_forsidebilde.jpg', 160210, 'Porsgrunn', '4c9827e06fa3afcd263d40cfed8ee0ec.docx', 'cb33dbf6c9dd70d7125810084400f9e3.pdf;190fb422ec12503b13a6ec43414a8a52.pdf;', '', NULL, '', 'Reiseliv, hotell og overnatting; Salg, butikk- og varehandel; Elektro/elektronikk; Musikk/lyd, foto og video; Sport og idrett', NULL, '', '', '', 'Tien Thanh Nguyen', '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(308, '152499@student.hit.no', 'a6e27ee1ab3958814b5e388890bdace705508e74', 'student', 1, NULL, 'Henrik', 'Almquist', 92080003, 'Hovet Ring 25', '3931', 'Porsgrunn', '23 år gammel mann fra Nøtterøy, Vestfold. Studerer BSc i elkraftteknikk ved HSN sin avdeling i Porsgrunn. \r\nHar i tillegg yrkesfaglig bakgrunn: Fagbrev i elektrikerfaget, eksamen i skipselektrisk modul og 18 mnd. læretid om bord i skip. \r\nEngasjert og aktiv både på skole og fritid. Interesser er trening, fotball, sport generelt og, så klart, elektronikk og alt som hører til. \r\nHar en del erfaring innenfor arbeidslivet, tross ung alder. Vært i ulike jobber ved siden av utdanning i ca. 8 år.\r\n', '2013-01-08', 'img/profilbilder/580a28f92f103_id308IMG_1678 (2).JPG', 'img/forsidebilder/student_forsidebilde.jpg', 152499, 'Porsgrunn', 'a227c477bb231a3249392c2fa53748eb.pdf', NULL, '', NULL, '', 'Elektro/elektronikk', NULL, '', '', 'https://www.facebook.com/henrik.almquist', 'https://no.linkedin.com/in/henrikalmquist', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(310, '130251@student.hit.no', '313a4710b34e0577977c22a41f1fa8eca10db62a', 'student', 1, NULL, 'Beate', 'Hansen', 45862451, 'Borgemarka 76B', '3711', 'Skien', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 130251, 'Porsgrunn', NULL, NULL, '', NULL, '', NULL, NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(312, '143417@student.hit.no', 'afd678ae68e3200b4ac6c01b3bf2cef25d9d1c0f', 'student', 1, NULL, 'Turid', 'Homme', 95883651, 'Haugbakken 12', '3830', 'Ulefoss', '', '1984-08-19', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 143417, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '', '2016-10-30', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(315, '150928@student.hit.no', '0f358a4f3b34acdaf3637b8e704636376a9df3cd', 'student', 1, NULL, 'Casper', 'Nilsen', 41603998, 'Herreveien 14A', '3962', 'Stathelle', 'Hei mitt navn er Casper Nilsen. Jeg er en ingeniørstudent ved Høyskolen i Sørøst-Norge som for øyeblikket jobber deltid ved Kiwi Grasmyr. Jeg er motivert og glad for alle mulighetene jeg har fått her på høyskolen og håper skolen kan fortsette å gjøre meg til en bedre arbeider senere i livet. Viktige verdier for meg ved siden av skolen er venner, familie og et aktivt liv.', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 150928, 'Porsgrunn', NULL, NULL, 'Informatikk og Automatisering:Campus Porsgrunn:2015:2018', NULL, '', 'Ledelse, administrasjon og rådgivning; Kundeservice og personlig tjenesteyting; Elektro/elektronikk; Sport og idrett; Kundeservice og personlig tjenesteyting; Universitet og høgskole; Informasjons- og kommunikasjonsteknologi', NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(317, '162756@student.hit.no', '981d83d4097e934eb627a8b00c6ff6fb32c61e4f', 'student', 1, NULL, 'Patrick', 'Pedersen', 46425227, 'Borgjalia 42', '3801', 'Bø i Telemark', 'Er førsteårs student på informasjonssystemer på Campus Bø. Har to fagbrev innenfor elektro. Et som tavlemontør (tavlebygger), hvor jeg stort sett jobbet med levering av inertgass-systemer og MCC-tavler (Motor Control Center). I den senere tid har jeg jobbet som elektriker med spisskompetanse innenfor å levere elektro, instrumentering og automasjons tjenester til prosessindustrien rundt om på østlandet. Mine hobbier har alltid ligget rundt data og dette er grunnen til at jeg nå har gått videre med skole for å utdype mine kunnskaper innenfor dette feltet. Drømmejobben må være å kunne kombinære den erfaring jeg har fra før med min nye kunnskap innenfor data, for å kunne levere styrings- og it-systemer til industrien.', '2013-01-08', 'img/profilbilder/580a683177093_id31713321162_10157116331980725_1588327256_o.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 162756, 'Bø', NULL, NULL, NULL, NULL, '', 'Bygg og anlegg; Elektro/elektronikk; Olje, gass og bergverk; Matproduksjon og næringsmiddelarbeid; Musikk/lyd, foto og video; Miljøvern; Informasjons- og kommunikasjonsteknologi', NULL, '', '', 'https://www.facebook.com/paett', '', '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(318, '163362@student.hit.no', '73342860e4d63f60b40b5b764de0c9931d97a706', 'student', 1, NULL, 'Darios', 'Moradi', 96959071, 'Engene 65', '3015', 'Drammen', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 163362, 'Bø', NULL, NULL, 'Informatikk:Campus Bø:2016:2018', NULL, '', 'Informasjons- og kommunikasjonsteknologi', NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(319, '152351@student.hit.no', '50afb065bc008fb8af275dc081768cdf9b332e93', 'student', 1, NULL, 'Widuramina', 'Amarasinghe', 97363378, 'Vallermyrvegen 42', '3917', 'Porsgrunn', '', '1990-02-28', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152351, 'Porsgrunn', NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', '', '2016-10-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(320, '150759@student.hit.no', '9a4f09b38499a7e35593f008e28476bd841d23c1', 'student', 1, NULL, 'Farah', 'Sharif Abdullahi', 45571532, 'hans houens gate 9', '3715', 'Skien', '  jeg er en pålitelig ung somalisk dame med godt humør som studerer i sykepleie ved HSN.\r\n Karakteriske egenskaper ved meg er ærlighet, selvstendighet, fleksible, flink til å planlegge og prioritere oppgaver.  Jeg liker utfordringer og jeg vil få mulighet til å utvikle meg videre. I tillegg til har jeg end del erfaring innen  pleie og omsorgsarbeid. ', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 150759, 'Porsgrunn', NULL, NULL, 'Sykepleie:Campus Porsgrunn:2015:2019', NULL, '', 'Helse- og pleiearbeid', NULL, NULL, '', '', '', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(323, '131868@student.hit.no', '0ffa16db39aa18af2a8e985d413df3e219dd4041', 'student', 1, NULL, 'Karoline', 'Thomassen', 92241746, 'Solvangveien 30', '3944', 'Porsgrunn', '', '1990-07-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 131868, 'Porsgrunn', NULL, NULL, 'Grunnskolelærer, 1. - 7. trinn:Campus Porsgrunn:2013:2017', NULL, '', 'Litteratur, kunst og illustrasjon; Barnehage, og grunnskole; Forskningsarbeid', NULL, '', '', NULL, NULL, '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(324, '160839@student.hit.no', 'd5731ed5987eb8681230399c9e669572768e1e40', 'student', 1, NULL, 'Tonje', 'Tollefsen', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 160839, 'Porsgrunn', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(327, '161910@student.hit.no', 'e94d69dd4393d596b31ec66ba9eff2270b7f404c', 'student', 1, NULL, 'Malen', 'Kårstad', 99610430, 'Lektorvegen73', '3800', 'Bø', 'Ei jente frå sjølvaste Bygstad i Sogn og Fjordane som studerar forurensing og miljø i Bø. Har tidlegare ein bachelor i pedagogikk frå universitetet i Bergen. Eg er utruleg glad i natur og det å vere ute i naturen, og kunne verkeleg tenkt meg ein arbeidsplass som inneber å vere mykje ute. Er glad i å oppleve nye ting, og synast det er kjekt å utfordre seg sjølv til å prøve ut det som er nytt. Synast det er kjekt å samarbeide med andre, men klarer også fint å utføre oppgåver åleine. Er veldig spent på kva studentsamarbeid.no kan få til og håper på å få nye kontakter som kan vere kjekke å ha for seinare arbeidsmoglegheiter. Kanskje eg vil finne mine framtidige arbeidskollegaer her?', '1990-01-01', 'img/profilbilder/580b4fcd3640f_id327IMG_0634.JPG', 'img/forsidebilder/student_forsidebilde.jpg', 161910, 'Bø', NULL, NULL, '', NULL, '', 'Biologi og bioteknologi; Jordbruk og dyrehold; Musikk/lyd, foto og video; Miljøvern; Barnehage, og grunnskole; Fritid', NULL, '', '', NULL, NULL, '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(328, '130969@student.hit.no', '2a9fa83a2ea8f27f281577005aa19ba4e422592b', 'student', 1, NULL, 'Lisa Marie', 'Rambekk', 93481707, 'Skogfaret 24', '3946', 'Porsgrunn', 'Studerer barnevern i et flerkulturelt samfunn i Porsgrunn (2016-2019).', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 130969, 'Porsgrunn', NULL, NULL, NULL, NULL, '', 'Juridisk arbeid; Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning', NULL, '', '', '', '', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(329, '152584@student.hit.no', 'b989c3f79370357aae5b7e07a98d0f23408f2f17', 'student', 1, NULL, 'Preben', 'Værholm', 91644188, 'Tunveien 27', '4790', 'Lillesand', '', '1990-07-20', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152584, 'Porsgrunn', NULL, NULL, 'Energy and Environmental Technology:Campus Porsgrunn:2015:2017', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-28', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(334, '160830@student.hit.no', '583807ca9c6be7c32ca57bea242fe095df89dfca', 'student', 1, NULL, 'Silje', 'Aas', 46446166, 'Lyngvegen 5B', '3930', 'Porsgrunn', '', '1995-02-11', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 160830, 'Porsgrunn', NULL, NULL, 'Byggdesign:Campus Porsgrunn:2016:2019', NULL, '', 'Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Salg, butikk- og varehandel; Arealplanlegging og arkitektur; Bygg og anlegg', NULL, '', '', NULL, NULL, '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(336, '161557@student.hit.no', 'aac062dcbb1cda06a3ff8facb7790379692a6297', 'student', 1, NULL, 'Petter', 'Mesel', 48332039, 'Valenvegen 49', '3802', 'Bø i Telemark', '', '1995-09-29', 'img/profilbilder/580bc94c4822e_id33613872996_10208526307213210_8224555222395113014_n.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 161557, 'Bø', NULL, NULL, 'Internasjonal Markedsføring:Campus Bø:2016:2019', NULL, '', 'Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Kundeservice og personlig tjenesteyting; Salg, butikk- og varehandel', NULL, '', '', NULL, NULL, '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(337, '162657@student.hit.no', 'ef4c86ffddcdbb58d9c0eedcf38a910055d743c2', 'student', 1, NULL, 'Joakim', 'Årvik', 0, '', '0', '', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 162657, 'Porsgrunn', NULL, NULL, 'Elkraftteknikk:Campus Porsgrunn:2016:2019', NULL, '', 'Elektro/elektronikk; Olje, gass og bergverk; Fiske, fangst og oppdrett; Underholdning, scene og teater; Forsvar/militær', NULL, NULL, '', '', '', '2016-10-22', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(340, '151422@student.hit.no', '728750c069285f3692b32ad48657e758c70dcb54', 'student', 1, NULL, 'Øyvind', 'Eilevstjønn', 94186487, '', '3804', 'BØ', 'Lever for å lære. Liker utfordringer som krever litt innsats og som gjør at man må vri hode litt. Har god arbeidsmoral og liker nye mennesker. Kan være sta og litt påståelig. Opptatt av å gjøre en god jobb.', '1990-06-12', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151422, 'Bø', NULL, NULL, '', NULL, '', 'Bank, finans og forsikring; Juridisk arbeid; Ledelse, administrasjon og rådgivning; Økonomi, statistikk og regnskap; Personal, arbeidsmiljø og rekruttering; Musikk/lyd, foto og video; Religiøst arbeid', NULL, '', '', NULL, NULL, '2016-10-23', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(341, '161249@student.hit.no', '23370232d63475485132fa6389d22dd5956c3622', 'student', 1, NULL, 'Marianne', 'Haave', 95731127, 'Sætrealleen 19', '3678', 'Notodden', '', '1996-09-01', 'img/profilbilder/580c8f4cec430_id341946674_10151652116344539_1018708440_n.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 161249, 'Bø', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-23', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(342, '140588@student.hit.no', '291224e5b41258ca71a3cb4ccf672349f414d859', 'student', 1, NULL, 'Johannes', 'Ystad', 45475889, 'Kjølnesjordet 23', '3912', 'Porsgrunn', 'Stunderer maskinteksnisk design (maskiningeniør) ved høgkolen i Sørøst-Norge. Er en positiv, lojal og arbeidsom gutt med et øye for detaljer.', '1993-12-27', 'img/profilbilder/580c92d2b8b4f_id342IMG_1683_red_2.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 140588, 'Porsgrunn', NULL, NULL, 'Maskinteknisk Design:Campus Porsgrunn:2014:2017', NULL, '', 'Maskinteknikk og mekanikk; Skogbruk, gartnerarbeide og hagebruk; Musikk/lyd, foto og video; Miljøvern', NULL, '', '', NULL, NULL, '2016-10-23', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(343, '112801@student.hit.no', '013d37d5face84fd6dfa1680af374d02dc7b45a6', 'student', 1, NULL, 'Kim Hieu Thi', 'Nguyen', 0, '', '0', '', '', '1989-11-20', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 112801, 'Bø', NULL, NULL, 'Informatikk:Campus Bø:2014:2015', NULL, '', NULL, NULL, '', '', '', '', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(345, '150919@student.hit.no', '646efd4972787201d6830df0d134b434f39e57fd', 'student', 1, NULL, 'Nina', 'Helland', 91117775, 'Luksefjellvegen 218', '3717', 'SKIEN', '', '2013-01-08', 'img/profilbilder/580e3747a3869_id345FB_IMG_1477326838152.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 150919, 'Porsgrunn', NULL, NULL, 'Barnevern i et Flerkulturelt Samfunn:Campus Porsgrunn:2015:2018', NULL, '', 'Sosial-, omsorgs- og fritidsarbeid', NULL, '', '', '', '', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(347, '150930@student.hit.no', 'e2a23da2dd489c1b258a9f8b01006b775d4bd9ff', 'student', 1, NULL, 'Eleonora', 'Ntreska', 45031246, 'Rønningjordet 6', '3718', 'SKIEN', '', '1996-06-28', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 150930, 'Porsgrunn', NULL, NULL, 'Informatikk og Automatisering:Campus Porsgrunn:2015:2018', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(348, '142355@student.hit.no', '40b9d4d71e1f4236abe908f88238489a026f37d2', 'student', 1, NULL, 'Jon Arne', 'Karlsen', 46631434, 'Skipperveien 12', '3965', 'HERRE', '', '0000-00-00', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142355, 'Porsgrunn', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(349, '162570@student.hit.no', 'fe783e58fb4cb4fcccab5d446305300f8b19744c', 'student', 1, NULL, 'Dag', 'Kalseth', 90600596, 'Sandtraåsen 7', '3280', 'Tjodalyng', 'Studerer bygg design', '1967-08-07', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 162570, 'Porsgrunn', NULL, NULL, 'Byggdesign:Campus Porsgrunn:2016:2019', NULL, '', 'Bygg og anlegg', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, '150894@student.hit.no', '27b76c764bb7ec62153f8964fc7c5071fb670e53', 'student', 1, NULL, 'Susanne', 'Oldervik', 95778369, 'Storvegen 55', '3919', 'Porsgrunn', 'Mitt navn er Susanne Oldervik, jeg er en dame på snart 34 år, ugift og har en datter på 10 år.\r\nFor tiden er jeg student ved høyskolen i Telemark hvor jeg er på mitt andre år i bachelor flerkulturelt barnevern. \r\nVed siden av studiene er jeg vikar hos Aleris Ungplan, her jobbet jeg 3 år som 100% miljøarbeider og de to siste årene som tilkallingsvikar grunnet studiet. Jobber i tillegg i stamina Grenland hvor jeg er gruppeinstruktør.                                                                                \r\n\r\nHva er mine fritidsinteresser? \r\nVi er mye ute i skog og mark, og tilbringer gjerne en helg i ett telt. Om muligheten byr seg reiser jeg gjerne til ett annet land for å bli kulturelt inspirert. \r\n\r\nMin bakgrunn og mine erfaringer utdypes ved henvedelse. \r\n\r\n\r\n', '1982-11-09', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 150894, 'Porsgrunn', 'a47924a759b5ccf22b957801dfe4d9fe.docx', NULL, 'Barnevern i et Flerkulturelt Samfunn:Campus Porsgrunn:2015:2018', NULL, '', 'Sosial-, omsorgs- og fritidsarbeid', NULL, '', '', '', '', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(354, '152290@student.hit.no', '0c49af511350c0c4a35c397135ac28c3865bdde2', 'student', 1, NULL, 'Petter', 'Stavnem', 98225006, 'Gulsetkåsa 8', '3743', 'Skien', '', '2013-01-08', 'img/profilbilder/580dbeab19f60_id35411d02e3.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 152290, 'Bø', '9eea40e4b1f23d3f323c5b2569127ccc.pdf', NULL, 'Internasjonal Markedsføring:Campus Bø:2016:2019', NULL, '', NULL, NULL, '', '', '', 'https://no.linkedin.com/in/petterstavnem', '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(355, '152268@student.hit.no', '2394dafeff19456f7dadec1a364a892b81651f84', 'student', 1, NULL, 'Erine Margrethe', 'Solberg', 90790086, 'Vattenbergvegen 2', '3717', 'Skien', 'Studerer Innovasjon og Entreprenørskap. Vil se vekst og utvikling i Grenlandsregionen. ', '1992-05-11', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152268, 'Bø', NULL, NULL, 'Innovasjon og Entreprenørskap:Campus Bø:2015:2018', NULL, '', 'Ledelse, administrasjon og rådgivning; Organisasjonsarbeid og politikk', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(356, '140821@student.hit.no', 'a9eec567ce276dc7a4d9e351fb4b2c895c07e2eb', 'student', 1, NULL, 'Marthine Veronica', 'Ackles', 47216949, 'Quinsgaards gate 11', '3060', 'Stathelle', '', '1994-07-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 140821, 'Porsgrunn', NULL, NULL, 'Barnevern i et Flerkulturelt Samfunn:Campus Porsgrunn:2014:2017', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(358, '152456@student.hit.no', 'e5d5b30b4aebe241de39a4637dc6cff4ac09af10', 'student', 1, NULL, 'Stian', 'Ohm Sørensen', 93877470, '', '3924', '', '', '1991-05-31', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152456, 'Porsgrunn', NULL, NULL, 'Maskinteknisk Design:Campus Porsgrunn:2015:2018', NULL, '', 'Maskinteknikk og mekanikk', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(359, '142770@student.hit.no', '7adfcb59541f29accc6a6352ddc0f04065ea1945', 'student', 1, NULL, 'Kateryna', 'Baranovska', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142770, 'Porsgrunn', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(360, '152577@student.hit.no', '345d21049dda12b099e7af07979e4fd94b1f8eb5', 'student', 1, NULL, 'Nora', 'Løvaasen', 48099858, 'Trollvegen 35B', '3924', 'Porsgrunn', '', '1992-02-23', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152577, 'Porsgrunn', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(361, '131035@student.hit.no', '6e239faba73f3ac6efcdc5c02c8e7e4827a905e1', 'student', 1, NULL, 'Steinar', 'Vikholt', 0, '', '0', '', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 131035, 'Porsgrunn', NULL, NULL, 'Vernepleie:Campus Porsgrunn:2013:2016', NULL, '', NULL, NULL, NULL, '', '', '', '2016-10-24', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(363, '132370@student.hit.no', '73ed6d44db4bcda6b5abf88b5e09973c833e33c3', 'student', 1, NULL, 'Aleks', 'Sigal', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 132370, 'Porsgrunn', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(364, '152354@student.hit.no', '6012354611483f54255ee55a71025c51318e01c9', 'student', 1, NULL, 'Ramesh', 'Timsina', 46584820, 'Kjolnesjordet 08, H0101', '3912', '', 'Student ~ Second Year ~ Process Technology', '2013-01-08', 'img/profilbilder/580efb1c9d08a_id3641413554577201.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 152354, 'Porsgrunn', '006a2c9f31a7ddaa5b65b4981e3ae4b4.docx', '45644dca873ed89d3a10b1b3740b064a.pdf;93cf2e10513f0db6fec1c98bb2319f8c.pdf;3363266d7c816efff52aff3f50c16f9f.pdf;56647169ada3088b5558b1f08e9bf237.pdf;', 'Process Technology:Campus Porsgrunn:2015:2017', NULL, '', 'Maskinteknikk og mekanikk; Olje, gass og bergverk; Universitet og høgskole', NULL, '', '', '', '', '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(366, '160025@student.hit.no', 'c2258fed3227e51274a726e62fb3720f076760f4', 'student', 1, NULL, 'Elin Aleksandra', 'Ringdal', 95892411, 'Raveien 219A', '3184', 'Borre', 'Jeg studerer ingeniørstudiet Produktdesign ved HSN Vestfold. Jeg brenner for miljø og bærekraft, og tar av den grunn aktuelle valgfag ved campus Bø. Skoleåret 2017/18 er jeg på utkikk etter samarbeid med en ingeniørbedrift, både bacheloroppgave samt 50% stilling.', '2013-01-08', 'img/profilbilder/580f1a0a950cd_id366AAEAAQAAAAAAAAaDAAAAJDJjZmM5MzQ5LTBkNDgtNDgzOC04MjE4LWM4ZTU2ODVjN2MyMA.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 160025, 'Bø', '12012dbb097778d72034b835fc4fe027.pdf', NULL, 'Forurensing og Miljø:Campus Bø:2016:2018', NULL, '', 'Maskinteknikk og mekanikk', NULL, '', '', 'https://www.facebook.com/elin.ringdal', 'https://no.linkedin.com/in/elin-aleksandra-ringdal-9083267b', '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(367, '142840@student.hit.no', 'dc44fcae68a5ce9b36b81bb894c0d02edfa7cfa7', 'student', 1, NULL, 'Håkon', 'Mølstre', 98827697, 'Valenvegen 49', '3802', 'BØ I TELEMARK', '', '1991-06-30', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142840, 'Bø', NULL, NULL, 'Informatikk:Campus Bø:2014:2017', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(369, '142227@student.hit.no', 'aacf7584b7bbc8615fb4e707299f07ed20299f09', 'student', 1, NULL, 'Morten', 'Thomsen', 92633393, 'Rådhusgata 8', '3915', 'Porsgrunn', '34 år gammel. Jeg har svennebrev som tømrer og har utdannet meg ved Telemark tekniske fagskole som også gav meg de teoretiske fagene for Mesterbrevet. Er snart ferdig med bachelor som bygningsingeniør med fordypning i plan og infrastruktur med hovedvekt på veg- og jernbanebygging og VA. ', '1982-04-12', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142227, 'Porsgrunn', NULL, NULL, 'Plan og Infrastruktur:Campus Porsgrunn:2014:2017', NULL, '', 'Ledelse, administrasjon og rådgivning; Arealplanlegging og arkitektur; Bygg og anlegg; Tog- og sporvogntrafikk; Vegtrafikk', NULL, '', '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(371, '141488@student.hit.no', '2c4239805ae6b901a8e08532187e6d625bd0ee4a', 'student', 1, NULL, 'Bård Andre', 'Blom', 47820640, 'Parkvegen 8a', '3716', 'Skien', '', '1994-11-27', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141488, 'Bø', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(372, '160384@student.hit.no', 'e9c9fa2a3eb7feeb63758e75ee0b8fe385c7d28b', 'student', 1, NULL, 'Tone Lise ', 'Bjørklund Hanssen', 97573259, 'Gullbringvegen 28, 302. ', '3800', 'Bø i Telemark', '', '1994-06-16', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 160384, 'Bø', NULL, NULL, 'Økonomi og Administrasjon:Campus Bø:2016:2017', NULL, '', 'Bank, finans og forsikring; Ledelse, administrasjon og rådgivning; Økonomi, statistikk og regnskap', NULL, '', '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(373, '131818@student.hit.no', '613873eb4aca6fb092e328bfb3de854be7a6ae10', 'student', 1, NULL, 'Marte', 'Henriksen Bollum', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 131818, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(377, '120400@student.hit.no', '8f1c539b8f046853f5264ed57c431e831756b59d', 'student', 1, NULL, 'Jørgen', 'Solli', 90104220, 'Oterholdtvegen 35', '3802', 'Bø i Telemark', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 120400, 'Bø', '', NULL, 'Barnehagelærer:Campus Bø:2016:2005', NULL, '', NULL, NULL, '', '', '', '', '2016-12-21', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(378, '151469@student.hit.no', 'f303df8e0499d4719555bae88edbefcbe965ac1f', 'student', 1, NULL, 'Ellen', 'Selander', 47631206, 'Tangarlia 25', '3731', 'Skien', '', '1995-02-16', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151469, 'Bø', NULL, NULL, 'Økonomi og Administrasjon:Campus Bø:2015:2018', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(379, '161468@student.hit.no', '166658716ad35decb2d61fdce73fd02f3411400a', 'student', 1, NULL, 'Lisa', 'Sjue', 45435423, 'Hulebakkroken 25', '3090', 'Hof', '', '1994-01-10', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 161468, 'Bø', NULL, NULL, 'Kulturledelse:Campus Bø:2016:2019', NULL, '', 'Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Personal, arbeidsmiljø og rekruttering; Reiseliv, hotell og overnatting; Musikk/lyd, foto og video; Sport og idrett', NULL, '', '', NULL, NULL, '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(380, '142095@student.hit.no', '04b010572a8187664b37faad00aff37c76769121', 'student', 1, NULL, 'Johanne Birgitte', 'Møller', 92694515, 'Gunnigata 14', '3936', 'Porsgrunn', '', '1984-09-13', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142095, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', '', '2016-10-25', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(381, '161682@student.hit.no', '23836c1f1502901e05e943c89dd1194b8ae7296a', 'student', 1, NULL, 'Oscar', 'Aamoth', 47239930, 'Eidsbergveien 161', '1890', 'Rakkestad', 'Student på Høyskolen i sør-øst Norge, campus Bø. Studerer Økonomi og administrasjon, og leier leilighet her i bø. ', '1997-04-07', 'img/profilbilder/580fd649a2b6c_id381fullsizeoutput_5.jpeg', 'img/forsidebilder/student_forsidebilde.jpg', 161682, 'Bø', NULL, NULL, 'Økonomi og Administrasjon:Campus Bø:2016:2019', NULL, '', 'Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning', NULL, '', '', '', '', '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(382, '151477@student.hit.no', '406276f969e0a908122df068bb278dd3d8a5146c', 'student', 1, NULL, 'Oda Amalie ', 'Severinsen', 98898250, 'Framstadvegen 19', '3800', 'Bø i Telemark', 'Studerer bachelor i internasjonal markedsføring ', '1996-03-26', 'img/profilbilder/580fea0e5a27c_id382profilbildeapril.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 151477, 'Bø', NULL, NULL, 'Internasjonal Markedsføring:Campus Bø:2015:2018', NULL, '', 'Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Organisasjonsarbeid og politikk', NULL, '', '', NULL, NULL, '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` (`id`, `email`, `password`, `bruker_type`, `verified`, `token`, `fornavn`, `etternavn`, `telefon`, `adresse`, `postnr`, `poststed`, `bio`, `dob`, `profilbilde`, `forsidebilde`, `student_nr`, `student_campus`, `student_cv`, `student_attester`, `student_studerer`, `bedrift_navn`, `bedrift_avdeling`, `bedrift_fagfelt`, `bedrift_ser_etter`, `foreleser_rom_nr`, `nettside`, `facebook`, `linkedin`, `sist_aktiv`, `remember_token`, `created_at`, `updated_at`) VALUES
(385, 'torstein.haugland@porsgrunn.kommune.no', '017e0dadac244cdad71c4f35ac7b3d0b4d0427fd', 'bedrift', 1, NULL, '', '', 40478404, 'Storgt. 153', '3901', 'Porsgrunn', 'Kommunen har oppgaver knyttet til tjenesteyting innenfor bl.a. (1) helse, velferd og omsorg, (2) barnehage og skole samt (3) tekniske tjenester/kultur. Dessuten har kommunen en rolle som samfunnsutvikler, lokaldemokratisk arena og myndighetsutøver. I Rådmannens stab jobber vi med eksternt samarbeid, politiske saker og saker som går på tvers av grensene mellom virksomheter og kommunalsjefområder.', NULL, 'img/profilbilder/bedrift_profilbilde.png', 'img/forsidebilder/bedrift_forsidebilde.jpg', 0, NULL, NULL, NULL, '', 'Porsgrunn kommune Rådmannens stab', '', '', NULL, '', '', NULL, NULL, '2016-11-03', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(386, '161469@student.hit.no', '4401d2b00b21c759e629d70a287c350246fea0af', 'student', 1, NULL, 'Stine', 'Bakke', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 161469, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(387, '141168@student.hit.no', '0381ccec7d2bdc02f9108dc0a10e924c6a8ec5a9', 'student', 1, NULL, 'Morten', 'Olsen', 40042106, 'Gautesvei 9', '3731', 'Skien', 'Jeg har jobbet i over 25 år før jeg bestemte meg for å studere informatikk ved Høyskolen i Bø. De tre siste årene har jeg suksessfylt kombinert full jobb med studier og ligger i rute til å ta en bachelor  i informatikk på normert tid. Sivilstatusen er gift med to barn. Tidligere trente jeg mye, men det måtte jeg gi opp pga studiene', '1973-01-28', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141168, 'Bø', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(389, '141430@student.hit.no', '63dc4033488a90a869ad85bc5658a43e7d013382', 'student', 1, NULL, 'Marianne', 'Paulsen', 99430220, 'Elsetvegen 297', '3731', 'Skien', '', '0000-00-00', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141430, 'Bø', NULL, NULL, 'Innovasjon og Entreprenørskap:Campus Bø:2015:2018;Internasjonal Markedsføring:Campus Bø:2016:2018', NULL, '', 'Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Personal, arbeidsmiljø og rekruttering; Kundeservice og personlig tjenesteyting; Markedsføring og reklame', NULL, '', '', NULL, NULL, '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(392, '131498@student.hit.no', '58ae2490e2f15babf980cf236b9d37dc91a2d76d', 'student', 1, NULL, 'Martin', 'Roligheten', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 131498, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(393, 'asbjorn.nygard@hit.no', 'df167cbfa7da306cd531ece095ccf2dcd35ad002', 'faglarer', 1, NULL, 'Asbjørn', 'Nygård', 95201770, '', '0', '', '', '0000-00-00', 'img/profilbilder/faglarer_profilbilde.png', '', 0, 'Bø', NULL, NULL, 'Økonomi og Administrasjon', NULL, '', '', NULL, '1-325', '', '', '', '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(395, '142777@student.hit.no', 'e7dfee00b158365075438ff5b4ac28000f252df9', 'student', 1, NULL, 'Ambrose', 'Ugwu', 45540502, 'Jotunveien 26, H0203', '3913', 'Porsgrunn', 'I am a master''s student of Process Technology and also a research assistant in improved oil recovery, biomass and gasification process. ', '1982-09-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142777, 'Porsgrunn', NULL, NULL, 'Process Technology:Campus Porsgrunn:2014:2016', NULL, '', 'Maskinteknikk og mekanikk', NULL, '', '', NULL, NULL, '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(396, '161723@student.hit.no', '31bdd1e00c07947c6bfe5032b01f9f65476f53eb', 'student', 1, NULL, 'Gina', 'Uthus ', 0, '', '0', '', '', '2013-01-08', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 161723, 'Bø', NULL, NULL, 'Økologi og Naturforvaltning:Campus Bø:2016:2018', NULL, '', NULL, NULL, NULL, '', '', '', '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(398, 'jorgen@landstrefftelemark.no', '408c7980183449883b6d3fb3e071111527fc0e69', 'bedrift', 1, NULL, '', '', 91006666, 'Ivan Bjørndalsgate 9', '482', 'Oslo', 'Landstreff Telemark er en festival som arrangeres siste helg i april hvert år, for russ fra hele Norge. Arrangementet foregår ved Bø Sommarland i Telemark. ', NULL, 'img/profilbilder/bedrift_profilbilde.png', 'img/forsidebilder/bedrift_forsidebilde.jpg', 0, NULL, NULL, NULL, 'Kulturledelse', 'Landstreff Telemark', '', 'Markedsføring og reklame; Grafisk arbeid, design og dekorasjon; Underholdning, scene og teater; Vakt-, sikrings- og kontrollarbeid', NULL, '', '', NULL, NULL, '2016-10-26', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(402, '161670@student.hit.no', '327b37e7a199e96c6957aa437110a09debe76af9', 'student', 1, NULL, 'Caroline', 'Ramsdal', 96231631, 'Kjeiks veg 48 ', '3676', 'Notodden', '', '1994-12-05', 'img/profilbilder/5813e07b1eac4_id402IMG_1533.JPG', 'img/forsidebilder/student_forsidebilde.jpg', 161670, 'Bø', NULL, NULL, 'Økonomi og Administrasjon:Campus Bø:2016:2019', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-29', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(405, '112031@student.hit.no', '8405e736c69c220e8cc817a3fe58c1fb685c1ea9', 'student', 1, NULL, 'Kai Arne ', 'Sætre', 0, '', '0', '', '', '1991-11-02', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 112031, 'Porsgrunn', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(406, '163322@student.hit.no', 'f2d1dc9f1aa9c656f72cc917b54ff78e6defc74a', 'student', 1, NULL, 'Isabell', 'Tangerud', 45489271, 'Vindalsåsen 35 A', '3728', 'Skien', '', '1988-10-07', 'img/profilbilder/5811b17009fb7_id40612109281_10156102533215716_8100369896248593380_n.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 163322, 'Bø', 'ab4c3a5f1158bed50616836121529845.docx', 'd025a62465da2c708deb81425910e56e.pdf;89ce3d22b43a0056f8ea204a77a39390.pdf;45b5818612a8ce7e9ec0a4aa995783a5.pdf;df8fccec3a5c1c1c308ca98a5049d299.pdf;269c46d0a00ff918155cb4627effd4be.pdf;', 'Kulturledelse:Campus Bø:2016:2019', NULL, '', 'Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning', NULL, '', '', NULL, NULL, '2016-10-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(407, 'fredrik.christoffersen@hit.no', '0a04f31a9c1a7ec640d40b138d61d355f069b98b', 'faglarer', 1, NULL, 'Fredrik', 'Christoffersen', 90208527, '', '0', '', '', '0000-00-00', 'img/profilbilder/faglarer_profilbilde.png', '', 0, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder', NULL, '', '', NULL, '1-150', '', '', '', '2016-10-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(408, '141217@student.hit.no', 'e219d1ce15575fa698ad394d3c1326fa8e0ef30c', 'student', 1, NULL, 'Kristine', 'Flote', 97152077, 'Lektorvegen 45A', '3800', 'Bø i Telemark', 'Jeg går tredje året Kulturledelse ved HSN, avd. Bø. Jeg er pliktoppfyllende og hardtarbeidende, er presis og positiv. Jeg jobber godt både alene og sammen i grupper. ', '2013-01-08', 'img/profilbilder/5811e9d35e41e_id408bilde.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 141217, 'Bø', 'c9ec226fc6b6edd3db99fb228d5cba75.docx', NULL, 'Kulturledelse:Campus Bø:2014:2017', NULL, '', 'Salg, butikk- og varehandel; Musikk/lyd, foto og video; Underholdning, scene og teater', NULL, '', '', '', 'https://no.linkedin.com/in/kristine-flote-851219112', '2016-11-04', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(409, '142750@student.hit.no', '36ae92ca23b5c0f4696e0196f29a5625e11a080c', 'student', 1, NULL, 'Vebjørn', 'Baustad', 93494761, 'Oterholtvegen 35', '3802', 'Bø', '', '1992-06-02', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142750, 'Bø', NULL, NULL, 'Informatikk:Campus Bø:2014:2017', NULL, '', 'Informasjons- og kommunikasjonsteknologi', NULL, '', '', NULL, NULL, '2016-10-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(411, '120517@student.hit.no', 'e3f92977b75e7932f5a279ad37bdfbdcb4700268', 'student', 1, NULL, 'Caroline ', 'Lyche', 99493070, 'Kullhusbakken 4B', '3912', 'PORSGRUNN ', '', '1991-03-01', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 120517, 'Porsgrunn', NULL, NULL, 'Process Technology:Campus Porsgrunn:2016:2016;Gass- og Energiteknologi:Campus Porsgrunn:2012:2017', NULL, '', NULL, NULL, NULL, '', '', '', '2016-10-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(413, '131704@student.hit.no', '014528d1d12887b57d0869aede4d788fcca833ac', 'student', 1, NULL, 'Ida Fagerholt ', 'Sandene', 41511966, 'Kleiverveien 273 ', '3268', 'Larvik ', '', '1990-08-17', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 131704, 'Bø', NULL, NULL, 'Internasjonal Markedsføring:Campus Bø:2014:2017', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-28', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(415, '131552@student.hit.no', '04f828742f17e0a89274594ec17a343d6c6face5', 'student', 1, NULL, 'Kristine', 'Svingen', 93224819, 'Gullbringvegen 28, H03011', '3800', 'Bø i Telemark', 'Jeg er en jente på 26 år, som studerer ved Bø i Telemark. I vår var jeg ferdig med bachelor i turisme og ledelse, og nå går jeg ett ekstra år slik at jeg får en dobbel bachelor, denne gangen i økonomi og administrasjon. Jeg er ambisiøs, systematisk og har stor arbeidskapasitet. ', '1990-01-23', 'img/profilbilder/5813c21b47183_id415IMG_2359.JPG', 'img/forsidebilder/student_forsidebilde.jpg', 131552, 'Bø', '2e459425cb02d1090298446a3b7c2e13.pdf', NULL, 'Turisme og Ledelse:Campus Bø:2013:2016;Økonomi og Administrasjon:Campus Bø:2016:2017', NULL, '', 'Bank, finans og forsikring; Ledelse, administrasjon og rådgivning; Økonomi, statistikk og regnskap; Reiseliv, hotell og overnatting', NULL, '', '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(417, 'Gina.winje@gmail.com', '967300d3bd2cc5db2e4f46c0c0d0001e2d1826c1', 'bedrift', 1, NULL, '', '', 91841150, 'Skiensgate 12', '3912', 'Porsgrunn', 'Litterært agentur som promoterer og selger rettigheter til å oversette og utgi norske forfattere til utenlandske forleggere. Nystartet i oktober 2016.', NULL, 'img/profilbilder/bedrift_profilbilde.png', 'img/forsidebilder/bedrift_forsidebilde.jpg', 0, NULL, NULL, NULL, 'Internasjonal Markedsføring', 'Winje Agency', '', '', NULL, '', '', NULL, NULL, '2016-10-30', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(418, '151277@student.hit.no', '5e704bfc1ea1c7898a17287667a50e13e61aec9f', 'student', 1, NULL, 'Maren Kostveit', 'Rogne', 92298929, '', '3800', 'Bø i Telemark', '', '1990-01-01', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151277, 'Bø', NULL, NULL, 'Kulturledelse:Campus Bø:2015:2018', NULL, '', 'Kontor, forvaltning og saksbehandling; Ledelse, administrasjon og rådgivning; Logistikk, lagerarbeid og innkjøp; Markedsføring og reklame; Økonomi, statistikk og regnskap; Organisasjonsarbeid og politikk; Personal, arbeidsmiljø og rekruttering; Kundeservi', NULL, '', '', NULL, NULL, '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(419, '112769@student.hit.no', 'e873ae1859f5e1f3fad1b5ef3c1fa56776d4329f', 'student', 1, NULL, 'Tina', 'Brænden Fet ', 46280225, 'Folkestadvegen 10', '3801', 'Bø i Telemark', '', '1989-05-05', 'img/profilbilder/581704cbea227_id41912273532_1678792949045268_1404976634248904128_o.jpg', 'img/forsidebilder/student_forsidebilde.jpg', 112769, 'Bø', NULL, NULL, 'Internasjonal Markedsføring:Campus Bø:2015:2017', NULL, '', 'Ledelse, administrasjon og rådgivning; Markedsføring og reklame; Personal, arbeidsmiljø og rekruttering; Markedsføring og reklame', NULL, '', '', '', '', '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(420, '151285@student.hit.no', '38139d3b2a26a86b483299c940d405af565d0fda', 'student', 1, NULL, 'Caroline', 'Hemmingby', 41495270, 'Gullbringvegen 1', '3800', 'Bø i Telemark', '', '1995-02-03', 'img/profilbilder/58171313c1e7d_id420_MG_1858 (1).jpg', 'img/forsidebilder/student_forsidebilde.jpg', 151285, 'Bø', NULL, NULL, 'Kulturledelse:Campus Bø:2015:2018', NULL, '', 'Journalistikk og media; Musikk/lyd, foto og video; Underholdning, scene og teater', NULL, NULL, '', 'https://www.facebook.com/carolinehemmingby', 'https://www.linkedin.com/in/caroline-hemmingby-701740124?trk=nav_responsive_tab_profile_pic', '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(422, '141292@student.hit.no', 'b28a8557ed713d02b2d47afc56341e9eb2d9f195', 'student', 1, NULL, 'Alexia', 'Skauen', 98420284, 'Folkestadvegen 10', '3802', 'Bø i Telemark', '', '1995-09-28', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141292, 'Bø', NULL, NULL, 'Internasjonal Markedsføring:Campus Bø:2014:2017', NULL, '', 'Markedsføring og reklame; Reiseliv, hotell og overnatting', NULL, '', '', NULL, NULL, '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(424, '151293@student.hit.no', '2c7df33d63cef1339405f519e5e98aa5eb51add7', 'student', 1, NULL, 'Elisabet', 'Aune', 94886967, 'Bøgata 76', '3800', 'Bø', '', '1996-12-20', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151293, 'Bø', NULL, NULL, '', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(425, '152263@student.hit.no', 'f359a16fdda92cc0e6cbd5a3c0c24e9e1c41413a', 'student', 1, NULL, 'Marit', 'Trøen', 48199704, 'Lektorvegen 45B', '3802', 'Bø i Telemark', '', '1996-05-11', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152263, 'Bø', NULL, NULL, 'Innovasjon og Entreprenørskap:Campus Bø:2015:2019', NULL, '', NULL, NULL, '', '', '', '', '2016-11-03', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(426, '151300@student.hit.no', '18131e159e189930cb2e37cce8fa39205a21815b', 'student', 1, NULL, 'Helene', 'Herrem', 92486807, 'Haugerudbakken 4', '3802', 'Bø i Telemark', '', '1994-09-06', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151300, 'Bø', NULL, NULL, 'Turisme og Ledelse:Campus Bø:2015:2018', NULL, '', '', NULL, '', '', NULL, NULL, '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(427, '151230@student.hit.no', '5fb4d89d1c322c63b4fbb79e0b76ffaf26a90de8', 'student', 1, NULL, 'Helgi', 'Simonsen', 98815119, 'Prestevegen 4', '3802', 'Bø', '', '1994-04-20', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151230, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder:Campus Bø:2015:2018', NULL, '', 'Reiseliv, hotell og overnatting; Restaurant og forpleining; Sosial-, omsorgs- og fritidsarbeid; Sport og idrett; Brann-, utryknings- og redningspersonell', NULL, '', '', 'https://www.facebook.com/helgi.simonsen?__nodl', '', '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(428, '142559@student.hit.no', 'b0058b9e17453dbb97af9eca7b9601fd43b1071c', 'student', 1, NULL, 'Jens Damgård ', 'Jensen', 2147483647, 'Hørtevegen', '3811', 'Bø', 'Jeg er dansk, og studerer på bacheloren, Friluftsliv Kultur og Naturveiledning i Bø. Jeg har en bachelor i Idræt og Sundhed fra Danmark, og veldig glad i at være ude i naturen og jobbe med mennesker. ', '1992-01-22', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 142559, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder:Campus Bø:2015:2018', NULL, '', 'Helse- og pleiearbeid; Sosial-, omsorgs- og fritidsarbeid; Sport og idrett; Instruktører og pedagoger; Universitet og høgskole; Videregående skole', NULL, '', '', NULL, NULL, '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(431, '152923@student.hit.no', '0505edbceb785f306c96b491785ee0a3ebf7e7a9', 'student', 1, NULL, 'Oda Eline', 'Aalstad', 41543857, 'Nedre Borgvin 76', '3802', 'Bø', '', '1991-05-10', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152923, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder:Campus Bø:2015:2018', NULL, '', NULL, NULL, '', '', '', '', '2016-10-31', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(433, '151245@student.hit.no', 'c3259ebd79b876b6438929d1f98cb85b54cfa5a7', 'student', 1, NULL, 'Rasmus Damgaard', 'Jensen', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151245, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-11-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(434, 'tpl@drangedal.kommune.no', 'e25b588c712181c011aa892decff70d8805b60b2', 'bedrift', 1, NULL, '', '', 35997000, 'Gudbrandsveien 7', '3750', 'Drangedal', 'Drangedal kommune er en brukerorientert kommune som legger vekt på å levere gode tjenester til kommunens innbyggere, blant annet ved å ta i bruk elektroniske løsninger til beste for innbyggerne. Drangedal kommune har i underkant av 4200 innbyggere og ligger i nedre Telemark. Her har man nærhet til både kysten med skjærgården, og til fjellet med Gautefall alpinsenter og biathlonanlegg for helårsdrift. Man finner et rikt kultur- og foreningsliv i bygda med den helt nye kultur- og kinosalen Tokestua. \r\n\r\nVi har fine oppvekstvilkår for barn, ny 10-årig skole i sentrum og full barnehagedekning. Det er 1 times biltur til byene i Grenland, og ferge fra Larvik nås på under 1, 5 timer. Tokevannet innbyr til rekreasjon med bading, båtliv og øyer. Stedsutviklingsprosjektet Toke Brygge skaper ny aktivitet og attraktivitet i sentrum. \r\n\r\nI Drangedal Kommune ønsker vi mangfold, og oppfordrer alle kvalifiserte til å søke uavhengig av kjønn, alder, funksjonshemming eller etnisk tilhørighet. Arbeidstakere i Drangedal Kommune tilsettes på de vilkår som til enhver tid framgår av gjeldende lover, tariffavtale, reglement og arbeidsavtaler.', '2013-01-08', 'img/profilbilder/bedrift_profilbilde.png', 'img/forsidebilder/bedrift_forsidebilde.jpg', 0, NULL, NULL, NULL, 'Geografiske Informasjonssystemer; Regnskap og Revisjon; Informasjonssystemer; Informatikk; Innovasjon og Entreprenørskap; Økonomi og Administrasjon; Master i Kroppsøving, Idrett- og Friluftsliv; Språk og Litteratur; Engelsk; Sykepleie; Barnevern i et Fler', 'Drangedal kommune', '', 'Bank, finans og forsikring;Juridisk arbeid;Kontor, forvaltning og saksbehandling;Ledelse, administrasjon og rådgivning;Økonomi, statistikk og regnskap;Organisasjonsarbeid og politikk;Personal, arbeidsmiljø og rekruttering;Helse- og pleiearbeid;Sosial-, om', NULL, '', '', 'https://www.facebook.com/Drangedal-Kommune-202048879827790/', '', '2016-11-04', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(435, '160701@student.hit.no', '83ec2b961adcac817dfcc105a729a73c72b5b43b', 'student', 1, NULL, 'Portia Joy', 'Kleiven', 45107625, 'Lisabakken 2', '4816', 'Kolbjørnsvik', 'I am interested in  marine research conservation, marine protected area establishment and management, and coastal resource management.  I have 10 years experience with conservation and research work from the Philippines (mostly on marine protected areas), and would like to continue on the same path here in Norway.', '1979-06-13', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 160701, 'Bø', NULL, NULL, 'Akvatisk Økologi:Campus Bø:2016:2017', NULL, '', 'Forskningsarbeid; Universitet og høgskole', NULL, '', '', NULL, NULL, '2016-11-01', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(437, '130296@student.hit.no', '8e812e418ea215fdcf71b5b99f3300b0ca4c585b', 'student', 1, NULL, 'Jørgen Fone ', 'Pedersen', 90050254, 'Lyngåsveien 3', '4993', 'Sundebru', 'Maskiningeniørstudent på 3. året høstsemesteret. Daglig leder i studentbedriften ecoPIPE SB.', '1992-05-27', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 130296, 'Porsgrunn', NULL, NULL, 'Maskinteknisk Design:Campus Porsgrunn:2014:2017', NULL, '', 'Jern og metall; Maskinteknikk og mekanikk', NULL, '', '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(438, '112740@student.hit.no', 'f18c41dd03d7af26e9128080aa1d33ae82f88bc2', 'student', 1, NULL, 'Michael', 'Andersson', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 112740, 'Bø', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(439, '151148@student.hit.no', 'b71483fd1124a50c7933d13160d90f87d7c8c2b3', 'student', 1, NULL, 'Thorbjørn', 'Helgesen', 41443557, 'Nedre Borgvin 76', '3802', 'Bø i Telemark', '', '1982-12-02', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 151148, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder:Campus Bø:2015:2018', NULL, '', 'Reiseliv, hotell og overnatting; Fiske, fangst og oppdrett; Sport og idrett; Fritid; Instruktører og pedagoger', NULL, '', '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(440, '141195@student.hit.no', '045a6a18b5e401e3ca966d3d91fcc47a9da3e62f', 'student', 1, NULL, 'Sunniva', 'Kråbøl', 97585881, 'Dagstjønnvegen 41', '3803', 'Bø i Telemark', '', '1993-07-04', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 141195, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder:Campus Bø:2014:2017', NULL, '', '', NULL, '', '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(441, '150550@student.hit.no', '1ba00cc7ca6a06ea30ab48f2e16af27a61cc2994', 'student', 1, NULL, 'Kim', 'Allergodt', 92899426, 'Gullbringvegen 1', '3800', 'Bø i Telemark', '2-års IT student på HSN. 6 år jobberfaring før studiene.', '1989-03-16', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 150550, 'Bø', NULL, NULL, 'Informasjonssystemer:Campus Bø:2015:2018', NULL, '', 'Informasjons- og kommunikasjonsteknologi', NULL, '', '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(443, '152837@student.hit.no', '4c542eca704d475b6ec501fdff308e32d75c6438', 'student', 1, NULL, 'Andre', 'Kristoffersen', 95818543, 'Jektveien 32', '8616', 'Mo i Rana', 'Studerer på 3. året Friluftsliv i Bø i Telemark. Driver med en del forskjellig; skikjøring, klatring, fjellsport og tradisjonelt friluftsliv. ', '1990-07-02', 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 152837, 'Bø', NULL, NULL, 'Friluftsliv, Kultur- og Naturveileder:Campus Bø:2015:2017', NULL, '', 'Instruktører og pedagoger', NULL, '', '', NULL, NULL, '2016-11-02', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(444, 'kim@nguyen.no', '8f1c539b8f046853f5264ed57c431e831756b59d', 'student', 1, NULL, 'Kim', 'Nguyen', NULL, NULL, NULL, NULL, NULL, NULL, 'img/profilbilder/student_profilbilde.png', 'img/forsidebilder/student_forsidebilde.jpg', 120401, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meldinger`
--
ALTER TABLE `meldinger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meldinger_svar`
--
ALTER TABLE `meldinger_svar`
  ADD PRIMARY KEY (`svar_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oppgaver`
--
ALTER TABLE `oppgaver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `samarbeid`
--
ALTER TABLE `samarbeid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stillinger`
--
ALTER TABLE `stillinger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meldinger`
--
ALTER TABLE `meldinger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meldinger_svar`
--
ALTER TABLE `meldinger_svar`
  MODIFY `svar_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `oppgaver`
--
ALTER TABLE `oppgaver`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `samarbeid`
--
ALTER TABLE `samarbeid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stillinger`
--
ALTER TABLE `stillinger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

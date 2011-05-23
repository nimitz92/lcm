-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2011 at 07:28 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sid` varchar(32) DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  `expiry` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sid`, `uid`, `time`, `expiry`) VALUES
('7kjjzsic5eelieta03wz8s9bjiikboot', 2, 1305896109, 1308488109),
('d56rgarzr0gva5wgp1tky30o0qni8la7', 2, 1305896275, 1308488275),
('gics7ipgwjd90c4htvjaetp66lw8bb02', 2, 1305896384, 1308488384),
('w9fjim0i4y7cxqwfoadwoxrlgyfrfez6', 2, 1305896442, 1308488442),
('04671g9crk3hwrrovc7g9pulnhppseq8', 2, 1305896556, 1308488556),
('18nkswyi2m4ilw6bxtonv8z6895s8nkv', 2, 1305896657, 1308488657),
('zm8frabgjyzclv3deooyywko9qrss7jc', 2, 1305896687, 1308488687),
('8r02tjq8do5uw659z3j3bybb4wwo53qk', 2, 1305896878, 1308488878),
('76vucbmsjh6nm515u103ud41obk1p63e', 2, 1306131836, 1308723836),
('h861mfvevipemwh9xizlrnayy6h7qmm9', 2, 1306132210, 1308724210),
('vxhb60ehsxfe4ssr8oq0ppc2fqn1rpm6', 2, 1306132257, 1308724257),
('d8qgdylmayqn17jyw1jmbgjm14kd664r', 2, 1306132320, 1308724320),
('fgvtz4kuzf07ovy28bjnblx72h8k4jt5', 2, 1306132335, 1308724335),
('viq5ssq4fk2pc91wc6mxolpohly7hhic', 2, 1306132451, 1308724451),
('hcgxf48ag7vc7zfxue85q6u84lwk2szm', 2, 1306132560, 1308724560),
('8i5n02vowh92m62aes9rto6e65idttkq', 2, 1306132595, 1308724595),
('uhcm7vpw0aisj2u9i73gj0yieuv1d7bn', 2, 1306132622, 1308724622),
('txf09a2ltewgk77uccubf4u3mvc722g8', 2, 1306132652, 1308724652),
('4vglsvay7h2gwr5dzvft8zkoip11u5ga', 2, 1306132676, 1308724676),
('mxmp31qhlq7sx47ge7ru3mdtbl9d77nn', 2, 1306134451, 1308726451),
('mjxvkpmvqoj2n6ogzfryprjcn0nk6c74', 2, 1306134637, 1308726637),
('4pmip43m8d0cd6uscrdwlr1a4ms78zvl', 2, 1306135027, 1308727027),
('5accplm5dkhcfwnu5en72f075dkyt76k', 2, 1306154341, 1308746341),
('tfsetfk91nww9hme3ji918imayx37lus', 2, 1306154679, 1308746679),
('tds2oylru19tjq3z5qbb59m1lcp4k6pw', 2, 1306155054, 1308747054),
('fox2cxr27yrrzprpeom9u0ey3pyimo8g', 2, 1306155193, 1308747193),
('uq5w8u9261lbifuzqdal3x6r4lfwl0gb', 2, 1306155658, 1308747658),
('4hjxwgwqznjj158rpfy3c6a0zbtl84zy', 2, 1306155804, 1308747804),
('8sm98vf3pylleu93e2b307yrle6hqni3', 2, 1306156836, 1308748836),
('mjui1xzckk8qe0fofcvk5r25ybo9yegy', 2, 1306157282, 1308749282),
('cvwy9lcpmnxc8ai1iuro11k7fsz4c8zz', 3, 1306158634, 1308750634);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 04:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `refcitymun`
--

--
-- Dumping data for table `refcitymun`
--

INSERT INTO `refcitymuns` (`id`, `psgcCode`, `citymunDesc`, `regDesc`, `provCode`, `citymunCode`) VALUES
(1086, '097201000', 'DAPITAN CITY', '09', '0972', '097201'),
(1087, '097202000', 'DIPOLOG CITY (Capital)', '09', '0972', '097202'),
(1088, '097203000', 'KATIPUNAN', '09', '0972', '097203'),
(1089, '097204000', 'LA LIBERTAD', '09', '0972', '097204'),
(1090, '097205000', 'LABASON', '09', '0972', '097205'),
(1091, '097206000', 'LILOY', '09', '0972', '097206'),
(1092, '097207000', 'MANUKAN', '09', '0972', '097207'),
(1093, '097208000', 'MUTIA', '09', '0972', '097208'),
(1094, '097209000', 'PIÑAN (NEW PIÑAN)', '09', '0972', '097209'),
(1095, '097210000', 'POLANCO', '09', '0972', '097210'),
(1096, '097211000', 'PRES. MANUEL A. ROXAS', '09', '0972', '097211'),
(1097, '097212000', 'RIZAL', '09', '0972', '097212'),
(1098, '097213000', 'SALUG', '09', '0972', '097213'),
(1099, '097214000', 'SERGIO OSMEÑA SR.', '09', '0972', '097214'),
(1100, '097215000', 'SIAYAN', '09', '0972', '097215'),
(1101, '097216000', 'SIBUCO', '09', '0972', '097216'),
(1102, '097217000', 'SIBUTAD', '09', '0972', '097217'),
(1103, '097218000', 'SINDANGAN', '09', '0972', '097218'),
(1104, '097219000', 'SIOCON', '09', '0972', '097219'),
(1105, '097220000', 'SIRAWAI', '09', '0972', '097220'),
(1106, '097221000', 'TAMPILISAN', '09', '0972', '097221'),
(1107, '097222000', 'JOSE DALMAN (PONOT)', '09', '0972', '097222'),
(1108, '097223000', 'GUTALAC', '09', '0972', '097223'),
(1109, '097224000', 'BALIGUIAN', '09', '0972', '097224'),
(1110, '097225000', 'GODOD', '09', '0972', '097225'),
(1111, '097226000', 'BACUNGAN (Leon T. Postigo)', '09', '0972', '097226'),
(1112, '097227000', 'KALAWIT', '09', '0972', '097227'),
(1113, '097302000', 'AURORA', '09', '0973', '097302'),
(1114, '097303000', 'BAYOG', '09', '0973', '097303'),
(1115, '097305000', 'DIMATALING', '09', '0973', '097305'),
(1116, '097306000', 'DINAS', '09', '0973', '097306'),
(1117, '097307000', 'DUMALINAO', '09', '0973', '097307'),
(1118, '097308000', 'DUMINGAG', '09', '0973', '097308'),
(1119, '097311000', 'KUMALARANG', '09', '0973', '097311'),
(1120, '097312000', 'LABANGAN', '09', '0973', '097312'),
(1121, '097313000', 'LAPUYAN', '09', '0973', '097313'),
(1122, '097315000', 'MAHAYAG', '09', '0973', '097315'),
(1123, '097317000', 'MARGOSATUBIG', '09', '0973', '097317'),
(1124, '097318000', 'MIDSALIP', '09', '0973', '097318'),
(1125, '097319000', 'MOLAVE', '09', '0973', '097319'),
(1126, '097322000', 'PAGADIAN CITY (Capital)', '09', '0973', '097322'),
(1127, '097323000', 'RAMON MAGSAYSAY (LIARGO)', '09', '0973', '097323'),
(1128, '097324000', 'SAN MIGUEL', '09', '0973', '097324'),
(1129, '097325000', 'SAN PABLO', '09', '0973', '097325'),
(1130, '097327000', 'TABINA', '09', '0973', '097327'),
(1131, '097328000', 'TAMBULIG', '09', '0973', '097328'),
(1132, '097330000', 'TUKURAN', '09', '0973', '097330'),
(1133, '097332000', 'ZAMBOANGA CITY', '09', '0973', '097332'),
(1134, '097333000', 'LAKEWOOD', '09', '0973', '097333'),
(1135, '097337000', 'JOSEFINA', '09', '0973', '097337'),
(1136, '097338000', 'PITOGO', '09', '0973', '097338'),
(1137, '097340000', 'SOMINOT (DON MARIANO MARCOS)', '09', '0973', '097340'),
(1138, '097341000', 'VINCENZO A. SAGUN', '09', '0973', '097341'),
(1139, '097343000', 'GUIPOS', '09', '0973', '097343'),
(1140, '097344000', 'TIGBAO', '09', '0973', '097344'),
(1141, '098301000', 'ALICIA', '09', '0983', '098301'),
(1142, '098302000', 'BUUG', '09', '0983', '098302'),
(1143, '098303000', 'DIPLAHAN', '09', '0983', '098303'),
(1144, '098304000', 'IMELDA', '09', '0983', '098304'),
(1145, '098305000', 'IPIL (Capital)', '09', '0983', '098305'),
(1146, '098306000', 'KABASALAN', '09', '0983', '098306'),
(1147, '098307000', 'MABUHAY', '09', '0983', '098307'),
(1148, '098308000', 'MALANGAS', '09', '0983', '098308'),
(1149, '098309000', 'NAGA', '09', '0983', '098309'),
(1150, '098310000', 'OLUTANGA', '09', '0983', '098310'),
(1151, '098311000', 'PAYAO', '09', '0983', '098311'),
(1152, '098312000', 'ROSELLER LIM', '09', '0983', '098312'),
(1153, '098313000', 'SIAY', '09', '0983', '098313'),
(1154, '098314000', 'TALUSAN', '09', '0983', '098314'),
(1155, '098315000', 'TITAY', '09', '0983', '098315'),
(1156, '098316000', 'TUNGAWAN', '09', '0983', '098316');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refcitymun`
--
ALTER TABLE `refcitymun`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `refcitymun`
--
ALTER TABLE `refcitymun`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

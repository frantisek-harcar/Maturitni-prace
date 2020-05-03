-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Počítač: wh44.farma.gigaserver.cz
-- Vytvořeno: Ned 03. kvě 2020, 13:46
-- Verze serveru: 8.0.18-9
-- Verze PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `vecerkajitka_cz_sunable`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`orderId` int(11) NOT NULL,
  `orderPerson` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `orderMail` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `orderPhone` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `orderCity` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `orderAddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `orderPostcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `orderTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `orders_record`
--

CREATE TABLE IF NOT EXISTS `orders_record` (
  `orderId` int(11) NOT NULL,
  `orderProductId` int(11) NOT NULL,
  `numberOfItems` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
`idPhoto` int(11) NOT NULL,
  `headerPhoto` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `imgPhoto` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL COMMENT '625x480',
  `imgAlt` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `descriptionPhoto` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `sectionPhoto` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `datePhoto` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`idProduct` int(11) NOT NULL,
  `nameProduct` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `priceProduct` int(11) NOT NULL,
  `imgProduct` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL COMMENT '1000x1172',
  `imgAlt` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `descriptionProduct` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `numberOfItems` int(11) NOT NULL,
  `sellCount` int(11) NOT NULL DEFAULT '0',
  `productType` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `productDate` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`idUsers` int(11) NOT NULL,
  `uidUsers` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `emailUsers` tinytext CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `pwdUsers` longtext CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`orderId`);

--
-- Klíče pro tabulku `photos`
--
ALTER TABLE `photos`
 ADD PRIMARY KEY (`idPhoto`);

--
-- Klíče pro tabulku `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`idProduct`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pro tabulku `photos`
--
ALTER TABLE `photos`
MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

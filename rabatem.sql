-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 10 Paź 2014, 12:12
-- Wersja serwera: 5.5.34
-- Wersja PHP: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `rabatem`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`id`, `company`, `address`, `phone`, `city`, `email`, `website`) VALUES
(1, 'Jakas firma', 'Lwowska 100', '', 'Kraków', '', ''),
(2, 'Nowa firma kokoko', 'kkookok', '15151', 'Kwakodakso', 'dassd@das.pl', 'www.rara.pl'),
(3, 'Nazwa firmy', 'Lwowska 100', '3323', 'Kraków', 'sdoakaso@doako.pl', 'www.rara.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresses_offers`
--

CREATE TABLE IF NOT EXISTS `adresses_offers` (
  `id_offer` int(11) NOT NULL,
  `id_adress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `adresses_offers`
--

INSERT INTO `adresses_offers` (`id_offer`, `id_adress`) VALUES
(5, 1),
(6, 2),
(8, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`, `link`) VALUES
(1, 'Gastronomia', 'gastronomia'),
(2, 'Turystyka', 'turystyka'),
(3, 'Motoryzacja', 'motoryzacja'),
(4, 'Moda', 'moda');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `id_admin` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `city`
--

INSERT INTO `city` (`id`, `name`, `region`, `id_admin`, `domain`, `link`) VALUES
(1, 'Nowy Sącz', 'Małopolska', 1, 'www.nowysacz.rabatem.pl', 'nowy-sacz'),
(2, 'Kraków', 'Małopolska', 1, 'www.krakow.rabatem.pl', 'krakow'),
(3, 'Zgierz', 'Lubelskie', 1, 'www.zgierz.rabatem.pl', 'zgierz'),
(4, 'Katowice', 'Małopolska', 2, 'www.katowice.rabatem.pl', 'katowice'),
(5, 'Nowe Miasto', 'malopolska', 2, 'www.newcityrabatem.pl', 'akaoskdasd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `disc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `logs`
--

INSERT INTO `logs` (`id`, `action`, `disc`, `user_id`, `read`, `date`, `city`) VALUES
(1, 'addoffer', 'Oferta <b>Oferta 30</b> została dodana pomyślnie.', 1, 1, 1411572392, 'Nowy Sącz'),
(2, 'addoffer', 'Oferta <b>Oferta 30</b> została dodana pomyślnie.', 1, 1, 1411572392, 'Kraków'),
(3, 'addoffer', 'Oferta <b>Nowa oferta</b> została dodana pomyślnie.', 1, 1, 1411572706, 'Nowy Sącz'),
(4, 'addoffer', 'Oferta <b>Nowa oferta</b> została dodana pomyślnie.', 1, 1, 1411572706, 'Zgierz'),
(5, 'addoffer', 'Oferta <b>Oferta 30</b> została dodana pomyślnie.', 2, 1, 1411572765, 'Katowice'),
(6, 'addoffer', 'Oferta <b>Nowa oferta</b> została dodana pomyślnie.', 2, 1, 1411572781, 'Nowe Miasto'),
(7, 'addoffer', 'Oferta <b>Oferta 30</b> została dodana pomyślnie.', 2, 1, 1411572854, 'Nowe Miasto'),
(8, 'addoffer', 'Oferta <b>Oferta test</b> została dodana pomyślnie.', 1, 1, 1411638292, 'Nowy Sącz'),
(9, 'refuseoffer', 'Oferta <b></b> została odrzucona pomyślnie.', 2, 1, 1412288440, 'Katowice');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `subject`, `text`, `date`, `username`, `from`, `read`) VALUES
(2, 'Temat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1425778759, 'x2008x', 'test', 0),
(3, 'Temat 2', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 145787778, 'x2008x', 'test', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `disc` text COLLATE utf8_polish_ci NOT NULL,
  `how` text COLLATE utf8_polish_ci NOT NULL,
  `worth` text COLLATE utf8_polish_ci NOT NULL,
  `old_price` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `new_price` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `add_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `id_category` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `code_per_person` int(11) NOT NULL,
  `recommended` int(11) NOT NULL,
  `pass` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `keyworlds` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `offers`
--

INSERT INTO `offers` (`id`, `name`, `disc`, `how`, `worth`, `old_price`, `new_price`, `add_time`, `end_time`, `active`, `id_category`, `link`, `code_per_person`, `recommended`, `pass`, `keyworlds`) VALUES
(2, '3afdsfds', 'das', 'dsa', 'dsa', '4', '213', 1411563251, 1411476851, 0, 1, '3afdsfds', 2, 0, '', '3afdsfds'),
(3, '3afdsfds', 'das', 'dsa', 'dsa', '4', '213', 1411563288, 1412081688, 0, 1, '3afdsfds5422bf189debf', 2, 0, '', '3afdsfds'),
(4, '3afdsfds', 'das', 'dsa', 'dsa', '4', '213', 1411563300, 1412081700, 0, 1, '3afdsfds5422bf24a00cb', 2, 0, '', '3afdsfds'),
(5, 'Oferta 30', 'das', 'ads', 'das', '250', '121', 1411572320, 1411572320, 0, 2, 'oferta-30', 0, 1, 'adsas', 'Oferta 30'),
(6, 'Nowa oferta', '55454', 'vddsf', 'fdsfds', '354', '233', 1411572647, 1411659047, 0, 1, 'nowa-oferta', 0, 0, 'okokokoko', 'Nowa oferta'),
(8, 'Oferta test', 'sad', 'sda', 'dsadsa', '33', '3', 1411638166, 1411465366, 0, 1, 'saddsa-hgjjf-fhh', 0, 1, 'asddsadsa', 'Oferta test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers_city`
--

CREATE TABLE IF NOT EXISTS `offers_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_offer` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `offers_city`
--

INSERT INTO `offers_city` (`id`, `id_offer`, `id_city`, `active`) VALUES
(1, 5, 1, 1),
(2, 5, 2, 1),
(3, 5, 4, 1),
(4, 5, 5, 1),
(5, 6, 1, 1),
(6, 6, 3, 1),
(8, 6, 5, 1),
(9, 8, 1, 1),
(10, 8, 2, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_offer` int(11) NOT NULL,
  `src` varchar(255) NOT NULL,
  `main` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `photos`
--

INSERT INTO `photos` (`id`, `id_offer`, `src`, `main`) VALUES
(1, 5, '5422e29f2295f_grid copy.jpg', 1),
(2, 6, '5422e3d0a445a_grid copy.jpg', 1),
(3, 8, '5423e3ef7807e_grid copy.jpg', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`) VALUES
(1, 'x2008x', 'mmatusikpl@gmail.com', NULL, '$2y$14$jSYTb1JMo88hXG9VZgFBvOKzkpOhrxE8p3Ze8EPd6pA/L01zxkpty', NULL),
(2, 'test', 'test@gmail.com', NULL, '$2y$14$AHrXyRDpwnHcFZP6Eo1yyuzcSaXoqt09TeQN1c4fuga944vR6do8K', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_role` (`role_id`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `user_role`
--

INSERT INTO `user_role` (`id`, `role_id`, `is_default`, `parent_id`) VALUES
(1, 'user', 0, NULL),
(2, 'admin', 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `idx_role_id` (`role_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `user_role_linker`
--

INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(1, 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `user_role` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Giu 25, 2019 alle 14:20
-- Versione del server: 5.7.26
-- Versione PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamesmore`
--
CREATE DATABASE IF NOT EXISTS `gamesmore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gamesmore`;

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

DROP TABLE IF EXISTS `articoli`;
CREATE TABLE IF NOT EXISTS `articoli` (
  `nome` varchar(70) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `quantita` int(5) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `immagine` varchar(100) NOT NULL,
  `InCatalogo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`nome`, `categoria`, `quantita`, `id`, `prezzo`, `immagine`, `InCatalogo`) VALUES
('Gran turismo', 'Videogames', 49, 51, 65.99, 'img/gran_turismo_.jpg', 1),
('Monopoly', 'Giochi da tavolo', 14, 52, 19.99, 'img/monopoly.jpg', 1),
('Black-ops III', 'Videogames', 48, 54, 59.99, 'img/call_of_duty.jpg', 1),
('Horizon-zero dawn', 'Videogames', 47, 55, 59.99, 'img/horizon.jpg', 1),
('Battlefield IV', 'Videogames', 34, 56, 49.99, 'img/battlefield.jpg', 0),
('Battlefield V', 'Videogames', 52, 57, 49.99, 'img/battlefield_v.jpg', 0),
('F1 2018', 'Videogames', 29, 58, 59.99, 'img/f1.jpg', 1),
('MotoGp 18', 'Videogames', 40, 59, 59.99, 'img/moto_gp.jpg', 1),
('For Honor', 'Videogames', 19, 60, 30.99, 'img/for_honor.jpg', 1),
('Campovolo', 'Musica', 5, 69, 15.99, 'img/51wLIoCc0jL.jpg', 1),
('Dragon Trainer', 'Film', 18, 70, 9.99, 'img/dragon_trainer.jpg', 0),
('Fifa 19', 'Videogames', 10, 71, 59.99, 'img/fifa19_ps4.jpg', 0),
('Queen 40th Anniversary Collect', 'Musica', 29, 72, 73.55, 'img/queen_collect.jpg', 1),
('Ultimo: Peter Pan', 'Musica', 16, 73, 9.99, 'img/ultimo.jpg', 1),
('Queen Greatest Hits I, II &amp; III', 'Musica', 20, 74, 18.98, 'img/queen_greatest.jpg', 1),
('Star Is Born / O.S.T.', 'Musica', 20, 75, 9.99, 'img/a_star_is_bornjpg.jpg', 1),
('BOHEMIAN RHAPSODY', 'Musica', 20, 76, 12.99, 'img/bohemian_rhapsody.jpg', 1),
('Bohemian Rhapsody (Blu Ray)', 'Film', 30, 77, 15.99, 'img/bohemian_bluray.jpg', 1),
('Spider-Man: Un Nuovo Universo (Blu Ray)', 'Film', 30, 78, 19.99, 'img/spiderman.jpg', 1),
('A Star Is Born', 'Film', 30, 79, 14.19, 'img/a_star_is_born_dvd.jpg', 1),
('Avengers: Infinity War', 'Film', 30, 80, 14.99, 'img/avengers_infinity_war.jpg', 1),
('Animali Fantastici: I Crimini Di Grindelwald', 'Film', 30, 81, 16.29, 'img/animali fantastici.jpg', 1),
('Taboo', 'Giochi da tavolo', 28, 82, 23.45, 'img/taboo.jpg', 1),
('Jumanji', 'Giochi da tavolo', 30, 83, 29.99, 'img/jumanji.jpg', 1),
('Dobble', 'Giochi da tavolo', 28, 84, 13.5, 'img/dobble.jpg', 1),
('Passa La Bomba', 'Giochi da tavolo', 29, 85, 17.86, 'img/passa_la_bomba.jpg', 1),
('Jenga', 'Giochi da tavolo', 30, 86, 16.99, 'img/jenga.jpg', 1),
('Funko-Pop Batman', 'Gadget', 10, 87, 17.99, 'img/batman.jpg', 1),
('Funko-Pop Freddie Mercury', 'Gadget', 3, 88, 14.99, 'img/Funko-pop f.mercury.jpg', 1),
('Funko-Pop Tyrion Lanister', 'Gadget', 4, 89, 13.99, 'img/Funko Tyrion.jpg', 1),
('Portachiavi Groot Guardian of galaxy', 'Gadget', 20, 90, 6.99, 'img/portachiavi_groot.jpg', 1),
('Funko-Pop Crash Bandicoot', 'Gadget', 7, 91, 13.99, 'img/Funko crash.jpg', 1),
('Pen Drive Iron Man 32Gb', 'Gadget', 10, 92, 16.99, 'img/PenDrive iron man.jpg', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

DROP TABLE IF EXISTS `carrello`;
CREATE TABLE IF NOT EXISTS `carrello` (
  `idUtente` int(6) NOT NULL,
  `idArticolo` int(6) NOT NULL,
  `quantita` int(11) NOT NULL,
  KEY `idArticolo` (`idArticolo`),
  KEY `idUtente` (`idUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `fatture`
--

DROP TABLE IF EXISTS `fatture`;
CREATE TABLE IF NOT EXISTS `fatture` (
  `idOrd` int(6) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Citta` varchar(30) NOT NULL,
  `Paese` varchar(30) NOT NULL,
  `Provincia` varchar(2) NOT NULL,
  `Cap` int(5) NOT NULL,
  `totale` float NOT NULL,
  `ScontoPerc` int(2) DEFAULT NULL,
  `TipoSped` varchar(30) NOT NULL,
  PRIMARY KEY (`idOrd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `fatture`
--

INSERT INTO `fatture` (`idOrd`, `data`, `Nome`, `Cognome`, `Indirizzo`, `Citta`, `Paese`, `Provincia`, `Cap`, `totale`, `ScontoPerc`, `TipoSped`) VALUES
(2, '2019-06-25 13:44:38', 'Mario', 'Rossi', 'Via Dante, 52', 'Palermo', 'Italia', 'PA', 90138, 306.01, 30, 'standard'),
(3, '2019-06-25 14:12:24', 'Mario', 'Rossi', 'Via Dante, 52', 'Palermo', 'Italia', 'PA', 90138, 202.95, 20, 'standard'),
(4, '2019-06-25 14:14:49', 'Benny', 'Marino', 'via marco polo, 52', 'Roma', 'Italia', 'Ro', 90000, 52.98, 0, 'standard');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

DROP TABLE IF EXISTS `ordini`;
CREATE TABLE IF NOT EXISTS `ordini` (
  `idOrdine` int(10) NOT NULL,
  `idUtente` int(5) NOT NULL,
  `idArticolo` int(11) NOT NULL,
  `destinatario` varchar(60) NOT NULL,
  `quantita` int(3) NOT NULL,
  `prezzo_unita` float NOT NULL,
  `indirizzo` varchar(200) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metodoPagamento` varchar(25) NOT NULL,
  `note` varchar(300) NOT NULL,
  PRIMARY KEY (`idOrdine`,`idArticolo`,`data`),
  KEY `ordini_ibfk_1` (`idUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`idOrdine`, `idUtente`, `idArticolo`, `destinatario`, `quantita`, `prezzo_unita`, `indirizzo`, `data`, `metodoPagamento`, `note`) VALUES
(2, 3, 51, 'Mario Rossi', 6, 65.99, 'Via Dante, 52,Palermo,Italia,PA,90138', '2019-06-25 13:44:38', 'PayPal', ''),
(2, 3, 82, 'Mario Rossi', 1, 23.45, 'Via Dante, 52,Palermo,Italia,PA,90138', '2019-06-25 13:44:38', 'PayPal', ''),
(2, 3, 84, 'Mario Rossi', 1, 13.5, 'Via Dante, 52,Palermo,Italia,PA,90138', '2019-06-25 13:44:38', 'PayPal', ''),
(3, 3, 56, 'Mario Bianchi', 5, 49.99, 'via roma,1,roma,italia,ro,90100', '2019-06-25 14:12:24', 'PayPal', ''),
(4, 1, 56, 'Benny Marino', 1, 49.99, 'via marco polo, 52,Roma,Italia,Ro,90000', '2019-06-25 14:14:49', 'PayPal', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(60) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `PassByAdmin` varchar(100) DEFAULT NULL,
  `Nazione` varchar(60) NOT NULL,
  `Citta` varchar(60) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Cap` int(10) NOT NULL,
  `Provincia` varchar(2) NOT NULL,
  `Domanda` varchar(100) NOT NULL,
  `Risposta` varchar(100) NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `Nome`, `Cognome`, `Email`, `Password`, `PassByAdmin`, `Nazione`, `Citta`, `Indirizzo`, `Cap`, `Provincia`, `Domanda`, `Risposta`, `Admin`) VALUES
(1, 'Benny', 'Marino', 'utenteAdmin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'Italia', 'Roma', 'via marco polo, 52', 90000, 'Ro', 'Nome del tuo primo animale domestico', 'Gino', 1),
(3, 'Mario', 'Rossi', 'rossi.mario@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'Italia', 'Palermo', 'Via Dante, 52', 90138, 'PA', 'Nome del tuo primo animale domestico', 'fuffy', 0);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FK_carrello_idArt` FOREIGN KEY (`idArticolo`) REFERENCES `articoli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_carrello_idUt` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `fatture`
--
ALTER TABLE `fatture`
  ADD CONSTRAINT `idOrdine` FOREIGN KEY (`idOrd`) REFERENCES `ordini` (`idOrdine`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

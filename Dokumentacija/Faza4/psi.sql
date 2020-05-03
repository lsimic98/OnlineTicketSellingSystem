# File name: C:/Users/Nikola/Desktop/New folder/psi.sql
# Creation date: 05/04/2020
# Created by MSSQL to MySQL 7.3 [Demo]
# --------------------------------------------------
# More conversion tools at http://www.convert-in.com

SET NAMES utf8;

DROP DATABASE IF EXISTS `psi`;
CREATE DATABASE `psi` character set utf8;
USE `psi`;

#
# Table structure for table 'Dogadjaj'
#

DROP TABLE IF EXISTS `Dogadjaj` CASCADE;
CREATE TABLE `Dogadjaj` (
  `IdD` INT NOT NULL,
  `Naziv` VARCHAR(40) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Cena` INT NOT NULL,
  `Datum` DATETIME NOT NULL,
  `Lokacija` VARCHAR(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Slika` LONGBLOB NOT NULL,
  PRIMARY KEY (`IdD`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Dogadjaj'
#

LOCK TABLES `Dogadjaj` WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Ima_Ulogu'
#

DROP TABLE IF EXISTS `Ima_Ulogu` CASCADE;
CREATE TABLE `Ima_Ulogu` (
  `IdK` INT NOT NULL,
  `IdU` INT NOT NULL,
  PRIMARY KEY (`IdK`, `IdU`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Ima_Ulogu'
#

LOCK TABLES `Ima_Ulogu` WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Korisnik'
#

DROP TABLE IF EXISTS `Korisnik` CASCADE;
CREATE TABLE `Korisnik` (
  `IdK` INT NOT NULL,
  `Ime` VARCHAR(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Prezime` VARCHAR(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `KorIme` VARCHAR(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Email` VARCHAR(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Sifra` VARCHAR(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Telefon` VARCHAR(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `JMBG` VARCHAR(13) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `BRLK` VARCHAR(9) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Grad` VARCHAR(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Adresa` VARCHAR(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`IdK`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Korisnik'
#

LOCK TABLES `Korisnik` WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Manifestacija'
#

DROP TABLE IF EXISTS `Manifestacija` CASCADE;
CREATE TABLE `Manifestacija` (
  `IdM` VARCHAR(18) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Slika` VARCHAR(18) CHARACTER SET utf8 DEFAULT '',
  `Naziv` VARCHAR(18) CHARACTER SET utf8 DEFAULT '',
  `Opis` VARCHAR(18) CHARACTER SET utf8 DEFAULT '',
  `IdD` INT NOT NULL,
  PRIMARY KEY (`IdM`, `IdD`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Manifestacija'
#

LOCK TABLES `Manifestacija` WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Oglas'
#

DROP TABLE IF EXISTS `Oglas` CASCADE;
CREATE TABLE `Oglas` (
  `IdD` INT NOT NULL,
  `IdK` INT NOT NULL,
  `BrojKarata` INT NOT NULL,
  PRIMARY KEY (`IdD`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Oglas'
#

LOCK TABLES `Oglas` WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Transakcija'
#

DROP TABLE IF EXISTS `Transakcija` CASCADE;
CREATE TABLE `Transakcija` (
  `IdT` INT NOT NULL,
  `IdK` INT NOT NULL,
  `IdD` INT NOT NULL,
  `Cena` INT NOT NULL,
  `BrojKartice` VARCHAR(16) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Ishod` BIT NOT NULL,
  PRIMARY KEY (`IdT`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Transakcija'
#

LOCK TABLES `Transakcija` WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Uloga'
#

DROP TABLE IF EXISTS `Uloga` CASCADE;
CREATE TABLE `Uloga` (
  `IdU` INT NOT NULL,
  `Opis` VARCHAR(10) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`IdU`)
) ENGINE=InnoDB;

#
# Dumping data for table 'Uloga'
#

LOCK TABLES `Uloga` WRITE;
UNLOCK TABLES;

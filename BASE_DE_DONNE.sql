

-- Dumping database structure for tprdv
DROP DATABASE IF EXISTS `tprdv`;
CREATE DATABASE IF NOT EXISTS `tprdv` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `tprdv`;

-- Dumping structure for table tp5.administrateurs
DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `login` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `administrateurs` (`idAdmin`, `nom`, `login`,`email`, `password`) VALUES (NULL, 'admin', 'admin@admin.com', 'admin@admin.com', '12345');


DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `idPatient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `telephone` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwrd` varchar(50) NOT NULL,
  PRIMARY KEY (`idPatient`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
-- Data exporting was unselected.

 DROP TABLE IF EXISTS `typeConsultation`;
CREATE TABLE IF NOT EXISTS `typeConsultation` (
  `idConsultation` int(11) NOT NULL AUTO_INCREMENT,
  `designConsultation` varchar(50) NOT NULL,
  PRIMARY KEY (`idConsultation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'une numération formule sanguine -FNS-');
INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'un bilan inflammatoire ');
INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'une analyse de la glycémie');
INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'un bilan lipidique');
INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'un bilan hormonal');
INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'un bilan rénal');
INSERT INTO `typeconsultation` (`idConsultation`, `designConsultation`) VALUES (NULL, 'un bilan hépatique');


DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE IF NOT EXISTS `rendezvous` (
  `idRdv` int(11) NOT NULL AUTO_INCREMENT,
  `dateRdv` date NOT NULL,
  `heureRdv` TIME NOT NULL,
  `idPatient` int(11) NOT NULL,
  `idConsultation` int(11) DEFAULT NULL,
  `statusRdv` int(1) DEFAULT 0,
   `MotifStatus` varchar (150) ,
  PRIMARY KEY (`idRdv`),
  KEY `fk20` (`idPatient`),
  CONSTRAINT `fk2` FOREIGN KEY (`idPatient`) REFERENCES `patient` (`idPatient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk3` FOREIGN KEY (`idConsultation`) REFERENCES `typeConsultation` (`idConsultation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `idResultat` int(11) NOT NULL AUTO_INCREMENT,
  `dateRes` date NOT NULL,
  `heureRes` TIME NOT NULL,
  `patientId` int(11) NOT NULL,
  `observation` varchar (250) ,
  PRIMARY KEY (`idResultat`),
  KEY `fk26` (`patientId`),
  CONSTRAINT `fk28` FOREIGN KEY (`patientId`) REFERENCES `patient` (`idPatient`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `decision`;
CREATE TABLE IF NOT EXISTS `decision` (
  `idDecision` int(11) NOT NULL AUTO_INCREMENT,
  `dateDec` datetime NOT NULL,
  `observation` varchar(150) ,
  `statusRdv` int(1) DEFAULT 0,
  `idRdv` int(11) NOT NULL,
  PRIMARY KEY (`idDecision`),
  KEY `fk18` (`idRdv`),
  CONSTRAINT `fk4` FOREIGN KEY (`idRdv`) REFERENCES `rendezvous` (`idRdv`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


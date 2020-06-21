-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : Dim 21 juin 2020 à 10:53
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eventactivity`
--
CREATE DATABASE IF NOT EXISTS `eventactivity` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eventactivity`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nomAdmin` varchar(255) NOT NULL,
  `prenomAdmin` varchar(255) NOT NULL,
  `mailAdmin` varchar(255) NOT NULL,
  `idTypeAdmin` int(11) NOT NULL,
  `passwordAdmin` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `nomAdmin`, `prenomAdmin`, `mailAdmin`, `idTypeAdmin`, `passwordAdmin`, `pseudo`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 1, '$2y$10$HzwVWFov.UPEnkUASJmlzOk7aSCEwUI01H0TF/dNBNFpb.xGVIbyC', 'Super-Admin');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Sport'),
(2, 'Soirée'),
(3, 'Bizness'),
(4, 'informatique');

-- --------------------------------------------------------

--
-- Structure de la table `civilite`
--

CREATE TABLE `civilite` (
  `idCiv` int(11) NOT NULL,
  `nomCiv` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `civilite`
--

INSERT INTO `civilite` (`idCiv`, `nomCiv`) VALUES
(1, 'Mr'),
(2, 'Mme');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idCommentaire` int(11) NOT NULL,
  `txtCommentaire` text NOT NULL,
  `dateValidCommentaire` datetime NOT NULL,
  `idPereCommentaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `txtCommentaire`, `dateValidCommentaire`, `idPereCommentaire`) VALUES
(8, 'Mauris augue neque gravida in fermentum. Imperdiet dui accumsan sit amet nulla. Viverra vitae congue eu consequat ac felis. Velit euismod in pellentesque massa placerat duis ultricies lacus. ', '2020-01-09 00:00:00', 0),
(9, 'attis ullamcorper velit sed ullamcorper morbi. Odio euismod lacinia at quis risus sed. Netus et malesuada fames ac turpis. Velit euismod in pellentesque massa placerat duis ultricies. Risus at ultrices mi tempus imperdiet nulla.', '2020-01-09 00:00:00', 1),
(10, 'Eget mi proin sed libero enim sed faucibus. In aliquam sem fringilla ut morbi tincidunt augue interdum velit.', '2020-01-09 00:00:00', 1),
(11, 'Adipiscing elit pellentesque habitant morbi tristique senectus et netus et. ', '2020-01-09 00:00:00', 3),
(12, 'Scelerisque varius morbi enim nunc faucibus a pellentesque sit. Sed velit dignissim sodales ut eu sem. Urna neque viverra justo nec. ', '2020-01-09 00:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idContact` int(11) NOT NULL,
  `orgContact` varchar(255) NOT NULL,
  `nomContact` varchar(255) NOT NULL,
  `prenomContact` varchar(255) NOT NULL,
  `telFixeContact` varchar(10) NOT NULL,
  `telMobContact` varchar(10) NOT NULL,
  `idCiv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`idContact`, `orgContact`, `nomContact`, `prenomContact`, `telFixeContact`, `telMobContact`, `idCiv`) VALUES
(1, 'Advenit post ', 'Lièvremont', 'Jean-Christophe', '0123456789', '0123456789', 1),
(2, 'eodem impetu', 'Allaire', 'Albert', '0123456789', '0123456789', 1),
(3, 'Iam virtutem ', 'Dupuy', 'Claude', '0123456789', '0123456789', 1),
(4, 'oculos flexeris', 'Balzac', 'Edgar', '0123456789', '0123456789', 1),
(5, 'coetuum magnificus', 'Mazet', 'Roland', '0123456789', '0123456789', 1),
(6, 'orientem diversis', 'Ruiz', 'Frantz', '0123456789', '0123456789', 1),
(7, 'senator inimicus', 'Cerfbeer', 'Lise', '0123456789', '0123456789', 2),
(8, 'Donec ullamcorper', 'Haie', 'Louise', '0123456789', '0123456789', 2),
(9, ' sola pernicies', 'Picard', 'Mathias', '0123456789', '0123456789', 1),
(10, 'nunc subsidiis', 'Ouvrard', 'Steeve', '0123456789', '0123456789', 1),
(11, 'Eodem tempore', 'Louias', 'Ludovic', '0123456789', '0123456789', 1),
(12, 'Utque proeliorum', 'Devereux', 'Line', '0123456789', '0123456789', 2);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idEvent` int(11) NOT NULL,
  `nomEvent` varchar(255) NOT NULL,
  `descriptionEvent` text NOT NULL,
  `pafEvent` decimal(10,2) NOT NULL,
  `heureEvent` time NOT NULL,
  `dateEvent` date NOT NULL,
  `dureeEvent` time DEFAULT NULL,
  `infoReservation` varchar(255) NOT NULL,
  `idSsCategorie` int(11) NOT NULL,
  `idPhoto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvent`, `nomEvent`, `descriptionEvent`, `pafEvent`, `heureEvent`, `dateEvent`, `dureeEvent`, `infoReservation`, `idSsCategorie`, `idPhoto`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '45.00', '15:30:00', '2020-06-19', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 5, 10),
(2, 'Ut vestibulum augue a elementum ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '25.00', '15:30:00', '2020-06-14', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 1, 3),
(3, 'Ut vel eros dapibus purus ornare ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:30:00', '2020-05-14', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 3, 11),
(4, 'Arem potatuim mol', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:30:00', '2020-06-25', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 2, 2),
(5, 'Integer imperdiet ex vitae ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:03:00', '2020-03-12', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 2, 4),
(6, 'Vivamus pharetra nisi a metus ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '45.00', '15:30:00', '2020-04-15', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 8, 5),
(7, 'Morbi at libero mollis vedum mallus', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:30:00', '2021-05-04', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 1, 6),
(8, 'Saolemllfd ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '45.00', '15:30:00', '2020-06-13', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 3, 9),
(9, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '45.00', '15:30:00', '2020-07-15', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 5, 10),
(10, 'Ut vestibulum augue a elementum ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '25.00', '15:30:00', '2020-07-25', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 1, 3),
(11, 'Ut vel eros dapibus purus ornare ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:30:00', '2020-08-20', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 3, 11),
(12, 'Arem potatuim mol', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:30:00', '2020-09-08', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 2, 2),
(13, 'Integer imperdiet ex vitae ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:03:00', '2020-03-08', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 2, 4),
(14, 'Vivamus pharetra nisi a metus ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '45.00', '15:30:00', '2020-08-29', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 8, 5),
(15, 'Morbi at libero mollis vedum mallus', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '4.00', '15:30:00', '2021-08-16', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 1, 6),
(16, 'Saolemllfd ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus mi, ultrices eget interdum et, aliquet ac elit. Integer lobortis, ex sit amet ornare vestibulum, massa lectus porta sem, a condimentum nibh tortor non ligula. Nulla a erat lacinia, consectetur libero non, suscipit justo. Nunc ipsum quam, pellentesque eu dapibus ut, pulvinar at diam. Nullam rutrum tortor ac malesuada blandit. Pellentesque ante risus, euismod et justo a, vulputate ultrices nunc. Integer vitae sapien nulla. ', '45.00', '15:30:00', '2020-08-11', NULL, 'In volutpat nisi leo. Praesent commodo nec justo vel mollis. Cras quis nisl justo. Quisque nulla tortor, blandit ac efficitur in, fringilla ac dolor. Integer id justo quis nibh laoreet facilisis. ', 3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL,
  `urlPhoto` varchar(255) NOT NULL,
  `nomPhoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `urlPhoto`, `nomPhoto`) VALUES
(1, 'default.jpg', 'default'),
(2, 'petanque_1.jpg', 'petanque_1'),
(3, 'petanque_2.jpg', 'petanque_2'),
(4, 'petanque_3.jpg', 'petanque_3'),
(5, 'clavier.jpg', 'clavier'),
(6, 'course.jpg', 'course'),
(7, 'escalade.jpg', 'escalade'),
(8, 'fitness.jpg', 'fitness'),
(9, 'fitness_2.jpg', 'fitness_2'),
(10, 'tango.png', 'tango'),
(11, 'soiree.jpg', 'soiree');

-- --------------------------------------------------------

--
-- Structure de la table `rel_event_contact`
--

CREATE TABLE `rel_event_contact` (
  `idContact` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rel_event_contact`
--

INSERT INTO `rel_event_contact` (`idContact`, `idEvent`) VALUES
(1, 4),
(2, 8),
(4, 6),
(5, 3),
(7, 7),
(10, 1),
(11, 4),
(12, 6);

-- --------------------------------------------------------

--
-- Structure de la table `rel_photo_event`
--

CREATE TABLE `rel_photo_event` (
  `idPhoto` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL,
  `infoPhoto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rel_slider_photo`
--

CREATE TABLE `rel_slider_photo` (
  `idSlider` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  `linkevent` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rel_slider_photo`
--

INSERT INTO `rel_slider_photo` (`idSlider`, `idPhoto`, `linkevent`) VALUES
(1, 8, 7),
(2, 3, 0),
(3, 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `rel_user_com_event_statut`
--

CREATE TABLE `rel_user_com_event_statut` (
  `idUser` int(11) NOT NULL,
  `idCom` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL,
  `idStatut` int(11) NOT NULL,
  `dateValid` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rel_user_com_event_statut`
--

INSERT INTO `rel_user_com_event_statut` (`idUser`, `idCom`, `idEvent`, `idStatut`, `dateValid`) VALUES
(1, 8, 6, 2, '2020-06-15'),
(1, 11, 2, 2, '2020-06-15'),
(1, 12, 3, 2, '2020-06-15'),
(1, 12, 7, 2, '2020-06-15');

-- --------------------------------------------------------

--
-- Structure de la table `slider`
--

CREATE TABLE `slider` (
  `idSlider` int(11) NOT NULL,
  `nomSlider` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `slider`
--

INSERT INTO `slider` (`idSlider`, `nomSlider`) VALUES
(1, 'Slider1'),
(2, 'Slider2'),
(3, 'Slider3');

-- --------------------------------------------------------

--
-- Structure de la table `ss_categorie`
--

CREATE TABLE `ss_categorie` (
  `idSSCateg` int(11) NOT NULL,
  `nomSSCateg` varchar(255) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ss_categorie`
--

INSERT INTO `ss_categorie` (`idSSCateg`, `nomSSCateg`, `idCategorie`) VALUES
(1, 'Course', 1),
(2, 'Pétanque', 1),
(3, 'Concert', 2),
(4, 'Opéra', 2),
(5, 'Cabaret', 2),
(6, 'Séminaire', 3),
(7, 'Congrés', 3),
(8, 'Salon Professionnel', 3),
(9, 'Rencontre jeux', 4),
(10, 'Salon Informatique', 4);

-- --------------------------------------------------------

--
-- Structure de la table `statutvalidation`
--

CREATE TABLE `statutvalidation` (
  `idStatut` int(11) NOT NULL,
  `nomStatut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statutvalidation`
--

INSERT INTO `statutvalidation` (`idStatut`, `nomStatut`) VALUES
(2, 'valider'),
(3, 'rejeter');

-- --------------------------------------------------------

--
-- Structure de la table `type_user`
--

CREATE TABLE `type_user` (
  `idTypeUser` int(11) NOT NULL,
  `nomTypeUser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_user`
--

INSERT INTO `type_user` (`idTypeUser`, `nomTypeUser`) VALUES
(1, 'Super-Administrateur'),
(2, 'Administrateur'),
(3, 'Modérateur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nomUser` varchar(255) NOT NULL,
  `prenomUser` varchar(255) NOT NULL,
  `dateBirth` date NOT NULL,
  `adresseUser` varchar(255) NOT NULL,
  `adressBisUser` varchar(255) NOT NULL,
  `cpUser` varchar(11) NOT NULL,
  `villeUser` varchar(255) NOT NULL,
  `paysUser` varchar(255) NOT NULL,
  `emailUser` varchar(255) NOT NULL,
  `mdpUser` varchar(255) NOT NULL,
  `idCiv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `nomUser`, `prenomUser`, `dateBirth`, `adresseUser`, `adressBisUser`, `cpUser`, `villeUser`, `paysUser`, `emailUser`, `mdpUser`, `idCiv`) VALUES
(1, 'lambda', 'lambda', '1986-12-16', 'lorem ipsum lambda', 'pgf', '59000', 'lille', 'france', 'lambda@lambda.com', '$2y$10$k8MMgzLucMiD8YB7uOU5mewsj5grEACe0UZNRd3PZN45XQDZAovey', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `fk_idTypeAdmin` (`idTypeAdmin`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `civilite`
--
ALTER TABLE `civilite`
  ADD PRIMARY KEY (`idCiv`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `fk_idPereCommentaire` (`idPereCommentaire`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`),
  ADD KEY `fk_idCiv` (`idCiv`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `idCategorie` (`idSsCategorie`),
  ADD KEY `fk_photo` (`idPhoto`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idPhoto`);

--
-- Index pour la table `rel_event_contact`
--
ALTER TABLE `rel_event_contact`
  ADD PRIMARY KEY (`idContact`,`idEvent`),
  ADD KEY `idContact` (`idContact`),
  ADD KEY `idEvent` (`idEvent`);

--
-- Index pour la table `rel_photo_event`
--
ALTER TABLE `rel_photo_event`
  ADD PRIMARY KEY (`idPhoto`,`idEvent`),
  ADD UNIQUE KEY `idPhoto` (`idPhoto`),
  ADD KEY `idEvent` (`idEvent`);

--
-- Index pour la table `rel_slider_photo`
--
ALTER TABLE `rel_slider_photo`
  ADD PRIMARY KEY (`idSlider`,`idPhoto`),
  ADD KEY `idPhoto` (`idPhoto`);

--
-- Index pour la table `rel_user_com_event_statut`
--
ALTER TABLE `rel_user_com_event_statut`
  ADD PRIMARY KEY (`idUser`,`idCom`,`idEvent`,`idStatut`) USING BTREE,
  ADD KEY `idStatut` (`idStatut`),
  ADD KEY `idEvent` (`idEvent`),
  ADD KEY `idCom` (`idCom`);

--
-- Index pour la table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`idSlider`);

--
-- Index pour la table `ss_categorie`
--
ALTER TABLE `ss_categorie`
  ADD PRIMARY KEY (`idSSCateg`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `statutvalidation`
--
ALTER TABLE `statutvalidation`
  ADD PRIMARY KEY (`idStatut`);

--
-- Index pour la table `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`idTypeUser`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `emailUser` (`emailUser`),
  ADD KEY `fk_idCiv` (`idCiv`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `civilite`
--
ALTER TABLE `civilite`
  MODIFY `idCiv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `slider`
--
ALTER TABLE `slider`
  MODIFY `idSlider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ss_categorie`
--
ALTER TABLE `ss_categorie`
  MODIFY `idSSCateg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `type_user`
--
ALTER TABLE `type_user`
  MODIFY `idTypeUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idTypeAdmin`) REFERENCES `type_user` (`idTypeUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`idCiv`) REFERENCES `civilite` (`idCiv`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idPhoto`) REFERENCES `photo` (`idPhoto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`idSsCategorie`) REFERENCES `ss_categorie` (`idSSCateg`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rel_event_contact`
--
ALTER TABLE `rel_event_contact`
  ADD CONSTRAINT `rel_event_contact_ibfk_1` FOREIGN KEY (`idContact`) REFERENCES `contact` (`idContact`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_event_contact_ibfk_2` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rel_slider_photo`
--
ALTER TABLE `rel_slider_photo`
  ADD CONSTRAINT `rel_slider_photo_ibfk_1` FOREIGN KEY (`idSlider`) REFERENCES `slider` (`idSlider`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_slider_photo_ibfk_2` FOREIGN KEY (`idPhoto`) REFERENCES `photo` (`idPhoto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rel_user_com_event_statut`
--
ALTER TABLE `rel_user_com_event_statut`
  ADD CONSTRAINT `rel_user_com_event_statut_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_user_com_event_statut_ibfk_2` FOREIGN KEY (`idCom`) REFERENCES `commentaire` (`idCommentaire`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_user_com_event_statut_ibfk_3` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_user_com_event_statut_ibfk_4` FOREIGN KEY (`idStatut`) REFERENCES `statutvalidation` (`idStatut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ss_categorie`
--
ALTER TABLE `ss_categorie`
  ADD CONSTRAINT `ss_categorie_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idCiv`) REFERENCES `civilite` (`idCiv`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

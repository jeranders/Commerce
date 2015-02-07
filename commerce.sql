-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 07 Février 2015 à 10:34
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
  `id` int(11) NOT NULL,
  `c_nom_societe` varchar(255) NOT NULL COMMENT 'Nom de votre entreprise, société',
  `c_siret` varchar(14) NOT NULL COMMENT 'Numéro de SIRET',
  `c_date_activite` date NOT NULL COMMENT 'Date du début de votre activité',
  `c_type_activite` varchar(80) NOT NULL COMMENT 'Type d''activité (Commercial, libéral...)',
  `c_ca_t` float(11,2) NOT NULL COMMENT 'Plafond du chiffre d''affaire',
  `c_organisme` varchar(80) NOT NULL COMMENT 'Organisme de retraite (RSI..)',
  `c_cotisation` float(11,2) NOT NULL COMMENT 'Taux de cotisation',
  `c_impot` float(11,2) NOT NULL,
  `c_accre` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Si ACCRE valeur à 1 sinon 0 par defaut',
  `c_adresse` varchar(255) NOT NULL COMMENT 'Adresse de la société',
  `c_logo` varchar(255) NOT NULL COMMENT 'Logo de la société',
  `c_avatar` varchar(255) NOT NULL COMMENT 'Avatar de la personne',
  `c_pseudo` varchar(255) NOT NULL COMMENT 'Pseudo de la personne',
  `c_email_societe` varchar(255) NOT NULL COMMENT 'Email de contact de la societe',
  `c_email_perso` varchar(255) NOT NULL COMMENT 'Email perso',
  `c_nom` varchar(255) NOT NULL COMMENT 'Votre nom',
  `c_prenom` varchar(255) NOT NULL COMMENT 'Votre prénom',
  `c_phrase_secret` varchar(255) NOT NULL COMMENT 'Phrase secret proposé',
  `c_phrase_verif` varchar(255) NOT NULL COMMENT 'Vérification du résultat de la phrase secréte',
  `c_password` varchar(60) NOT NULL COMMENT 'Password du portail',
  `c_valide` tinyint(1) NOT NULL COMMENT 'Valide le site',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `configurations`
--

INSERT INTO `configurations` (`id`, `c_nom_societe`, `c_siret`, `c_date_activite`, `c_type_activite`, `c_ca_t`, `c_organisme`, `c_cotisation`, `c_impot`, `c_accre`, `c_adresse`, `c_logo`, `c_avatar`, `c_pseudo`, `c_email_societe`, `c_email_perso`, `c_nom`, `c_prenom`, `c_phrase_secret`, `c_phrase_verif`, `c_password`, `c_valide`) VALUES
(0, 'Little Owl', '0', '0000-00-00', '1', 0.00, '', 13.30, 1.00, 0, 'Little Owl', '', '', 'Moltes', 'contact@little-owl.fr', 'Brechoire.j@gmail.com', 'Brechoire', 'Jérôme', 'Nom de votre premier animal', 'Moustache', '723156650c5778d0e4df4b2fbfeefa65359302e5', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `f_nom` varchar(80) NOT NULL COMMENT 'Nom du fournisseur',
  `f_ref` varchar(255) NOT NULL DEFAULT '000000' COMMENT 'Référence du fournisseur',
  `f_site` varchar(255) NOT NULL DEFAULT '#' COMMENT 'Lien du site du fournisseur',
  `f_tel` varchar(30) NOT NULL DEFAULT '0102030405' COMMENT 'Numéro de téléphone du fournisseur',
  `f_fax` varchar(30) NOT NULL DEFAULT '0102030405' COMMENT 'Fax du fournisseur',
  `f_commentaire` text NOT NULL COMMENT 'Commentaire sur le fournisseur',
  `f_pays` varchar(60) NOT NULL DEFAULT 'Inconnu' COMMENT 'Pays du fournisseur',
  `f_logo` varchar(255) NOT NULL COMMENT 'Logo du fournisseur',
  `f_adresse` varchar(255) NOT NULL DEFAULT 'Inconnu' COMMENT 'Adresse du du fournisseur',
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id_fournisseur`, `f_nom`, `f_ref`, `f_site`, `f_tel`, `f_fax`, `f_commentaire`, `f_pays`, `f_logo`, `f_adresse`) VALUES
(1, 'Hema', '', 'http://www.hema.fr/', '', '', 'Magasin ou j''achète les vernis à ongles', 'France', '', ''),
(2, 'Alex', '000000', '#', '0102030405', '0102030405', '', 'Inconnu', '', 'Inconnu');

-- --------------------------------------------------------

--
-- Structure de la table `produit_c`
--

CREATE TABLE IF NOT EXISTS `produit_c` (
  `id_produit_c` int(11) NOT NULL AUTO_INCREMENT,
  `pc_nom` varchar(255) NOT NULL COMMENT 'Nom du produit',
  `pc_ref` varchar(255) NOT NULL COMMENT 'Reférence du produit',
  `pc_type_produit` int(11) NOT NULL COMMENT 'id du type de produit',
  `pc_image` varchar(255) NOT NULL COMMENT 'Image du produit',
  `pc_dernier_prix` float(11,2) NOT NULL COMMENT 'Prix de la dernière commande',
  `pc_derniere_date` date NOT NULL COMMENT 'Date de la dernière commande',
  `pc_derniere_quantite` int(11) NOT NULL COMMENT 'Dernière quantité commandé',
  `pc_description` text NOT NULL COMMENT 'Description du produit',
  `pc_commentaire` text NOT NULL COMMENT 'Commentaire sur le produit',
  `pc_dernier_fournisseur` int(11) NOT NULL COMMENT 'id du dernier fournisseur de la dernière commande',
  PRIMARY KEY (`id_produit_c`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COMMENT='Produit consommable ' AUTO_INCREMENT=2 ;

--
-- Contenu de la table `produit_c`
--

INSERT INTO `produit_c` (`id_produit_c`, `pc_nom`, `pc_ref`, `pc_type_produit`, `pc_image`, `pc_dernier_prix`, `pc_derniere_date`, `pc_derniere_quantite`, `pc_description`, `pc_commentaire`, `pc_dernier_fournisseur`) VALUES
(1, 'Cabochon en verre 18mm', 'CABO18', 1, '', 3.30, '2015-01-05', 20, 'Cabochon en verre de taille 18mm', 'Très bon produit', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

CREATE TABLE IF NOT EXISTS `type_produit` (
  `id_type_produit` int(11) NOT NULL AUTO_INCREMENT,
  `tp_nom` varchar(255) NOT NULL COMMENT 'Nom du type de produit',
  `tp_description` text NOT NULL COMMENT 'Description du type de produit',
  PRIMARY KEY (`id_type_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `type_produit`
--

INSERT INTO `type_produit` (`id_type_produit`, `tp_nom`, `tp_description`) VALUES
(1, 'Cabochon', 'Cabochon :\r\n\r\nProduit qui permet de faire un effet loupe sur un dessin.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

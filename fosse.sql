-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 mai 2019 à 22:12
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fosse`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `pseudo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `prenom`, `pseudo`) VALUES
(1, 'Dang', 'Kévin', 'SéraphimKefka'),
(2, 'Qu', 'Julien', 'yulsrw');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `idAuteur` int(11) NOT NULL,
  `titre` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `paragraphe` text NOT NULL,
  PRIMARY KEY (`idArticle`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `idAuteur`, `titre`, `image`, `paragraphe`) VALUES
(3, 9, '[Sekiro]: Débat sur sa difficulté', 'sekiro.jpg', 'Voir les débats sur la difficulté de Sekiro Shadows Die Twice nous donne envie de sortir le pop-corn. D\'un côté, se trouvent des joueurs qui ont acheté un jeu en sachant pertinemment qu\'il allait être très difficile, puis qui se plaignent qu\'il est trop difficile. De l\'autre, des joueurs hardcore considèrent que Sekiro est en mode facile par défaut, et qu\'il faut jouer en NG+ avec la Cloche démoniaque et en ayant rendu le Talisman de Kuro pour goûter à la véritable expérience qu\'il a à proposer (avec celui de son propre sang, probablement).\r\n\r\nMême si le jeu est à la fois plus accessible et grand public que ses prédécesseurs, de toute évidence, FromSoftware n\'était pas encore prêt à aller jusqu\'à proposer des modes de difficulté directement accessibles à la création d\'une partie. Heureusement pour ceux qui rencontrent des difficultés qui semblent insurmontables, du moins sur PC, voici une première solution proposée par le mod Sekiro Fps Unlock And More disponible sur Nexusmods.com. Celui-ci propose différentes options vidéo et graphiques qui faisaient défaut au jeu, ainsi que des statistiques sur vos performances, mais surtout, une option pour rendre Sekiro plus facile en ralentissant l\'intégralité du jeu, joueur comme ennemis, entre autres choses.'),
(8, 9, '[Notre-Dame]: Ubisoft rend hommage à Notre-Dame', 'notredame.jpg', 'Suite au terrible incendie qui a touché la cathédrale Notre-Dame de Paris, Ubisoft avait décidé d\'offrir temporairement Assassin\'s Creed Unity. Eh bien, si l\'on en croit le Hollywood Reporter, l\'opération a été une totale réussite. En effet, le jeu aurait été téléchargé plus de trois millions de fois, sachant que la proposition ne concernait que la version PC. Le geste de l\'éditeur français a été fortement apprécié donc, et ceux qui n\'avaient pas encore eu l\'occasion de se glisser dans la peau d\'Arno (le héros du jeu) ont ainsi pu découvrir le monument à l\'échelle 1:1.\r\n\r\nPour mémoire, Ubisoft a également signé un chèque de 500 000€ afin de participer à la restauration de la célèbre cathédrale.\r\n'),
(9, 9, ' [Kingdom Come: Deliverance]: Accusation de racisme', 'kingdom.jpg', 'Le jeu Kingdom Come: Deliverance a été victime d’une campagne l’accusant de racisme sous prétexte qu’on n’y trouve pas de personnages « de couleurs ». Cette polémique est une sorte de postface ridicule après les débats hystériques autour du mot-clef #gamergate en 2014. C’est une illustration très précise de comment les positionnements postmodernes ont littéralement pourris le camp des progressistes de l’intérieur et brouillent les pistes par rapport aux réactionnaires.\r\nQuand on est à Gauche, lorsque l’on parle d’une œuvre culturelle, soit l’on considère qu’elle fait partie du problème, c’est-à-dire des choses qu’il faut changer dans la société, soit l’on considère qu’elle va dans le bon sens, c’est-à-dire qu’elle fait partie des choses positives aidant le monde à être meilleure.\r\n\r\nSi nous avons mis en avant Kingdom Come: Deliverance dans une comparaison au jeu Red Dead Redemption 2, c’est précisément selon cette considération que le premier va dans le bon sens contrairement au second qui représente tout un tas de choses négatives.\r\n\r\nRien que le fait d’avoir fait un jeu réaliste selon une trame historique précise et détaillée, avec une interface de jeu aboutie, profonde, est un marqueur progressiste. C’est une volonté d’appartenir au champ des productions culturelles qui élèvent le niveau, qui sont intelligentes, qui relèvent du savoir et pas de la consommation passive et improductive.'),
(10, 9, '[Polémique]: Les jeux vidéos sont-ils sexistes?', 'tombraider.jpg', 'Selon les premières estimations du Syndicat national du jeu vidéo communiquées à l\'AFP avant leur présentation le 12 décembre au groupe d\'études sur le jeu vidéo à l\'Assemblée nationale, la proportion de femmes est en légère hausse par rapport à 2017, après trois années de baisse : 13,5% des effectifs des studios de développement de jeux vidéo en France. Première explication de la faible part des femmes : dans les écoles qui forment aux jeux vidéo, elles représentent moins d\'un quart des étudiants. « C\'est à la fois une industrie créative et une industrie de la tech et donc un double fardeau pour les femmes qui ont du mal à évoluer dans ces milieux », analyse Audrey Leprince, fondatrice de l\'association Women in Games qui a mobilisé 900 membres en un an, dont beaucoup d\'étudiantes. Selon Christine Burgess-Quémard, directrice exécutive des studios d\'Ubisoft, qui comptent 21% de femmes, la formation de créatrices de jeux « va prendre du temps », tout comme le démontage des stéréotypes sexistes. « C\'est bien de réussir à injecter plus de femmes dans le secteur, mais il faut faire en sorte qu\'elles y restent en instaurant un climat \"safe\" dans les entreprises, pour éviter de reproduire l\'ambiance \"vestiaires\" qui y règne », relève Clémentine Plissonnier, conceptrice de jeux qui a rejoint l\'association « le Rassemblement inclusif du jeu vidéo » après plusieurs expériences dans des équipes masculines.'),
(12, 9, '[Sondage] Le jeu vidéo est-il un art ?', 'horizoon.jpg', 'Le jeu vidéo peut-il être considéré comme un art ? Cette question, qui se pose de plus en plus, a ses défenseurs comme ses détracteurs. Pour l’ancienne Ministre de la Culture, Françoise Nyssen (remplacée, depuis, par Franck Riester), il ne fait aucun doute que le média « est un art comme les autres, faisant partie de notre culture » mais la réalité, ou en tout cas l’image que nous renvoie ce divertissement, est plus complexe. Si les débats sur internet font rage, avec parfois quelques envolées philosophiques, nous avons choisi, pour ce papier, une autre approche : celle de donner la parole aux joueurs et aux développeurs pour confronter les avis de chacun. Alors, le jeu vidéo est-il un art ? Voici une part de réponse.\r\n\r\nSi le jeu vidéo a tous les atouts pour devenir l’art du XXIème siècle, il n’en demeure pas moins catalogué par une large frange de la population. En 2016, une étude financée par le ministère de la culture a démontré que seuls 7% des Français considèrent le jeu vidéo comme un objet culturel. Même si trois années ont passé depuis, il y a peu de chances pour que ce chiffre ait considérablement évolué et soit en passe de rattraper les autres formes de divertissement que sont les visites de musées/monuments (84%), la science (77%), les voyages (73%), la cuisine (62%), le théâtre (62%), la pratique d’un instrument de musique (53%) ou le cinéma (50%). Ainsi, pour la majorité de la population, tout ce qui touche aux jeux vidéo (ainsi qu’aux émissions de téléréalité et aux parcs d’attraction) est exclus du champ culturel par plus de cinq Français sur dix. On vous l’accorde, ça fait beaucoup. Mais les sondages n’étant pas toujours d’une précision d’orfèvre, voyons ce que vous en pensez…');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `pseudo` varchar(256) NOT NULL,
  `commentaire` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `idArticle`, `pseudo`, `commentaire`) VALUES
(1, 3, 'SéraphimKefka', 'Salut je trouve que c\'est un bonne article.'),
(7, 3, 'SéraphimKefka', 'Je suis tout a fait d\'accord.'),
(8, 3, 'yulsrw', 'Je ne suis pas d\'accord avec cet article, car étant un nouveau joueur de ce type de jeu, il n\'est pas si dur une fois qu\'on a comprit les mécaniques.'),
(9, 12, 'yulsrw', 'Pour moi le jeu vidéo est un art.'),
(10, 8, 'Diderot7', 'Un grand merci a Ubisoft, pour une fois qu\'ils font une bonne chose.');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL DEFAULT '',
  `prenom` varchar(256) NOT NULL DEFAULT '',
  `pseudo` varchar(256) NOT NULL DEFAULT '',
  `password` varchar(256) NOT NULL DEFAULT '',
  `mail` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `pseudo`, `password`, `mail`) VALUES
(1, 'Zhang', 'Johnny', 'KuroTenshi', '*2FA2217E22D91A58CCC5C1D19EE47BC087A0FEE5', 'johnnyzhang268@gmail.com'),
(5, 'Guijarro', 'Natacha', 'Tachou78', '$2y$10$BbX7smHpJA6RC6eCAbBLCuWPm42XrrTSly9QKPsYFZKxod5apOK5q', 'nat@gmail.com'),
(6, 'Lothsavan', 'kevin', 'faucheur1998', '$2y$10$xlwXlAkktDzDojjdQXqR7e4i9N.lRanW8WUNNioDVfdAPoPSotfp6', 'kevinlothsavan@gmail.com\r\n'),
(7, 'la meilleure', 'Laëtitia', 'laplusbelle2000', '$2y$10$trsk/xU1ryyLgzrE3jtTC.iD8Vk3j7livLFy1ptoh/FpRdHHrgK8y', 'bensimoncervanteslaetitia@gmail.com'),
(8, 'DU', 'Vincent', 'Shindeiru', '$2y$10$1L16k/GIryCYs8LBk7.1mumt8g2UVB8dMB8.06/j3bxi38r486guy', 'vincent@hotmail.fr'),
(10, 'Dang', 'Kevin', 'SéraphimKefka', '$2y$10$39q6t6Ds4xtNDiGPOQh9I.22q/QM6rt7e3iCmuiS1NxhhQmUM1htu', 'kevindang@hotmail.fr'),
(12, 'Diderot', 'Denis', 'Diderot7', '$2y$10$Zzd.0zk3oW4qP8P4T2VuL.SiTQcuBagNljjNSZg56TSZIeVTu4xFW', 'denis@univ-paris-diderot.fr'),
(13, 'Descartes', 'Rene', 'Descartes5', '$2y$10$V0K0F272tPiEpLpMvA3Lne6s.sR4Ii3z89lnXfo2rGssLlWf5CqTm', 'descartes@univ-paris-descartes.fr'),
(14, 'Qu', 'Julien', 'yulsrw', '$2y$10$kIRqDhcQj21pyDdRK1ryhuxlZtZ7p1E0fUA26ipwQG4IkwkW8xNgu', 'yulsrw@gmail.com'),


-- --------------------------------------------------------

--
-- Structure de la table `moderateurs`
--

DROP TABLE IF EXISTS `moderateurs`;
CREATE TABLE IF NOT EXISTS `moderateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `pseudo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `moderateurs`
--

INSERT INTO `moderateurs` (`id`, `nom`, `prenom`, `pseudo`) VALUES
(1, 'DU', 'Vincent', 'Shindeiru'),
(2, 'Diderot', 'Denis', 'Diderot7');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

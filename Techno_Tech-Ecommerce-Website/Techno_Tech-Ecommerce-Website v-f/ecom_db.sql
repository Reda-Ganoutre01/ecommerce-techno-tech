-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 avr. 2024 à 20:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecom_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(2, 'admin2', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_Categorie` int(11) NOT NULL,
  `nom_Categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_Categorie`, `nom_Categorie`) VALUES
(1, 'PC PORTABLE'),
(2, 'Souris'),
(3, 'CLAVIER'),
(4, 'Ecran Gamer'),
(5, 'CASQUE');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(50) NOT NULL,
  `email_client` varchar(50) NOT NULL,
  `mod_pass_client` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `email_client`, `mod_pass_client`) VALUES
(1, 'adnanne', 'aryf@gmail.com', '$2y$10$BrXDdy8HA/PKJ17GPjRkKeuOaM4.POPXlrMNpKmypjA'),
(4, 'armani', 'armani@gmail.com', 'didi2023'),
(5, 'redaa', 'reda@gmail.com', 'reda1234'),
(6, 'saadmoltoon', 'saad@gmail.com', 'saad1234'),
(7, 'firstclient', 'first@gmail.com', 'first1234'),
(8, 'reda1234', 'dadada@GMAIL.COM', 'reda1234');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `id_client` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prix` int(30) NOT NULL,
  `description` varchar(400) NOT NULL,
  `nbr_star` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `Nom_categorie` varchar(50) NOT NULL,
  `img` varchar(400) NOT NULL,
  `quantite_en_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `nbr_star`, `top`, `Nom_categorie`, `img`, `quantite_en_stock`) VALUES
(10, 'Logitech G502 Hero', 449, 'La souris Logitech G502 Hero vous permet d’explorer de nouvelles dimensions du gaming. Cette souris possède un capteur optique de pointe qui peut atteindre une résolution maximale de 25600 dpi, ce qui garantit une précision remarquable dans chaque mouvement. Les 11  boutons programmables vous permettent de personnaliser votre expérience de gaming pour un contrôle optimal.\r\n\r\nLa Logitech G502 Hero ', 5, 10, 'Souris', 'images/img_Products/1.png', 40),
(11, 'Logitech G102 LightSync RGB (Noir)', 229, 'Pour les passionnés de gaming, la souris Logitech G102 LightSync RGB en noir est la meilleure option. Elle possède un capteur optique de 8000 DPI et offre une précision remarquable. Elle s’adapte à votre style de jeu avec 6 boutons programmables. Le rétro-éclairage RGB personnalisable donne à l’ambiance une touche esthétique.\r\n\r\nElle an un design ergonomique de 116,6 x 62,2 x 38,2 mm et un poids l', 5, 10, 'Souris', 'images/img_Products/2.png', 30),
(12, 'RAZER DeathAdder Essential (Noir)', 349, 'écouvrez la souris Razer DeathAdder Essential (Noir), conçue pour vous offrir une expérience de gaming sans précédent. Cette souris dispose d’un capteur optique de 6400 dpi, ce qui garantit une précision exceptionnelle pour répondre avec une grande finesse à vos mouvements les plus rapides. Ses 5 boutons programmables vous permettent de personnaliser votre configuration pour s’adapter parfaitement', 4, 10, 'Souris', 'images/img_Products/3.png', 40),
(13, 'Razer Blackshark V2 X (Noir)', 659, 'Le casque Razer Blackshark V2 X (Noir) vous permet d’améliorer votre expérience de gaming. Ce casque gamer circum-aural offre un son surround virtuel 7.1 afin que vous puissiez vous immerger complètement dans vos jeux préférés. Son design confortable et son couplage auriculaire englobant les oreilles vous permettent de gamer longtemps sans se fatiguer. Il est plus facile à utiliser grâce à sa conn', 4, 10, 'CASQUE', 'images/img_Products/4.png', 20),
(14, 'ASUS Ecran 24″ VG24VQ', 2850, 'ASUS Ecran 24 VG24VQ Marrakech Maroc\r\n\r\nASUS TUF VG24VQ : La victoire s’inscrit dans votre quotidien\r\nASUS Ecran 24 VG24VQ Marrakech Maroc\r\n\r\nL’heure du combat est toute proche ! Armez-vous avec le moniteur ASUS TUF VG24VQ et mettez toutes les chances de votre côté pour sortir grand vainqueur de cet affrontement ! Cet écran incurvé Full HD à dalle VA de 23.6 pouces possède de sérieux arguments en ', 4, 10, 'Ecran Gamer', 'images/img_Products/5.png', 50),
(15, 'AOC 31.5″ LED – C32G2ZE', 3549, 'AOC 32 C32G2ZE\r\nLa gloire est toute proche avec AOC\r\nPréparez-vous pour les échéances à venir en intégrant dans votre arsenal le moniteur AOC C32G2ZE ! Ce modèle incurvé 240 Hz à dalle VA de 31.5 pouces possède toutes les qualités pour vous mener directement vers la victoire.Bénéficiez d’un temps de réponse ultra-rapide, appréciez le travail de la technologie AMD FreeSync Premium et mettez toutes ', 4, 9, 'Ecran Gamer', 'images/img_Products/6.png', 20),
(16, 'ASUS 24 LED – VZ24EHE', 1580, 'Finesse suprême, design sans bordures\r\nLe ASUS VZ24EHE possède un design compact avec un profil de 6,5 mm seulement à son point le plus fin. Son design sans bord est idéal pour une installation à plusieurs écrans qui vous offrira un niveau d’immersion encore plus grand. Sa dalle IPS présente un angle de vision large à 178°.\r\nDe plus, la technologie ASUS Eye Care assure le confort de vos yeux devan', 3, 9, 'Ecran Gamer', 'images/img_Products/7.png', 40),
(18, 'CONNECT 32C1G 31.5', 2490, 'L’écran gamer CONNECT 32C1G 31.5″ vous permet d’explorer de nouveaux horizons visuels. Sa technologie de dalle VA vous plonge au cœur de l’action avec des couleurs éclatantes et des angles de vision étendus. La résolution FHD de 1920 x 1080 et la fréquence verticale maximale de 165 Hz et le temps de réponse ultra-rapide de 1 ms garantissent une expérience de gaming fluide et réactive.\r\n\r\nAvec ses ', 4, 9, 'Ecran Gamer', 'images/img_Products/8.png', 10),
(19, 'MSI Optix 27 G27C4X', 2690, 'Découvrez l’écran gamer MSI Optix 27 G27C4X, qui est conçu pour offrir une expérience de gaming interactive et efficace. Ce moniteur de 27 pouces avec une résolution Full HD de 1920 x 1080 pixels vous plonge au cœur de l’action avec des détails nets et précis. La courbure incurvée offre une expérience visuelle enveloppante, tandis que la dalle VA offre des couleurs vibrantes et des contrastes rich', 4, 9, 'Ecran Gamer', 'images/img_Products/10.png', 40),
(20, 'ASUS 27″ LED – TUF VG27AQML1A', 5499, 'L’écran gamer ASUS 27″ LED – TUF VG27AQML1A, un bijou de technologie destiné aux passionnés de jeux vidéo, vous permet de plonger au cœur de l’action. Sa résolution remarquable de 2560 x 1440 pixels offre des détails cristallins et son temps de réponse exceptionnellement rapide de 1 ms élimine tout flou de mouvement. Cet écran, doté d’une dalle Fast  IPS rapide, offre des angles de vision étendus ', 5, 9, 'Ecran Gamer', 'images/img_Products/9.png', 20),
(21, 'MSI GS66 Stealth 12UHS', 23990, 'Profitez de hautes performances de jeu grâce au PC portable MSI Raider GE67 HX 12UGS ! Conçu pour les gamers, cet ordinateur portable MSI bénéficie d’un design au look moderne à l’esthétique soignée.\r\nAvec sa conception Gamer, ses composants performants et son écran OLED QHD 240 Hz.Le PC portable MSI Raider GE67 HX 12UGS-043FR dévoile d’excellentes performances grâce à son processeur Intel Core i9', 3, 8, 'PC PORTABLE', 'images/img_Products/11.png', 4),
(22, 'MSI KATANA GF66 12UE-1203XES', 12990, 'Performances de jeu avec NVIDIA GeForce RTX 3060\r\nL’ordinateur portable gamer MSI GF66 Katana 12UE allie performance et mobilité. Idéal pour les gamers, il bénéficie d’un écran 144 Hz, d’un clavier Gamer rétro-éclairé, d’un système audio de qualité et d’un puissant système de refroidissement. Le PC portable MSI Katana GF66 12UE-850FR offre des performances et une fluidité élevées grâce à un proces', 4, 9, 'PC PORTABLE', 'images/img_Products/12.png', 5),
(23, 'Asus Rog Strix Scar G733ZW-LL05W', 11990, 'Confort et hautes performances avec un écran WQHD 240 Hz\r\nLe PC Portable Gaming ASUS ROG STRIX SCAR 17 vous permettra de jouer dans les meilleurs conditions à vos jeux PC favoris grâce à des composants ultra-performants, un écran 240 Hz et une conception haut de gamme qui ne laisse rien au hasard.\r\nLe PC portable Gamer ASUS ROG STRIX SCAR 17 G733ZW-LL05W offre de hautes performances grâce à son pr', 5, 9, 'PC PORTABLE', 'images/img_Products/13.png', 5),
(24, 'Asus Rog Strix Scar G733ZW-LL05W', 12900, 'Confort et hautes performances avec un écran WQHD 240 Hz\r\nLe PC Portable Gaming ASUS ROG STRIX SCAR 17 vous permettra de jouer dans les meilleurs conditions à vos jeux PC favoris grâce à des composants ultra-performants, un écran 240 Hz et une conception haut de gamme qui ne laisse rien au hasard.\r\nLe PC portable Gamer ASUS ROG STRIX SCAR 17 G733ZW-LL05W offre de hautes performances grâce à son pr', 4, 9, 'PC PORTABLE', 'images/img_Products/14.png', 3),
(25, 'DELL XPS 15 9510', 18900, 'Dell XPS 15 9510 : Stimulez votre pouvoir créatif\r\nLe PC portable Dell XPS 15 9510 constitue le parfait équilibre entre taille et performances pour des projets créatifs. Avec son design soigné, son écran 16/10 lumineux, ses composants performants et ses 2 connecteurs Thunderbolt 4, cet ordinateur portable est tourné vers la performance et la créativité. Avec un processeur Intel Core i7-11800H, 16 ', 4, 9, 'PC PORTABLE', 'images/img_Products/15.png', 5),
(26, 'MSI Crosshair 17', 26990, 'Un compagnon de Gaming ultra-performant !\r\nMettez toutes les chances de votre côté avec l’ordinateur portable MSI Crosshair 17 ! Ce PC portable Gaming offre un confort de jeu supérieur notamment grâce à ses composants haut de gamme, son écran Full HD avec fréquence de 360 Hz et son clavier Gamer rétroéclairé. Le PC portable MSI Crosshair 17 B12UGSZ-036FR offre de hautes performances grâce à son pr', 4, 9, 'PC PORTABLE', 'images/img_Products/16.png', 5),
(27, 'Razer Ornata V3', 849, 'e clavier Razer Ornata V3, une fusion idéale entre la réactivité d’un clavier et le confort d’un clavier à membrane, est l’innovation du gaming. Avec sa connexion filaire, vous bénéficiez d’une expérience de gaming ultra-réactive avec une latence minimale. Les touches méca-membrane offrent une sensation tactile agréable en combinant les deux. Pour personnaliser votre configuration, utilisez le rét', 5, 9, 'CLAVIER', 'images/img_Products/17.png', 10),
(28, 'STEP-ONE Mechanical Keyboard', 375, 'La légende continue\r\nPrenez l’ascendant sur tous vos adversaires grâce au STEP-ONE. Testé par des professionnels de l’e-sport, il est doté de switches Red et bénéficie de la technologie d’hyper-traitement pour une transmission des entrées jusqu’à 8x plus rapidement que les claviers gaming traditionnels. Il dispose en plus d’un rétro-éclairage RGB personnalisable pour vous aider à le personnaliser ', 5, 8, 'CLAVIER', 'images/img_Products/21.png', 5),
(29, 'Razer Ornata V3 X', 499, 'e clavier gamer Razer Ornata V3 X est une véritable révolution dans le domaine du gaming. Ce clavier filaire a été spécialement conçu pour vous offrir une expérience de gaming incroyablement immersive et efficace. Le Ornata V3 X dispose d’un rétroéclairage RGB personnalisable pour donner à votre espace de gaming une touche visuelle impressionnante. Les touches à membrane vous offrent un avantage c', 4, 9, 'CLAVIER', 'images/img_Products/19.png', 5),
(30, 'Spirit of Gamer Pro-K5', 249, 'Le clavier gamer Spirit of Gamer Pro-K5 est un équipement indispensable pour les passionnés de jeux vidéo. Ce clavier dispose d’une connectivité filaire pour une réponse rapide pour des performances de gaming optimales. Les touches méca-membrane offrent une expérience de frappe exceptionnelle en combinant la réactivité des claviers mécaniques avec la souplesse des touches à membrane. La dispositio', 3, 5, 'CLAVIER', 'images/img_Products/20.png', 20),
(31, 'Spirit of Gamer Xpert-K700', 699, 'Le clavier Spirit of Gamer Xpert-K700, conçu pour les passionnés de gaming, vous permet d’explorer de nouvelles dimensions de jeu. Ce clavier mécanique propose une connexion filaire pratique avec un câble de 1,80 mètre pour une expérience de gaming immersive.\r\n\r\nLes commutateurs Victory Red offrent une réactivité exceptionnelle tout en augmentant la précision et la vitesse. Créez une atmosphère de', 5, 9, 'CLAVIER', 'images/img_Products/18.png', 12),
(32, 'Razer Blackshark V2 X (Green)', 659, 'Le casque Razer Blackshark V2 X (Green) vous permet d’améliorer votre expérience de gaming. Ce casque gamer circum-aural offre un son surround virtuel 7.1 afin que vous puissiez vous immerger complètement dans vos jeux préférés. Son design confortable et son couplage auriculaire englobant les oreilles vous permettent de gamer longtemps sans se fatiguer. Il est plus facile à utiliser grâce à sa con', 5, 8, 'CASQUE', 'images/img_Products/23.png', 5),
(33, 'COOLER MASTER CH321', 329, 'Le casque Cooler Master CH321 est un excellent casque stéréo qui enveloppe vos oreilles et vous emmène au cœur de votre univers de gaming. Ce casque gamer filaire dispose d’un couplage auriculaire circum-aural pour un confort optimal et dispose d’un câble de 2,3 mètres pour une connectivité pratique via USB. Profitez d’une qualité sonore supérieure tout en vous immergeant complètement dans vos jeu', 5, 8, 'CASQUE', 'images/img_Products/22.png', 5),
(34, 'LOGITECH G733 Lightspeed Wireless RGB', 1780, 'Le casque gamer Logitech G733 Lightspeed présente de sérieux atouts pour vous aider à triompher dans vos affrontements au quotidien. Très confortable, il est équipé d’un son surround DTS\r\n\r\nHeadphone:X 2.0 pour un rendu 7.1 virtuel d’une grande qualité. Vivez une immersion hors du commun dans tous vos jeux favoris ! Percevez les mouvements de vos adversaires dans l’espace pour anticiper leurs acti', 5, 9, 'CASQUE', 'images/img_Products/26.png', 22),
(35, 'LOGITECH G733 Lightspeed RGB Lilac', 1780, 'Affirmez votre style Avec le micro-casque Logitech G733, vous disposez d’un casque spécialement conçu pour un confort inégalé. Doté du son surround DTS Headphone:X 2.0, ce dernier crée une précision positionnelle exceptionnelle en jeu pour que vous puissiez entendre vos ennemis se faufiler derrière vous et ainsi anticipez leurs attaques.\r\n\r\nQuant au rétro-éclairage Lightsync RGB entièrement person', 5, 9, 'CASQUE', 'images/img_Products/25.png', 2),
(36, 'Logitech G G733 Lightspeed (Blanc)', 1799, 'Entrez dans la légende\r\nAvec le micro-casque Logitech G733, vous disposez d’un casque spécialement conçu pour un confort inégalé. Doté du son surround DTS Headphone:X 2.0, ce dernier crée une précision positionnelle exceptionnelle en jeu pour que vous puissiez entendre vos ennemis se faufiler derrière vous et ainsi anticipez leurs attaques. Quant au rétro-éclairage Lightsync RGB entièrement person', 4, 9, 'CASQUE', 'images/img_Products/24.png', 5),
(37, 'RAPOO V16RGB', 129, 'La RAPOO V16RGB est un outil de gaming de haute performance conçu pour répondre aux besoins des gamers exigeants, bien plus qu’une simple souris. Son capteur optique peut atteindre une résolution de 12800 dpi, ce qui garantit une précision remarquable dans chaque mouvement. Les 5 boutons programmables vous permettent de personnaliser votre gaming selon vos préférences.\r\n\r\nDe plus, cette souris an ', 3, 6, 'Souris', 'images/img_Products/27.png', 5),
(38, 'Logitech MX Master 3S (Graphite)', 1190, 'a souris Logitech MX Master 3S (Graphite) est l’innovation la plus récente dans le domaine de l’informatique. Elle offre une précision exceptionnelle pour une navigation fluide et réactive grâce à son capteur optique de 8000 dpi. Cette souris, dotée de sept boutons entièrement personnalisables, peut répondre à vos besoins professionnels ou ludiques.\r\n\r\nSon design ergonomique permet une prise en ma', 4, 7, 'Souris', 'images/img_Products/28.png', 4),
(39, 'RAPOO V16', 99, 'La souris gamer RAPOO V16 offre une expérience de gaming exceptionnelle avec son capteur optique offrant une résolution maximale de 2000 dpi. Elle combine style et fonctionnalité pour répondre aux besoins des gamers exigeants, avec un rétro-éclairage attrayant. Avec ses 5 boutons, cette souris offre une précision et une réactivité optimales dans toutes les situations de gaming.\r\n\r\nPesant 112 g et ', 3, 5, 'Souris', 'images/img_Products/29.png', 5),
(40, 'Razer Cobra', 579, 'La souris gamer Razer Cobra, une véritable merveille de technologie conçue pour les passionnés de jeux, vous permet d’explorer de nouveaux horizons dans le gaming. Cette souris gamer dispose d’un capteur optique d’une résolution maximale de 8500 dpi, offrant une expérience de gaming immersive et réactive. Les 6 boutons programmables vous permettent de maximiser la personnalisation en configurant l', 5, 9, 'Souris', 'images/img_Products/30.png', 4);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `produit_nom` varchar(60) NOT NULL,
  `produit_img` varchar(400) NOT NULL,
  `pourcentage_reduction` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id`, `produit_id`, `produit_nom`, `produit_img`, `pourcentage_reduction`, `date_debut`, `date_fin`) VALUES
(2, 14, 'ASUS Ecran 24″ VG24VQ', 'images/img_Products/5.png', 12, '2024-03-12', '2024-03-31'),
(3, 13, 'Razer Blackshark V2 X', 'images/img_Products/4.png', 10, '2024-03-12', '2024-03-31'),
(4, 15, 'AOC 31.5″ LED – C32G2ZE', 'images/img_Products/6.png', 10, '2024-03-26', '2024-03-31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_Categorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Nom_categorie` (`Nom_categorie`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produit_id` (`produit_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_Categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `fk_produit_id` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

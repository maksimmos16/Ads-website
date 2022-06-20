<?php
	
	global $wpdb;
	$prefix = $wpdb->prefix;
	
	//terms table
	$wpdb->query("TRUNCATE TABLE `".$prefix."terms`");
	$wpdb->query("INSERT INTO `".$prefix."terms` (`term_id`, `name`, `slug`, `term_group`, `term_order`) VALUES
	(1, 'Uncategorized', 'uncategorized', 0, 0),
	(2, 'USA', 'usa', 0, 0),
	(3, 'Alabama', 'alabama', 0, 0),
	(4, 'Alaska', 'alaska', 0, 0),
	(5, 'Arkansas', 'arkansas', 0, 0),
	(6, 'Arizona', 'arizona', 0, 0),
	(7, 'California', 'california', 0, 0),
	(8, 'Colorado', 'colorado', 0, 0),
	(9, 'Connecticut', 'connecticut', 0, 0),
	(10, 'Delaware', 'delaware', 0, 0),
	(11, 'District of Columbia', 'district-of-columbia', 0, 0),
	(12, 'Florida', 'florida', 0, 0),
	(13, 'Georgia', 'georgia', 0, 0),
	(14, 'Hawaii', 'hawaii', 0, 0),
	(15, 'Idaho', 'idaho', 0, 0),
	(16, 'Illinois', 'illinois', 0, 0),
	(17, 'Indiana', 'indiana', 0, 0),
	(18, 'Iowa', 'iowa', 0, 0),
	(19, 'Kansas', 'kansas', 0, 0),
	(20, 'Kentucky', 'kentucky', 0, 0),
	(21, 'Louisiana', 'louisiana', 0, 0),
	(22, 'Maine', 'maine', 0, 0),
	(23, 'Maryland', 'maryland', 0, 0),
	(24, 'Massachusetts', 'massachusetts', 0, 0),
	(25, 'Michigan', 'michigan', 0, 0),
	(26, 'Minnesota', 'minnesota', 0, 0),
	(27, 'Mississippi', 'mississippi', 0, 0),
	(28, 'Missouri', 'missouri', 0, 0),
	(29, 'Montana', 'montana', 0, 0),
	(30, 'Nebraska', 'nebraska', 0, 0),
	(31, 'Nevada', 'nevada', 0, 0),
	(32, 'New Hampshire', 'new-hampshire', 0, 0),
	(33, 'New Jersey', 'new-jersey', 0, 0),
	(34, 'New Mexico', 'new-mexico', 0, 0),
	(35, 'New York', 'new-york', 0, 0),
	(36, 'North Carolina', 'north-carolina', 0, 0),
	(37, 'North Dakota', 'north-dakota', 0, 0),
	(38, 'Ohio', 'ohio', 0, 0),
	(39, 'Oklahoma', 'oklahoma', 0, 0),
	(40, 'Oregon', 'oregon', 0, 0),
	(41, 'Pennsylvania', 'pennsylvania', 0, 0),
	(42, 'Rhode Island', 'rhode-island', 0, 0),
	(43, 'South Carolina', 'south-carolina', 0, 0),
	(44, 'South Dakota', 'south-dakota', 0, 0),
	(45, 'Tennessee', 'tennessee', 0, 0),
	(46, 'Texas', 'texas', 0, 0),
	(47, 'Utah', 'utah', 0, 0),
	(48, 'Vermont', 'vermont', 0, 0),
	(49, 'Virginia', 'virginia', 0, 0),
	(50, 'Washington state', 'washington-state', 0, 0),
	(51, 'West Virginina', 'west-virginina', 0, 0),
	(52, 'Wisconsin', 'wisconsin', 0, 0),
	(53, 'Wyoming', 'wyoming', 0, 0),
	(54, 'main', 'main', 0, 0),
	(141, 'Rent', 'rent', 0, 0),
	(142, 'Ofiice', 'ofiice', 0, 0),
	(143, 'Laptop', 'laptop', 0, 0),
	(144, 'sale', 'sale', 0, 0),
	(145, 'accountant', 'accountant', 0, 0),
	(146, 'beauty products', 'beauty-products', 0, 0),
	(147, 'events', 'events', 0, 0),
	(148, 'doctor', 'doctor', 0, 0),
	(149, 'house cleaning', 'house-cleaning', 0, 0),
	(150, 'Ads', 'ads', 0, 0),
	(151, 'Classified', 'classified', 0, 0),
	(152, 'Classiadspro', 'classiadspro', 0, 0),
	(153, 'News', 'news', 0, 0),
	(154, 'cars', 'cars', 0, 0),
	(155, 'fastest cars', 'fastest-cars', 0, 0),
	(156, 'new cars', 'new-cars', 0, 0),
	(157, 'car on rent', 'car-on-rent', 0, 0),
	(158, 'car loan', 'car-loan', 0, 0),
	(159, 'Group TOUR', 'group-tour', 0, 0),
	(160, 'Travel', 'travel', 0, 0),
	(161, 'USA', 'usa', 0, 0),
	(162, 'hotels', 'hotels', 0, 0),
	(163, 'resturants', 'resturants', 0, 0),
	(164, 'premium traveling', 'premium-traveling', 0, 0),
	(165, 'tour guide', 'tour-guide', 0, 0),
	(166, 'children', 'children', 0, 0),
	(167, 'event', 'event', 0, 0),
	(168, 'reality show', 'reality-show', 0, 0),
	(169, 'New Business', 'new-business', 0, 0),
	(170, 'business', 'business', 0, 0),
	(171, 'mobile for sale', 'mobile-for-sale', 0, 0),
	(172, 'tv for sale', 'tv-for-sale', 0, 0),
	(173, 'dvd for sale', 'dvd-for-sale', 0, 0),
	(174, 'tv repair', 'tv-repair', 0, 0),
	(175, 'Ac repairing', 'ac-repairing', 0, 0),
	(176, 'lcd', 'lcd', 0, 0),
	(177, 'lcd for sale', 'lcd-for-sale', 0, 0),
	(178, 'fashion', 'fashion', 0, 0),
	(179, 'make over', 'make-over', 0, 0),
	(180, 'beauty', 'beauty', 0, 0),
	(181, 'products', 'products', 0, 0),
	(182, 'hospital', 'hospital', 0, 0),
	(183, 'hotel for sale', 'hotel-for-sale', 0, 0),
	(184, 'for sale', 'for-sale', 0, 0),
	(185, 'land for sale', 'land-for-sale', 0, 0),
	(186, 'house for sale', 'house-for-sale', 0, 0),
	(187, 'farm house', 'farm-house', 0, 0),
	(194, 'canada', 'canada', 0, 0),
	(195, 'china', 'china', 0, 0),
	(196, 'United Kingdom', 'united-kingdom', 0, 0),
	(197, 'simple', 'simple', 0, 0),
	(198, 'grouped', 'grouped', 0, 0),
	(199, 'variable', 'variable', 0, 0),
	(200, 'external', 'external', 0, 0),
	(201, 'custom menu1', 'custom-menu1', 0, 0),
	(202, 'Australia', 'australia', 0, 0),
	(203, 'Pakistan', 'pakistan', 0, 0),
	(204, 'India', 'india', 0, 0),
	(205, 'France', 'france', 0, 0),
	(206, 'KSA', 'ksa', 0, 0),
	(207, 'Italy', 'italy', 0, 0),
	(208, 'New Zealand', 'new-zealand', 0, 0),
	(209, 'Turkey', 'turkey', 0, 0),
	(210, 'shop', 'shop', 0, 0),
	(211, 'laptop', 'laptop', 0, 0),
	(212, 'for sale', 'for-sale', 0, 0),
	(213, 'cars', 'cars', 0, 0),
	(214, 'mobiles', 'mobiles', 0, 0),
	(215, 'laptop', 'laptop', 0, 0),
	(216, 'bikes', 'bikes', 0, 0),
	(217, 'Fashion', 'fashion', 0, 0),
	(218, 'Clothing', 'clothing', 0, 0),
	(219, 'houses', 'houses', 0, 0),
	(220, 'pet', 'pet', 0, 0),
	(221, 'accounting', 'accounting', 0, 0),
	(222, 'hotels', 'hotels', 0, 0),
	(223, 'hotel', 'hotel', 0, 0),
	(224, 'booking', 'booking', 0, 0),
	(225, 'rent', 'rent', 0, 0),
	(226, 'sale', 'sale', 0, 0),
	(227, 'finance', 'finance', 0, 0),
	(228, 'services', 'services', 0, 0),
	(229, 'cleaning', 'cleaning', 0, 0),
	(230, 'pet', 'pet', 0, 0),
	(231, 'houses', 'houses', 0, 0),
	(232, 'dresses', 'dresses', 0, 0),
	(233, 'beauty', 'beauty', 0, 0),
	(234, 'bikes', 'bikes', 0, 0),
	(235, 'car', 'car', 0, 0),
	(236, 'mobile', 'mobile', 0, 0),
	(237, 'forsale', 'forsale', 0, 0),
	(238, 'listing_single', 'listing_single', 0, 0),
	(239, 'listings_package', 'listings_package', 0, 0),
	(240, 'teocosta', 'teocosta', 0, 0),
	(241, 'brazil', 'brazil', 0, 0),
	(242, 'corinthians', 'corinthians', 0, 0),
	(243, 'porsche', 'porsche', 0, 0),
	(244, 'exclude-from-search', 'exclude-from-search', 0, 0),
	(245, 'exclude-from-catalog', 'exclude-from-catalog', 0, 0),
	(246, 'featured', 'featured', 0, 0),
	(247, 'outofstock', 'outofstock', 0, 0),
	(248, 'rated-1', 'rated-1', 0, 0),
	(249, 'rated-2', 'rated-2', 0, 0),
	(250, 'rated-3', 'rated-3', 0, 0),
	(251, 'rated-4', 'rated-4', 0, 0),
	(252, 'rated-5', 'rated-5', 0, 0),
	(258, 'custom menu', 'custom-menu', 0, 0),
	(262, 'location sub level2', 'location-sub-level2', 0, 0),
	(265, 'Uncategorized', 'uncategorized', 0, 0),
	(266, 'German Shepherd for sale', 'german-shepherd-for-sale', 0, 0),
	(267, 'dog', 'dog', 0, 0),
	(268, 'asdfasd', 'asdfasd', 0, 0),
	(269, 'asdfasdf', 'asdfasdf', 0, 0),
	(270, 'Samsung', 'samsung', 0, 0),
	(271, 'Samsung Galaxy S8', 'samsung-galaxy-s8', 0, 0),
	(272, 'samsung galaxy s8 plus', 'samsung-galaxy-s8-plus', 0, 0),
	(273, 'phone for sale', 'phone-for-sale', 0, 0),
	(274, 'job', 'job', 0, 0),
	(275, 'Assistant job', 'assistant-job', 0, 0),
	(276, 'Accountant job', 'accountant-job', 0, 0),
	(277, 'Fish', 'fish', 0, 0),
	(319, 'Horses', 'horses', 0, 0),
	(420, 'Rabbits', 'rabbits', 0, 0),
	(518, 'Dog', 'dog', 0, 0),
	(688, 'Cats', 'cats', 0, 0),
	(754, 'Birds', 'birds', 0, 0),
	(772, 'horse', 'horse', 0, 0),
	(773, 'brooodmare', 'brooodmare', 0, 0),
	(774, 'pet', 'pet', 0, 0),
	(775, 'Affenpinscher', 'affenpinscher', 0, 0),
	(776, 'pedigree', 'pedigree', 0, 0),
	(777, 'cat', 'cat', 0, 0),
	(778, 'Arctic Curl', 'arctic-curl', 0, 0),
	(779, 'fish', 'fish', 0, 0),
	(780, 'Piranhas', 'piranhas', 0, 0),
	(781, 'water life', 'water-life', 0, 0),
	(782, 'Alaska', 'alaska', 0, 0),
	(783, 'rabbit', 'rabbit', 0, 0),
	(784, 'poultry', 'poultry', 0, 0),
	(785, 'ducks', 'ducks', 0, 0),
	(786, 'Poultry Chickens', 'poultry-chickens', 0, 0),
	(787, 'hen', 'hen', 0, 0),
	(788, 'cock', 'cock', 0, 0),
	(789, 'snail', 'snail', 0, 0),
	(790, 'invertibrates', 'invertibrates', 0, 0),
	(791, 'turtle', 'turtle', 0, 0),
	(792, 'reptiles', 'reptiles', 0, 0),
	(793, 'mouse', 'mouse', 0, 0),
	(794, 'rodent', 'rodent', 0, 0),
	(795, 'mice', 'mice', 0, 0),
	(796, 'birds', 'birds', 0, 0),
	(797, 'owl', 'owl', 0, 0),
	(798, 'female', 'female', 0, 0),
	(799, 'woocommerce-db-updates', 'woocommerce-db-updates', 0, 0),
	(800, 'wc_update_product_lookup_tables', 'wc_update_product_lookup_tables', 0, 0),
	(801, 'page', 'page', 0, 0),
	(802, 'Havanese', 'havanese', 0, 0),
	(803, 'Male', 'male', 0, 0),
	(804, 'Goat', 'goat', 0, 0),
	(805, 'Monkey', 'monkey', 0, 0),
	(806, 'news', 'news', 0, 0),
	(807, 'pets', 'pets', 0, 0),
	(808, 'cat', 'cat', 0, 0),
	(809, 'dog', 'dog', 0, 0),
	(810, 'Footer01', 'footer01', 0, 0),
	(811, 'Category', 'category', 0, 0);");
	
	// term_taxonomy
	$wpdb->query("TRUNCATE TABLE `".$prefix."term_taxonomy`");
	$wpdb->query("INSERT INTO `".$prefix."term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
	(1, 1, 'category', '', 0, 0),
	(2, 2, 'directorypress-location', '', 0, 1),
	(3, 3, 'directorypress-location', '', 2, 0),
	(4, 4, 'directorypress-location', '', 2, 0),
	(5, 5, 'directorypress-location', '', 2, 1),
	(6, 6, 'directorypress-location', '', 2, 0),
	(7, 7, 'directorypress-location', '', 2, 0),
	(8, 8, 'directorypress-location', '', 2, 1),
	(9, 9, 'directorypress-location', '', 2, 0),
	(10, 10, 'directorypress-location', '', 2, 0),
	(11, 11, 'directorypress-location', '', 2, 0),
	(12, 12, 'directorypress-location', '', 2, 0),
	(13, 13, 'directorypress-location', '', 2, 0),
	(14, 14, 'directorypress-location', '', 2, 0),
	(15, 15, 'directorypress-location', '', 2, 0),
	(16, 16, 'directorypress-location', '', 2, 0),
	(17, 17, 'directorypress-location', '', 2, 0),
	(18, 18, 'directorypress-location', '', 2, 0),
	(19, 19, 'directorypress-location', '', 2, 0),
	(20, 20, 'directorypress-location', '', 2, 0),
	(21, 21, 'directorypress-location', '', 2, 0),
	(22, 22, 'directorypress-location', '', 2, 0),
	(23, 23, 'directorypress-location', '', 2, 0),
	(24, 24, 'directorypress-location', '', 2, 0),
	(25, 25, 'directorypress-location', '', 2, 0),
	(26, 26, 'directorypress-location', '', 2, 0),
	(27, 27, 'directorypress-location', '', 2, 0),
	(28, 28, 'directorypress-location', '', 2, 0),
	(29, 29, 'directorypress-location', '', 2, 0),
	(30, 30, 'directorypress-location', '', 2, 0),
	(31, 31, 'directorypress-location', '', 2, 0),
	(32, 32, 'directorypress-location', '', 2, 0),
	(33, 33, 'directorypress-location', '', 2, 0),
	(34, 34, 'directorypress-location', '', 2, 0),
	(35, 35, 'directorypress-location', '', 2, 0),
	(36, 36, 'directorypress-location', '', 2, 0),
	(37, 37, 'directorypress-location', '', 2, 0),
	(38, 38, 'directorypress-location', '', 2, 0),
	(39, 39, 'directorypress-location', '', 2, 0),
	(40, 40, 'directorypress-location', '', 2, 0),
	(41, 41, 'directorypress-location', '', 2, 0),
	(42, 42, 'directorypress-location', '', 2, 0),
	(43, 43, 'directorypress-location', '', 2, 0),
	(44, 44, 'directorypress-location', '', 2, 0),
	(45, 45, 'directorypress-location', '', 2, 0),
	(46, 46, 'directorypress-location', '', 2, 0),
	(47, 47, 'directorypress-location', '', 2, 0),
	(48, 48, 'directorypress-location', '', 2, 0),
	(49, 49, 'directorypress-location', '', 2, 0),
	(50, 50, 'directorypress-location', '', 2, 0),
	(51, 51, 'directorypress-location', '', 2, 0),
	(52, 52, 'directorypress-location', '', 2, 0),
	(53, 53, 'directorypress-location', '', 2, 0),
	(54, 54, 'nav_menu', '', 0, 3),
	(141, 141, 'directorypress-tag', '', 0, 0),
	(142, 142, 'directorypress-tag', '', 0, 0),
	(143, 143, 'directorypress-tag', '', 0, 0),
	(144, 144, 'directorypress-tag', '', 0, 0),
	(145, 145, 'directorypress-tag', '', 0, 0),
	(146, 146, 'directorypress-tag', '', 0, 0),
	(147, 147, 'directorypress-tag', '', 0, 0),
	(148, 148, 'directorypress-tag', '', 0, 0),
	(149, 149, 'directorypress-tag', '', 0, 0),
	(150, 150, 'post_tag', '', 0, 0),
	(151, 151, 'post_tag', '', 0, 0),
	(152, 152, 'post_tag', '', 0, 0),
	(153, 153, 'category', '', 0, 6),
	(154, 154, 'directorypress-tag', '', 0, 0),
	(155, 155, 'directorypress-tag', '', 0, 0),
	(156, 156, 'directorypress-tag', '', 0, 0),
	(157, 157, 'directorypress-tag', '', 0, 0),
	(158, 158, 'directorypress-tag', '', 0, 0),
	(159, 159, 'directorypress-tag', '', 0, 0),
	(160, 160, 'directorypress-tag', '', 0, 0),
	(161, 161, 'directorypress-tag', '', 0, 0),
	(162, 162, 'directorypress-tag', '', 0, 0),
	(163, 163, 'directorypress-tag', '', 0, 0),
	(164, 164, 'directorypress-tag', '', 0, 0),
	(165, 165, 'directorypress-tag', '', 0, 0),
	(166, 166, 'directorypress-tag', '', 0, 0),
	(167, 167, 'directorypress-tag', '', 0, 0),
	(168, 168, 'directorypress-tag', '', 0, 0),
	(169, 169, 'directorypress-tag', '', 0, 0),
	(170, 170, 'directorypress-tag', '', 0, 0),
	(171, 171, 'directorypress-tag', '', 0, 0),
	(172, 172, 'directorypress-tag', '', 0, 0),
	(173, 173, 'directorypress-tag', '', 0, 0),
	(174, 174, 'directorypress-tag', '', 0, 0),
	(175, 175, 'directorypress-tag', '', 0, 0),
	(176, 176, 'directorypress-tag', '', 0, 0),
	(177, 177, 'directorypress-tag', '', 0, 0),
	(178, 178, 'directorypress-tag', '', 0, 0),
	(179, 179, 'directorypress-tag', '', 0, 0),
	(180, 180, 'directorypress-tag', '', 0, 0),
	(181, 181, 'directorypress-tag', '', 0, 0),
	(182, 182, 'directorypress-tag', '', 0, 0),
	(183, 183, 'directorypress-tag', '', 0, 0),
	(184, 184, 'directorypress-tag', '', 0, 0),
	(185, 185, 'directorypress-tag', '', 0, 0),
	(186, 186, 'directorypress-tag', '', 0, 0),
	(187, 187, 'directorypress-tag', '', 0, 0),
	(194, 194, 'directorypress-location', '', 0, 1),
	(195, 195, 'directorypress-location', '', 0, 1),
	(196, 196, 'directorypress-location', '', 0, 1),
	(197, 197, 'product_type', '', 0, 12),
	(198, 198, 'product_type', '', 0, 0),
	(199, 199, 'product_type', '', 0, 0),
	(200, 200, 'product_type', '', 0, 0),
	(201, 201, 'nav_menu', '', 0, 6),
	(202, 202, 'directorypress-location', '', 0, 1),
	(203, 203, 'directorypress-location', '', 0, 0),
	(204, 204, 'directorypress-location', '', 0, 1),
	(205, 205, 'directorypress-location', '', 0, 1),
	(206, 206, 'directorypress-location', '', 0, 0),
	(207, 207, 'directorypress-location', '', 0, 1),
	(208, 208, 'directorypress-location', '', 0, 1),
	(209, 209, 'directorypress-location', '', 0, 1),
	(210, 210, 'product_tag', '', 0, 12),
	(211, 211, 'product_tag', '', 0, 1),
	(212, 212, 'product_tag', '', 0, 6),
	(213, 213, 'product_cat', '', 0, 1),
	(214, 214, 'product_cat', '', 0, 1),
	(215, 215, 'product_cat', '', 0, 1),
	(216, 216, 'product_cat', '', 0, 1),
	(217, 217, 'product_cat', '', 0, 1),
	(218, 218, 'product_cat', '', 0, 1),
	(219, 219, 'product_cat', '', 0, 2),
	(220, 220, 'product_cat', '', 0, 1),
	(221, 221, 'product_cat', '', 0, 1),
	(222, 222, 'product_cat', '', 0, 1),
	(223, 223, 'product_tag', '', 0, 1),
	(224, 224, 'product_tag', '', 0, 1),
	(225, 225, 'product_tag', '', 0, 1),
	(226, 226, 'product_tag', '', 0, 2),
	(227, 227, 'product_tag', '', 0, 1),
	(228, 228, 'product_tag', '', 0, 2),
	(229, 229, 'product_tag', '', 0, 1),
	(230, 230, 'product_tag', '', 0, 1),
	(231, 231, 'product_tag', '', 0, 1),
	(232, 232, 'product_tag', '', 0, 1),
	(233, 233, 'product_tag', '', 0, 1),
	(234, 234, 'product_tag', '', 0, 1),
	(235, 235, 'product_tag', '', 0, 1),
	(236, 236, 'product_tag', '', 0, 1),
	(237, 237, 'product_tag', '', 0, 1),
	(238, 238, 'product_type', '', 0, 3),
	(239, 239, 'product_type', '', 0, 3),
	(240, 240, 'directorypress-tag', '', 0, 0),
	(241, 241, 'directorypress-tag', '', 0, 0),
	(242, 242, 'directorypress-tag', '', 0, 0),
	(243, 243, 'directorypress-tag', '', 0, 0),
	(244, 244, 'product_visibility', '', 0, 0),
	(245, 245, 'product_visibility', '', 0, 0),
	(246, 246, 'product_visibility', '', 0, 0),
	(247, 247, 'product_visibility', '', 0, 0),
	(248, 248, 'product_visibility', '', 0, 0),
	(249, 249, 'product_visibility', '', 0, 0),
	(250, 250, 'product_visibility', '', 0, 0),
	(251, 251, 'product_visibility', '', 0, 0),
	(252, 252, 'product_visibility', '', 0, 0),
	(258, 258, 'nav_menu', '', 0, 5),
	(262, 262, 'directorypress-location', '', 3, 0),
	(265, 265, 'product_cat', '', 0, 7),
	(266, 266, 'directorypress-tag', '', 0, 0),
	(267, 267, 'directorypress-tag', '', 0, 1),
	(268, 268, 'directorypress-tag', '', 0, 0),
	(269, 269, 'directorypress-tag', '', 0, 0),
	(270, 270, 'directorypress-tag', '', 0, 0),
	(271, 271, 'directorypress-tag', '', 0, 0),
	(272, 272, 'directorypress-tag', '', 0, 0),
	(273, 273, 'directorypress-tag', '', 0, 0),
	(274, 274, 'directorypress-tag', '', 0, 0),
	(275, 275, 'directorypress-tag', '', 0, 0),
	(276, 276, 'directorypress-tag', '', 0, 0),
	(277, 277, 'directorypress-category', '', 0, 1),
	(319, 319, 'directorypress-category', '', 0, 1),
	(420, 420, 'directorypress-category', '', 0, 1),
	(518, 518, 'directorypress-category', '', 0, 3),
	(688, 688, 'directorypress-category', '', 0, 2),
	(754, 754, 'directorypress-category', '', 0, 2),
	(772, 772, 'directorypress-tag', '', 0, 0),
	(773, 773, 'directorypress-tag', '', 0, 0),
	(774, 774, 'directorypress-tag', '', 0, 0),
	(775, 775, 'directorypress-tag', '', 0, 0),
	(776, 776, 'directorypress-tag', '', 0, 0),
	(777, 777, 'directorypress-tag', '', 0, 0),
	(778, 778, 'directorypress-tag', '', 0, 0),
	(779, 779, 'directorypress-tag', '', 0, 0),
	(780, 780, 'directorypress-tag', '', 0, 0),
	(781, 781, 'directorypress-tag', '', 0, 0),
	(782, 782, 'directorypress-tag', '', 0, 0),
	(783, 783, 'directorypress-tag', '', 0, 0),
	(784, 784, 'directorypress-tag', '', 0, 0),
	(785, 785, 'directorypress-tag', '', 0, 0),
	(786, 786, 'directorypress-tag', '', 0, 0),
	(787, 787, 'directorypress-tag', '', 0, 0),
	(788, 788, 'directorypress-tag', '', 0, 0),
	(789, 789, 'directorypress-tag', '', 0, 0),
	(790, 790, 'directorypress-tag', '', 0, 0),
	(791, 791, 'directorypress-tag', '', 0, 0),
	(792, 792, 'directorypress-tag', '', 0, 0),
	(793, 793, 'directorypress-tag', '', 0, 0),
	(794, 794, 'directorypress-tag', '', 0, 0),
	(795, 795, 'directorypress-tag', '', 0, 0),
	(796, 796, 'directorypress-tag', '', 0, 0),
	(797, 797, 'directorypress-tag', '', 0, 0),
	(798, 798, 'directorypress-tag', '', 0, 0),
	(799, 799, 'action-group', '', 0, 0),
	(800, 800, 'action-group', '', 0, 0),
	(801, 801, 'elementor_library_type', '', 0, 3),
	(802, 802, 'directorypress-tag', '', 0, 1),
	(803, 803, 'directorypress-tag', '', 0, 1),
	(804, 804, 'directorypress-category', '', 0, 1),
	(805, 805, 'directorypress-category', '', 0, 1),
	(806, 806, 'post_tag', '', 0, 6),
	(807, 807, 'post_tag', '', 0, 6),
	(808, 808, 'post_tag', '', 0, 6),
	(809, 809, 'post_tag', '', 0, 6),
	(810, 810, 'nav_menu', '', 0, 0),
	(811, 811, 'nav_menu', '', 0, 0);");

	$wpdb->query("TRUNCATE TABLE `".$prefix."termmeta`");
	$wpdb->query("INSERT INTO `".$prefix."termmeta` (`meta_id`, `term_id`, `meta_key`, `meta_value`) VALUES
	(34, 210, 'product_count_product_tag', '12'),
	(35, 211, 'product_count_product_tag', '1'),
	(36, 212, 'product_count_product_tag', '6'),
	(37, 213, 'order', '0'),
	(38, 214, 'order', '0'),
	(39, 215, 'order', '0'),
	(40, 216, 'order', '0'),
	(41, 217, 'order', '0'),
	(42, 218, 'order', '0'),
	(43, 219, 'order', '0'),
	(44, 220, 'order', '0'),
	(45, 221, 'order', '0'),
	(46, 222, 'order', '0'),
	(47, 222, 'product_count_product_cat', '1'),
	(48, 223, 'product_count_product_tag', '1'),
	(49, 224, 'product_count_product_tag', '1'),
	(50, 219, 'product_count_product_cat', '2'),
	(51, 225, 'product_count_product_tag', '1'),
	(52, 226, 'product_count_product_tag', '2'),
	(53, 221, 'product_count_product_cat', '1'),
	(54, 227, 'product_count_product_tag', '1'),
	(55, 228, 'product_count_product_tag', '2'),
	(56, 229, 'product_count_product_tag', '1'),
	(57, 220, 'product_count_product_cat', '1'),
	(58, 230, 'product_count_product_tag', '1'),
	(59, 231, 'product_count_product_tag', '1'),
	(60, 218, 'product_count_product_cat', '1'),
	(61, 232, 'product_count_product_tag', '1'),
	(62, 217, 'product_count_product_cat', '1'),
	(63, 233, 'product_count_product_tag', '1'),
	(64, 216, 'product_count_product_cat', '1'),
	(65, 234, 'product_count_product_tag', '1'),
	(66, 213, 'product_count_product_cat', '1'),
	(67, 235, 'product_count_product_tag', '1'),
	(68, 214, 'product_count_product_cat', '1'),
	(69, 236, 'product_count_product_tag', '1'),
	(70, 237, 'product_count_product_tag', '1'),
	(71, 215, 'product_count_product_cat', '1'),
	(100, 265, 'product_count_product_cat', '7'),
	(101, 688, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3173\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/car1.png\";}'),
	(102, 688, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3173\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/car1.png\";}'),
	(103, 688, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3173\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/car1.png\";}'),
	(104, 688, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(105, 688, 'directorypress_category_font_icon', ''),
	(106, 688, 'marker_color', ''),
	(107, 754, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3182\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/bbbb.png\";}'),
	(108, 754, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3182\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/bbbb.png\";}'),
	(109, 754, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3182\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/bbbb.png\";}'),
	(110, 754, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(111, 754, 'directorypress_category_font_icon', ''),
	(112, 754, 'marker_color', ''),
	(113, 319, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3174\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/h.png\";}'),
	(114, 319, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3174\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/h.png\";}'),
	(115, 319, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3174\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/h.png\";}'),
	(116, 319, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(117, 319, 'directorypress_category_font_icon', ''),
	(118, 319, 'marker_color', ''),
	(119, 518, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3171\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/dogg.png\";}'),
	(120, 518, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3171\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/dogg.png\";}'),
	(121, 518, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3171\";s:3:\"src\";s:96:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/dogg.png\";}'),
	(122, 518, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(123, 518, 'directorypress_category_font_icon', ''),
	(124, 518, 'marker_color', ''),
	(125, 277, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3175\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/F.png\";}'),
	(126, 277, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3175\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/F.png\";}'),
	(127, 277, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3175\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/F.png\";}'),
	(128, 277, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(129, 277, 'directorypress_category_font_icon', ''),
	(130, 277, 'marker_color', ''),
	(131, 420, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3177\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/r.png\";}'),
	(132, 420, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3177\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/r.png\";}'),
	(133, 420, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3177\";s:3:\"src\";s:93:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/r.png\";}'),
	(134, 420, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(135, 420, 'directorypress_category_font_icon', ''),
	(136, 420, 'marker_color', ''),
	(137, 804, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3301\";s:3:\"src\";s:97:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/goatr.png\";}'),
	(138, 804, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3301\";s:3:\"src\";s:97:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/goatr.png\";}'),
	(139, 804, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3301\";s:3:\"src\";s:97:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/goatr.png\";}'),
	(140, 804, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(141, 804, 'directorypress_category_font_icon', ''),
	(142, 804, 'marker_color', ''),
	(143, 805, 'directorypress_category_icon', 'a:2:{s:2:\"id\";s:4:\"3300\";s:3:\"src\";s:99:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/monkeyy.png\";}'),
	(144, 805, 'directorypress_category_icon_for_listing', 'a:2:{s:2:\"id\";s:4:\"3300\";s:3:\"src\";s:99:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/monkeyy.png\";}'),
	(145, 805, 'directorypress_category_icon_for_map', 'a:2:{s:2:\"id\";s:4:\"3300\";s:3:\"src\";s:99:\"https://classiads.designinvento.net/elementor/classiads-pets/wp-content/uploads/2020/11/monkeyy.png\";}'),
	(146, 805, 'category-image-id', 'a:2:{s:2:\"id\";s:0:\"\";s:3:\"src\";s:0:\"\";}'),
	(147, 805, 'directorypress_category_font_icon', ''),
	(148, 805, 'marker_color', '');");

	$wpdb->query("TRUNCATE TABLE `".$prefix."term_relationships`");
	$wpdb->query("INSERT INTO `".$prefix."term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
	(260, 150, 0),
	(260, 151, 0),
	(260, 152, 0),
	(260, 153, 0),
	(1928, 258, 0),
	(1929, 258, 0),
	(1930, 258, 0),
	(1931, 258, 0),
	(1932, 258, 0),
	(2503, 171, 0),
	(2503, 204, 0),
	(2503, 270, 0),
	(2504, 204, 0),
	(2504, 270, 0),
	(2506, 204, 0),
	(2506, 270, 0),
	(2586, 197, 0),
	(2586, 210, 0),
	(2586, 211, 0),
	(2586, 212, 0),
	(2586, 215, 0),
	(2587, 197, 0),
	(2587, 210, 0),
	(2587, 214, 0),
	(2587, 236, 0),
	(2587, 237, 0),
	(2588, 197, 0),
	(2588, 210, 0),
	(2588, 212, 0),
	(2588, 216, 0),
	(2588, 234, 0),
	(2589, 197, 0),
	(2589, 210, 0),
	(2589, 212, 0),
	(2589, 217, 0),
	(2589, 233, 0),
	(2590, 197, 0),
	(2590, 210, 0),
	(2590, 212, 0),
	(2590, 213, 0),
	(2590, 235, 0),
	(2591, 197, 0),
	(2591, 210, 0),
	(2591, 212, 0),
	(2591, 218, 0),
	(2591, 232, 0),
	(2592, 197, 0),
	(2592, 210, 0),
	(2592, 219, 0),
	(2592, 226, 0),
	(2592, 231, 0),
	(2593, 197, 0),
	(2593, 210, 0),
	(2593, 212, 0),
	(2593, 220, 0),
	(2593, 230, 0),
	(2594, 197, 0),
	(2594, 210, 0),
	(2594, 228, 0),
	(2594, 229, 0),
	(2594, 265, 0),
	(2595, 197, 0),
	(2595, 210, 0),
	(2595, 221, 0),
	(2595, 227, 0),
	(2595, 228, 0),
	(2596, 197, 0),
	(2596, 210, 0),
	(2596, 219, 0),
	(2596, 225, 0),
	(2596, 226, 0),
	(2597, 197, 0),
	(2597, 210, 0),
	(2597, 222, 0),
	(2597, 223, 0),
	(2597, 224, 0),
	(2598, 238, 0),
	(2598, 265, 0),
	(2599, 238, 0),
	(2599, 265, 0),
	(2600, 238, 0),
	(2600, 265, 0),
	(2601, 239, 0),
	(2601, 265, 0),
	(2602, 239, 0),
	(2602, 265, 0),
	(2603, 239, 0),
	(2603, 265, 0),
	(3132, 801, 0),
	(3135, 801, 0),
	(3170, 8, 0),
	(3170, 267, 0),
	(3170, 518, 0),
	(3170, 802, 0),
	(3170, 803, 0),
	(3185, 195, 0),
	(3185, 518, 0),
	(3188, 204, 0),
	(3188, 518, 0),
	(3212, 202, 0),
	(3212, 754, 0),
	(3245, 205, 0),
	(3245, 754, 0),
	(3254, 194, 0),
	(3254, 805, 0),
	(3263, 207, 0),
	(3263, 804, 0),
	(3272, 208, 0),
	(3272, 319, 0),
	(3280, 209, 0),
	(3280, 420, 0),
	(3290, 5, 0),
	(3290, 688, 0),
	(3302, 196, 0),
	(3302, 277, 0),
	(3310, 2, 0),
	(3310, 688, 0),
	(3328, 153, 0),
	(3328, 806, 0),
	(3328, 807, 0),
	(3328, 808, 0),
	(3328, 809, 0),
	(3344, 801, 0),
	(3351, 153, 0),
	(3351, 806, 0),
	(3351, 807, 0),
	(3351, 808, 0),
	(3351, 809, 0),
	(3352, 153, 0),
	(3352, 806, 0),
	(3352, 807, 0),
	(3352, 808, 0),
	(3352, 809, 0),
	(3353, 153, 0),
	(3353, 806, 0),
	(3353, 807, 0),
	(3353, 808, 0),
	(3353, 809, 0),
	(3354, 153, 0),
	(3354, 806, 0),
	(3354, 807, 0),
	(3354, 808, 0),
	(3354, 809, 0),
	(3356, 153, 0),
	(3356, 806, 0),
	(3356, 807, 0),
	(3356, 808, 0),
	(3356, 809, 0),
	(3364, 153, 0),
	(3364, 806, 0),
	(3364, 807, 0),
	(3364, 808, 0),
	(3364, 809, 0),
	(3365, 153, 0),
	(3365, 806, 0),
	(3365, 807, 0),
	(3365, 808, 0),
	(3365, 809, 0),
	(3366, 153, 0),
	(3366, 806, 0),
	(3366, 807, 0),
	(3366, 808, 0),
	(3366, 809, 0),
	(3367, 153, 0),
	(3367, 806, 0),
	(3367, 807, 0),
	(3367, 808, 0),
	(3367, 809, 0),
	(3929, 54, 0),
	(3930, 54, 0),
	(3932, 54, 0),
	(3934, 201, 0),
	(3935, 201, 0),
	(3936, 201, 0),
	(3937, 201, 0),
	(3939, 201, 0),
	(3940, 201, 0);");
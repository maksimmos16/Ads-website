<?php
		
	global $wpdb;
	$prefix = $wpdb->prefix;
	
	$wpdb->query("TRUNCATE TABLE `wp_directorypress_directorytypes`");
	$wpdb->query("INSERT INTO `wp_directorypress_directorytypes` (`id`, `name`, `single`, `plural`, `listing_slug`, `category_slug`, `location_slug`, `tag_slug`, `categories`, `locations`, `packages`) VALUES
	(1, 'Listings', 'listing', 'listings', 'business-listing', 'business-category', 'business-place', 'business-tag', '', 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}');");
	
	// fields
	$wpdb->query("TRUNCATE TABLE `".$prefix."directorypress_fields`");
	$wpdb->query("INSERT INTO `".$prefix."directorypress_fields` (`id`, `is_core_field`, `order_num`, `name`, `slug`, `description`, `fieldwidth`, `fieldwidth_archive`, `type`, `icon_image`, `is_required`, `is_configuration_page`, `is_search_configuration_page`, `is_ordered`, `is_hide_name`, `is_hide_name_on_grid`, `is_hide_name_on_list`, `is_hide_name_on_search`, `is_field_in_line`, `on_exerpt_page`, `on_exerpt_page_list`, `on_listing_page`, `on_search_form`, `on_map`, `advanced_search_form`, `categories`, `options`, `checkbox_icon_type`, `search_options`, `group_id`) VALUES
	(1, 1, 16, 'Summary', 'summary', '', '', '', 'summary', '', 0, 0, 0, 0, 0, 'hide', 'hide', 1, 0, 0, 1, 0, 0, 0, 0, '', '', '', '', 0),
	(2, 1, 18, 'Address', 'address', '', '', '', 'address', 'alsp-fa-map-marker', 0, 0, 0, 0, 0, 'hide', 'hide', 1, 0, 1, 0, 1, 0, 0, 0, '', '', '', '', 1),
	(3, 1, 22, 'Description', 'content', '', NULL, '', 'content', '', 0, 0, 0, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, '', '', '', '', 0),
	(4, 1, 17, 'Brand and Model', 'categories_list', '', '', '', 'categories', '', 0, 1, 0, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, '', '', '', '', 1),
	(5, 1, 19, 'Listing Tags', 'listing_tags', '', '', '', 'tags', '', 0, 0, 0, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, '', '', '', '', 1),
	(7, 0, 20, 'Website', 'website', '', '', '', 'link', 'alsp-fa-globe', 0, 1, 0, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:5:{s:8:\"is_blank\";i:1;s:11:\"is_nofollow\";i:1;s:13:\"use_link_text\";i:1;s:17:\"default_link_text\";s:13:\"view our site\";s:21:\"use_default_link_text\";i:0;}', '', '', 1),
	(8, 0, 21, 'Email', 'email', '', NULL, '', 'email', 'alsp-fa-envelope-o', 0, 0, 0, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, '', '', '', '', 1),
	(9, 0, 1, 'Price', 'price', '', '25', '', 'price', '', 0, 1, 1, 1, 0, 'hide', 'hide', 1, 0, 1, 1, 0, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:6:{s:15:\"currency_symbol\";s:1:\"$\";s:17:\"decimal_separator\";s:1:\".\";s:19:\"thousands_separator\";s:0:\"\";s:15:\"symbol_position\";s:1:\"1\";s:13:\"hide_decimals\";s:1:\"1\";s:13:\"range_options\";a:1:{i:0;s:0:\"\";}}', '', 'a:4:{s:4:\"mode\";s:7:\"min_max\";s:15:\"min_max_options\";a:4:{i:0;s:4:\"5000\";i:1;s:5:\"10000\";i:2;s:5:\"20000\";i:3;s:5:\"30000\";}s:17:\"slider_step_1_min\";s:2:\"25\";s:17:\"slider_step_1_max\";s:2:\"75\";}', 1),
	(11, 0, 15, 'Method of Payment', 'method_of_payment', '', '75', '', 'checkbox', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:4:{s:15:\"selection_items\";a:8:{i:1;s:16:\"American Express\";i:2;s:4:\"Cash\";i:3;s:6:\"Cheque\";i:4;s:8:\"Discover\";i:5;s:8:\"Interact\";i:6;s:10:\"MasterCard\";i:7;s:4:\"Visa\";i:8;s:16:\"Gift Sertificate\";}s:17:\"how_display_items\";s:3:\"all\";s:15:\"check_icon_type\";s:7:\"default\";s:20:\"icon_selection_items\";N;}', '', 'a:1:{s:17:\"search_input_mode\";s:10:\"checkboxes\";}', 0),
	(19, 0, 3, 'Condition', 'condition', '', '25', '25', 'select', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 1, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:2:{i:1;s:4:\"Used\";i:2;s:9:\"Brand New\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:2:\"OR\";s:11:\"items_count\";i:1;}', 0),
	(21, 0, 11, 'Color', 'color', '', '', '', 'text', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:0:{}', '', '', '', 0),
	(31, 0, 2, 'Model Year', 'model_year', '', '25', '25', 'select', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 1, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:80:{i:80;s:4:\"2019\";i:79;s:4:\"2018\";i:1;s:4:\"2017\";i:2;s:4:\"2016\";i:3;s:4:\"2015\";i:4;s:4:\"2014\";i:5;s:4:\"2013\";i:6;s:4:\"2012\";i:7;s:4:\"2011\";i:8;s:4:\"2010\";i:9;s:4:\"2009\";i:10;s:4:\"2008\";i:11;s:4:\"2007\";i:12;s:4:\"2006\";i:13;s:4:\"2005\";i:14;s:4:\"2004\";i:15;s:4:\"2003\";i:16;s:4:\"2002\";i:17;s:4:\"2001\";i:18;s:4:\"2000\";i:19;s:4:\"1999\";i:20;s:4:\"1998\";i:21;s:4:\"1997\";i:22;s:4:\"1996\";i:23;s:4:\"1995\";i:24;s:4:\"1994\";i:25;s:4:\"1993\";i:26;s:4:\"1992\";i:27;s:4:\"1991\";i:28;s:4:\"1990\";i:29;s:4:\"1989\";i:30;s:4:\"1988\";i:31;s:4:\"1987\";i:32;s:4:\"1986\";i:33;s:4:\"1985\";i:34;s:4:\"1984\";i:35;s:4:\"1983\";i:36;s:4:\"1982\";i:37;s:4:\"1981\";i:38;s:4:\"1980\";i:39;s:4:\"1979\";i:40;s:4:\"1978\";i:41;s:4:\"1977\";i:42;s:4:\"1976\";i:43;s:4:\"1975\";i:44;s:4:\"1974\";i:45;s:4:\"1973\";i:46;s:4:\"1972\";i:47;s:4:\"1971\";i:48;s:4:\"1970\";i:49;s:4:\"1969\";i:50;s:4:\"1968\";i:51;s:4:\"1967\";i:52;s:4:\"1966\";i:53;s:4:\"1965\";i:54;s:4:\"1964\";i:55;s:4:\"1963\";i:56;s:4:\"1962\";i:57;s:4:\"1961\";i:58;s:4:\"1960\";i:59;s:4:\"1959\";i:60;s:4:\"1958\";i:61;s:4:\"1957\";i:62;s:4:\"1956\";i:63;s:4:\"1955\";i:64;s:4:\"1954\";i:65;s:4:\"1953\";i:66;s:4:\"1952\";i:67;s:4:\"1951\";i:68;s:4:\"1950\";i:69;s:4:\"1949\";i:70;s:4:\"1948\";i:71;s:4:\"1947\";i:72;s:4:\"1946\";i:73;s:4:\"1945\";i:74;s:4:\"1944\";i:75;s:4:\"1943\";i:76;s:4:\"1942\";i:77;s:4:\"1941\";i:78;s:4:\"1940\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:2:\"OR\";s:11:\"items_count\";i:1;}', 0),
	(37, 0, 13, 'Seller type', 'seller_type', '', '25', '', 'select', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:2:{i:1;s:6:\"Agency\";i:2;s:8:\"Personal\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:2:\"OR\";s:11:\"items_count\";i:1;}', 0),
	(58, 0, 12, 'Registered City', 'registered-city', '', '', '', 'text', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:0:{}', '', '', '', 0),
	(60, 0, 10, 'Engine Capacity', 'engine-capacity', '', '', '', 'text', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 1, 0, 1, 1, 0, 0, 'a:1:{i:0;s:0:\"\";}', '', '', '', 0),
	(65, 0, 14, 'Car Features', 'car-features', '', '', '', 'checkbox', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:0:{}', 'a:4:{s:15:\"selection_items\";a:16:{i:1;s:3:\"ABS\";i:2;s:11:\"AM/FM Radio\";i:3;s:8:\"Air Bags\";i:4;s:16:\"Air Conditioning\";i:5;s:10:\"Alloy Rims\";i:6;s:9:\"CD Player\";i:7;s:15:\"Immobilizer Key\";i:8;s:13:\"Keyless Entry\";i:9;s:11:\"Power Locks\";i:10;s:13:\"Power Mirrors\";i:11;s:14:\"Power Steering\";i:12;s:13:\"Power Windows\";i:13;s:13:\"Rear AC Vents\";i:14;s:13:\"Rear speakers\";i:15;s:8:\"Sun Roof\";i:16;s:23:\"USB and Auxillary Cable\";}s:17:\"how_display_items\";s:3:\"all\";s:15:\"check_icon_type\";s:7:\"default\";s:20:\"icon_selection_items\";N;}', '', '', 0),
	(85, 0, 4, 'Other Model', 'other_model', '', '', '', 'text', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 1, 0, 1, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', '', '', '', 0),
	(86, 0, 6, 'Litres', 'liters', '', '', '', 'text', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 1, 0, 1, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', '', '', '', 0),
	(87, 0, 5, 'Mileage', 'mileage', '', '25', '25', 'select', 'pacz-automotive-street', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 1, 1, 1, 1, 1, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:11:{i:1;s:4:\"5000\";i:2;s:5:\"10000\";i:3;s:5:\"20000\";i:4;s:5:\"30000\";i:5;s:5:\"40000\";i:6;s:5:\"50000\";i:7;s:5:\"60000\";i:8;s:5:\"70000\";i:9;s:5:\"80000\";i:10;s:5:\"90000\";i:11;s:6:\"100000\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:2:\"OR\";s:11:\"items_count\";i:1;}', 0),
	(88, 0, 7, 'Convertible', 'convertible', '', '25', '25', 'select', '', 0, 1, 1, 0, 0, 'hide', 'hide', 1, 0, 0, 0, 1, 0, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:2:{i:1;s:3:\"Yes\";i:2;s:2:\"No\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:2:\"OR\";s:11:\"items_count\";i:1;}', 0),
	(89, 0, 8, 'Transmission', 'transmission', '', '25', '25', 'select', 'pacz-automotive-gearshift', 0, 1, 1, 0, 0, 'show_only_icon', 'show_only_icon', 1, 1, 1, 1, 1, 1, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:3:{i:1;s:6:\"Manual\";i:2;s:14:\"Semi Automatic\";i:3;s:9:\"Automatic\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:2:\"OR\";s:11:\"items_count\";i:1;}', 0),
	(90, 0, 9, 'Seats', 'seats', '', '25', '25', 'select', 'pacz-automotive-seat', 0, 1, 1, 0, 0, 'show_only_icon', 'show_only_icon', 1, 1, 1, 1, 1, 1, 0, 0, 'a:1:{i:0;s:0:\"\";}', 'a:1:{s:15:\"selection_items\";a:4:{i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"5\";i:4;s:1:\"7\";}}', '', 'a:3:{s:17:\"search_input_mode\";s:9:\"selectbox\";s:19:\"checkboxes_operator\";s:3:\"AND\";s:11:\"items_count\";i:0;}', 0),
	(91, 1, 4, 'Listing Types', 'listingtype_list', '', NULL, '', 'listingtypes', '', 0, 0, 0, 0, 0, 'hide', 'hide', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 0);");

	// fields groups
	$wpdb->query("TRUNCATE TABLE `".$prefix."directorypress_fields_groups`");
	$wpdb->query("INSERT INTO `".$prefix."directorypress_fields_groups` (`id`, `name`, `on_tab`, `group_style`, `hide_anonymous`) VALUES
	(1, 'Contact Information', 0, '2', 0),
	(2, 'payment methods', 0, '', 0);");
	
	
	$wpdb->query("TRUNCATE TABLE `".$prefix."directorypress_locations_depths`");
	
	$wpdb->query("INSERT INTO `".$prefix."directorypress_locations_depths` (`id`, `name`, `in_widget`, `in_address_line`) VALUES
	(1, 'Country', 1, 1),
	(2, 'State', 1, 1),
	(3, 'City', 1, 1);");

	$wpdb->query("TRUNCATE TABLE `".$prefix."directorypress_locations_relation`");
	$wpdb->query("INSERT INTO `".$prefix."directorypress_locations_relation` (`id`, `post_id`, `location_id`, `address_line_1`, `address_line_2`, `zip_or_postal_index`, `additional_info`, `manual_coords`, `map_coords_1`, `map_coords_2`, `map_icon_file`) VALUES
	(79, 740, 3, '', '', '', '', 0, 32.318230, -86.902298, 'pacz-fic1-scissors'),
	(202, 1636, 2, '', '', '', '', 0, 0.000000, 0.000000, ''),
	(209, 1752, 2, 'Alabama, United States', '', '', '', 0, 0.000000, 0.000000, ''),
	(212, 1776, 194, 'karaci', 'dsdshTakas Classified – Codeigniter PHP Classified Ad ScriptTakas Classified – Codeigniter PHP Classified Ad ScriptTakas Classified – Codeigniter PHP Classified Ad Script', '47384998', '', 0, 0.000000, 0.000000, ''),
	(214, 1788, 0, 'São Roque - SP, Brasil', '12', '18143-300', 'super local bonito', 0, -23.525745, -47.132061, '_new/6.png'),
	(223, 1832, 0, '?????? ??????, ?????, ????? ?????, ?????', '', '', '', 0, 0.000000, 0.000000, ''),
	(296, 2262, 0, '', '', '', '', 0, 39.213993, -79.637009, ''),
	(337, 2404, 196, '18 Bank Street, Melksham, UK', '', 'SN12 6DQ', '', 1, 51.374153, -2.137881, ''),
	(338, 2411, 202, '', '', '', '', 0, 0.000000, 0.000000, ''),
	(339, 2413, 194, '', '', '', '', 0, 0.000000, 0.000000, ''),
	(370, 2431, 196, '', '', '', '', 0, 55.378052, -3.435973, ''),
	(371, 2445, 0, 'Madina', '', '', '', 1, 40.684559, 0.979064, ''),
	(372, 2459, 194, 'montreal', '', '', '', 0, 0.000000, 0.000000, ''),
	(373, 2468, 0, 'Concordia 800', '', '2820', '', 0, 33.651108, -117.814842, ''),
	(374, 2468, 0, '', '', '2820', '', 0, 35.223907, -80.723396, ''),
	(400, 2501, 0, 'da', '', '', '', 1, 45.947342, -101.139038, '_new/10.png'),
	(401, 2503, 204, 'Delhi, India', '', '', '', 1, 28.559397, 77.207893, ''),
	(402, 2504, 204, 'Delhi, India', '', '', '', 1, 28.602528, 77.192444, '_new/2.png'),
	(403, 2506, 204, 'Delhi, India', '', '', '', 1, 28.704060, 77.256302, ''),
	(427, 2520, 194, '', '', '', '', 0, 0.000000, 0.000000, ''),
	(439, 550, 203, 'Lahore, Punjab, Pakistan', '', '54000', '', 1, 33.523373, -86.917130, '_new/2.png'),
	(440, 549, 50, 'Washington', '', '', '', 1, 33.723373, -86.817131, '_new/9.png'),
	(441, 544, 3, 'Birmingham', '', '', '', 0, 33.520660, -86.802490, '_new/7.png'),
	(442, 542, 4, 'Fairbanks, AK, United States', '', '', '', 1, 64.828300, -147.809082, ''),
	(443, 541, 50, 'Washington, DC, United States', '', '', '', 1, 38.899265, -77.154648, ''),
	(444, 545, 3, 'Birmingham, AL, United States', '', '', '', 1, 33.532890, -87.128609, ''),
	(445, 535, 4, 'Alaska, United States', '', '', '', 1, 39.065868, -80.887604, '_new/3.png'),
	(446, 534, 4, 'Alaska, United States', '', '', '', 1, 42.065868, -77.887604, '_new/3.png'),
	(447, 533, 4, 'Alaska, United States', '', '', '', 1, 41.065868, -78.887604, '_new/3.png'),
	(448, 154, 7, 'California, United States', '', '', '', 1, 37.195839, -86.762802, ''),
	(449, 152, 7, 'Los Angeles', '', '', '', 1, 34.320183, -118.191917, '_new/M.png'),
	(450, 150, 50, 'Birmingham', '', '', '', 1, 33.623325, -86.817429, ''),
	(451, 129, 3, 'Alabama, United States', '', '', '', 1, 30.499287, -90.789093, ''),
	(452, 128, 2, 'Alabama, United States', '', '', '', 1, 33.499287, -86.789093, '_new/9.png'),
	(453, 127, 3, 'Alabama', '', '', '', 1, 31.499287, -89.789093, ''),
	(454, 107, 194, 'Canada', '', '', '', 1, 33.623371, -86.789093, '_new/R.png'),
	(455, 98, 7, 'San Francisco', '', '', '', 1, 37.574928, -122.419418, '_new/2.png'),
	(458, 551, 203, 'Lahore, Punjab, Pakistan', 'Lahore, Punjab, Pakistan', '54000', 'Lahore, Punjab, Pakistan', 1, 33.523373, -86.617126, '_new/PETS.png'),
	(461, 2664, 204, 'Delhi Road, Penn Run, Indiana, PA, USA', '', '', '', 1, 39.973465, 40.021263, '_new/10.png'),
	(512, 3026, 23, '', '', '', '', 0, 39.045753, -76.641273, ''),
	(518, 3087, 196, '', '', '', '', 0, 38.920273, -77.062943, '_new/V.png'),
	(519, 3083, 3, '', '', '', '', 0, 32.318230, -86.902298, '_new/3.png'),
	(520, 3079, 196, '', '', '', '', 0, 38.920273, -77.062943, '_new/V.png'),
	(521, 3072, 209, '', '', '', '', 0, 38.963745, 35.243320, '_new/3.png'),
	(522, 3068, 207, '', '', '', '', 0, 41.871941, 12.567380, '_new/3.png'),
	(553, 3063, 205, '', '', '', '', 0, 0.000000, 0.000000, ''),
	(525, 3058, 208, '', '', '', '', 0, 34.028099, -118.471146, '_new/3.png'),
	(526, 3054, 202, '', '', '', '', 0, -25.274399, 133.775131, '_new/V.png'),
	(528, 3045, 203, '', '', '', '', 0, 30.375320, 69.345116, '_new/3.png'),
	(529, 3037, 196, '', '', '', '', 0, 38.920273, -77.062943, '_new/V.png'),
	(530, 3031, 194, '1623 Chestnut Street, Philadelphia, PA, USA', '', '', '', 0, 39.951702, -75.168190, '_new/3.png'),
	(531, 3020, 194, '1455 Massachusetts Avenue, Lexington, MA, USA', '', '', '', 0, 42.444733, -71.219925, '_new/V.png'),
	(532, 3015, 194, '', '', '', '', 0, 41.110649, -81.380699, '_new/3.png'),
	(533, 3049, 196, '', '', '', '', 0, 38.920273, -77.062943, '_new/3.png');");
	
	// packages
	$wpdb->query("TRUNCATE TABLE `".$prefix."directorypress_packages`");
	$wpdb->query("INSERT INTO `".$prefix."directorypress_packages` (`id`, `order_num`, `name`, `description`, `package_duration`, `package_duration_unit`, `package_no_expiry`, `change_package_id`, `number_of_listings_in_package`, `can_be_bumpup`, `has_sticky`, `has_featured`, `category_number_allowed`, `location_number_allowed`, `featured_package`, `images_allowed`, `videos_allowed`, `selected_categories`, `selected_locations`, `fields`, `upgrade_meta`) VALUES
	(1, 1, 'Free Package', '', 0, '', 1, 0, 1, 1, 0, 0, 2, 3, 0, 7, 1, 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}', 'a:3:{i:1;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:1;s:7:\"raiseup\";b:1;}i:2;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:0;s:7:\"raiseup\";b:0;}i:3;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:0;s:7:\"raiseup\";b:0;}}'),
	(2, 2, 'normal package', '', 0, '', 1, 0, 1, 1, 0, 1, 0, 5, 1, 7, 2, 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}', 'a:3:{i:1;a:3:{s:5:\"price\";s:2:\"10\";s:8:\"disabled\";b:0;s:7:\"raiseup\";b:0;}i:2;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:1;s:7:\"raiseup\";b:1;}i:3;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:0;s:7:\"raiseup\";b:0;}}'),
	(3, 3, 'Best Package', '', 0, '', 1, 0, 1, 1, 0, 1, 0, 10, 0, 10, 5, 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}', 'a:1:{i:0;s:0:\"\";}', 'a:3:{i:1;a:3:{s:5:\"price\";s:2:\"20\";s:8:\"disabled\";b:0;s:7:\"raiseup\";b:0;}i:2;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:0;s:7:\"raiseup\";b:0;}i:3;a:3:{s:5:\"price\";i:0;s:8:\"disabled\";b:1;s:7:\"raiseup\";b:1;}}');");

	//packages relation
	$wpdb->query("TRUNCATE TABLE `".$prefix."directorypress_packages_relation`");
	$wpdb->query("INSERT INTO `".$prefix."directorypress_packages_relation` (`id`, `post_id`, `package_id`) VALUES
	(1, 11, 1),
	(2, 12, 1),
	(3, 14, 1),
	(4, 58, 1),
	(5, 97, 1),
	(6, 98, 2),
	(7, 103, 1),
	(8, 104, 1),
	(9, 107, 3),
	(10, 127, 1),
	(11, 128, 1),
	(12, 129, 1),
	(13, 130, 1),
	(14, 131, 1),
	(15, 132, 1),
	(16, 133, 1),
	(17, 134, 1),
	(18, 135, 1),
	(19, 150, 2),
	(20, 152, 3),
	(21, 154, 1),
	(22, 194, 1),
	(25, 533, 2),
	(26, 534, 2),
	(27, 535, 2),
	(28, 541, 1),
	(29, 542, 1),
	(31, 544, 1),
	(32, 545, 3),
	(34, 549, 3),
	(35, 550, 2),
	(36, 551, 3),
	(46, 615, 1),
	(47, 633, 2),
	(48, 634, 2),
	(49, 635, 2),
	(50, 636, 2),
	(51, 641, 2),
	(52, 642, 2),
	(53, 648, 1),
	(54, 734, 1),
	(55, 735, 1),
	(56, 736, 1),
	(57, 737, 1),
	(58, 738, 1),
	(59, 739, 1),
	(60, 740, 1),
	(61, 867, 2),
	(62, 1057, 1),
	(63, 1058, 2),
	(64, 1614, 1),
	(65, 1615, 1),
	(66, 1616, 1),
	(67, 1617, 2),
	(68, 1618, 3),
	(69, 1619, 1),
	(71, 1621, 1),
	(72, 1622, 1),
	(73, 1623, 1),
	(74, 1624, 1),
	(75, 1625, 1),
	(76, 1626, 1),
	(77, 1627, 2),
	(79, 1630, 2),
	(81, 1633, 1),
	(82, 1634, 1),
	(83, 1635, 1),
	(84, 1636, 1),
	(85, 1637, 1),
	(86, 1638, 1),
	(87, 1639, 1),
	(88, 1640, 1),
	(89, 1641, 1),
	(91, 1644, 1),
	(92, 1645, 1),
	(93, 1646, 1),
	(94, 1647, 1),
	(96, 1652, 3),
	(97, 1653, 2),
	(98, 1655, 3),
	(99, 1656, 1),
	(100, 1658, 1),
	(101, 1659, 1),
	(102, 1660, 1),
	(103, 1661, 1),
	(104, 1662, 1),
	(105, 1663, 1),
	(106, 1664, 1),
	(107, 1665, 1),
	(108, 1732, 1),
	(111, 1735, 1),
	(112, 1736, 1),
	(113, 1737, 2),
	(114, 1738, 1),
	(115, 1739, 1),
	(116, 1745, 2),
	(117, 1746, 1),
	(118, 1748, 1),
	(119, 1749, 1),
	(120, 1750, 1),
	(121, 1751, 1),
	(122, 1752, 1),
	(123, 1753, 1),
	(124, 1754, 2),
	(125, 1755, 1),
	(126, 1756, 2),
	(128, 1758, 1),
	(129, 1759, 1),
	(131, 1761, 1),
	(133, 1765, 2),
	(134, 1766, 2),
	(135, 1767, 2),
	(136, 1768, 1),
	(137, 1769, 1),
	(138, 1770, 1),
	(139, 1771, 1),
	(140, 1772, 1),
	(141, 1773, 1),
	(142, 1774, 3),
	(143, 1775, 1),
	(144, 1776, 1),
	(145, 1778, 3),
	(146, 1779, 3),
	(147, 1780, 1),
	(148, 1781, 2),
	(149, 1782, 1),
	(150, 1783, 1),
	(151, 1787, 2),
	(152, 1788, 1),
	(153, 1789, 1),
	(154, 1790, 3),
	(155, 1791, 1),
	(157, 1795, 2),
	(158, 1796, 1),
	(160, 1798, 1),
	(162, 1800, 1),
	(163, 1801, 1),
	(166, 1806, 2),
	(167, 1807, 1),
	(168, 1808, 1),
	(169, 1809, 1),
	(171, 1813, 1),
	(172, 1814, 1),
	(173, 1815, 2),
	(174, 1816, 3),
	(175, 1817, 1),
	(177, 1821, 1),
	(178, 1822, 1),
	(179, 1823, 1),
	(181, 1825, 3),
	(182, 1826, 2),
	(183, 1827, 2),
	(185, 1829, 1),
	(186, 1830, 2),
	(187, 1831, 1),
	(188, 1832, 2),
	(189, 1833, 1),
	(191, 1835, 3),
	(193, 1837, 2),
	(194, 1838, 2),
	(195, 1839, 1),
	(196, 1840, 2),
	(198, 1842, 1),
	(199, 1843, 1),
	(201, 1846, 1),
	(202, 1847, 1),
	(203, 1848, 1),
	(204, 1849, 3),
	(206, 1894, 3),
	(207, 1974, 3),
	(208, 1975, 3),
	(209, 1977, 2),
	(210, 1979, 2),
	(211, 1982, 3),
	(212, 1994, 1),
	(213, 2219, 2),
	(214, 2220, 1),
	(215, 2221, 2),
	(216, 2222, 1),
	(217, 2223, 1),
	(218, 2224, 1),
	(219, 2225, 1),
	(220, 2229, 1),
	(221, 2230, 1),
	(222, 2231, 1),
	(223, 2232, 1),
	(224, 2233, 1),
	(225, 2234, 1),
	(226, 2235, 1),
	(227, 2236, 1),
	(228, 2237, 1),
	(229, 2238, 1),
	(230, 2239, 1),
	(231, 2240, 1),
	(232, 2241, 1),
	(233, 2242, 1),
	(234, 2243, 1),
	(235, 2244, 1),
	(236, 2245, 1),
	(237, 2246, 1),
	(238, 2247, 1),
	(239, 2248, 1),
	(240, 2249, 1),
	(241, 2250, 1),
	(242, 2251, 1),
	(243, 2252, 1),
	(244, 2262, 1),
	(245, 2263, 1),
	(247, 2265, 1),
	(248, 2266, 1),
	(249, 2267, 3),
	(250, 2268, 1),
	(251, 2270, 1),
	(252, 2271, 1),
	(253, 2272, 1),
	(254, 2273, 1),
	(255, 2274, 1),
	(256, 2275, 1),
	(257, 2276, 1),
	(258, 2277, 1),
	(259, 2279, 1),
	(260, 2281, 1),
	(261, 2282, 1),
	(262, 2283, 1),
	(264, 2285, 1),
	(265, 2286, 1),
	(266, 2306, 1),
	(267, 2307, 1),
	(268, 2308, 1),
	(269, 2309, 1),
	(270, 2310, 1),
	(273, 2315, 1),
	(274, 2316, 1),
	(275, 2317, 1),
	(276, 2318, 1),
	(277, 2319, 1),
	(278, 2320, 1),
	(279, 2321, 1),
	(280, 2322, 1),
	(281, 2323, 1),
	(282, 2324, 1),
	(283, 2325, 1),
	(284, 2326, 3),
	(285, 2327, 3),
	(286, 2328, 3),
	(287, 2329, 3),
	(288, 2330, 1),
	(289, 2331, 1),
	(290, 2332, 1),
	(291, 2334, 1),
	(292, 2336, 2),
	(293, 2337, 1),
	(295, 2340, 2),
	(296, 2341, 3),
	(297, 2342, 1),
	(298, 2343, 1),
	(299, 2344, 3),
	(300, 2345, 1),
	(301, 2346, 2),
	(302, 2347, 1),
	(303, 2348, 2),
	(304, 2349, 1),
	(305, 2350, 1),
	(306, 2351, 1),
	(307, 2352, 2),
	(308, 2353, 1),
	(309, 2354, 3),
	(310, 2355, 1),
	(311, 2357, 1),
	(312, 2358, 1),
	(313, 2359, 2),
	(314, 2360, 3),
	(315, 2361, 1),
	(316, 2362, 1),
	(317, 2363, 1),
	(318, 2365, 1),
	(319, 2366, 3),
	(320, 2367, 1),
	(321, 2368, 1),
	(322, 2369, 2),
	(323, 2370, 1),
	(324, 2371, 1),
	(325, 2372, 1),
	(326, 2373, 1),
	(327, 2374, 1),
	(328, 2376, 1),
	(329, 2377, 1),
	(330, 2379, 1),
	(331, 2380, 1),
	(332, 2381, 1),
	(333, 2382, 1),
	(334, 2383, 1),
	(335, 2384, 1),
	(336, 2385, 1),
	(337, 2386, 1),
	(338, 2387, 1),
	(339, 2388, 2),
	(340, 2389, 1),
	(341, 2390, 1),
	(342, 2391, 1),
	(343, 2392, 1),
	(344, 2393, 1),
	(345, 2394, 1),
	(346, 2395, 1),
	(347, 2397, 3),
	(348, 2398, 2),
	(349, 2399, 1),
	(350, 2400, 2),
	(351, 2401, 1),
	(352, 2402, 2),
	(353, 2403, 2),
	(354, 2404, 1),
	(355, 2405, 1),
	(356, 2406, 1),
	(357, 2407, 1),
	(358, 2408, 1),
	(359, 2409, 1),
	(360, 2410, 2),
	(361, 2411, 1),
	(362, 2412, 1),
	(363, 2413, 1),
	(364, 2414, 1),
	(365, 2416, 1),
	(366, 2420, 1),
	(367, 2421, 1),
	(368, 2422, 1),
	(369, 2423, 1),
	(370, 2424, 1),
	(371, 2426, 1),
	(372, 2427, 1),
	(373, 2428, 1),
	(374, 2430, 1),
	(375, 2431, 1),
	(376, 2432, 2),
	(377, 2433, 1),
	(378, 2434, 2),
	(379, 2435, 2),
	(380, 2436, 1),
	(381, 2437, 1),
	(382, 2438, 3),
	(383, 2441, 1),
	(384, 2443, 1),
	(385, 2444, 1),
	(386, 2445, 1),
	(387, 2453, 1),
	(388, 2455, 3),
	(389, 2456, 1),
	(390, 2458, 1),
	(391, 2459, 2),
	(392, 2460, 2),
	(393, 2461, 2),
	(394, 2462, 2),
	(395, 2463, 2),
	(396, 2464, 2),
	(397, 2465, 2),
	(398, 2466, 2),
	(399, 2467, 3),
	(400, 2468, 1),
	(401, 2480, 2),
	(402, 2482, 1),
	(403, 2483, 1),
	(404, 2484, 1),
	(405, 2485, 1),
	(406, 2486, 1),
	(407, 2487, 1),
	(408, 2488, 1),
	(409, 2489, 1),
	(410, 2490, 1),
	(411, 2493, 2),
	(412, 2494, 1),
	(413, 2495, 3),
	(414, 2496, 1),
	(415, 2501, 1),
	(416, 2503, 1),
	(417, 2504, 2),
	(418, 2506, 2),
	(419, 2516, 1),
	(420, 2518, 1),
	(421, 2519, 1),
	(422, 2520, 1),
	(423, 2521, 1),
	(424, 2522, 1),
	(425, 2523, 1),
	(426, 2524, 1),
	(427, 2525, 1),
	(428, 2526, 1),
	(429, 2527, 1),
	(430, 2528, 1),
	(431, 2529, 1),
	(432, 2530, 2),
	(433, 2531, 1),
	(434, 2532, 1),
	(435, 2533, 1),
	(436, 2534, 1),
	(437, 2535, 1),
	(438, 2536, 1),
	(439, 2548, 1),
	(440, 2550, 3),
	(441, 2551, 2),
	(442, 2552, 3),
	(443, 2553, 1),
	(448, 2560, 1),
	(450, 2563, 3),
	(463, 2581, 1),
	(464, 2582, 2),
	(465, 2636, 1),
	(466, 2658, 1),
	(467, 2659, 1),
	(468, 2660, 1),
	(469, 2661, 1),
	(470, 2662, 1),
	(471, 2663, 1),
	(472, 2664, 1),
	(473, 2668, 1),
	(474, 2733, 1),
	(476, 2987, 1),
	(477, 2988, 1),
	(478, 2989, 1),
	(479, 2990, 1),
	(480, 2991, 1),
	(481, 2992, 1),
	(482, 2993, 1),
	(483, 2994, 1),
	(484, 2995, 1),
	(486, 3000, 1),
	(488, 3003, 1),
	(489, 3004, 1),
	(490, 3005, 1),
	(491, 3006, 1),
	(493, 3015, 3),
	(494, 3020, 2),
	(495, 3026, 2),
	(496, 3031, 2),
	(497, 3037, 1),
	(498, 3045, 1),
	(499, 3049, 1),
	(500, 3054, 1),
	(501, 3058, 1),
	(502, 3063, 1),
	(503, 3067, 1),
	(504, 3068, 1),
	(505, 3072, 1),
	(506, 3079, 1),
	(507, 3083, 1),
	(508, 3087, 1),
	(510, 3097, 1),
	(684, 3710, 1),
	(675, 3655, 1),
	(513, 3148, 2),
	(515, 3154, 2),
	(518, 3186, 1),
	(519, 3187, 1),
	(520, 3188, 1),
	(521, 3189, 1),
	(522, 3190, 1),
	(523, 3191, 1),
	(524, 3194, 1),
	(525, 3195, 1),
	(527, 3198, 1),
	(528, 3199, 1),
	(529, 3200, 1),
	(530, 3201, 1),
	(531, 3202, 1),
	(532, 3203, 1),
	(533, 3204, 1),
	(534, 3205, 1),
	(535, 3207, 1),
	(536, 3208, 2),
	(537, 3212, 1),
	(538, 3213, 2),
	(539, 3217, 1),
	(540, 3218, 3),
	(541, 3219, 1),
	(542, 3220, 3),
	(543, 3221, 1),
	(544, 3222, 1),
	(545, 3223, 1),
	(546, 3224, 2),
	(547, 3225, 1),
	(548, 3226, 2),
	(549, 3227, 3),
	(550, 3228, 1),
	(551, 3229, 1),
	(552, 3230, 1),
	(553, 3231, 1),
	(554, 3232, 1),
	(555, 3233, 1),
	(556, 3234, 1),
	(557, 3235, 1),
	(558, 3236, 1),
	(559, 3237, 3),
	(560, 3238, 1),
	(561, 3239, 1),
	(562, 3240, 1),
	(563, 3241, 1),
	(564, 3242, 1),
	(565, 3243, 1),
	(566, 3244, 1),
	(567, 3245, 1),
	(568, 3246, 1),
	(569, 3247, 1),
	(571, 3251, 1),
	(572, 3252, 1),
	(573, 3253, 1),
	(574, 3254, 1),
	(575, 3256, 1),
	(576, 3257, 1),
	(578, 3259, 1),
	(579, 3260, 3),
	(580, 3261, 2),
	(581, 3262, 2),
	(582, 3263, 3),
	(584, 3267, 1),
	(585, 3268, 1),
	(586, 3269, 1),
	(588, 3275, 1),
	(589, 3276, 1),
	(590, 3277, 1),
	(591, 3278, 1),
	(592, 3279, 2),
	(593, 3280, 3),
	(594, 3281, 3),
	(595, 3282, 1),
	(597, 3286, 3),
	(600, 3297, 1),
	(601, 3298, 1),
	(604, 3304, 1),
	(605, 3305, 1),
	(606, 3308, 1),
	(607, 3309, 1),
	(608, 3312, 1),
	(609, 3318, 1),
	(610, 3319, 1),
	(612, 3335, 3),
	(613, 3336, 1),
	(614, 3337, 1),
	(615, 3338, 2),
	(617, 3341, 2),
	(618, 3342, 1),
	(619, 3343, 1),
	(620, 3344, 1),
	(621, 3345, 1),
	(622, 3346, 1),
	(623, 3348, 1),
	(624, 3352, 1),
	(625, 3353, 1),
	(627, 3355, 1),
	(628, 3356, 1),
	(629, 3357, 1),
	(630, 3358, 1),
	(631, 3359, 1),
	(632, 3360, 3),
	(634, 3362, 1),
	(635, 3363, 1),
	(636, 3364, 1),
	(637, 3365, 1),
	(639, 3374, 1),
	(640, 3375, 1),
	(641, 3376, 1),
	(642, 3377, 1),
	(643, 3378, 1),
	(644, 3379, 1),
	(646, 3381, 1),
	(647, 3382, 1),
	(648, 3383, 1),
	(649, 3384, 1),
	(650, 3385, 1),
	(651, 3386, 2),
	(652, 3387, 1),
	(653, 3388, 1),
	(654, 3389, 1),
	(656, 3391, 1),
	(657, 3392, 1),
	(658, 3393, 1),
	(665, 3405, 2),
	(666, 3633, 3),
	(667, 3634, 3),
	(669, 3637, 2),
	(670, 3639, 1),
	(671, 3640, 1),
	(672, 3641, 1),
	(673, 3642, 2),
	(674, 3643, 2),
	(676, 3697, 3),
	(677, 3698, 1),
	(678, 3699, 1),
	(680, 3706, 1),
	(681, 3707, 1),
	(682, 3708, 2),
	(683, 3709, 2),
	(685, 3718, 1),
	(686, 3719, 1),
	(687, 3720, 2);");
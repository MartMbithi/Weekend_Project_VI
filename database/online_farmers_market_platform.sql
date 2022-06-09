-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2022 at 06:00 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_farmers_market_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(200) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `category_desc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Cereals', 'A cereal is any grass cultivated for the edible components of its grain (botanically, a type of fruit called a caryopsis), composed of the endosperm, germ, and bran. The term may also refer to the resulting grain itself (specifically \"cereal grain\"). Cereal grain crops are grown in greater quantities and provide more food energy worldwide than any other type of crop[1] and are therefore staple crops. Edible grains from other plant families, such as buckwheat, quinoa and chia, are referred to as pseudocereals. '),
(2, 'Legumes', 'A legume (/ˈlɛɡjuːm, ləˈɡjuːm/) is a plant in the family Fabaceae (or Leguminosae), or the fruit or seed of such a plant. When used as a dry grain, the seed is also called a pulse. Legumes are grown agriculturally, primarily for human consumption, for livestock forage and silage, and as soil-enhancing green manure. Well-known legumes include beans, soybeans, peas, chickpeas, peanuts, lentils, lupins, mesquite, carob, tamarind, alfalfa, and clover. Legumes produce a botanically unique type of fruit – a simple dry fruit that develops from a simple carpel and usually dehisces (opens along a seam) on two sides.\r\n\r\nLegumes are notable in that most of them have symbiotic nitrogen-fixing bacteria in structures called root nodules. For that reason, they play a key role in crop rotation. '),
(3, 'Tubers', 'Tubers are enlarged structures used as storage organs for nutrients in some plants. They are used for the plant\'s perennation (survival of the winter or dry months), to provide energy and nutrients for regrowth during the next growing season, and as a means of asexual reproduction.[1] Stem tubers form thickened rhizomes (underground stems) or stolons (horizontal connections between organisms); well known species with stem tubers include the potato and yam. Some writers also treat modified lateral roots (root tubers) under the definition; these are found in sweet potatoes, cassava, and dahlias. '),
(5, 'Vegetables', 'Vegetables are parts of plants that are consumed by humans or other animals as food. The original meaning is still commonly used and is applied to plants collectively to refer to all edible plant matter, including the flowers, fruits, stems, leaves, roots, and seeds. An alternative definition of the term is applied somewhat arbitrarily, often by culinary and cultural tradition. It may exclude foods derived from some plants that are fruits, flowers, nuts, and cereal grains, but include savoury fruits such as tomatoes and courgettes, flowers such as broccoli, and seeds such as pulses. '),
(6, 'Fruits', 'In botany, a fruit is the seed-bearing structure in flowering plants that is formed from the ovary after flowering.\r\n\r\nFruits are the means by which flowering plants (also known as angiosperms) disseminate their seeds. Edible fruits in particular have long propagated using the movements of humans and animals in a symbiotic relationship that is the means for seed dispersal for the one group and nutrition for the other; in fact, humans and many animals have become dependent on fruits as a source of food.[1] Consequently, fruits account for a substantial fraction of the world\'s agricultural output, and some (such as the apple and the pomegranate) have acquired extensive cultural and symbolic meanings. ');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(200) NOT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `customer_phone` varchar(200) DEFAULT NULL,
  `customer_email` varchar(200) DEFAULT NULL,
  `customer_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_login_id`) VALUES
(3, 'Paul', '98886746346', 'paul@gmail.com', '50de78d38669d48892e56f1f81203502c51a83f69335'),
(4, 'Jane', '0704031263', 'cust001@mail.com', '6235e6cf30dc0979fd32c1d958dffd007ed843c4a06a'),
(5, 'James D Doe', '090654893', 'james1234@gmail.com', '74820c322758da983ec75a30d216f272e2a13a4963e1'),
(6, 'Janet Monroe', '0877742354', 'janetmon@gmail.com', '0d43b67d4c2846cb183eb0d02fa581f4426f946a89d1');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmer_id` int(200) NOT NULL,
  `farmer_name` varchar(200) DEFAULT NULL,
  `farmer_email` varchar(200) DEFAULT NULL,
  `farmer_phone` varchar(200) DEFAULT NULL,
  `farmer_address` longtext DEFAULT NULL,
  `farmer_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmer_id`, `farmer_name`, `farmer_email`, `farmer_phone`, `farmer_address`, `farmer_login_id`) VALUES
(9, 'James Doe', 'jd@gmail.com', '0712345678', '12345 Nairobi', 'cb2fb74daf0d6a10d3ba45629cefa6aae9aad6279cc2'),
(10, 'Jane Doe', 'jane_doe@gmail.com', '0966542312', '127 Moyale', '0a1697b8fe07f0cc243aef6ff340f7b5c5ab9b2e2b3c');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_products`
--

CREATE TABLE `farmer_products` (
  `farmer_product_id` int(200) NOT NULL,
  `farmer_product_farmer_id` int(200) NOT NULL,
  `farmer_product_product_id` int(200) NOT NULL,
  `farmer_product_date` varchar(200) DEFAULT NULL,
  `farmer_product_quantity` varchar(200) DEFAULT NULL,
  `farmer_product_price` varchar(200) DEFAULT NULL,
  `farmer_product_image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer_products`
--

INSERT INTO `farmer_products` (`farmer_product_id`, `farmer_product_farmer_id`, `farmer_product_product_id`, `farmer_product_date`, `farmer_product_quantity`, `farmer_product_price`, `farmer_product_image`) VALUES
(2, 9, 4, '2022-06-07', '388', '20', 'W4890.jpg'),
(3, 9, 5, '2022-06-07', '296', '10', 'K6721.jpg'),
(6, 10, 1, '2022-06-07', '1355', '150', 'B2671.jpg'),
(7, 10, 2, '2022-06-08', '1185', '200', 'V7104.jpg'),
(8, 9, 1, '2022-06-09', '1500', '500', 'T3815.jpg'),
(9, 10, 1, '2022-06-09', '790', '150', 'V5061.png'),
(10, 9, 6, '2022-06-09', '1488', '10', 'Z2108.jpg'),
(11, 9, 7, '2022-06-09', '492', '120', 'Y6915.jpg'),
(12, 10, 8, '2022-06-09', '1500', '500', 'R4358.jpg'),
(13, 9, 10, '2022-06-09', '550', '100', 'E5068.jpg'),
(14, 10, 9, '2022-06-09', '499', '150', 'E9761.jpg'),
(15, 10, 11, '2022-06-09', '4489', '700', 'J3429.jpg'),
(16, 10, 13, '2022-06-09', '697', '450', 'V8547.jpeg'),
(17, 10, 14, '2022-06-09', '887', '150', 'G5748.jpg'),
(18, 10, 15, '2022-06-09', '438', '900', 'L2410.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(200) NOT NULL,
  `login_name` varchar(200) NOT NULL,
  `login_password` varchar(200) NOT NULL,
  `login_rank` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_name`, `login_password`, `login_rank`) VALUES
('0a1697b8fe07f0cc243aef6ff340f7b5c5ab9b2e2b3c', 'jane_doe@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Farmer'),
('0d43b67d4c2846cb183eb0d02fa581f4426f946a89d1', 'janetmon@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('50de78d38669d48892e56f1f81203502c51a83f69335', 'paul@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('5d765e3358b5677856f1ee79eacf5a5984a7ff533716', 'sysadmin@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Admin'),
('6235e6cf30dc0979fd32c1d958dffd007ed843c4a06a', 'cust001@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('74820c322758da983ec75a30d216f272e2a13a4963e1', 'james1234@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('753e65daba8f8a1309a38032c40caec67db3e59be23a', 'martdevelopers254@gmail.com', 'df0056bf1e9ee39794c7680a186bed41a7d5c0ec', 'Farmer'),
('cb2fb74daf0d6a10d3ba45629cefa6aae9aad6279cc2', 'jd@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Farmer');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(200) NOT NULL,
  `order_ref` varchar(200) DEFAULT NULL,
  `order_status` varchar(200) DEFAULT NULL,
  `order_customer_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_ref`, `order_status`, `order_customer_id`) VALUES
(24, 'N4013', 'Pending', 3),
(26, 'A4862', 'Paid', 6),
(27, 'M8045', 'Paid', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(200) NOT NULL,
  `order_item_order_id` int(200) NOT NULL,
  `order_item_farmer_product_id` int(200) NOT NULL,
  `order_item_quantity_ordered` varchar(200) DEFAULT NULL,
  `order_item_cost` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_item_order_id`, `order_item_farmer_product_id`, `order_item_quantity_ordered`, `order_item_cost`) VALUES
(46, 26, 7, '1', '200'),
(47, 26, 10, '1', '10'),
(48, 26, 18, '1', '900'),
(49, 26, 2, '1', '20'),
(50, 27, 3, '1', '10'),
(51, 27, 14, '1', '150'),
(52, 27, 7, '1', '200'),
(53, 27, 16, '1', '450'),
(54, 27, 15, '1', '700');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(200) NOT NULL,
  `payment_type` varchar(200) DEFAULT NULL,
  `payment_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `payment_ref` varchar(200) DEFAULT NULL,
  `payment_order_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_type`, `payment_date`, `payment_ref`, `payment_order_id`) VALUES
(19, 'Cash On Delivery', '2022-06-09 15:57:22.399185', 'JYF5O8B0D4', 26),
(20, 'Credit / Debit Card', '2022-06-09 15:59:48.802963', 'REBHJDYMFN', 27);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(200) NOT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_desc` longtext DEFAULT NULL,
  `product_category_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_category_id`) VALUES
(1, 'Maize', 'Maize  also known as corn (North American and Australian English), is a cereal grain first domesticated by indigenous peoples in southern Mexico about 10,000 years ago.[1][2] The leafy stalk of the plant produces pollen inflorescences (or \"tassels\") and separate ovuliferous inflorescences called ears that when fertilized yield kernels or seeds, which are fruits.[3][4] ', 1),
(2, 'Beans', 'A bean is the seed of one of several genera of the flowering plant family Fabaceae, which are used as vegetables for human or animal food. They can be cooked in many different ways, including boiling, frying, and baking, and are used in many traditional dishes throughout the world. ', 2),
(4, 'Tomatoes', 'The tomato is the edible berry of the plant Solanum lycopersicum,[1][2] commonly known as the tomato plant. The species originated in western South America and Central America.[2][3] The Mexican Nahuatl word tomatl gave rise to the Spanish word tomate, from which the English word tomato derived.[3][4] Its domestication and use as a cultivated food may have originated with the indigenous peoples of Mexico.[2][5] The Aztecs used tomatoes in their cooking at the time of the Spanish conquest of the Aztec Empire, and after the Spanish encountered the tomato for the first time after their contact with the Aztecs, they brought the plant to Europe, in a widespread transfer of plants known as the Columbian exchange. From there, the tomato was introduced to other parts of the European-colonized world during the 16th century.[2]\r\n', 5),
(5, 'Avocado', 'The avocado (Persea americana) is a tree originating in the Americas which is likely native to the highland regions of south-central Mexico to Guatemala.[3][4][5] It is classified as a member of the flowering plant family Lauraceae.[3] The fruit of the plant, also called an avocado (or avocado pear or alligator pear), is botanically a large berry containing a single large seed.[6] Avocado trees are partially self-pollinating, and are often propagated through grafting to maintain predictable fruit quality and quantity.[7]', 6),
(6, 'Carrots', 'The carrot (Daucus carota subsp. sativus) is a root vegetable, typically orange in color, though purple, black, red, white, and yellow cultivars exist,[2][3][4] all of which are domesticated forms of the wild carrot, Daucus carota, native to Europe and Southwestern Asia. The plant probably originated in Persia and was originally cultivated for its leaves and seeds. The most commonly eaten part of the plant is the taproot, although the stems and leaves are also eaten. The domestic carrot has been selectively bred for its enlarged, more palatable, less woody-textured taproot.\r\n\r\nThe carrot is a biennial plant in the umbellifer family, Apiaceae. At first, it grows a rosette of leaves while building up the enlarged taproot. Fast-growing cultivars mature within three months (90 days) of sowing the seed, while slower-maturing cultivars need a month longer (120 days). The roots contain high quantities of alpha- and beta-carotene, and are a good source of vitamin A, vitamin K, and vitamin B6.\r\n\r\nThe United Nations Food and Agriculture Organization (FAO) reports that world production of carrots and turnips (these plants are combined by the FAO) for 2018 was 40 million tonnes, with 45% of the world total grown in China. Carrots are commonly consumed raw or cooked in various cuisines. ', 3),
(7, 'Bell Peppers', 'The bell pepper (also known as paprika, sweet pepper, pepper, or capsicum /ˈkæpsɪkəm/)[1] is the fruit of plants in the Grossum cultivar group of the species Capsicum annuum.[2][3] Cultivars of the plant produce fruits in different colors, including red, yellow, orange, green, white, and purple. Bell peppers are sometimes grouped with less pungent chili varieties as \"sweet peppers\". While they are fruits—botanically classified as berries—they are commonly used as a vegetable ingredient or side dish. The fruits of the Capsicum genus are categorized as chili peppers.\r\n\r\nPeppers are native to Mexico, Central America, and northern South America. Pepper seeds were imported to Spain in 1493 and then spread through Europe and Asia. The mild bell pepper cultivar was developed in the 1920s, in Szeged, Hungary.[4] Preferred growing conditions for bell peppers include warm, moist soil in a temperature range of 21 to 29 °C (70 to 84 °F).[5] ', 5),
(8, 'Dates', 'Phoenix dactylifera, commonly known as date or date palm,[2] is a flowering plant species in the palm family, Arecaceae, cultivated for its edible sweet fruit called dates. The species is widely cultivated across northern Africa, the Middle East, and South Asia, and is naturalized in many tropical and subtropical regions worldwide.[3][4][5] P. dactylifera is the type species of genus Phoenix, which contains 12–19 species of wild date palms.[6]\r\n\r\nDate trees reach up to 30 metres (100 ft) in height, growing singly or forming a clump with several stems from a single root system. Slow-growing, they can reach over 100 years of age when maintained properly.[7] Date fruits (dates) are oval-cylindrical, 3 to 7 centimetres (1 to 3 in) long, and about 2.5 centimetres (1 in) in diameter, with colour ranging from dark brown to bright red or yellow, depending on variety. Containing 61–68 percent sugar by mass when dried,[8] dates are very sweet and are enjoyed as desserts on their own or within confections.\r\n\r\nDates have been cultivated in the Middle East and the Indus Valley for thousands of years. There is archaeological evidence of date cultivation in Arabia from the 6th millennium BCE. The total annual world production of dates amounts to 8.5 million metric tons, countries of the Middle East and North Africa being the largest producers and consumers.[9] ', 6),
(9, 'Bananas', 'A banana is an elongated, edible fruit – botanically a berry[1][2] – produced by several kinds of large herbaceous flowering plants in the genus Musa.[3] In some countries, bananas used for cooking may be called \"plantains\", distinguishing them from dessert bananas. The fruit is variable in size, color, and firmness, but is usually elongated and curved, with soft flesh rich in starch covered with a rind, which may be green, yellow, red, purple, or brown when ripe. The fruits grow upward in clusters near the top of the plant. Almost all modern edible seedless (parthenocarp) bananas come from two wild species – Musa acuminata and Musa balbisiana. The scientific names of most cultivated bananas are Musa acuminata, Musa balbisiana, and Musa × paradisiaca for the hybrid Musa acuminata × M. balbisiana, depending on their genomic constitution. The old scientific name for this hybrid, Musa sapientum, is no longer used. ', 6),
(10, 'Peas', 'The pea is most commonly the small spherical seed or the seed-pod of the pod fruit Pisum sativum. Each pod contains several peas, which can be green or yellow. Botanically, pea pods are fruit,[2] since they contain seeds and develop from the ovary of a (pea) flower. The name is also used to describe other edible seeds from the Fabaceae such as the pigeon pea (Cajanus cajan), the cowpea (Vigna unguiculata), and the seeds from several species of Lathyrus.\r\n\r\nPeas are annual plants, with a life cycle of one year. They are a cool-season crop grown in many parts of the world; planting can take place from winter to early summer depending on location. The average pea weighs between 0.1 and 0.36 gram.[3] The immature peas (and in snow peas the tender pod as well) are used as a vegetable, fresh, frozen or canned; varieties of the species typically called field peas are grown to produce dry peas like the split pea shelled from a matured pod. These are the basis of pease porridge and pea soup, staples of medieval cuisine; in Europe, consuming fresh immature green peas was an innovation of early modern cuisine. ', 2),
(11, 'Sweet Potatoes', 'The sweet potato or sweetpotato (Ipomoea batatas) is a dicotyledonous plant that belongs to the bindweed or morning glory family, Convolvulaceae. Its large, starchy, sweet-tasting tuberous roots are used as a root vegetable.[1][2] The young shoots and leaves are sometimes eaten as greens. Cultivars of the sweet potato have been bred to bear tubers with flesh and skin of various colors. Sweet potato is only distantly related to the common potato (Solanum tuberosum), both being in the order Solanales. Although darker sweet potatoes are often referred to as \"yams\" in parts of North America, the species is not a true yam, which are monocots in the order Dioscoreales.[3]\r\n\r\nSweet potato is native to the tropical regions of the Americas.[4][5] Of the approximately 50 genera and more than 1,000 species of Convolvulaceae, I. batatas is the only crop plant of major importance—some others are used locally (e.g., I. aquatica \"kangkong\"), but many are poisonous. The genus Ipomoea that contains the sweet potato also includes several garden flowers called morning glories, though that term is not usually extended to I. batatas. Some cultivars of I. batatas are grown as ornamental plants under the name tuberous morning glory, and used in a horticultural context. ', 3),
(12, 'Yams', 'Yam is the common name for some plant species in the genus Dioscorea (family Dioscoreaceae) that form edible tubers.[1] Yams are perennial herbaceous vines cultivated for the consumption of their starchy tubers in many temperate and tropical regions, especially in West Africa, South America and the Caribbean, Asia, and Oceania.[1] The tubers themselves, also called \"yams\", come in a variety of forms owing to numerous cultivars and related species.[1]\r\nYams were independently domesticated on three different continents: Africa (Dioscorea rotundata), Asia (Dioscorea alata), and the Americas (Dioscorea trifida).[2] ', 3),
(13, 'Cassava', 'Manihot esculenta, commonly called cassava (/kəˈsɑːvə/), manioc,[2] or yuca (among numerous regional names) is a woody shrub of the spurge family, Euphorbiaceae, native to South America. Although a perennial plant, cassava is extensively cultivated as an annual crop in tropical and subtropical regions for its edible starchy tuberous root, a major source of carbohydrates. Though it is often called yuca in parts of Spanish America and in the United States, it is not related to yucca, a shrub in the family Asparagaceae. Cassava is predominantly consumed in boiled form, but substantial quantities are used to extract cassava starch, called tapioca, which is used for food, animal feed, and industrial purposes. The Brazilian farinha, and the related garri of West Africa, is an edible coarse flour obtained by grating cassava roots, pressing moisture off the obtained grated pulp, and finally drying it (and roasting both in the case of farinha and garri).\r\n\r\nCassava is the third-largest source of food carbohydrates in the tropics, after rice and maize.[3][4][5] Cassava is a major staple food in the developing world, providing a basic diet for over half a billion people.[6] It is one of the most drought-tolerant crops, capable of growing on marginal soils. Nigeria is the world\'s largest producer of cassava, while Thailand is the largest exporter of cassava starch. ', 3),
(14, 'Yellow Peas', 'Lathyrus aphaca, known as the yellow pea or yellow vetchling, is an annual species in the family Fabaceae with yellow flowers and solitary, pea-like fruits. It originated in the Middle East and has spread throughout Europe and beyond as a weed of cultivated fields and roadsides. The fruits are eaten as a supplement to diets in some parts of South Asia but are narcotic and potentially toxic in large quantities.', 2),
(15, 'Strawberries', 'The garden strawberry (or simply strawberry; Fragaria × ananassa)[1] is a widely grown hybrid species of the genus Fragaria, collectively known as the strawberries, which are cultivated worldwide for their fruit. The fruit is widely appreciated for its characteristic aroma, bright red color, juicy texture, and sweetness. It is consumed in large quantities, either fresh or in such prepared foods as jam, juice, pies, ice cream, milkshakes, and chocolates. Artificial strawberry flavorings and aromas are also widely used in products such as candy, soap, lip gloss, perfume, and many others.\r\n\r\nThe garden strawberry was first bred in Brittany, France, in the 1750s via a cross of Fragaria virginiana from eastern North America and Fragaria chiloensis, which was brought from Chile by Amédée-François Frézier in 1714.[2] Cultivars of Fragaria × ananassa have replaced, in commercial production, the woodland strawberry (Fragaria vesca), which was the first strawberry species cultivated in the early 17th century.[3]\r\n\r\nThe strawberry is not, from a botanical point of view, a berry. Technically, it is an aggregate accessory fruit, meaning that the fleshy part is derived not from the plant\'s ovaries but from the receptacle that holds the ovaries.[4] Each apparent \"seed\" (achene) on the outside of the fruit is actually one of the ovaries of the flower, with a seed inside it.[4]\r\nIn 2019, world production of strawberries was 9 million tonnes, led by China with 40% of the total. ', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `CustomerLogin` (`customer_login_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`farmer_id`),
  ADD KEY `Farmer_Login` (`farmer_login_id`);

--
-- Indexes for table `farmer_products`
--
ALTER TABLE `farmer_products`
  ADD PRIMARY KEY (`farmer_product_id`),
  ADD KEY `ProductProductID` (`farmer_product_product_id`),
  ADD KEY `FarmerProductID` (`farmer_product_farmer_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `OrderCustomer` (`order_customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `ItemOrdeID` (`order_item_order_id`),
  ADD KEY `ItemOrderFarmerProductID` (`order_item_farmer_product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `PaymentOrderID` (`payment_order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ProductCategory` (`product_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `farmer_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `farmer_products`
--
ALTER TABLE `farmer_products`
  MODIFY `farmer_product_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `CustomerLogin` FOREIGN KEY (`customer_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmer`
--
ALTER TABLE `farmer`
  ADD CONSTRAINT `Farmer_Login` FOREIGN KEY (`farmer_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmer_products`
--
ALTER TABLE `farmer_products`
  ADD CONSTRAINT `FarmerProductID` FOREIGN KEY (`farmer_product_farmer_id`) REFERENCES `farmer` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProductProductID` FOREIGN KEY (`farmer_product_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `OrderCustomer` FOREIGN KEY (`order_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `ItemOrdeID` FOREIGN KEY (`order_item_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ItemOrderFarmerProductID` FOREIGN KEY (`order_item_farmer_product_id`) REFERENCES `farmer_products` (`farmer_product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `PaymentOrderID` FOREIGN KEY (`payment_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `ProductCategory` FOREIGN KEY (`product_category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

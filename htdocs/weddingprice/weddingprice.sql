--
-- MySQL 5.5.8
-- Wed, 20 Mar 2013 10:26:34 +0000
--

CREATE TABLE `bid` (
   `bidid` int(11) not null auto_increment,
   `weddingcategoryid` int(11) not null,
   `amount` int(11) not null,
   `date` varchar(255) not null,
   `supplierid` int(11) not null,
   `biddescription` text not null,
   `lastmodified` datetime not null default '2011-02-01 00:00:00',
   `status` enum('PENDING','CONFIRMED','ACCEPTED','DSICARDED','COMPLETEDBUYER','REVIEWRESPONDED','REVIEWDONE','REJECTED') not null default 'PENDING',
   `weddingid` int(11) not null,
   `categoryid` int(11) not null,
   PRIMARY KEY (`bidid`,`weddingcategoryid`,`weddingid`,`categoryid`),
   KEY `weddingid` (`weddingcategoryid`,`supplierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=67;

INSERT INTO `bid` (`bidid`, `weddingcategoryid`, `amount`, `date`, `supplierid`, `biddescription`, `lastmodified`, `status`, `weddingid`, `categoryid`) VALUES 
('59', '8', '750', '2011-11-15 18:23:41', '78', 'I can do it', '2011-11-15 18:23:41', 'ACCEPTED', '70', '2'),
('60', '12', '499', '2011-11-28 05:48:04', '83', 'this is bid description ........\r\n&lt;strong&gt;This type in bold&lt;/strong&gt;', '2011-11-28 05:48:04', 'REVIEWRESPONDED', '73', '1'),
('62', '10', '100', '2011-11-29 05:40:52', '83', 'hello', '2011-11-29 05:40:52', 'PENDING', '70', '3'),
('66', '17', '20', '2012-01-09 16:24:26', '82', 'ashdasd', '2012-01-09 16:24:26', 'REVIEWRESPONDED', '76', '1');

CREATE TABLE `buyer` (
   `buyerid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   `contactemail` varchar(255) not null,
   `phone` varchar(255) not null,
   `contactperson` varchar(255) not null,
   `countryid` int(11) not null,
   `primaryregionid` int(11) not null,
   `zip` varchar(255) not null,
   `address` text not null,
   `recievequotes` enum('Yes','No') not null,
   `userid` int(11) not null,
   `address2` text not null,
   `city` varchar(255) not null,
   PRIMARY KEY (`buyerid`),
   KEY `countryid` (`countryid`,`primaryregionid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

INSERT INTO `buyer` (`buyerid`, `name`, `contactemail`, `phone`, `contactperson`, `countryid`, `primaryregionid`, `zip`, `address`, `recievequotes`, `userid`, `address2`, `city`) VALUES 
('4', 'Test Buyer', 'haisumbhatti@gmail.com', 'asdad', 'asdads', '151', '59', '213', 'sasadfsf', 'Yes', '3', 'asfsfd', 'asdfwe'),
('5', 'paul', 'paul_web123@yahoo.com', '3232323', 'Paul', '151', '44', '5028', 'eweweeqwewe', 'No', '12', 'ewewewewew', 'wellington'),
('9', 'BrideToBe', 'zulfiqar.a.memon@gmail.com', '1234567890', 'BrideToBe', '151', '2', '123456', 'this is line 1', 'Yes', '46', 'line2', 'Linkin Inn'),
('7', 'Asifali Roudani', 'asifaliroudani@hotmail.com', '00923222334342', '009232255806', '151', '40', '74000', '201, prince Appartment, Garden West, Karachi', 'No', '42', '', 'Karachi'),
('8', 'lynn', 'b3uk01@hotmail.com', '123123123', 'lynn', '151', '5', '5028', 'eeeeeeeeeeee', 'Yes', '44', 'eeeeeeeee', 'wellington'),
('10', 'Joe', 'hertz.media@gmail.com', '12345698', 'Ather\'', '151', '1', '84487', 'wfwerewrwr', 'Yes', '47', '23', 'Zimbabwe');

CREATE TABLE `category` (
   `categoryid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=42;

INSERT INTO `category` (`categoryid`, `name`) VALUES 
('1', 'Bridal Gowns'),
('2', 'Photography'),
('3', 'Videography'),
('4', 'Transport'),
('5', 'stationary'),
('6', 'Entertainment'),
('7', 'flowers'),
('8', 'Celebrant'),
('9', 'Reception Venues'),
('10', 'Suit Hire'),
('11', 'Jewellery'),
('12', 'Cattering'),
('13', 'Cakes');

CREATE TABLE `categorysuppliermap` (
   `categoryid` int(11) not null,
   `supplierid` int(11) not null,
   KEY `categoryid` (`categoryid`,`supplierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `categorysuppliermap` (`categoryid`, `supplierid`) VALUES 
('1', '59'),
('1', '76'),
('1', '78'),
('1', '82'),
('1', '83'),
('2', '77'),
('2', '78'),
('2', '79'),
('2', '83'),
('3', '77'),
('3', '83'),
('4', '78'),
('4', '79'),
('4', '81'),
('5', '75'),
('5', '77'),
('5', '82'),
('6', '59'),
('6', '77'),
('6', '82'),
('6', '83'),
('7', '78'),
('7', '83'),
('8', '63'),
('8', '78'),
('8', '81'),
('8', '82'),
('8', '83'),
('9', '75'),
('9', '82'),
('10', '75'),
('11', '83'),
('12', '59'),
('12', '63'),
('12', '76'),
('12', '82'),
('12', '83'),
('13', '63'),
('13', '81'),
('13', '82');

CREATE TABLE `cmsadmin` (
   `id` int(10) not null auto_increment,
   `user` varchar(50),
   `pass` varchar(50),
   `ses` varchar(50) default '*',
   `dtime` datetime,
   `main` enum('Y','N') not null default 'N',
   `city` int(11) not null default '-1',
   `email` varchar(255),
   `name` varchar(255),
   `role` enum('A','U'),
   `status` enum('A','I') default 'A',
   PRIMARY KEY (`id`),
   KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6;

INSERT INTO `cmsadmin` (`id`, `user`, `pass`, `ses`, `dtime`, `main`, `city`, `email`, `name`, `role`, `status`) VALUES 
('1', 'admin', '200820e3227815ed1756a6b531e7e0d2', '1927-6720-9754-7781', '2011-06-02 10:26:00', 'Y', '1', 'churd@contractorsan.com', 'JP', 'A', 'A'),
('4', 'developer', '5e8edd851d2fdfbd7415232c67367cc3', '5267-6995-7741-6589', '2011-11-27 23:09:00', 'Y', '1', 'jeffally@gmail.com', 'Zee', 'A', 'A'),
('5', 'haisum', 'd8578edf8458ce06fbc5bb76a58c5ca4', '*', '', 'N', '-1', '', '', '', 'A');

CREATE TABLE `configuration` (
   `configurationid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   `value` varchar(255) not null,
   PRIMARY KEY (`configurationid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8;

INSERT INTO `configuration` (`configurationid`, `name`, `value`) VALUES 
('1', 'adperdaycost', '3'),
('2', 'paypalactionurl', 'https://www.sandbox.paypal.com/cgi-bin/webscr'),
('3', 'paypalaccountemail', 'ather_1263477894_biz@hertzmedia.org'),
('4', '3monthpackage', '25'),
('5', '6monthpackage', '40'),
('6', '12monthpackage', '60'),
('7', 'freebidsperuser', '3');

CREATE TABLE `country` (
   `countryid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   `abbreviation` varchar(3) not null,
   `isactive` enum('YES','NO') not null default 'NO',
   PRIMARY KEY (`countryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=261;

INSERT INTO `country` (`countryid`, `name`, `abbreviation`, `isactive`) VALUES 
('1', 'Afghanistan', 'AF', 'NO'),
('2', 'Albania', 'AL', 'NO'),
('3', 'Algeria', 'DZ', 'NO'),
('4', 'American Somoa', 'AS', 'NO'),
('5', 'Andorra', 'AD', 'NO'),
('6', 'Angola', 'AO', 'NO'),
('7', 'Anguilla', 'AI', 'NO'),
('8', 'Antarctica', 'AQ', 'NO'),
('9', 'Antigua and Barbuda', 'AG', 'NO'),
('10', 'Argentina', 'AR', 'NO'),
('11', 'Armenia', 'AM', 'NO'),
('12', 'Aruba', 'AW', 'NO'),
('13', 'Australia', 'AU', 'NO'),
('14', 'Austria', 'AT', 'NO'),
('15', 'Bahamas', 'BS', 'NO'),
('16', 'Bahrain', 'BH', 'NO'),
('17', 'Bangladesh', 'BD', 'NO'),
('18', 'Barbados', 'BB', 'NO'),
('19', 'Belarus', 'BY', 'NO'),
('20', 'Belgium', 'BE', 'NO'),
('21', 'Belize', 'BZ', 'NO'),
('22', 'Benin', 'BJ', 'NO'),
('23', 'Bermuda', 'BM', 'NO'),
('24', 'Bhutan', 'BT', 'NO'),
('25', 'Bolivia', 'BO', 'NO'),
('26', 'Bosnia and Herzegovina', 'BA', 'NO'),
('27', 'Botswana', 'BW', 'NO'),
('28', 'Bouvet Island', 'BV', 'NO'),
('29', 'Brazil', 'BR', 'NO'),
('30', 'British Indian Ocean Territory', 'IO', 'NO'),
('31', 'Brunei Darussalam', 'BN', 'NO'),
('32', 'Bulgaria', 'BG', 'NO'),
('33', 'Burkina Faso', 'BF', 'NO'),
('34', 'Burundi', 'BI', 'NO'),
('35', 'Cambodia', 'KH', 'NO'),
('36', 'Cameroon', 'CM', 'NO'),
('37', 'Canada', 'CA', 'NO'),
('38', 'Cape Verde', 'CV', 'NO'),
('39', 'Cayman Islands', 'KY', 'NO'),
('40', 'Central African Republic', 'CF', 'NO'),
('41', 'Chad', 'TD', 'NO'),
('42', 'Chile', 'CL', 'NO'),
('43', 'China', 'CN', 'NO'),
('44', 'Christmas Island', 'CX', 'NO'),
('45', 'Cocos (Keeling) Islands', 'CC', 'NO'),
('46', 'Colombia', 'CO', 'NO'),
('47', 'Comoros', 'KM', 'NO'),
('48', 'Congo', 'CG', 'NO'),
('49', 'Cook Islands', 'CK', 'NO'),
('50', 'Costa Rica', 'CR', 'NO'),
('51', 'Croatia', 'HR', 'NO'),
('52', 'Cuba', 'CU', 'NO'),
('53', 'Cyprus', 'CY', 'NO'),
('54', 'Czech Republic', 'CZ', 'NO'),
('55', 'Denmark', 'DK', 'NO'),
('56', 'Djibouti', 'DJ', 'NO'),
('57', 'Dominica', 'DM', 'NO'),
('58', 'Dominican Republic', 'DO', 'NO'),
('59', 'East Timor', 'TP', 'NO'),
('60', 'Ecuador', 'EC', 'NO'),
('61', 'Egypt', 'EG', 'NO'),
('62', 'El Salvador', 'SV', 'NO'),
('63', 'Equatorial Guinea', 'GQ', 'NO'),
('64', 'Eritrea', 'ER', 'NO'),
('65', 'Estonia', 'EE', 'NO'),
('66', 'Ethiopia', 'ET', 'NO'),
('67', 'Faroe Islands', 'FO', 'NO'),
('68', 'Falkland Islands', 'FK', 'NO'),
('69', 'Fiji', 'FJ', 'NO'),
('70', 'Finland', 'FI', 'NO'),
('71', 'France', 'FR', 'NO'),
('72', 'French Guiana', 'GF', 'NO'),
('73', 'French Polynesia', 'PF', 'NO'),
('74', 'French Southern and Antarctic Lands', 'FQ', 'NO'),
('75', 'Gabon', 'GA', 'NO'),
('76', 'Gambia', 'GM', 'NO'),
('77', 'Georgia', 'GE', 'NO'),
('78', 'Germany', 'DE', 'NO'),
('79', 'Ghana', 'GH', 'NO'),
('80', 'Gibraltar', 'GI', 'NO'),
('81', 'Greece', 'GR', 'NO'),
('82', 'Greenland', 'GL', 'NO'),
('83', 'Grenada', 'GD', 'NO'),
('84', 'Guadaloupe', 'GP', 'NO'),
('85', 'Guam', 'GU', 'NO'),
('86', 'Guatemala', 'GT', 'NO'),
('87', 'Guinea', 'GN', 'NO'),
('88', 'Guinea-Bissau', 'GW', 'NO'),
('89', 'Guyana', 'GY', 'NO'),
('90', 'Haiti', 'HT', 'NO'),
('91', 'Heard Island and McDonald Islands', 'HM', 'NO'),
('92', 'Honduras', 'HN', 'NO'),
('93', 'Hong Kong', 'HK', 'NO'),
('94', 'Hungary', 'HU', 'NO'),
('95', 'Iceland', 'IS', 'NO'),
('96', 'India', 'IN', 'NO'),
('97', 'Indonesia', 'ID', 'NO'),
('98', 'Iran', 'IR', 'NO'),
('99', 'Iraq', 'IQ', 'NO'),
('100', 'Ireland', 'IE', 'NO'),
('101', 'Israel', 'IL', 'NO'),
('102', 'Italy', 'IT', 'NO'),
('103', 'Ivory Coast', 'CI', 'NO'),
('104', 'Jamaica', 'JM', 'NO'),
('105', 'Japan', 'JP', 'NO'),
('106', 'Jordan', 'JO', 'NO'),
('107', 'Kazakhstan', 'KZ', 'NO'),
('108', 'Kenya', 'KE', 'NO'),
('109', 'North Korea', 'KP', 'NO'),
('110', 'South Korea', 'KR', 'NO'),
('111', 'Kuwait', 'KW', 'NO'),
('112', 'Kyrgyzstan', 'KG', 'NO'),
('113', 'Laos', 'LA', 'NO'),
('114', 'Latvia', 'LV', 'NO'),
('115', 'Lebanon', 'LN', 'NO'),
('116', 'Lesotho', 'LS', 'NO'),
('117', 'Liberia', 'LR', 'NO'),
('118', 'Libya', 'LY', 'NO'),
('119', 'Liechtenstein', 'LI', 'NO'),
('120', 'Lithuania', 'LT', 'NO'),
('121', 'Luxembourg', 'LU', 'NO'),
('122', 'Macau', 'MO', 'NO'),
('123', 'Macedonia', 'MK', 'NO'),
('124', 'Madagascar', 'MG', 'NO'),
('125', 'Malawi', 'MW', 'NO'),
('126', 'Malaysia', 'MY', 'NO'),
('127', 'Maldives', 'MV', 'NO'),
('128', 'Mali', 'ML', 'NO'),
('129', 'Malta', 'MT', 'NO'),
('130', 'Marshall Islands', 'MH', 'NO'),
('131', 'Martinique', 'MQ', 'NO'),
('132', 'Mauritania', 'MR', 'NO'),
('133', 'Mauritius', 'MU', 'NO'),
('134', 'Mayotte', 'YT', 'NO'),
('135', 'Mexico', 'MX', 'NO'),
('136', 'Micronesia', 'FM', 'NO'),
('137', 'Moldova', 'MD', 'NO'),
('138', 'Monaco', 'MC', 'NO'),
('139', 'Mongolia', 'MN', 'NO'),
('140', 'Montserrat', 'MS', 'NO'),
('141', 'Morocco', 'MA', 'NO'),
('142', 'Mozambique', 'MZ', 'NO'),
('143', 'Myanmar', 'MM', 'NO'),
('144', 'Namibia', 'NA', 'NO'),
('145', 'Nauru', 'NR', 'NO'),
('146', 'Nepal', 'NP', 'NO'),
('147', 'Netherlands', 'NL', 'NO'),
('148', 'Netherlands Antilles', 'AN', 'NO'),
('149', 'New Caledonia', 'NC', 'NO'),
('150', 'New Hebrides', 'NH', 'NO'),
('151', 'New Zealand', 'NZ', 'YES'),
('152', 'Nicaragua', 'NI', 'NO'),
('153', 'Niger', 'NE', 'NO'),
('154', 'Nigeria', 'NG', 'NO'),
('155', 'Niue', 'NU', 'NO'),
('156', 'Norfolk Island', 'NF', 'NO'),
('157', 'Norway', 'NO', 'NO'),
('158', 'Oman', 'OM', 'NO'),
('159', 'Pakistan', 'PK', 'NO'),
('160', 'Palau', 'PW', 'NO'),
('161', 'Panama', 'PA', 'NO'),
('162', 'Papua New Guinea', 'PG', 'NO'),
('163', 'Paraguay', 'PY', 'NO'),
('164', 'Peru', 'PE', 'NO'),
('165', 'Philippines', 'PH', 'NO'),
('166', 'Pitcairn', 'PN', 'NO'),
('167', 'Poland', 'PL', 'NO'),
('168', 'Portugal', 'PT', 'NO'),
('169', 'Puerto Rico', 'PR', 'NO'),
('170', 'Qatar', 'QA', 'NO'),
('171', 'Reunion', 'RE', 'NO'),
('172', 'Romania', 'RO', 'NO'),
('173', 'Russia', 'RU', 'NO'),
('174', 'Rwanda', 'RW', 'NO'),
('175', 'St. Christopher-Nevis-Anguilla', 'KN', 'NO'),
('176', 'St. Helena', 'SH', 'NO'),
('177', 'St. Lucia', 'LC', 'NO'),
('178', 'St. Pierre and Miquelon', 'PM', 'NO'),
('179', 'St. Vincent', 'VC', 'NO'),
('180', 'Samoa', 'WS', 'NO'),
('181', 'San Marino', 'SM', 'NO'),
('182', 'Sao Tome and Principe', 'ST', 'NO'),
('183', 'Saudi Arabia', 'SA', 'NO'),
('184', 'Senegal', 'SN', 'NO'),
('185', 'Seychelles', 'SC', 'NO'),
('186', 'Sierra Leone', 'SL', 'NO'),
('187', 'Singapore', 'SG', 'NO'),
('188', 'Slovakia', 'SK', 'NO'),
('189', 'Slovenia', 'SI', 'NO'),
('190', 'Solomon Islands', 'SB', 'NO'),
('191', 'Somalia', 'SO', 'NO'),
('192', 'South Africa', 'ZA', 'NO'),
('193', 'Spain', 'ES', 'NO'),
('194', 'Sri Lanka', 'LK', 'NO'),
('195', 'Sudan', 'SD', 'NO'),
('196', 'Surinam', 'SR', 'NO'),
('197', 'Svalbard and Jan Mayen', 'SJ', 'NO'),
('198', 'Swaziland', 'SZ', 'NO'),
('199', 'Sweden', 'SE', 'NO'),
('200', 'Switzerland', 'CH', 'NO'),
('201', 'Syria', 'SY', 'NO'),
('202', 'Taiwan', 'TW', 'NO'),
('203', 'Tajikistan', 'TJ', 'NO'),
('204', 'Tanzania', 'TZ', 'NO'),
('205', 'Thailand', 'TH', 'NO'),
('206', 'Togo', 'TG', 'NO'),
('207', 'Tokelau Islands', 'TK', 'NO'),
('208', 'Tonga', 'TO', 'NO'),
('209', 'Trinidad and Tobago', 'TT', 'NO'),
('210', 'Tunisia', 'TN', 'NO'),
('211', 'Turkey', 'TR', 'NO'),
('212', 'Turks and Caicos Islands', 'TC', 'NO'),
('213', 'Tuvalu', 'TV', 'NO'),
('214', 'Uganda', 'UG', 'NO'),
('215', 'Ukraine', 'UA', 'NO'),
('216', 'United Arab Emirates', 'AE', 'NO'),
('217', 'United Kingdom', 'GB', 'NO'),
('218', 'United States of America', 'US', 'NO'),
('220', 'Uruguay', 'UY', 'NO'),
('221', 'Uzbekistan', 'UZ', 'NO'),
('222', 'Vatican City', 'VA', 'NO'),
('223', 'Venezuela', 'VE', 'NO'),
('224', 'Vietnam', 'VN', 'NO'),
('225', 'Virgin Islands (U.S.)', 'VI', 'NO'),
('226', 'Wallis and Futana', 'WF', 'NO'),
('227', 'Western Sahara', 'EH', 'NO'),
('228', 'Yemen', 'YE', 'NO'),
('229', 'Yugoslavia', 'YU', 'NO'),
('230', 'Zaire', 'ZR', 'NO'),
('231', 'Zambia', 'ZM', 'NO'),
('232', 'Zimbabwe', 'ZW', 'NO'),
('233', 'Serbia', 'RS', 'NO'),
('234', 'Montenegro', 'ME', 'NO'),
('235', 'Republika Srpska', 'RS2', 'NO');

CREATE TABLE `emailtemplate` (
   `emailtemplateid` int(11) not null auto_increment,
   `type` varchar(255) not null,
   `body` varchar(255) not null,
   `subject` varchar(255) not null,
   `from` varchar(255) not null,
   `fromname` varchar(255) not null,
   `to` varchar(255) not null,
   PRIMARY KEY (`emailtemplateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=35;

INSERT INTO `emailtemplate` (`emailtemplateid`, `type`, `body`, `subject`, `from`, `fromname`, `to`) VALUES 
('1', 'passwordReset', 'We have recieved password reset request for your account. Kindly click on following URL to continue with password reset.<br/>[link]<br/>If your browser doesn\'t respond on click, manually copy URL to navigation bar of your browser and press return key.', 'Wedding Price Sample - Password Reset Request', 'admin@weddingpricesample.com', 'Admin', ''),
('2', 'contactSupport', 'Name: [name]&lt;br/&gt;Email: [email]&lt;br/&gt;Message: [message]', '', 'contact@weddingpricesample.com', 'Wedding Price Contact Form', 'hertz.media@gmail.com'),
('3', 'registeration', 'Thankyou for showing interest in WeddingPrice. Your new password is:\"[password]\". Please use it to login on <a href=\"[linkUrl]\">Weddingprice login page</a>.', 'Your Weddingprice Password', 'admin@weddingpricesample.com', 'Weddingprice Admin', ''),
('29', 'bidStatusChange', 'Your bid status on a request was changed to view changes visit [link].', 'Wedding Price - Bid Status Changed', 'admin@weddingprice.co.nz', 'Wedding Price Admin', ''),
('30', 'requestStatusChange', 'Your request status was changed to view details visit [link]', 'Wedding Price - Request Changed', 'admin@weddingprice.co.nz', 'Wedding Price Admin', ''),
('31', 'requestInRegion', 'A request for a wedding in your region has been posted to view follow [link]', 'Wedding Price | New Request In Region', 'admin@weddingprice.co.nz', 'Wedding Price Admin', ''),
('32', 'requestInCategory', 'A request for a wedding in your preferred category has been posted to view follow [link]', 'Wedding Price | New Request In Region', 'admin@weddingprice.co.nz', 'Wedding Price Admin', ''),
('33', 'goldPaymentReceived', 'This email is to confirm that your payment for Gold membership has been received. You may enjoy benefits of gold membership now.', 'Wedding Price | Gold Membership Confirmation', 'admin@weddingprice.co.nz', 'Wedding Price Admin', ''),
('34', 'adPaymentReceived', 'Thisasdd email is to confirm that your payment for ads has been received. You may now see your ad  at our site\'s home page.', 'Wedding Price | Ad Payment Received', 'admin@weddingprice.co.nz', 'Weddddding Price Admin', '');

CREATE TABLE `faq` (
   `faqid` int(11) not null auto_increment,
   `question` text not null,
   `answer` text not null,
   `position` int(11) not null default '1',
   `date` datetime not null,
   `faqcategoryid` int(11) not null,
   PRIMARY KEY (`faqid`),
   KEY `faqcategoryid` (`faqcategoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=40;

INSERT INTO `faq` (`faqid`, `question`, `answer`, `position`, `date`, `faqcategoryid`) VALUES 
('1', 'How to register?', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. ', '1', '2011-08-02 14:17:06', '1'),
('2', 'How to reset my password?', 'Go to password reset page :P', '2', '2011-08-02 14:18:02', '1'),
('3', 'How much do I have to pay', 'Nothing :D', '1', '2011-08-02 14:18:34', '3'),
('4', 'What if I forgot my password', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', '2', '2011-08-02 14:31:17', '1'),
('5', 'Duis autem vel eum iriure dolor?', 'praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. ', '3', '2011-08-02 14:33:15', '2'),
('6', 'Lorem ipsum dolor sit amet, consectetuer adipiscing', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis', '6', '2011-08-02 14:34:30', '4'),
('7', 'et iusto odio dignissim qui blandit praesent luptatum zzril ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat', '6', '2011-08-02 14:35:38', '2'),
('8', 'Duis autem vel eum iriure dolor?', 'praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. ', '4', '2011-08-02 14:33:15', '1'),
('9', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, se?', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis', '5', '2011-08-02 14:34:30', '3'),
('10', 'et iusto odio dignissim qui blandit praesent luptatum zzril ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat', '6', '2011-08-02 14:35:38', '3'),
('11', 'et iusto odio dignissim qui blandit praesent luptatum zzril asdgf?', 'haisum ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat', '5', '2011-08-02 14:35:38', '2'),
('12', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, se?', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis', '5', '2011-08-02 14:34:30', '4'),
('13', 'Duis autem vel eum iriure dolor?', 'praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. ', '4', '2011-08-02 14:33:15', '2');

CREATE TABLE `faqcategory` (
   `faqcategoryid` int(11) not null auto_increment,
   `title` varchar(255) not null,
   `position` int(11) not null default '1',
   `date` datetime not null,
   PRIMARY KEY (`faqcategoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=31;

INSERT INTO `faqcategory` (`faqcategoryid`, `title`, `position`, `date`) VALUES 
('1', 'New To Wedding Price Sample?', '1', '2011-08-02 14:15:51'),
('2', 'How Wedding Price Sample Works', '2', '2011-08-02 14:16:16'),
('3', 'Supplier Account', '3', '2011-08-02 14:22:40'),
('4', 'Bride or Groom Account', '4', '2011-08-02 14:23:08');

CREATE TABLE `goldpayment` (
   `goldpaymentid` int(11) not null auto_increment,
   `supplierid` int(11) not null,
   `package` enum('3','6','12') not null,
   `amount` int(11) not null,
   `status` enum('VERIFIED','PENDING') not null,
   `date` datetime not null,
   `expiredate` datetime not null,
   `responsearray` text not null,
   PRIMARY KEY (`goldpaymentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

INSERT INTO `goldpayment` (`goldpaymentid`, `supplierid`, `package`, `amount`, `status`, `date`, `expiredate`, `responsearray`) VALUES 
('1', '83', '3', '25', 'VERIFIED', '2011-11-29 07:11:26', '2012-02-29 07:11:26', 'mc_gross=25.00||protection_eligibility=Eligible||address_status=confirmed||payer_id=S3643N8W3NE76||tax=0.00||address_street=1 Main St||payment_date=05:12:23 Nov 29, 2011 PST||payment_status=Pending||charset=windows-1252||address_zip=95131||first_name=Test||address_country_code=US||address_name=Test User||notify_version=3.4||custom=1||payer_status=verified||business=ather_1263477894_biz@hertzmedia.org||address_country=United States||address_city=San Jose||quantity=1||verify_sign=AkCfnbaUwA08R9AA4waqrASPDV-1A87ba5twvf-XKrmI9uIFIm.QY64q||payer_email=ather_1317908234_per@hertzmedia.org||txn_id=1F962458XN251013Y||payment_type=instant||last_name=User||address_state=CA||receiver_email=ather_1263477894_biz@hertzmedia.org||receiver_id=GNYEC24EAH2N2||pending_reason=multi_currency||txn_type=web_accept||item_name=Wedding Price | Gold Membersip Payment||mc_currency=NZD||item_number=||residence_country=US||test_ipn=1||handling_amount=0.00||transaction_subject=1||payment_gross=||shipping=0.00||ipn_track_id=Q8RBvXmmKVvc3z7.AfFmUw||'),
('2', '81', '3', '25', 'VERIFIED', '2011-11-30 02:57:39', '2013-08-28 03:13:44', 'mc_gross=25.00||protection_eligibility=Eligible||address_status=confirmed||payer_id=S3643N8W3NE76||tax=0.00||address_street=1 Main St||payment_date=00:58:08 Nov 30, 2011 PST||payment_status=Pending||charset=windows-1252||address_zip=95131||first_name=Test||address_country_code=US||address_name=Test User||notify_version=3.4||custom=2||payer_status=verified||business=ather_1263477894_biz@hertzmedia.org||address_country=United States||address_city=San Jose||quantity=1||verify_sign=AFcWxV21C7fd0v3bYYYRCpSSRl31AEgBhhhIYrCD0ZfXt-aKY8ltA6p4||payer_email=ather_1317908234_per@hertzmedia.org||txn_id=01069009WV679590C||payment_type=instant||last_name=User||address_state=CA||receiver_email=ather_1263477894_biz@hertzmedia.org||receiver_id=GNYEC24EAH2N2||pending_reason=multi_currency||txn_type=web_accept||item_name=Wedding Price | Gold Membersip Payment||mc_currency=NZD||item_number=||residence_country=US||test_ipn=1||handling_amount=0.00||transaction_subject=2||payment_gross=||shipping=0.00||ipn_track_id=Wio6rblw9.3MJMA.HH74rw||'),
('3', '78', '6', '40', 'PENDING', '2011-12-06 02:01:29', '2012-06-06 02:01:29', '');

CREATE TABLE `message` (
   `messageid` int(11) not null auto_increment,
   `fromid` int(11) not null,
   `toid` int(11) not null,
   `content` text not null,
   `date` datetime not null,
   `isread` enum('YES','NO') not null,
   `status` enum('SHOW','HIDE') not null,
   `weddingid` int(11) not null,
   `from` enum('Buyer','Supplier') not null default 'Buyer',
   PRIMARY KEY (`messageid`),
   KEY `fromidid` (`fromid`,`toid`,`weddingid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=102;

INSERT INTO `message` (`messageid`, `fromid`, `toid`, `content`, `date`, `isread`, `status`, `weddingid`, `from`) VALUES 
('77', '5', '77', 'got your bid - what\'s the price ?', '2011-11-15 03:56:18', 'NO', 'SHOW', '70', 'Buyer'),
('78', '78', '5', 'hi, what do you think of my bid', '2011-11-15 18:24:13', 'YES', 'SHOW', '70', 'Supplier'),
('79', '5', '78', 'nice one', '2011-11-15 18:29:04', 'YES', 'SHOW', '70', 'Buyer'),
('80', '83', '9', '&lt;strong&gt;how r u ??&lt;/strong&gt;', '2011-11-28 05:48:04', 'YES', 'SHOW', '73', 'Supplier'),
('81', '9', '83', 'I am Fine doe', '2011-11-28 05:48:53', 'YES', 'SHOW', '73', 'Buyer'),
('96', '84', '10', '689', '2011-11-30 03:38:12', 'YES', 'SHOW', '74', 'Supplier'),
('97', '10', '84', 'haan bol', '2011-11-30 00:00:00', 'YES', 'SHOW', '74', 'Buyer'),
('98', '10', '84', 'khush?', '2011-11-30 03:40:00', 'YES', 'SHOW', '74', 'Buyer'),
('92', '83', '5', 'Hey I am interested in your wedding', '2012-12-28 00:00:00', 'YES', 'SHOW', '70', 'Supplier'),
('99', '82', '4', 'askdjfjsakdjfsdf', '2012-01-09 16:24:26', 'YES', 'SHOW', '76', 'Supplier'),
('100', '4', '82', 'hey thanks for bidding', '2012-01-09 16:27:25', 'YES', 'SHOW', '76', 'Buyer'),
('101', '4', '82', 'hello', '2012-01-10 11:37:11', 'NO', 'SHOW', '76', 'Buyer');

CREATE TABLE `paypaladpayment` (
   `paypaladpaymentid` int(11) not null auto_increment,
   `specialofferid` int(11) not null,
   `content` text not null,
   PRIMARY KEY (`paypaladpaymentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;

INSERT INTO `paypaladpayment` (`paypaladpaymentid`, `specialofferid`, `content`) VALUES 
('5', '12', 'Array\n(\n    [mc_gross] =&gt; 448.00\n    [protection_eligibility] =&gt; Eligible\n    [address_status] =&gt; confirmed\n    [payer_id] =&gt; S3643N8W3NE76\n    [tax] =&gt; 0.00\n    [address_street] =&gt; 1 Main St\n    [payment_date] =&gt; 02:44:49 Nov 03, 2011 PDT\n    [payment_status] =&gt; Pending\n    [charset] =&gt; windows-1252\n    [address_zip] =&gt; 95131\n    [first_name] =&gt; Test\n    [address_country_code] =&gt; US\n    [address_name] =&gt; Test User\n    [notify_version] =&gt; 3.4\n    [custom] =&gt; 12\n    [payer_status] =&gt; verified\n    [business] =&gt; ather_1263477894_biz@hertzmedia.org\n    [address_country] =&gt; United States\n    [address_city] =&gt; San Jose\n    [quantity] =&gt; 1\n    [verify_sign] =&gt; AytXPGUMNEXPF5Apyyi2wrVOZW.NA2N.ZhSL5c43J3.ibRmlBJEE7bCk\n    [payer_email] =&gt; ather_1317908234_per@hertzmedia.org\n    [txn_id] =&gt; 38850484VP070043P\n    [payment_type] =&gt; instant\n    [last_name] =&gt; User\n    [address_state] =&gt; CA\n    [receiver_email] =&gt; ather_1263477894_biz@hertzmedia.org\n    [receiver_id] =&gt; GNYEC24EAH2N2\n    [pending_reason] =&gt; multi_currency\n    [txn_type] =&gt; web_accept\n    [item_name] =&gt; Wedding Price | Advertising Payment\n    [mc_currency] =&gt; NZD\n    [item_number] =&gt; \n    [residence_country] =&gt; US\n    [test_ipn] =&gt; 1\n    [handling_amount] =&gt; 0.00\n    [transaction_subject] =&gt; 12\n    [payment_gross] =&gt; \n    [shipping] =&gt; 0.00\n    [ipn_track_id] =&gt; T4HEOKCtW4nLU7H51sThpA\n)\n'),
('6', '13', 'mc_gross=14.00||protection_eligibility=Eligible||address_status=confirmed||payer_id=S3643N8W3NE76||tax=0.00||address_street=1 Main St||payment_date=02:54:51 Nov 03, 2011 PDT||payment_status=Pending||charset=windows-1252||address_zip=95131||first_name=Test||address_country_code=US||address_name=Test User||notify_version=3.4||custom=13||payer_status=verified||business=ather_1263477894_biz@hertzmedia.org||address_country=United States||address_city=San Jose||quantity=1||verify_sign=AFcWxV21C7fd0v3bYYYRCpSSRl31A3NHHvYkvMBdEI.H.8U.IKKOwUEy||payer_email=ather_1317908234_per@hertzmedia.org||txn_id=7XR55726UY0888155||payment_type=instant||last_name=User||address_state=CA||receiver_email=ather_1263477894_biz@hertzmedia.org||receiver_id=GNYEC24EAH2N2||pending_reason=multi_currency||txn_type=web_accept||item_name=Wedding Price | Advertising Payment||mc_currency=NZD||item_number=||residence_country=US||test_ipn=1||handling_amount=0.00||transaction_subject=13||payment_gross=||shipping=0.00||ipn_track_id=OMd0HFxTv6IvsURvfZvK9Q||'),
('7', '16', 'mc_gross=14.00||protection_eligibility=Eligible||address_status=confirmed||payer_id=S3643N8W3NE76||tax=0.00||address_street=1 Main St||payment_date=04:30:44 Nov 28, 2011 PST||payment_status=Pending||charset=windows-1252||address_zip=95131||first_name=Test||address_country_code=US||address_name=Test User||notify_version=3.4||custom=16||payer_status=verified||business=ather_1263477894_biz@hertzmedia.org||address_country=United States||address_city=San Jose||quantity=1||verify_sign=AtFgSRA8pxmmBAYinSjJQcrAWlpBAu6R2DxVfZB9qBbmkAdVQcNpvwAR||payer_email=ather_1317908234_per@hertzmedia.org||txn_id=28H86554GH1002119||payment_type=instant||last_name=User||address_state=CA||receiver_email=ather_1263477894_biz@hertzmedia.org||receiver_id=GNYEC24EAH2N2||pending_reason=multi_currency||txn_type=web_accept||item_name=Wedding Price | Advertising Payment||mc_currency=NZD||item_number=||residence_country=US||test_ipn=1||handling_amount=0.00||transaction_subject=16||payment_gross=||shipping=0.00||ipn_track_id=.pFafSWIDtFft9IByd9ijw||'),
('8', '17', 'mc_gross=14.00||protection_eligibility=Eligible||address_status=confirmed||payer_id=S3643N8W3NE76||tax=0.00||address_street=1 Main St||payment_date=00:59:42 Nov 30, 2011 PST||payment_status=Pending||charset=windows-1252||address_zip=95131||first_name=Test||address_country_code=US||address_name=Test User||notify_version=3.4||custom=17||payer_status=verified||business=ather_1263477894_biz@hertzmedia.org||address_country=United States||address_city=San Jose||quantity=1||verify_sign=Ahe51rrx9ui3AMs392s0e0IhR5OhAiPBTBvdIPtUuP01fIL.265C8oaM||payer_email=ather_1317908234_per@hertzmedia.org||txn_id=0FF87584JB959290M||payment_type=instant||last_name=User||address_state=CA||receiver_email=ather_1263477894_biz@hertzmedia.org||receiver_id=GNYEC24EAH2N2||pending_reason=multi_currency||txn_type=web_accept||item_name=Wedding Price | Advertising Payment||mc_currency=NZD||item_number=||residence_country=US||test_ipn=1||handling_amount=0.00||transaction_subject=17||payment_gross=||shipping=0.00||ipn_track_id=XIGP4zF3puVerBEtRkQMwA||');

CREATE TABLE `region` (
   `regionid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   `countryid` int(11) not null,
   PRIMARY KEY (`regionid`),
   KEY `countryid` (`countryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=73;

INSERT INTO `region` (`regionid`, `name`, `countryid`) VALUES 
('1', 'Northland', '151'),
('2', 'Auckland', '151'),
('3', 'Waikato', '151'),
('4', 'Bay Of Plenty', '151'),
('5', 'Gisborne', '151'),
('59', 'Manawatu-Wanganui', '151'),
('38', 'Taranaki', '151'),
('40', 'Hawke\'s Bay', '151'),
('41', 'Wellington', '151'),
('43', 'Marlborough', '151'),
('44', 'West Coast', '151'),
('45', 'Canterbury', '151'),
('57', 'Nelson', '151'),
('47', 'Otago', '151'),
('50', 'Southland', '151'),
('72', 'demo', '0');

CREATE TABLE `regionsuppliermap` (
   `regionid` int(11) not null,
   `supplierid` int(11) not null,
   KEY `regionid` (`regionid`,`supplierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `regionsuppliermap` (`regionid`, `supplierid`) VALUES 
('1', '59'),
('1', '80'),
('1', '83'),
('1', '84'),
('2', '59'),
('2', '78'),
('2', '80'),
('2', '83'),
('3', '80'),
('3', '83'),
('4', '76'),
('4', '77'),
('4', '78'),
('4', '80'),
('4', '81'),
('4', '83'),
('5', '76'),
('5', '77'),
('5', '78'),
('5', '79'),
('5', '80'),
('5', '81'),
('5', '82'),
('5', '83'),
('38', '78'),
('38', '80'),
('38', '83'),
('40', '75'),
('40', '76'),
('40', '77'),
('40', '79'),
('40', '80'),
('40', '83'),
('41', '77'),
('41', '78'),
('41', '80'),
('41', '83'),
('43', '80'),
('43', '83'),
('44', '80'),
('44', '83'),
('45', '59'),
('45', '75'),
('45', '77'),
('45', '79'),
('45', '80'),
('45', '83'),
('47', '80'),
('47', '83'),
('50', '78'),
('50', '80'),
('50', '83'),
('57', '80'),
('57', '83'),
('59', '80'),
('59', '83');

CREATE TABLE `review` (
   `reviewid` int(11) not null auto_increment,
   `fromid` int(11) not null,
   `toid` int(11) not null,
   `content` text not null,
   `date` datetime not null,
   `rating` enum('1','2','3','4','5') not null,
   `status` enum('SHOW','HIDE') not null,
   `weddingid` int(11) not null,
   `from` enum('Buyer','Supplier') not null default 'Buyer',
   PRIMARY KEY (`reviewid`),
   KEY `weddingid` (`weddingid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=22;

INSERT INTO `review` (`reviewid`, `fromid`, `toid`, `content`, `date`, `rating`, `status`, `weddingid`, `from`) VALUES 
('12', '9', '83', 'Good job\r\nGood job\r\nPathetic job\r\nPathetic job\r\nPathetic job\r\nPathetic job', '2011-11-28 00:00:00', '2', 'SHOW', '12', 'Buyer'),
('14', '4', '81', 'hello dirty fellow asdf sadfhello dirty fellow asdf sadfhello dirty fellow asdf sadfhello dirty fellow asdf sadf', '2011-11-29 08:38:23', '2', 'SHOW', '5', 'Buyer'),
('19', '84', '10', 'work work work work work', '2011-11-22 00:00:00', '4', 'SHOW', '15', 'Supplier'),
('18', '10', '84', 'lush mamay chup kar.. a alsdk aodsk', '2011-11-30 03:43:58', '2', 'SHOW', '15', 'Buyer'),
('20', '4', '82', 'good onesdadfgdf gsdfh sdfh dsfh dh fdghdfj fgj', '2012-01-09 16:35:00', '4', 'SHOW', '17', 'Buyer'),
('21', '82', '4', 'ok just ok i wud say it just went ok', '2012-01-09 16:35:52', '3', 'SHOW', '17', 'Supplier');

CREATE TABLE `specialoffer` (
   `specialofferid` int(11) not null auto_increment,
   `title` varchar(255) not null,
   `link` varchar(255) not null,
   `content` text not null,
   `days` int(11) not null,
   `supplierid` int(11) not null,
   `status` enum('ACTIVE','INACTIVE') not null,
   `date` datetime not null,
   `dateend` datetime not null,
   PRIMARY KEY (`specialofferid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=19;

INSERT INTO `specialoffer` (`specialofferid`, `title`, `link`, `content`, `days`, `supplierid`, `status`, `date`, `dateend`) VALUES 
('15', 'erewrt', 'http://sdfafdasfd.com', 'sdfgsdg ewf sd re hdf hdfhf hdhdf hfd hdf df jdfjfgj', '7', '77', 'INACTIVE', '2011-11-13 07:52:24', '2011-11-20 07:52:24'),
('16', 'Joe Wedding Portal', 'http://www.joe.wedding.com', 'this is an add\r\nthis is an add\r\nthis is an add\r\nthis is an add\r\nthis is an add', '7', '83', 'ACTIVE', '2011-11-27 06:29:57', '2011-11-27 06:29:57'),
('17', 'Code Freak&#039;s Advertisemenst', 'http://codefreak.com', 'hello world hello world hello world hello world hello world hello world', '7', '81', 'ACTIVE', '2011-11-30 02:59:12', '2011-12-07 02:59:12');

CREATE TABLE `supplier` (
   `supplierid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   `salesemail` varchar(255) not null,
   `nonsalesemail` varchar(255) not null,
   `phone` varchar(255) not null,
   `contactperson` varchar(255) not null,
   `countryid` int(11) not null,
   `zip` varchar(255) not null,
   `address` text not null,
   `recieverequests` enum('Yes','No') not null,
   `userid` int(11) not null,
   `primaryregionid` int(11) not null,
   `address2` text not null,
   `city` varchar(255) not null,
   `companyprofile` text not null,
   `primarycategoryid` int(11) not null,
   `accounttype` enum('PAYMENTNOTVERIFIED','OUTOFFREEBIDS','INVALIDURL','GOLD','JUSTREGISTERED','FREE') not null default 'INVALIDURL',
   `goldexpires` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`supplierid`),
   KEY `countryid` (`countryid`,`userid`,`primaryregionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=88;

INSERT INTO `supplier` (`supplierid`, `name`, `salesemail`, `nonsalesemail`, `phone`, `contactperson`, `countryid`, `zip`, `address`, `recieverequests`, `userid`, `primaryregionid`, `address2`, `city`, `companyprofile`, `primarycategoryid`, `accounttype`, `goldexpires`) VALUES 
('78', 'paul', 'paul_web123@hotmail.com', 'paul_web123@hotmail.com', '21212121212', 'eweweweweew', '151', '5028', '212121212', 'No', '39', '3', '1221212121', 'wellington', 'The wedding company', '2', 'GOLD', '2012-02-29 07:11:26'),
('83', 'Joe ', 'jeffally@gmail.com', 'haisumbhatti@gmail.com', '12345as67890', 'Joe D', '151', '12345', 'this is line 1', 'Yes', '45', '4', 'sdf', 'asdsad', 'this is a company profile\nthis is a company prof', '4', 'GOLD', '2012-02-29 07:11:26'),
('80', 'Mr. R', 'ra_10_r@hotmail.com', 'ra_10_r@hotmial.com', '12345', '12345', '151', '74000', 'abcdefghijklmnopqrstuvwz', 'No', '43', '5', 'a to z', 'Karachi', 'elielnsalenflasenfiaownfisnv,dcdnvoargnoiaehwnlksdnfaoiewnfawoifniaosjefllkasnfoiawegnwoiaghaskln', '12', 'JUSTREGISTERED', '0000-00-00 00:00:00'),
('82', 'test supplier', 'wef@sad.com', 'haisum@gmail.com', '2804882', 'asdasd', '151', 'sadsf', 'urbanpeacock.com', 'Yes', '40', '4', 'asfsaf', 'Karachi', 'ibuuuu sadm fms dfms dfms dfms dfm asfd smdf smd fms fms dfmsd fmns df', '1', 'GOLD', '2012-02-10 00:00:00'),
('84', 'John', 'info@hertzmedia.org', 'sales@hertzhosting.com', '342342424', '34324234', '151', '3423424', '2423i42j3i4j', 'Yes', '48', '3', 'ij2i4j2i3424', 'jhsdhfhgjasjdfhj', 'asdadasdsa asd dsfsfdsfsdf s', '1', 'FREE', '0000-00-00 00:00:00');

CREATE TABLE `user` (
   `userid` int(11) not null auto_increment,
   `email` varchar(255) not null,
   `password` varchar(255) not null,
   `isactive` enum('Yes','No') not null,
   `registrationdate` timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   `lastlogin` timestamp not null default '0000-00-00 00:00:00',
   `forgotpassword` varchar(255) not null,
   `type` enum('Buyer','Supplier','Normal') not null,
   `deleted` enum('Yes','No') not null default 'No',
   PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=53;

INSERT INTO `user` (`userid`, `email`, `password`, `isactive`, `registrationdate`, `lastlogin`, `forgotpassword`, `type`, `deleted`) VALUES 
('3', 'haisumbhatti@gmail.com', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Yes', '2011-10-08 12:33:03', '2012-01-17 07:27:48', '', 'Buyer', 'No'),
('46', 'zulfiqar.a.memon@gmail.com', '3ccb2c42ef980dbd96fd86a81aa186f1bbee16f0', 'Yes', '2011-12-20 14:22:50', '2011-11-28 05:34:06', '', 'Buyer', 'No'),
('45', 'jeffally@gmail.com', '3ccb2c42ef980dbd96fd86a81aa186f1bbee16f0', 'Yes', '2011-11-28 05:32:48', '2011-12-05 04:23:20', '', 'Supplier', 'No'),
('12', 'paul_web123@yahoo.com', '3b80d57cdaef8cac1d256070402e42afee3657ad', 'Yes', '2011-12-20 14:33:08', '2011-12-06 01:57:22', '', 'Buyer', 'No'),
('11', 'ather@hertzmedia.org', 'f3d01aea1af09ac2cc06030aacfff1b2c80eb9ed', 'Yes', '2011-10-05 12:04:04', '2011-08-15 01:53:19', '', 'Normal', 'No'),
('40', 'codefreax@gmail.com', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Yes', '2011-11-25 06:02:46', '2012-01-09 15:56:16', '', 'Supplier', 'No'),
('39', 'paul_web123@hotmail.com', '3b80d57cdaef8cac1d256070402e42afee3657ad', 'Yes', '2011-12-06 06:22:27', '2011-12-06 03:23:51', '', 'Supplier', 'No'),
('41', 'asif@gmail.com', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Yes', '2011-10-10 10:41:26', '2011-11-25 02:03:02', '', 'Supplier', 'No'),
('42', 'asifaliroudani@hotmail.com', '2c4c3891e2ac6958e9810a1e49c6705784fbfa1a', 'Yes', '2011-10-18 04:44:05', '2011-10-20 14:18:04', '', 'Buyer', 'No'),
('43', 'ra_10_r@hotmail.com', '2c4c3891e2ac6958e9810a1e49c6705784fbfa1a', 'Yes', '2011-10-18 12:33:20', '2011-10-19 04:38:12', '', 'Supplier', 'No'),
('44', 'b3uk01@hotmail.com', '9d6f04790d93013cdd20fdd7d04dbbe034c0385c', 'Yes', '2011-10-19 01:10:00', '2011-12-06 03:08:38', '', 'Buyer', 'No'),
('47', 'hertz.media@gmail.com', 'f3d01aea1af09ac2cc06030aacfff1b2c80eb9ed', 'Yes', '2011-11-30 03:08:02', '2011-11-30 03:39:20', '', 'Buyer', 'No'),
('48', 'info@hertzmedia.org', 'f3d01aea1af09ac2cc06030aacfff1b2c80eb9ed', 'Yes', '2011-11-30 03:22:11', '2011-11-30 03:22:37', '', 'Supplier', 'No');

CREATE TABLE `website` (
   `websiteid` int(11) not null auto_increment,
   `name` varchar(255) not null,
   `url` varchar(255) not null,
   `supplierid` int(11) not null,
   PRIMARY KEY (`websiteid`),
   KEY `supplierid` (`supplierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=43;

INSERT INTO `website` (`websiteid`, `name`, `url`, `supplierid`) VALUES 
('30', 'hadasd', 'http://haisum.info', '59'),
('31', 'hello world', 'http://174.120.96.251/~hertztes/rock/community/rockingham-in-the-community.php', '81'),
('38', '', 'http://174.120.96.251/~demoserv/weddingprice', '84'),
('37', 'This is a webiste', 'http://174.120.96.251/~hertztes/rock/community/rockingham-in-the-community.php', '83'),
('39', '', 'http://www.weddingsguide.co.nz/services/services-reception-venues.html', '78');

CREATE TABLE `wedding` (
   `weddingid` int(11) not null auto_increment,
   `weddingdate` timestamp not null default '0000-00-00 00:00:00',
   `biddeadline` timestamp not null default '0000-00-00 00:00:00',
   `regionid` int(11) not null,
   `guestcount` int(11) not null,
   `bridalpartysize` int(11) not null,
   `budgetfrom` int(11) not null,
   `budgetto` varchar(255) not null,
   `additionalinfo` text not null,
   `status` enum('OPEN','CLOSED') not null,
   `posteddate` timestamp not null default CURRENT_TIMESTAMP,
   `buyerid` int(11) not null,
   `lastmodified` timestamp not null default '0000-00-00 00:00:00',
   `title` varchar(255) not null,
   PRIMARY KEY (`weddingid`),
   KEY `regionid` (`regionid`,`buyerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=77;

INSERT INTO `wedding` (`weddingid`, `weddingdate`, `biddeadline`, `regionid`, `guestcount`, `bridalpartysize`, `budgetfrom`, `budgetto`, `additionalinfo`, `status`, `posteddate`, `buyerid`, `lastmodified`, `title`) VALUES 
('76', '2012-01-25 00:00:00', '2012-01-03 09:27:26', '5', '1200', '34', '0', '0', '', 'OPEN', '2012-01-03 09:27:26', '4', '2012-01-03 09:27:26', 'my groom (#) your bride'),
('70', '2011-12-21 00:00:00', '2011-11-05 14:06:16', '41', '100', '4', '0', '0', '', 'OPEN', '2011-11-05 14:06:16', '5', '2011-11-05 14:06:16', 'mike (#) sarah'),
('71', '2012-11-07 00:00:00', '2011-11-07 20:08:12', '41', '100', '2', '0', '0', '', 'OPEN', '2011-11-07 20:08:12', '8', '2011-11-07 20:08:12', 'lynn (#) paul'),
('74', '2011-11-30 00:00:00', '2011-11-30 03:17:10', '1', '54', '33', '0', '0', '', 'OPEN', '2011-11-30 03:17:10', '10', '2011-11-30 03:17:10', 'Unknown groom (#) Unknown bride'),
('73', '2011-12-17 00:00:00', '2011-11-28 05:42:55', '38', '1200', '100', '0', '0', '', 'OPEN', '2011-11-28 05:42:55', '9', '2011-11-28 05:42:55', 'GroomToBe (#) BrideToBe');

CREATE TABLE `weddingcategory` (
   `weddingcategoryid` int(11) not null auto_increment,
   `weddingid` int(11) not null,
   `categoryid` int(11) not null,
   `budgetto` int(11) not null,
   `budgetfrom` int(11) not null,
   `status` enum('PENDING','ACCEPTED') not null,
   `detail` text not null,
   `biddeadline` datetime not null,
   `lastmodified` datetime not null,
   `posteddate` datetime not null,
   PRIMARY KEY (`weddingcategoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=18;

INSERT INTO `weddingcategory` (`weddingcategoryid`, `weddingid`, `categoryid`, `budgetto`, `budgetfrom`, `status`, `detail`, `biddeadline`, `lastmodified`, `posteddate`) VALUES 
('1', '69', '1', '443', '33', 'PENDING', 'ewrwewqed', '2011-10-04 00:00:00', '2011-10-20 15:07:11', '2011-10-20 14:52:07'),
('3', '69', '2', '4334', '32', 'PENDING', 'sadfsadfasdf', '2011-10-19 00:00:00', '2011-10-20 13:49:21', '2011-10-20 13:49:21'),
('5', '69', '4', '4345', '34', 'PENDING', 'ddsfgdsfg', '2011-10-19 00:00:00', '2011-10-20 14:56:53', '2011-10-20 14:56:53'),
('6', '70', '1', '2000', '1000', 'PENDING', 'red one', '2011-12-14 00:00:00', '2011-12-06 06:26:49', '2011-11-05 14:11:14'),
('7', '71', '4', '500', '300', 'PENDING', 'jjjjj', '2011-11-30 00:00:00', '2011-11-07 20:11:48', '2011-11-07 20:11:48'),
('8', '70', '2', '1000', '550', 'PENDING', 'start to finish', '2011-12-14 00:00:00', '2011-12-06 06:25:58', '2011-11-08 01:00:55'),
('12', '73', '1', '600', '300', 'PENDING', 'pearl white\r\nwith starts', '2011-12-07 00:00:00', '2011-11-28 05:46:01', '2011-11-28 05:46:01'),
('10', '70', '3', '2000', '1000', 'PENDING', 'full coverage', '2011-12-21 00:00:00', '2011-12-06 06:27:02', '2011-11-12 17:41:49'),
('11', '69', '3', '434', '22', 'PENDING', 'sdfasd asdg sadg sadg dfsg dsfg', '2011-11-16 00:00:00', '2011-11-28 05:18:36', '2011-11-28 05:14:56'),
('13', '73', '9', '234235', '234', 'PENDING', 'sdfasdasdasd\r\nda\r\nsd\r\nasdas\r\nds\r\nadas\r\nd', '2011-11-21 00:00:00', '2011-11-28 06:13:08', '2011-11-28 06:13:08'),
('14', '69', '13', '230', '12', 'PENDING', 'aslkdfsd fklsd fsd gds fgd afgd, fgd afkg dfkg dfg dfg d', '2011-11-30 00:00:00', '2011-11-30 03:03:45', '2011-11-30 03:03:45'),
('17', '76', '1', '324', '22', 'PENDING', 'sadfsadf', '2012-01-10 00:00:00', '2012-01-09 16:04:52', '2012-01-09 15:53:08'),
('16', '71', '2', '2000', '1000', 'PENDING', 'full coverage', '2012-03-01 00:00:00', '2011-12-06 03:16:11', '2011-12-06 03:16:11');
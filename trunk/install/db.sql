CREATE TABLE `comments` (
  `id` int(6) NOT NULL auto_increment,
  `article` int(6) NOT NULL default '0',
  `username` varchar(100) NOT NULL default '',
  `comment` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

INSERT INTO `comments` VALUES (1, 1, 'FireBlog Team', 'This is the first comment. Feel free to delete it.');

CREATE TABLE `config` (
  `id` int(6) NOT NULL auto_increment,
  `config_type` varchar(15) NOT NULL default '',
  `config_name` varchar(100) NOT NULL default '',
  `config_shortname` varchar(10) NOT NULL default '',
  `config_description` longtext NOT NULL,
  `config_value` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

INSERT INTO `config` VALUES (1, 'General', 'Site Name', 'name', 'Name of 
the site', 'FireBlog 0.9SVN');
INSERT INTO `config` VALUES (2, 'General', 'Site Tagline', 'tagline', 'Short site description that appears under the title on the home page.', 'The ultimate CMS system!');
INSERT INTO `config` VALUES (3, 'General', 'Theme Name', 'theme', 'The theme that the site is using', 'FireBlog');
INSERT INTO `config` VALUES (4, 'General', 'Page Footer', 'footer', 'This text will be shown in the page footer - can contain HTML', 'This page is a default <b>FireBlog</b> installation');
INSERT INTO `config` VALUES (5, 'General', 'Site description', 'desc', 'A detailed description of your site, appearing on the home page.', 'Welcome to your brand new FireBlog 0.9SVN installation. This is a development version, so bug reports are very welcome. Thanks! Remember that there may be undiscovered bugs and/or security holes');

CREATE TABLE `links` (
  `id` int(6) NOT NULL auto_increment,
  `link_name` varchar(50) NOT NULL default '',
  `link_description` varchar(100) NOT NULL default '',
  `link_location` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

INSERT INTO `links` VALUES (1, 'Home', 'Main page of this blog', 'index.php');
INSERT INTO `links` VALUES (2, 'FireBlog', 'FireBlog home page', 'http://fireblog.berlios.de');
INSERT INTO `links` VALUES (3, 'TuxTalk', 'Linux Help and discussion site', 'http://www.tuxtalk.org');

CREATE TABLE `news` (
  `id` int(6) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `details` varchar(255) NOT NULL default '',
  `short_article` longtext NOT NULL,
  `extended_article` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

INSERT INTO `news` VALUES (1, 'Welcome to your new FireBlog installation!', 'Posted on Wed June 19 12:00:00 GMT 2005 by FireBlog Team', 'Welcome to your brand new FireBlog installation. Please click the read more link to find some important information about FireBlog, and how to set it up', 'You now must set up your site in the admin panel. You can get to this by logging in using the user name and password you provided during the installation. Once you are there, please change the site settings, and edit the default links. If you need help, just take a trip to either the FireBlog handbook, IRC channel, or forums.\r\n\r\nThanks!\r\nThe FireBlog team');

CREATE TABLE `pages` (
  `id` int(6) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `id_string` varchar(10) NOT NULL default '',
  `page` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

CREATE TABLE `users` (
  `id` int(6) NOT NULL auto_increment,
  `username` varchar(15) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `permissions` int(10) NOT NULL default '0',
  `first` varchar(20) NOT NULL default '',
  `last` varchar(20) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

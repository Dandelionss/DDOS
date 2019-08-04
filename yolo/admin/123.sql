-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2017 年 04 月 20 日 10:34
-- 服务器版本: 5.6.35-log
-- PHP 版本: 5.3.21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `2878450210`
--

-- --------------------------------------------------------

--
-- 表的结构 `api`
--

CREATE TABLE IF NOT EXISTS `api` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `api` varchar(1024) NOT NULL,
  `slots` int(3) NOT NULL,
  `methods` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `api`
--

INSERT INTO `api` (`id`, `name`, `api`, `slots`, `methods`) VALUES
(4, '1', 'http://www.baidu.com/api.php=[host]&port=[port]&time=30&method=[method]', 1, 'ntp');

-- --------------------------------------------------------

--
-- 表的结构 `bans`
--

CREATE TABLE IF NOT EXISTS `bans` (
  `username` varchar(15) NOT NULL,
  `reason` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bans`
--

INSERT INTO `bans` (`username`, `reason`) VALUES
('4508', '非法参数'),
('lj0969', '使用频繁'),
('baisha', '超出最大使用次数'),
('baisha', ''),
('4508', '非法参数'),
('lj0969', '使用频繁'),
('baisha', '超出最大使用次数'),
('baisha', '');

-- --------------------------------------------------------

--
-- 表的结构 `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `cardcode`
--

CREATE TABLE IF NOT EXISTS `cardcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `code` varchar(32) NOT NULL,
  `jtime` int(11) DEFAULT NULL,
  `plansid` int(11) NOT NULL,
  `state` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`,`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `cardcode`
--

INSERT INTO `cardcode` (`id`, `uid`, `code`, `jtime`, `plansid`, `state`) VALUES
(2, 12, '1bdf8ad07d14c9132123f1486044e63a', 1492653378, 84, 1);

-- --------------------------------------------------------

--
-- 表的结构 `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `question` varchar(1024) NOT NULL,
  `answer` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'My first question!', 'Well it''s simple sir, you just find the answer.'),
(2, 'Update!', 'New methods and new servers!');

-- --------------------------------------------------------

--
-- 表的结构 `fe`
--

CREATE TABLE IF NOT EXISTS `fe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gjcs`
--

CREATE TABLE IF NOT EXISTS `gjcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `shijian` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `gjcs`
--

INSERT INTO `gjcs` (`id`, `uid`, `shijian`) VALUES
(28, 12, 1492185600),
(27, 12, 1492185600),
(26, 12, 1492185600),
(25, 12, 1492185600),
(24, 12, 1492185600),
(23, 12, 1492185600),
(22, 12, 1492185600),
(21, 12, 1492185600),
(20, 12, 1492185600),
(19, 12, 1492185600),
(18, 12, 1492185600),
(17, 12, 1492185600),
(16, 12, 1492185600),
(15, 12, 1492185600),
(29, 12, 1492185600),
(30, 12, 1492185600),
(31, 12, 1492185600),
(32, 12, 1492185600),
(33, 12, 1492185600),
(34, 12, 1492185600),
(35, 12, 1492185600),
(36, 12, 1492185600),
(37, 12, 1492185600),
(38, 12, 1492185600),
(39, 12, 1492617600),
(40, 12, 1492617600);

-- --------------------------------------------------------

--
-- 表的结构 `iplogs`
--

CREATE TABLE IF NOT EXISTS `iplogs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `logged` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `iplogs`
--

INSERT INTO `iplogs` (`ID`, `userID`, `logged`, `date`) VALUES
(17, 12, '127.0.0.1', 1439005407);

-- --------------------------------------------------------

--
-- 表的结构 `loginlogs`
--

CREATE TABLE IF NOT EXISTS `loginlogs` (
  `username` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(15) NOT NULL,
  `ip` varchar(1024) NOT NULL,
  `port` int(5) NOT NULL,
  `time` int(4) NOT NULL,
  `method` varchar(10) NOT NULL,
  `date` int(11) NOT NULL,
  `stopped` int(1) NOT NULL DEFAULT '0',
  `handler` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `lostp`
--

CREATE TABLE IF NOT EXISTS `lostp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `username` text NOT NULL,
  `mail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `ticketid` int(11) NOT NULL,
  `content` text NOT NULL,
  `sender` varchar(30) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `methods`
--

CREATE TABLE IF NOT EXISTS `methods` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `type` varchar(6) NOT NULL,
  `command` varchar(1000) NOT NULL,
  KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `methods`
--

INSERT INTO `methods` (`id`, `name`, `fullname`, `type`, `command`) VALUES
(9, 'ntp', 'NTP', 'udp', '');

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` int(11) NOT NULL,
  `author` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- 表的结构 `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `paid` float NOT NULL,
  `plan` int(11) NOT NULL,
  `user` int(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tid` varchar(30) NOT NULL,
  `date` int(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mbt` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `length` int(11) NOT NULL,
  `price` float NOT NULL,
  `concurrents` int(11) NOT NULL,
  `private` int(1) NOT NULL,
  `cishu` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- 转存表中的数据 `plans`
--

INSERT INTO `plans` (`ID`, `name`, `mbt`, `unit`, `length`, `price`, `concurrents`, `private`, `cishu`) VALUES
(84, 'åŸºç¡€ç‰ˆ', 100, 'Months', 1, 1, 1, 0, 100);

-- --------------------------------------------------------

--
-- 表的结构 `rusers`
--

CREATE TABLE IF NOT EXISTS `rusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `servers`
--

CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `slots` int(3) NOT NULL,
  `methods` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `paypal` varchar(50) NOT NULL,
  `bitcoin` varchar(50) NOT NULL,
  `maintaince` varchar(100) NOT NULL,
  `tos` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `rotation` int(1) NOT NULL DEFAULT '0',
  `system` varchar(7) NOT NULL,
  `maxattacks` int(5) NOT NULL,
  `key` varchar(100) NOT NULL,
  `testboots` int(1) NOT NULL,
  `cloudflare` int(1) NOT NULL,
  `cbp` int(1) NOT NULL,
  `skype` varchar(200) NOT NULL,
  `issuerId` varchar(50) NOT NULL,
  `secretKey` varchar(50) NOT NULL,
  `coinpayments` varchar(50) NOT NULL,
  `ipnSecret` varchar(100) NOT NULL,
  KEY `sitename` (`sitename`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`sitename`, `description`, `paypal`, `bitcoin`, `maintaince`, `tos`, `url`, `rotation`, `system`, `maxattacks`, `key`, `testboots`, `cloudflare`, `cbp`, `skype`, `issuerId`, `secretKey`, `coinpayments`, `ipnSecret`) VALUES
('DDOS', 'Welcome to DDOS', '', '', '', 'tos.php', 'index.php', 1, 'api', 5, '', 0, 0, 0, '', '', 'x01AhBQ8Uc-Vivhtvp-j7w', '7a7e7e59c12bafe43351914dd41884e1', '');

-- --------------------------------------------------------

--
-- 表的结构 `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(1024) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `scode` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `referral` varchar(50) NOT NULL,
  `referralbalance` int(3) NOT NULL DEFAULT '0',
  `testattack` int(1) NOT NULL,
  `cishu` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2646 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `scode`, `rank`, `membership`, `expire`, `status`, `referral`, `referralbalance`, `testattack`, `cishu`) VALUES
(12, 'root', '83353d597cbad458989f2b1a5c1fa1f9f665c858', '123@qq.com', '1234', 1, 84, 1495245378, 0, '0', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yt`
--

CREATE TABLE IF NOT EXISTS `yt` (
  `id1` text NOT NULL,
  `date1` text NOT NULL,
  `id2` text NOT NULL,
  `date2` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

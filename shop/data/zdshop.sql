-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-07 09:03:05
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zdshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` char(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin@qq.com'),
(2, 'zd', 'zd', '114901190@qq.com'),
(3, 'zd1', 'zd', 'zd'),
(4, '5', 'zd2', '5'),
(6, '6', '6', '6'),
(7, '7', '7', '7'),
(8, '8', '8', '8');

-- --------------------------------------------------------

--
-- 表的结构 `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `albumPath` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `album`
--

INSERT INTO `album` (`id`, `pid`, `albumPath`) VALUES
(15, 25, '061cea84bbe4fa7add5f0bfc7a9fe045.png'),
(16, 25, '56a19f529f4549427f3cd6fa975cc61a.png'),
(17, 26, '128fda74e11d60ee0ba1e43b2d7f057d.jpg'),
(18, 27, '2a133910579ca3b1bf37a9977660bc56.jpg'),
(19, 34, '03d32249221f154c9d5843c47944acab.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `cate`
--

CREATE TABLE IF NOT EXISTS `cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cName` (`cName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `cate`
--

INSERT INTO `cate` (`id`, `cName`) VALUES
(12, '333'),
(10, '家具专区'),
(8, '生活专区'),
(7, '电子专区');

-- --------------------------------------------------------

--
-- 表的结构 `pro`
--

CREATE TABLE IF NOT EXISTS `pro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pSn` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pNum` int(10) unsigned DEFAULT '1',
  `mPrice` decimal(10,2) NOT NULL,
  `iPrice` decimal(10,2) NOT NULL,
  `pDesc` text CHARACTER SET utf8,
  `pubTime` int(10) unsigned NOT NULL,
  `isShow` tinyint(1) DEFAULT '1',
  `isHot` tinyint(1) DEFAULT '0',
  `cId` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pName` (`pName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `pro`
--

INSERT INTO `pro` (`id`, `pName`, `pSn`, `pNum`, `mPrice`, `iPrice`, `pDesc`, `pubTime`, `isShow`, `isHot`, `cId`) VALUES
(6, '333', '333', 333, '333.00', '333.00', '11', 1496382723, 1, 0, 12),
(26, '22', '22', 22, '2.00', '2.00', '2222', 1496389697, 1, 0, 12),
(27, '123', '12', 31, '31.00', '31.00', '3131', 1496392178, 1, 0, 12),
(32, '9', '9', 9, '9.00', '9.00', '9', 1496631987, 1, 0, 12),
(33, '6', '6', 6, '6.00', '6.00', '666', 1496641783, 1, 0, 12),
(34, '沙发', '9', 99, '999.00', '999.00', '9999', 1496642667, 1, 0, 12),
(35, '沙发1 ', '1', 1, '1.00', '1.00', '1', 1496643817, 1, 0, 12),
(36, '沙发2', '2', 2, '2.00', '2.00', '2', 1496643827, 1, 0, 12);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` char(32) CHARACTER SET utf8 NOT NULL,
  `sex` enum('保密','男','女') CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `face` varchar(50) CHARACTER SET utf8 NOT NULL,
  `regTime` int(10) unsigned NOT NULL,
  `activeFlag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `sex`, `email`, `face`, `regTime`, `activeFlag`) VALUES
(1, '1', 'c4ca4238a0b923820dcc509a6f75849b', '保密', '1@qq.com', '6975273644e7691feede3aaa2aa10bb6.png', 1496717527, 0),
(8, '5', '5', '女', '5@qq.com', '9b7c43dd84be227acec195270b7950f9.png', 1496729541, 0),
(9, '3', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '保密', '3@qq.com', 'cca9c07df9a0f642cd8505ec66dd188d.png', 1496729557, 0),
(10, '4', 'a87ff679a2f3e71d9181a67b7542122c', '男', '4', '7347498987981906dde4bd49be4c4a4d.png', 1496729566, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

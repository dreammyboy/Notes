-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2016 年 12 月 29 日 15:48

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `LUdpseiAAwTaLMyzWYSJ`
--

-- --------------------------------------------------------

--
-- 表的结构 `zhe_word`
--

CREATE TABLE IF NOT EXISTS `zhe_word` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '单词ID',
  `word` varchar(50) NOT NULL DEFAULT '' COMMENT '单词',
  `meaning` char(255) NOT NULL DEFAULT '' COMMENT '单词意思',
  `state` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '状态，1、新增。2、修改。0、删除',
  `groupId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分组',
  `addDate` varchar(10) NOT NULL DEFAULT '' COMMENT '加入日期',
  `addTime` varchar(10) NOT NULL DEFAULT '' COMMENT '加入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=195 ;

--
-- 转存表中的数据 `zhe_word`
--

INSERT INTO `zhe_word` (`id`, `word`, `meaning`, `state`, `groupId`, `addDate`, `addTime`) VALUES
(7, 'scorch', '烤焦', 1, 0, '20161110', '1639'),
(8, 'tumble', '暴跌', 1, 0, '20161110', '1646'),
(9, 'tremendous', '巨大的', 1, 0, '20161110', '2003'),
(10, 'demolish', '意外损坏', 1, 0, '20161110', '2006'),
(35, 'falsehood', '不实之言', 1, 0, '20161112', '1249'),
(36, 'incompetent', '不胜任的', 1, 0, '20161112', '1320'),
(37, 'overt', '公开的，不隐瞒的', 1, 0, '20161112', '1315'),
(38, 'acrimony', '言辞态度尖刻', 1, 0, '20161114', '0726'),
(39, 'cast', '把某人描写成', 1, 0, '20161114', '0730'),
(40, 'unhinged', '精神失常的', 1, 0, '20161114', '0732'),
(41, 'rant', '咆哮', 1, 0, '20161114', '0735'),
(42, 'dial', '仪表盘', 1, 0, '20161114', '1938'),
(43, 'crescent', '新月', 1, 0, '20161114', '1942'),
(44, 'fabricate', '编造', 1, 0, '20161114', '1950'),
(108, 'spray', '喷', 1, 0, '20161117', '2023'),
(109, 'honk', '汽车按喇叭', 1, 0, '20161117', '2027'),
(110, 'wield', '操着武器工具等', 1, 0, '20161117', '2029'),
(193, 'Concorde', '协和式飞机', 1, 0, '20161215', '1405'),
(194, 'prank', '恶作剧', 1, 0, '20161215', '1423');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

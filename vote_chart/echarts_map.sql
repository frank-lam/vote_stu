-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 02 月 22 日 15:13
-- 服务器版本: 5.6.21
-- PHP 版本: 5.4.34

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lrfbeyond_demo`
--

-- --------------------------------------------------------

--
-- 表的结构 `echarts_map`
--

CREATE TABLE IF NOT EXISTS `echarts_map` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `province` varchar(30) NOT NULL,
  `gdp` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `echarts_map`
--

INSERT INTO `echarts_map` (`id`, `province`, `gdp`) VALUES
(1, '北京', '2.29'),
(2, '天津', '1.65'),
(3, '上海', '2.50'),
(4, '重庆', '1.57'),
(5, '河北', '2.98'),
(6, '河南', '3.70'),
(7, '云南', '1.37'),
(8, '辽宁', '2.91'),
(9, '黑龙江', '1.50'),
(10, '安徽', '2.20'),
(11, '山东', '6.30'),
(12, '新疆', '0.94'),
(13, '江苏', '7.06'),
(14, '浙江', '4.28'),
(15, '江西', '1.67'),
(16, '湖北', '2.95'),
(17, '广西', '1.68'),
(18, '甘肃', '0.69'),
(19, '山西', '1.28'),
(20, '内蒙古', '1.80'),
(21, '陕西', '1.81'),
(22, '吉林', '1.40'),
(23, '福建', '2.59'),
(24, '贵州', '1.05'),
(25, '广东', '7.28'),
(26, '青海', '0.24'),
(27, '西藏', '0.10'),
(28, '四川', '3.01'),
(29, '宁夏', '0.29'),
(30, '海南', '0.37'),
(31, '台湾', '0.00'),
(32, '香港', '0.00'),
(33, '澳门', '0.00'),
(34, '湖南', '2.90');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

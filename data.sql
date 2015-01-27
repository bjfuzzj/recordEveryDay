-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2015 年 01 月 27 日 16:24
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_ctserver`
--

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `num` int(10) NOT NULL,
  `des` varchar(200) DEFAULT NULL,
  `time` date NOT NULL,
  KEY `id` (`id`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=217 ;

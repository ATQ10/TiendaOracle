-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-08-2019 a las 19:28:52
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `videoaula`
--
CREATE DATABASE `videoaula` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `videoaula`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensagens`
--

CREATE TABLE IF NOT EXISTS `mensagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_de` int(11) NOT NULL,
  `id_para` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `lido` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `mensagens`
--

INSERT INTO `mensagens` (`id`, `id_de`, `id_para`, `mensagem`, `time`, `lido`) VALUES
(1, 3, 1, 'Oi Lucas', 1433864460, 1),
(2, 3, 1, 'Outra mensagem da maria pro lucas', 1433864490, 1),
(3, 1, 3, 'Oi maria tudo bem, sou lucas', 1433864649, 1),
(4, 3, 1, 'Oi lucas, blz? é a maria denovo', 1433865949, 1),
(5, 1, 3, 'Tudo beleza sim :) até mais 8)', 1433866082, 1),
(6, 3, 1, 'Teste em aula 1', 1434405824, 1),
(7, 3, 1, 'Test', 1434406351, 1),
(8, 1, 3, 'Test em aula, maria!', 1434406472, 1),
(9, 3, 1, 'Certo, lucas!', 1434406480, 1),
(10, 3, 1, 'Olá lucas, tudo bem? este é um teste de som', 1434407254, 1),
(11, 3, 1, 'Este é outro teste de som', 1434407269, 1),
(12, 1, 3, 'Olá maria, recebi sua mensagem!', 1434407279, 1),
(13, 1, 3, 'Outra mensagem do lugas para a maria no firefox', 1434407306, 1),
(14, 3, 1, 'Mensagem da maria pro lugas denovo', 1434407323, 1),
(15, 1, 3, 'Teste de nova mensagem do lucas', 1434407441, 1),
(17, 1, 3, 'test', 1434407589, 1),
(18, 3, 1, 'Esta é uma mensagem de teste', 1434407664, 1),
(19, 2, 1, 'Oi lucas', 1434413216, 1),
(20, 1, 2, 'Fala ae joão', 1434413223, 1),
(21, 2, 1, 'Tudo de boa?', 1434413257, 1),
(22, 1, 2, 'Aham!', 1434413263, 1),
(23, 3, 1, 'hola', 1566547154, 1),
(24, 1, 3, 'hhhh', 1566547170, 0),
(25, 3, 1, 'bbnbnbnb', 1566547189, 1),
(26, 3, 1, 'nnnnnnnnnnnnnnn', 1566547205, 1),
(27, 1, 3, '545454545', 1566547235, 0),
(28, 3, 1, '565656', 1566547250, 1),
(29, 3, 1, '4444', 1566547268, 1),
(30, 2, 1, 'hola lucas como estas', 1566588715, 1),
(31, 1, 2, 'muy bien y tu q', 1566588726, 1),
(32, 1, 2, 'werewr', 1566588733, 1),
(33, 1, 5, 'mfgmflg', 1566867872, 0),
(34, 1, 5, 're', 1566867879, 0),
(35, 1, 3, 'rter', 1566867882, 0),
(36, 1, 3, 'ewrew7', 1566867891, 0),
(37, 1, 5, 'werw', 1566867895, 0),
(38, 1, 2, 'werew', 1566867898, 1),
(39, 1, 4, 'hola como estas', 1566871962, 0),
(40, 2, 1, 'hola', 1566933090, 1),
(41, 2, 1, 'fdsfsd', 1566933103, 1),
(42, 1, 2, 'etret', 1566933118, 1),
(43, 2, 1, 'trtr', 1566933150, 0),
(44, 2, 1, 'rtyrty', 1566933200, 0),
(45, 1, 2, 'retert', 1566933213, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `horario` datetime NOT NULL,
  `limite` datetime NOT NULL,
  `blocks` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `foto`, `nome`, `email`, `horario`, `limite`, `blocks`) VALUES
(1, 'lucas.jpg', 'Lucas Silva', 'lucas.designer@hotmail.com', '2019-08-27 19:04:54', '2019-08-27 19:22:21', ''),
(2, '', 'João Souza', 'joao@hotmail.com', '2019-08-27 19:11:22', '2019-08-27 19:14:35', ''),
(3, '', 'Maria da Silva', 'mariasilva@gmail.com', '2019-08-23 07:58:51', '2019-08-23 08:02:09', '2'),
(4, '', 'keyner', 'keyner@hotmail.com', '2019-08-08 00:00:00', '2019-08-14 00:00:00', ''),
(5, '', 'thali', 'thali@hotmail.com', '2019-08-08 00:00:00', '2019-08-14 00:00:00', ''),
(6, '', 'ana maria', 'ana@gmail.com', '2019-08-27 19:23:24', '2019-08-27 19:24:26', '2'),
(7, '', 'carolina', 'carolina@hotmail.com', '2019-08-02 00:00:00', '2019-08-16 00:00:00', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

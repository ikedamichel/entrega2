-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Ago-2015 às 11:58
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `entrega2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `idProd` int(11) NOT NULL AUTO_INCREMENT,
  `flagProdAtivo` tinyint(1) NOT NULL,
  `flagPossuiFoto` tinyint(1) NOT NULL,
  `flagDesconto` tinyint(1) NOT NULL,
  `tituloProd` varchar(300) NOT NULL,
  `descriProd` varchar(1000) NOT NULL,
  `valorProdUnit` float NOT NULL,
  `valorDescProdUnit` float NOT NULL,
  `fotoProd` varchar(1000) NOT NULL,
  `estoqueProdAtual` int(11) NOT NULL,
  `estoqueProdAguardaVenda` int(11) NOT NULL,
  `estoqueProdVendido` int(11) NOT NULL,
  PRIMARY KEY (`idProd`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProd`, `flagProdAtivo`, `flagPossuiFoto`, `flagDesconto`, `tituloProd`, `descriProd`, `valorProdUnit`, `valorDescProdUnit`, `fotoProd`, `estoqueProdAtual`, `estoqueProdAguardaVenda`, `estoqueProdVendido`) VALUES
(1, 1, 1, 1, 'titulo', 'aaaaaaaaaaaaaaaa', 6666670, 777777, '0407oxw14284428643422.jpg', 5, 0, 0),
(3, 0, 1, 1, 'titulo3', 'deaaaaaao3', 300, 30, 'hunt1111er.jpg', 500, 0, 0),
(2, 1, 1, 1, 'titulo', 'descrição', 300, 30, 'dasdasda', 500, 0, 0),
(4, 1, 1, 1, 'titulo', 'descrição', 300, 30, 'dasdasda', 500, 0, 0),
(5, 1, 1, 1, 'titulo', 'descrição', 300, 30, 'dasdasda', 500, 0, 0),
(6, 1, 1, 1, 'titulo produto', '12312312 ', 12.111, 22, '0407oxw14284428643422.jpg', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

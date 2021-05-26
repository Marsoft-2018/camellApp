/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.21 : Database - appsolutec
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`appsolutec` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `appsolutec`;

/*Table structure for table `agenda` */

DROP TABLE IF EXISTS `agenda`;

CREATE TABLE `agenda` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idProveedorServicio` bigint(9) NOT NULL,
  `idTipoAgenda` tinyint(4) NOT NULL,
  `hora_ini` time NOT NULL,
  `hora_fin` time NOT NULL,
  `dia_semana` date NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_Reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_reg` bigint(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idTipoAgenda` (`idTipoAgenda`),
  KEY `idProveedorServicio` (`idProveedorServicio`),
  CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`idTipoAgenda`) REFERENCES `tipo_agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`idProveedorServicio`) REFERENCES `proveedor_servicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `agenda` */

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nombre`,`fechaReg`,`activo`) values (1,'Algo','2018-03-22 19:53:52',1);

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `nbres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idMunicipio` bigint(6) NOT NULL,
  `calificacion` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `longitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `clientes` */

/*Table structure for table `continentes` */

DROP TABLE IF EXISTS `continentes`;

CREATE TABLE `continentes` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `continentes` */

insert  into `continentes`(`id`,`nombre`,`fecha_reg`,`activo`) values (1,'America Central','2018-03-25 14:17:32',1),(2,'America del Norte','2018-03-25 14:17:40',1),(3,'America del Sur','2018-03-25 14:17:45',1),(4,'Asia','2018-03-25 14:17:49',1),(5,'Africa','2018-03-25 14:17:53',1),(6,'Antartida','2018-03-25 14:18:08',1),(7,'Oceania','2018-03-25 14:18:14',1);

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `idPais` tinyint(4) NOT NULL,
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idPais` (`idPais`),
  CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`idPais`) REFERENCES `paises` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `departamentos` */

insert  into `departamentos`(`idPais`,`id`,`nombre`,`fecha_reg`,`activo`) values (1,1,'Bolivar','2018-03-25 14:54:41',1);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `municipios` */

DROP TABLE IF EXISTS `municipios`;

CREATE TABLE `municipios` (
  `idDepto` tinyint(4) NOT NULL,
  `id` bigint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `municipios` */

insert  into `municipios`(`idDepto`,`id`,`nombre`,`fecha_reg`,`activo`) values (1,1,'El Carmen de Bolivar','2018-03-25 14:54:57',1);

/*Table structure for table `paises` */

DROP TABLE IF EXISTS `paises`;

CREATE TABLE `paises` (
  `idContinente` tinyint(4) NOT NULL,
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idContinente` (`idContinente`),
  CONSTRAINT `paises_ibfk_1` FOREIGN KEY (`idContinente`) REFERENCES `continentes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `paises` */

insert  into `paises`(`idContinente`,`id`,`nombre`,`fecha_registro`,`activo`) values (3,1,'Colombia','2018-03-25 14:51:00',1),(1,2,'Mexico','2018-03-25 14:51:12',1),(2,3,'Estados Unidos','2018-03-25 14:51:27',1),(4,4,'China','2018-03-25 14:51:37',1),(5,5,'Egipto','2018-03-25 14:51:48',1),(7,6,'Australia','2018-03-25 14:51:59',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idMunicipio` bigint(6) NOT NULL,
  `calificacion` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `longitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `proveedor` */

/*Table structure for table `proveedor_servicio` */

DROP TABLE IF EXISTS `proveedor_servicio`;

CREATE TABLE `proveedor_servicio` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint(9) NOT NULL,
  `idServicio` bigint(9) NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_Reg` bigint(6) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  KEY `idServicio` (`idServicio`),
  CONSTRAINT `proveedor_servicio_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proveedor_servicio_ibfk_2` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `proveedor_servicio` */

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idcategoria` smallint(3) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuarioReg` bigint(9) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`),
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `servicios` */

/*Table structure for table `solicitud_servicio` */

DROP TABLE IF EXISTS `solicitud_servicio`;

CREATE TABLE `solicitud_servicio` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idCliente` bigint(9) NOT NULL,
  `idProveedorServicio` bigint(9) NOT NULL,
  `fecha` date NOT NULL,
  `hora_ini` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `calf_proveedor` tinyint(4) DEFAULT NULL,
  `calf_cliente` tinyint(4) DEFAULT NULL,
  `obs_cliente` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obs_proveedor` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_reg` bigint(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`),
  KEY `idProveedorServicio` (`idProveedorServicio`),
  CONSTRAINT `solicitud_servicio_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitud_servicio_ibfk_2` FOREIGN KEY (`idProveedorServicio`) REFERENCES `proveedor_servicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `solicitud_servicio` */

/*Table structure for table `subcategoria` */

DROP TABLE IF EXISTS `subcategoria`;

CREATE TABLE `subcategoria` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `nbre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idcategoria` smallint(3) NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_reg` bigint(9) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`),
  CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `subcategoria` */

/*Table structure for table `telefono` */

DROP TABLE IF EXISTS `telefono`;

CREATE TABLE `telefono` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint(9) NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_reg` bigint(9) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `telefono` */

/*Table structure for table `tipo_agenda` */

DROP TABLE IF EXISTS `tipo_agenda`;

CREATE TABLE `tipo_agenda` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nbre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_reg` bigint(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipo_agenda` */

/*Table structure for table `usuariosclientes` */

DROP TABLE IF EXISTS `usuariosclientes`;

CREATE TABLE `usuariosclientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuariosclientes_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuariosclientes` */

/*Table structure for table `usuariosproveedores` */

DROP TABLE IF EXISTS `usuariosproveedores`;

CREATE TABLE `usuariosproveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fechaRegistro` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuariosproveedores_email_unique` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuariosproveedores` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
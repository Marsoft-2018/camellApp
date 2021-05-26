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

/*Table structure for table `agendas` */

DROP TABLE IF EXISTS `agendas`;

CREATE TABLE `agendas` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idProveedorServicio` bigint(9) NOT NULL,
  `idTipoAgenda` tinyint(4) NOT NULL DEFAULT '1',
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
  CONSTRAINT `agendas_ibfk_1` FOREIGN KEY (`idTipoAgenda`) REFERENCES `tipoagenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agendas_ibfk_2` FOREIGN KEY (`idProveedorServicio`) REFERENCES `proveedorservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `agendas` */

/*Table structure for table `calificacioncliente` */

DROP TABLE IF EXISTS `calificacioncliente`;

CREATE TABLE `calificacioncliente` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idCliente` bigint(9) NOT NULL,
  `idProveedor` bigint(9) NOT NULL,
  `calificacion` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `opinion` longtext COLLATE utf8_unicode_ci,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `calificacioncliente` */

/*Table structure for table `calificacionproveedor` */

DROP TABLE IF EXISTS `calificacionproveedor`;

CREATE TABLE `calificacionproveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` bigint(9) NOT NULL,
  `idProveedor` bigint(9) NOT NULL,
  `calificacion` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `opinion` longtext COLLATE utf8_unicode_ci,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`),
  KEY `idProveedor` (`idProveedor`),
  CONSTRAINT `calificacionproveedor_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificacionproveedor_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `calificacionproveedor` */

insert  into `calificacionproveedor`(`id`,`idCliente`,`idProveedor`,`calificacion`,`opinion`,`fechaRegistro`,`estado`) values (1,2,3,'Bueno','Muy Recomendado','2018-07-12 13:28:08',1),(2,2,3,'Regular','Llego muy tarde','2018-07-12 13:28:11',1),(3,2,3,'Bueno','Lo recomiendo','2018-07-12 13:29:20',1);

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nombre`,`fechaReg`,`activo`) values (1,'Conciertos','2018-08-15 10:55:25',1),(2,'Educaci√≥n','2018-08-15 10:55:30',1),(3,'Entretenimiento','2018-08-15 10:55:33',1),(4,'Est√©ticas','2018-08-15 10:55:35',1),(5,'Jardiner√≠a','2018-08-15 10:55:38',1),(6,'Religi√≥n','2018-08-15 10:55:41',1),(7,'Seguros','2018-08-15 10:55:43',1),(8,'Servicios de Salud','2018-08-15 10:55:46',1),(9,'Servicios Legales','2018-08-15 10:55:49',1),(10,'Transporte de Carga','2018-08-15 10:55:53',1),(11,'TV por Cable','2018-08-15 10:55:57',1),(12,'Contabilidad','2018-08-15 10:45:17',1),(13,'Lavander√≠a','2018-08-15 10:45:17',1),(14,'Publicidad','2018-08-15 10:45:17',1),(15,'Mentenimiento','2018-08-15 10:45:17',1),(16,'Instalaci√≥n','2018-08-15 10:56:10',1);

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idMunicipio` bigint(6) NOT NULL,
  `calificacion` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNac` date DEFAULT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`usuario`,`nombres`,`apellidos`,`idMunicipio`,`calificacion`,`fechaNac`,`fechaReg`,`activo`) values (1,'josealf7@gmail.com','Jose Alfredo','Tapia Arroyo',1,'0','1978-09-04','2018-04-16 22:14:31',1),(2,'norelys@correo.com','MARELIS MABEL','GARIZAO VASQUEZ',1,'0','1985-12-25','2018-04-23 17:59:56',1),(3,'josealf@correo.com','Cesar Alfonso','Tapia Arroyo',1,'0','1982-02-23','2018-10-18 17:40:01',1),(4,'cesar@correo.com','CESAR ALFONSO','TAPIA ARROYO',1,'0','1982-03-23','2018-10-18 17:54:42',1),(5,'orlay@correo.com','ORLAY DAVID','TAPIA ARROYO',1,'0','1981-02-24','2018-10-18 17:56:50',1),(6,'enis@correo.com','ENIS YOJANA','TAPIA ARROYO',1,'0','1984-11-12','2018-10-18 17:59:06',1),(7,'mariana@correo.com','Mariana Sofia','Tapia Garizao',3,'0','2006-03-29','2018-10-18 18:26:52',1),(8,'josealf123@correo.com','ELEJANDRA LUCIA','Tapia Garizao',1,'0','2010-03-16','2018-10-22 17:54:07',1);

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

/*Table structure for table `disponibilidad_dias` */

DROP TABLE IF EXISTS `disponibilidad_dias`;

CREATE TABLE `disponibilidad_dias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint(9) NOT NULL,
  `Dias` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  CONSTRAINT `disponibilidad_dias_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `disponibilidad_dias` */

insert  into `disponibilidad_dias`(`id`,`idProveedor`,`Dias`,`estado`,`fechaReg`) values (5,1,'Lun',1,'2018-10-29 08:10:19'),(6,1,'Mar',1,'2018-10-29 08:10:19'),(7,1,'Mie',1,'2018-10-29 08:10:19');

/*Table structure for table `disponibilidad_horas` */

DROP TABLE IF EXISTS `disponibilidad_horas`;

CREATE TABLE `disponibilidad_horas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint(9) NOT NULL,
  `Hora` time NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  CONSTRAINT `disponibilidad_horas_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `disponibilidad_horas` */

insert  into `disponibilidad_horas`(`id`,`idProveedor`,`Hora`,`estado`,`fechaReg`) values (5,1,'14:00:00',1,'2018-10-29 08:10:19'),(6,1,'15:00:00',1,'2018-10-29 08:10:19'),(7,1,'16:00:00',1,'2018-10-29 08:10:19'),(8,1,'17:00:00',1,'2018-10-29 08:10:19');

/*Table structure for table `eventos` */

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `body` text COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `class` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'event-important',
  `start` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `end` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `inicio_normal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `final_normal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `eventos` */

insert  into `eventos`(`id`,`title`,`body`,`url`,`class`,`start`,`end`,`inicio_normal`,`final_normal`) values (1,'Disponible','asdasdhioiuasd asdasd asdadad','','event-important','1537386180000','1538250180000','19/09/2018 16:43','29/09/2018 16:43');

/*Table structure for table `localizacionclientes` */

DROP TABLE IF EXISTS `localizacionclientes`;

CREATE TABLE `localizacionclientes` (
  `idCliente` bigint(9) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `localizacionclientes_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `localizacionclientes` */

insert  into `localizacionclientes`(`idCliente`,`id`,`direccion`,`lat`,`lng`,`fechaReg`,`activo`) values (1,1,'KR 47A #31-50',9.717400,-75.120232,'2018-04-08 11:05:53',1),(2,2,'KR 47A #31-50',8.670438,-74.030014,'2018-04-23 17:59:56',1),(3,3,'KR 47 #31-50 BARRIO 7 DE AGOSTO',9.717400,-75.120232,'2018-10-18 17:40:01',1),(4,4,'KR 47 #31-50 BARRIO 7 DE AGOSTO',9.717400,-75.120232,'2018-10-18 17:54:42',1),(5,5,'KR 47 #31-50 BARRIO 7 DE AGOSTO',9.717400,-75.120232,'2018-10-18 17:56:50',1),(6,6,'KR 47 #31-50 BARRIO 7 DE AGOSTO',9.717400,-75.120232,'2018-10-18 17:59:06',1),(7,7,'KR 47 #31-50 BARRIO 7 DE AGOSTO',9.717400,-75.120232,'2018-10-18 18:26:52',1),(8,8,'KR 47 #31-50 BARRIO 7 DE AGOSTO',40.463669,-3.749220,'2018-10-22 17:54:07',1);

/*Table structure for table `localizacionproveedores` */

DROP TABLE IF EXISTS `localizacionproveedores`;

CREATE TABLE `localizacionproveedores` (
  `idProveedor` bigint(9) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  CONSTRAINT `localizacionproveedores_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `localizacionproveedores` */

insert  into `localizacionproveedores`(`idProveedor`,`id`,`direccion`,`lat`,`lng`,`fechaReg`,`activo`) values (1,1,'Cl 25 KR 59 barrio Montecarmelo',4.570868,-74.297333,'2018-04-08 18:26:23',1),(3,3,'KR 47A #31-50',9.717400,-75.120232,'2018-04-08 19:04:28',1),(4,4,'kra 55',4.570868,-74.297333,'2018-09-15 19:05:59',1),(5,5,'kr 55',9.717400,-75.120232,'2018-09-18 05:43:58',1),(6,6,'Cra 45 # 25-72',9.717400,-75.120232,'2018-10-16 19:41:33',1),(7,7,'KR 47 #31-50 BARRIO 7 DE AGOSTO',9.717400,-75.120232,'2018-10-18 17:59:06',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `municipios` */

insert  into `municipios`(`idDepto`,`id`,`nombre`,`fecha_reg`,`activo`) values (1,1,'El Carmen de Bolivar','2018-03-25 14:54:57',1),(1,2,'Magangue','2018-10-17 07:17:36',1),(1,3,'Cartagena','2018-10-17 07:17:47',1),(1,4,'Mar√≠a la baja','2018-10-17 07:18:19',1);

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

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idMunicipio` bigint(6) NOT NULL,
  `calificacion` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `proveedores` */

insert  into `proveedores`(`id`,`usuario`,`nombres`,`apellidos`,`idMunicipio`,`calificacion`,`fechaNac`,`fechaReg`,`activo`) values (1,'ingjerson2014@gmail.com','Jerson Daniel','Batista Vega',1,'0','1989-05-26','2018-04-08 18:26:23',1),(3,'josealf7@gmail.com','JOSE ALFREDO','TAPIA ARROYO',1,'0','1978-09-04','2018-04-08 19:04:27',1),(4,'jcvasquez18@hotmail.com','Juan Carlos','Vasquez Lopez',1,'0','1996-07-04','2018-09-15 19:05:59',1),(5,'ingjerson@gmail.com','Jerson Daniel','Batista Vega',1,'0','1989-05-26','2018-09-18 05:43:58',1),(6,'leo@gmail.com','LEONARDO RAFAEL','ROMERO ORTEGA',1,'0','1972-03-09','2018-10-16 19:41:33',1),(7,'enis@correo.com','ENIS YOJANA','TAPIA ARROYO',1,'0','1984-11-12','2018-10-18 17:59:06',1);

/*Table structure for table `proveedorservicios` */

DROP TABLE IF EXISTS `proveedorservicios`;

CREATE TABLE `proveedorservicios` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint(9) NOT NULL,
  `idServicio` bigint(9) NOT NULL,
  `valor` float NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  KEY `idServicio` (`idServicio`),
  CONSTRAINT `proveedorservicios_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proveedorservicios_ibfk_2` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `proveedorservicios` */

insert  into `proveedorservicios`(`id`,`idProveedor`,`idServicio`,`valor`,`fecha_reg`,`activo`) values (1,1,4,0,'2018-09-15 19:01:48',1),(2,4,4,0,'2018-09-15 19:06:26',1),(3,1,5,0,'2018-09-21 19:31:39',1),(4,1,7,0,'2018-09-21 19:31:53',1),(49,1,4,0,'2018-10-29 08:10:18',1),(50,1,5,0,'2018-10-29 08:10:19',1),(51,1,6,0,'2018-10-29 08:10:19',1),(52,1,7,0,'2018-10-29 08:10:19',1);

/*Table structure for table `rango_accion_servicios` */

DROP TABLE IF EXISTS `rango_accion_servicios`;

CREATE TABLE `rango_accion_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idServicios` bigint(9) NOT NULL,
  `idMunicipio` bigint(6) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idServicios` (`idServicios`),
  KEY `idMunicipio` (`idMunicipio`),
  CONSTRAINT `rango_accion_servicios_ibfk_1` FOREIGN KEY (`idServicios`) REFERENCES `proveedorservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rango_accion_servicios_ibfk_2` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `rango_accion_servicios` */

insert  into `rango_accion_servicios`(`id`,`idServicios`,`idMunicipio`,`estado`,`fecha`) values (1,49,3,1,'2018-10-29 08:10:18'),(2,49,4,1,'2018-10-29 08:10:19'),(3,50,3,1,'2018-10-29 08:10:19'),(4,50,4,1,'2018-10-29 08:10:19'),(5,51,3,1,'2018-10-29 08:10:19'),(6,51,4,1,'2018-10-29 08:10:19'),(7,52,3,1,'2018-10-29 08:10:19'),(8,52,4,1,'2018-10-29 08:10:19');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `idcategoria` smallint(3) NOT NULL,
  `idSubCategoria` smallint(3) DEFAULT NULL,
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idSubCategoria` (`idSubCategoria`),
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`idSubCategoria`) REFERENCES `subcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `servicios` */

insert  into `servicios`(`idcategoria`,`idSubCategoria`,`id`,`nombre`,`fechaReg`,`activo`) values (15,NULL,1,'pintura exterior','2018-08-22 07:07:49',1),(15,NULL,2,'pintura interior','2018-08-22 07:08:07',1),(15,NULL,3,'impermeabilizaci√≥n','2018-08-22 07:09:17',1),(15,NULL,4,'electricidad','2018-08-22 07:09:27',1),(15,NULL,5,'plomer√≠a Y fontaner√≠a','2018-08-22 07:09:43',1),(15,NULL,6,'carpinter√≠a','2018-08-22 07:09:54',1),(15,NULL,7,'herrer√≠a','2018-08-22 07:10:03',1),(15,NULL,8,'alba√±iler√≠a','2018-08-22 07:10:12',1),(5,NULL,9,'jardiner√≠a','2018-08-22 07:11:36',1),(15,NULL,10,'limpieza','2018-08-22 07:10:43',1);

/*Table structure for table `solicitudservicios` */

DROP TABLE IF EXISTS `solicitudservicios`;

CREATE TABLE `solicitudservicios` (
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
  CONSTRAINT `solicitudservicios_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitudservicios_ibfk_2` FOREIGN KEY (`idProveedorServicio`) REFERENCES `proveedorservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `solicitudservicios` */

/*Table structure for table `subcategoria` */

DROP TABLE IF EXISTS `subcategoria`;

CREATE TABLE `subcategoria` (
  `idcategoria` smallint(3) NOT NULL,
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuarioReg` bigint(9) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`),
  CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `subcategoria` */

insert  into `subcategoria`(`idcategoria`,`id`,`nombre`,`fechaReg`,`usuarioReg`,`activo`) values (15,1,'mantenimiento residencial','2018-08-22 07:06:28',NULL,1);

/*Table structure for table `telefonoclientes` */

DROP TABLE IF EXISTS `telefonoclientes`;

CREATE TABLE `telefonoclientes` (
  `id` bigint(9) NOT NULL DEFAULT '0',
  `idCliente` bigint(9) NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `telefonoclientes_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `telefonoclientes` */

insert  into `telefonoclientes`(`id`,`idCliente`,`telefono`,`fechaReg`,`activo`) values (0,2,'3008829776','2018-04-23 17:59:56',1);

/*Table structure for table `telefonoproveedores` */

DROP TABLE IF EXISTS `telefonoproveedores`;

CREATE TABLE `telefonoproveedores` (
  `id` bigint(9) NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint(9) NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fechaReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idProveedor` (`idProveedor`),
  CONSTRAINT `telefonoproveedores_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `telefonoproveedores` */

insert  into `telefonoproveedores`(`id`,`idProveedor`,`telefono`,`fechaReg`,`activo`) values (1,1,'3006469855','2018-04-08 18:26:23',1),(3,3,'3107358169','2018-04-08 19:04:28',1),(4,4,'3006558024','2018-09-15 19:05:59',1),(5,5,'3007358024','2018-09-18 05:43:58',1),(6,6,'3116576004','2018-10-16 19:41:33',1),(7,7,'6861395, 3105636','2018-10-18 17:59:06',1);

/*Table structure for table `tipoagenda` */

DROP TABLE IF EXISTS `tipoagenda`;

CREATE TABLE `tipoagenda` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipoagenda` */

insert  into `tipoagenda`(`id`,`nombre`,`fecha_reg`,`activo`) values (1,'General','2018-10-25 14:52:29',1),(2,'Especifica','2018-10-25 14:52:34',1);

/*Table structure for table `usuariosclientes` */

DROP TABLE IF EXISTS `usuariosclientes`;

CREATE TABLE `usuariosclientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` blob NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuariosclientes_email_unique` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuariosclientes` */

insert  into `usuariosclientes`(`id`,`usuario`,`contrasena`,`activo`,`fechaRegistro`) values (1,'josealf7@gmail.com','NÅ:fJAô	Ój”y',1,'2018-04-16 22:14:37'),(2,'norelys@correo.com','ëeuä!√û0k—\'˘i',1,'2018-04-23 17:59:55'),(3,'josealf@correo.com','%πQ˘ﬁª3≈wπˆÇN',1,'2018-10-18 17:40:00'),(4,'cesar@correo.com','NÅ:fJAô	Ój”y',1,'2018-10-18 17:54:42'),(5,'orlay@correo.com','NÅ:fJAô	Ój”y',1,'2018-10-18 17:56:50'),(6,'enis@correo.com','NÅ:fJAô	Ój”y',1,'2018-10-18 17:59:06'),(7,'mariana@correo.com','NÅ:fJAô	Ój”y',1,'2018-10-18 18:26:52'),(8,'josealf123@correo.com','dÕ Àﬁn]ŒÇÊÊwë¢mŒ',1,'2018-10-22 17:54:07');

/*Table structure for table `usuariosproveedores` */

DROP TABLE IF EXISTS `usuariosproveedores`;

CREATE TABLE `usuariosproveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` blob NOT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuariosproveedores_email_unique` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuariosproveedores` */

insert  into `usuariosproveedores`(`id`,`usuario`,`contrasena`,`activo`,`fechaRegistro`) values (1,'ingjerson2014@gmail.com','NÅ:fJAô	Ój”y',1,'2018-08-15 08:41:07'),(3,'josealf7@gmail.com','NÅ:fJAô	Ój”y',1,'2018-08-15 08:41:06'),(4,'jcvasquez18@hotmail.com','fà˘ˇÍWT=∫Õ≈oÚ',2,'2018-09-15 19:05:59'),(5,'ingjerson@gmail.com','dÕ Àﬁn]ŒÇÊÊwë¢mŒ',2,'2018-09-18 05:43:57'),(6,'leo@gmail.com','NÅ:fJAô	Ój”y',1,'2018-10-16 19:43:08'),(7,'enis@correo.com','NÅ:fJAô	Ój”y',2,'2018-10-18 17:59:06');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

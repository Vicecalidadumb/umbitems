/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : umb_itemsdps

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-02-24 16:38:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `umbitems_componentes`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_componentes`;
CREATE TABLE `umbitems_componentes` (
  `COMPONENTE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL COMPONENTE',
  `COMPONENTE_NOMBRE` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NOMBRE DEL COMPONENTE',
  `COMPONENTE_SIGLA` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'SIGLA DEL COMPONENTE',
  `COMPONENTE_ESTADO` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'ESTADO DEL COMPONENTE',
  `COMPONENTE_PREGUNTAS` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NUMERO DE PREGUNTAS ESPERADAS PARA EL COMPONENTE',
  `COMPONENTE_PREGUNTAS_RESERVAS` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `COMPONENTE_FECHADEINGRESO` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE CREACION DEL COMPONENTE EN LA BD',
  `COMPONENTE_OKCONSTRUCTOR` tinyint(4) DEFAULT '0' COMMENT 'VISTO BUENO DEL CONSTRUCTOR - HE REALIZADO TODAS LAS CORRECCIONES',
  `COMPONENTE_OKCONSTRUCTOR_FECHA` datetime DEFAULT NULL COMMENT 'FECHA DEL VB',
  `COMPONENTE_OKCONSTRUCTOR_ID` int(11) DEFAULT NULL COMMENT 'ID DE USUARIO DEL VB',
  PRIMARY KEY (`COMPONENTE_ID`),
  UNIQUE KEY `COMPONENTE_SIGLA` (`COMPONENTE_SIGLA`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='COMPONENTES DE LOS ITEMS';

-- ----------------------------
-- Records of umbitems_componentes
-- ----------------------------
INSERT INTO `umbitems_componentes` VALUES ('1', 'COMPONENTE PRUEBA 1', 'CP1', '1', '10', null, '2014-12-18 11:09:53', '0', null, null);

-- ----------------------------
-- Table structure for `umbitems_configuracion`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_configuracion`;
CREATE TABLE `umbitems_configuracion` (
  `CONFIGURACION_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `CONFIGURACION_NOMBRE` varchar(256) DEFAULT NULL COMMENT 'NOMBRE',
  `CONFIGURACION_DESCRIPCION` varchar(1024) DEFAULT NULL COMMENT 'DESCRIPCION',
  `CONFIGURACION_IMA1` varchar(1024) DEFAULT NULL COMMENT 'IMA1',
  `CONFIGURACION_IMA2` varchar(1024) DEFAULT NULL COMMENT 'IMA2',
  PRIMARY KEY (`CONFIGURACION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of umbitems_configuracion
-- ----------------------------
INSERT INTO `umbitems_configuracion` VALUES ('1', 'CONVOCATORIA No. 320 de 2014 - DPS', 'CONVOCATORIA No. 320 de 2014 - DPS', 'ima1.png', null);

-- ----------------------------
-- Table structure for `umbitems_log`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_log`;
CREATE TABLE `umbitems_log` (
  `LOG_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL EVENTO',
  `USUARIO_ID` int(11) DEFAULT NULL COMMENT 'ID DEL USUARIO',
  `PREGUNTA_ID` int(11) DEFAULT NULL COMMENT 'ID DE LA PREGUNTA',
  `LOG_TIPO` int(11) DEFAULT NULL COMMENT 'TIPO DE EVENTO',
  `LOG_DESCRIPCION` varchar(1024) DEFAULT NULL COMMENT 'DESCRIPCION',
  `LOG_FECHA` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DEL EVENTO',
  `LOG_IDREFERENCIA` int(11) NOT NULL COMMENT 'ID DE REFERENCIA DE EVALUACION',
  PRIMARY KEY (`LOG_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of umbitems_log
-- ----------------------------
INSERT INTO `umbitems_log` VALUES ('1', '2', '2', '1', '0sdfsdfsdfsdfsdfsdfsdfsdf', '2014-12-18 12:48:49', '0');
INSERT INTO `umbitems_log` VALUES ('2', '2', '3', '1', 'Agrego una Pregunta', '2014-12-18 17:12:08', '0');
INSERT INTO `umbitems_log` VALUES ('3', '2', '4', '1', 'Agrego una Pregunta', '2014-12-18 18:14:05', '0');
INSERT INTO `umbitems_log` VALUES ('4', '2', '5', '1', 'Agrego una Pregunta', '2014-12-18 19:39:30', '0');
INSERT INTO `umbitems_log` VALUES ('5', '2', '6', '1', 'Agrego una Pregunta', '2014-12-18 19:39:51', '0');
INSERT INTO `umbitems_log` VALUES ('6', '2', '7', '1', 'Agrego una Pregunta', '2014-12-19 10:59:37', '0');
INSERT INTO `umbitems_log` VALUES ('7', '2', '1', '1', 'Agrego una Pregunta', '2014-12-22 12:34:23', '0');
INSERT INTO `umbitems_log` VALUES ('8', '2', '2', '1', 'Agrego una Pregunta', '2015-01-02 12:11:34', '0');
INSERT INTO `umbitems_log` VALUES ('9', '2', '3', '1', 'Agrego una Pregunta', '2015-01-02 15:40:05', '0');
INSERT INTO `umbitems_log` VALUES ('10', '2', '4', '1', 'Agrego una Pregunta', '2015-01-02 16:14:54', '0');
INSERT INTO `umbitems_log` VALUES ('11', '2', '5', '1', 'Agrego una Pregunta', '2015-01-02 16:24:41', '0');
INSERT INTO `umbitems_log` VALUES ('12', '2', '6', '1', 'Agrego una Pregunta', '2015-01-02 16:34:26', '0');
INSERT INTO `umbitems_log` VALUES ('13', '2', '7', '1', 'Agrego una Pregunta', '2015-01-02 16:57:43', '0');
INSERT INTO `umbitems_log` VALUES ('14', '2', '8', '1', 'Agrego una Pregunta', '2015-01-03 09:06:23', '0');
INSERT INTO `umbitems_log` VALUES ('15', '2', '9', '1', 'Agrego una Pregunta', '2015-01-03 09:07:11', '0');
INSERT INTO `umbitems_log` VALUES ('16', '2', '10', '1', 'Agrego una Pregunta', '2015-01-03 09:11:07', '0');
INSERT INTO `umbitems_log` VALUES ('17', '2', '11', '1', 'Agrego una Pregunta', '2015-01-03 09:16:39', '0');
INSERT INTO `umbitems_log` VALUES ('18', '2', '12', '1', 'Agrego una Pregunta', '2015-01-03 10:05:16', '0');
INSERT INTO `umbitems_log` VALUES ('19', '2', '13', '1', 'Agrego una Pregunta', '2015-01-03 10:15:22', '0');
INSERT INTO `umbitems_log` VALUES ('20', '2', '14', '1', 'Agrego una Pregunta', '2015-01-05 11:55:46', '0');
INSERT INTO `umbitems_log` VALUES ('21', '2', '15', '1', 'Agrego una Pregunta', '2015-01-05 12:16:17', '0');
INSERT INTO `umbitems_log` VALUES ('22', '2', '1', '1', 'Agrego una Pregunta', '2015-01-17 09:23:38', '0');
INSERT INTO `umbitems_log` VALUES ('23', '2', '2', '1', 'Agrego una Pregunta', '2015-01-26 10:16:46', '0');
INSERT INTO `umbitems_log` VALUES ('24', '2', '3', '1', 'Agrego una Pregunta', '2015-01-26 10:19:05', '0');
INSERT INTO `umbitems_log` VALUES ('25', '2', '4', '1', 'Agrego una Pregunta', '2015-01-26 10:25:42', '0');
INSERT INTO `umbitems_log` VALUES ('26', '2', '5', '1', 'Agrego una Pregunta', '2015-01-26 15:57:19', '0');
INSERT INTO `umbitems_log` VALUES ('27', '2', '6', '1', 'Agrego una Pregunta', '2015-01-26 16:35:19', '0');
INSERT INTO `umbitems_log` VALUES ('28', '2', '7', '1', 'Agrego una Pregunta', '2015-01-26 16:48:29', '0');
INSERT INTO `umbitems_log` VALUES ('29', '2', '8', '1', 'Agrego una Pregunta', '2015-01-26 17:34:21', '0');
INSERT INTO `umbitems_log` VALUES ('30', '2', '10', '1', 'Agrego una Pregunta', '2015-02-04 12:03:53', '0');
INSERT INTO `umbitems_log` VALUES ('31', '2', '11', '1', 'Agrego una Pregunta', '2015-02-04 12:06:16', '0');
INSERT INTO `umbitems_log` VALUES ('32', '2', '12', '1', 'Agrego una Pregunta', '2015-02-04 12:06:49', '0');
INSERT INTO `umbitems_log` VALUES ('33', '2', '13', '1', 'Agrego una Pregunta', '2015-02-04 12:07:19', '0');
INSERT INTO `umbitems_log` VALUES ('34', '2', '14', '1', 'Agrego una Pregunta', '2015-02-04 12:07:53', '0');
INSERT INTO `umbitems_log` VALUES ('35', '2', '15', '1', 'Agrego una Pregunta', '2015-02-23 10:39:24', '0');
INSERT INTO `umbitems_log` VALUES ('36', '2', '16', '1', 'Agrego una Pregunta', '2015-02-23 10:40:16', '0');

-- ----------------------------
-- Table structure for `umbitems_modulos`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_modulos`;
CREATE TABLE `umbitems_modulos` (
  `ID_MODULO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL MODULO',
  `NOM_MODULO` varchar(300) DEFAULT NULL COMMENT 'NOMBRE DEL MODULO',
  `SIGLA_MODULO` varchar(3) DEFAULT NULL,
  `ACT_MODULO` tinyint(1) DEFAULT NULL COMMENT 'ESTADO DEL MODULO(1=ACTIVO,0=INACTIVO)',
  PRIMARY KEY (`ID_MODULO`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='MODULOS DE SISTEMA';

-- ----------------------------
-- Records of umbitems_modulos
-- ----------------------------
INSERT INTO `umbitems_modulos` VALUES ('1', 'Construccion de Preguntas', 'PRE', '1');
INSERT INTO `umbitems_modulos` VALUES ('2', 'Configuracion del Sistema', 'CON', '1');
INSERT INTO `umbitems_modulos` VALUES ('3', 'Validacion de Preguntas', 'VAL', '1');
INSERT INTO `umbitems_modulos` VALUES ('9', 'Modificar Pregunta', 'VMO', '1');
INSERT INTO `umbitems_modulos` VALUES ('10', 'Usuarios del Sistema', 'USU', '1');
INSERT INTO `umbitems_modulos` VALUES ('11', 'Componentes', 'COM', '1');

-- ----------------------------
-- Table structure for `umbitems_modulos_tipos`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_modulos_tipos`;
CREATE TABLE `umbitems_modulos_tipos` (
  `ID_MODULO` int(11) NOT NULL COMMENT 'ID DEL MODULO',
  `ID_TIPO_USU` int(11) NOT NULL COMMENT 'ID DEL TIPO DE USUARIO',
  `GUARDAR` tinyint(1) DEFAULT NULL COMMENT 'GUARDAR EN MODULO',
  `ACTUALIZAR` tinyint(1) DEFAULT NULL COMMENT 'ACTUALIZAR EN MODULO',
  `ELIMINAR` tinyint(1) DEFAULT NULL COMMENT 'ELIMINAR EN MODULO',
  `CONSULTAR` tinyint(1) DEFAULT NULL COMMENT 'CONSULTAR MODULO',
  PRIMARY KEY (`ID_MODULO`,`ID_TIPO_USU`),
  KEY `ID_TIPO_USU` (`ID_TIPO_USU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Modulos por Tipos de Usuario';

-- ----------------------------
-- Records of umbitems_modulos_tipos
-- ----------------------------
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '2', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '3', '0', '0', '0', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '4', '0', '0', '0', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '5', '0', '0', '0', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '6', '0', '0', '0', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('1', '7', '0', '0', '0', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('2', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '3', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '4', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '6', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('3', '7', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '4', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('4', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '4', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('5', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '4', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('6', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '3', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('7', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '3', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('8', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '2', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '3', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('9', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '5', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('10', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '5', '0', '0', '0', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '6', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('11', '7', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '1', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '2', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '3', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '4', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '5', '0', '0', '0', '0');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '6', '1', '1', '1', '1');
INSERT INTO `umbitems_modulos_tipos` VALUES ('12', '7', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `umbitems_preguntas`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_preguntas`;
CREATE TABLE `umbitems_preguntas` (
  `PREGUNTA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DE LA PREGUNTA',
  `PREGUNTA_TEMA` varchar(512) COLLATE utf8_spanish_ci NOT NULL COMMENT 'TEMA DE LA PREGUNTA',
  `PREGUNTA_NIVELRUBRICA` varchar(128) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NIVEL DE LA RUBRICA ',
  `PREGUNTA_NIVELPREGUNTA` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NIVEL DE PREGUNTA(ASISTENCIAL,TECNICO O PROFESIONAL ESPECIALIZADO)',
  `PREGUNTA_TIPOITEM` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'TIPO DEL ITEM (SMUR,SMMR,ANPOS,ANREL)',
  `PREGUNTA_NIVELDIFICULTAD` int(1) NOT NULL COMMENT 'NIVEL DE DIFICULTAD DE LA PREGUNTA(1=BAJO,2=MEDIO,3=ALTO)',
  `PREGUNTA_CONTEXTO` longblob COMMENT 'CONTEXTO DE LA PREGUNTA',
  `PREGUNTA_ENUNCIADO` longblob COMMENT 'ENUNCIADO DE LA PREGUNTA(ENCRIPTADO CON AES)',
  `PREGUNTA_IDRESPUESTA` longblob COMMENT 'ID DE LA RESPUESTA CORRECTA ((ENCRIPTADO CON AES)',
  `PREGUNTA_OBSERVACIONES` longblob COMMENT 'OBSERVACIONES DE LA PREGUNTA(ENCRIPTADO CON AES)',
  `PREGUNTA_ESTADO` tinyint(1) NOT NULL COMMENT 'ESTADO DE LA PREGUNTA EN EL SISTEMA(1=ACTIVA,0=INACTIVA)',
  `PREGUNTA_ETAPA` int(1) DEFAULT '0' COMMENT 'ETAPA DE LA PREGUNTA(0=CONSTRUCCION,1=VALIDACION)',
  `PREGUNTA_FECHADECREACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE CREACION DE LA PREGUNTA',
  `PREGUNTA_SELECCIONADA` tinyint(4) DEFAULT '0' COMMENT 'PREGUNTA SELECCIONADA (0=NO,1=SI)',
  `PREGUNTA_SELECCIONADA_FECHA` datetime DEFAULT NULL COMMENT 'FECHA DE SELECCION',
  `PREGUNTA_DIAGRAMADA` tinyint(4) DEFAULT '0' COMMENT 'PREGUNTA DIAGRAMADA(0=NO,1=SI)',
  `PREGUNTA_DIAGRAMADA_FECHA` datetime DEFAULT NULL COMMENT 'FECHA DE DIAGRAMACION',
  `PREGUNTA_VALIDA_CE` int(11) DEFAULT '0' COMMENT 'CORRECCION DE ESTILO',
  `PREGUNTA_VALIDA_CE_FECHA` datetime DEFAULT NULL COMMENT 'CORRECCION DE ESTILO - FECHA',
  `PREGUNTA_VALIDA_2` tinyint(4) DEFAULT '0' COMMENT 'VALIDADOR 2',
  `PREGUNTA_VALIDA_2_TEXT1` varchar(1024) COLLATE utf8_spanish_ci DEFAULT '1. ' COMMENT 'TEXTO 1 DEL VALIDADOR 2',
  `PREGUNTA_VALIDA_2_TEXT2` varchar(1024) COLLATE utf8_spanish_ci DEFAULT '1. ' COMMENT 'TEXTO 2 DEL VALIDADOR 2',
  `PREGUNTA_VALIDA_2_FECHA` datetime DEFAULT NULL COMMENT 'VALIDADOR 2 - FECHA',
  `PREGUNTA_SELEC_1_TEXT2` varchar(1024) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1.',
  `COMPONENTE_ID` int(11) NOT NULL COMMENT 'ID DEL COMPONENTE',
  `USUARIO_ID` int(11) NOT NULL COMMENT 'ID DEL USUARIO ENCARGADO',
  PRIMARY KEY (`PREGUNTA_ID`),
  KEY `COMPONENTE_ID` (`COMPONENTE_ID`),
  KEY `USUARIO_ID` (`USUARIO_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='PREGUNTAS O ITEMS';

-- ----------------------------
-- Records of umbitems_preguntas
-- ----------------------------
INSERT INTO `umbitems_preguntas` VALUES ('15', 'ddddd', 'RESOLUTIVO', 'ASISTENCIAL', 'SMUR', '1', 0x1CFA4324D1ED33DF5D1D5AAF039CD0D5, 0x04604799BBF8C359BE1C652629E69834, 0x69277FCAC2BC59961EFDF3033DB6846B, 0x29A122C2FAA2F13B1F99B037634C79D8, '1', '3', '2015-02-23 10:39:24', '1', '2015-02-23 10:43:47', '0', null, '0', null, '1', '1. ggrf<br>23/02/2015 10:42:25<br>', '1. fgfgfgf<br>23/02/2015 10:42:25<br>', '2015-02-23 10:42:25', '1.ys wurfo <br>23/02/2015 10:43:47 En Seleccion <br>', '1', '2');
INSERT INTO `umbitems_preguntas` VALUES ('16', 'ffff', 'RESOLUTIVO', 'ASISTENCIAL', 'SMUR', '1', 0x3AB087109A012C0E6E0E6BF1EF7E6168, 0x7ABE8385FA7DA32D2B9D8C43F09BA17B, 0x02CF00459FFFB83153F9732618DDDFE3, 0x29A122C2FAA2F13B1F99B037634C79D8, '1', '1', '2015-02-23 10:40:16', '1', '2015-02-23 10:43:34', '0', null, '0', null, '1', '1. gggg<br>23/02/2015 10:41:52<br>fgfg<br>23/02/2015 10:42:33<br>', '1. 4444ggg<br>23/02/2015 10:41:52<br>fgfgfgfg<br>23/02/2015 10:42:33<br>', '2015-02-23 10:42:33', '1.ttttereeeeee<br>23/02/2015 10:43:34 En Seleccion <br>', '1', '2');

-- ----------------------------
-- Table structure for `umbitems_pregunta_modificacion`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_pregunta_modificacion`;
CREATE TABLE `umbitems_pregunta_modificacion` (
  `PREGUNTA_MODIFICACION_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DE LA MODIFICACION DE LA PREGUNTA',
  `PREGUNTA_MODIFICACION_ENUNCIADO` longblob NOT NULL COMMENT 'ENUNCIADO DE LA PREGUNTA',
  `PREGUNTA_MODIFICACION_CONTEXTO` longblob COMMENT 'CONTEXTO DE LA PREGUNTA',
  `PREGUNTA_MODIFICACION_OBSERVACIONES` longblob NOT NULL COMMENT 'OBSERVACIONES DE LA PREGUNTA',
  `PREGUNTA_MODIFICACION_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE MODIFICACION',
  `PREGUNTA_MODIFICACION_IDUSUARIOCREADOR` int(11) NOT NULL COMMENT 'ID DEL USUARIO MODIFICADOR',
  `PREGUNTA_ID` int(11) NOT NULL COMMENT 'ID DE LA PREGUNTA MODIFICADA',
  PRIMARY KEY (`PREGUNTA_MODIFICACION_ID`),
  KEY `PREGUNTA_ID` (`PREGUNTA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='PREGUNTAS MODIFICADAS';

-- ----------------------------
-- Records of umbitems_pregunta_modificacion
-- ----------------------------
INSERT INTO `umbitems_pregunta_modificacion` VALUES ('4', 0x01BA78DC2A43D0740F6C693FD46EE1EA, 0x01BA78DC2A43D0740F6C693FD46EE1EA, 0xBB67585F1804C9AD130D49F5878ED92F, '2015-02-19 17:12:41', '3', '14');

-- ----------------------------
-- Table structure for `umbitems_respuestas`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_respuestas`;
CREATE TABLE `umbitems_respuestas` (
  `RESPUESTA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DE LA RESPUESTA',
  `RESPUESTA_ENUNCIADO` longblob NOT NULL COMMENT 'ENUNCIADO DE LA RESPUESTA(ENCRIPTADO CON AES)',
  `RESPUESTA_JUSTIFICACION` longblob NOT NULL COMMENT 'JUSTIFICACION DE LA RESPUESTA(ENCRIPTADO CON AES)',
  `RESPUESTA_ESTADO` tinyint(4) NOT NULL COMMENT 'ESTADO DE LA RESPUESTA EN EL SISTEMA(1=ACTIVO,0=INACTIVO)',
  `RESPUESTA_FECHADECREACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE CREACION DEL COMPONENTE EN LA BD',
  `USUARIO_ID` int(11) NOT NULL COMMENT 'ID DEL USUARIO CREADOR',
  `PREGUNTA_ID` int(11) NOT NULL COMMENT 'ID DE LA PREGUNTA',
  PRIMARY KEY (`RESPUESTA_ID`),
  KEY `USUARIO_ID` (`USUARIO_ID`,`PREGUNTA_ID`),
  KEY `PREGUNTA_ID` (`PREGUNTA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='RESPUESTAS DE ITEMS';

-- ----------------------------
-- Records of umbitems_respuestas
-- ----------------------------
INSERT INTO `umbitems_respuestas` VALUES ('97', 0x8DE7192D84E97C922DFB1767AA82BD8E, 0x8DE7192D84E97C922DFB1767AA82BD8E, '1', '2015-02-04 12:06:16', '2', '11');
INSERT INTO `umbitems_respuestas` VALUES ('98', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '1', '2015-02-04 12:06:16', '2', '11');
INSERT INTO `umbitems_respuestas` VALUES ('99', 0xDB569E2CF45C2D77558D572ED426A19D, 0xDB569E2CF45C2D77558D572ED426A19D, '1', '2015-02-04 12:06:16', '2', '11');
INSERT INTO `umbitems_respuestas` VALUES ('100', 0x614ED96CBA1A2FEEC3CA740888ADF3CF, 0x614ED96CBA1A2FEEC3CA740888ADF3CF, '1', '2015-02-04 12:06:16', '2', '11');
INSERT INTO `umbitems_respuestas` VALUES ('101', 0x417B0474F39D0153C2B0BF16C285DB6C, 0xCC2E9EE3D80952621C467E28E4C52315, '1', '2015-02-04 12:06:49', '2', '12');
INSERT INTO `umbitems_respuestas` VALUES ('102', 0xB7C31258668B15E2CA9273ECA4641D68, 0xB7C31258668B15E2CA9273ECA4641D68, '1', '2015-02-04 12:06:49', '2', '12');
INSERT INTO `umbitems_respuestas` VALUES ('103', 0x09E1A91481F43A598B916427EE44AFC5, 0xB8ACAA95CAE3526DB11C1BF057DA1D52, '1', '2015-02-04 12:06:49', '2', '12');
INSERT INTO `umbitems_respuestas` VALUES ('104', 0x16B508CFCA6DC38E48B8244CE27640BF, 0x16B508CFCA6DC38E48B8244CE27640BF, '1', '2015-02-04 12:06:49', '2', '12');
INSERT INTO `umbitems_respuestas` VALUES ('105', 0x614ED96CBA1A2FEEC3CA740888ADF3CF, 0x614ED96CBA1A2FEEC3CA740888ADF3CF, '1', '2015-02-04 12:07:19', '2', '13');
INSERT INTO `umbitems_respuestas` VALUES ('106', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '1', '2015-02-04 12:07:19', '2', '13');
INSERT INTO `umbitems_respuestas` VALUES ('107', 0xDB569E2CF45C2D77558D572ED426A19D, 0xDB569E2CF45C2D77558D572ED426A19D, '1', '2015-02-04 12:07:19', '2', '13');
INSERT INTO `umbitems_respuestas` VALUES ('108', 0x8DE7192D84E97C922DFB1767AA82BD8E, 0x8DE7192D84E97C922DFB1767AA82BD8E, '1', '2015-02-04 12:07:19', '2', '13');
INSERT INTO `umbitems_respuestas` VALUES ('109', 0x2253ACD8BADAFC2554E466283E791F1C, 0x2253ACD8BADAFC2554E466283E791F1C, '1', '2015-02-04 12:07:53', '2', '14');
INSERT INTO `umbitems_respuestas` VALUES ('110', 0x614ED96CBA1A2FEEC3CA740888ADF3CF, 0x614ED96CBA1A2FEEC3CA740888ADF3CF, '1', '2015-02-04 12:07:53', '2', '14');
INSERT INTO `umbitems_respuestas` VALUES ('111', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '1', '2015-02-04 12:07:53', '2', '14');
INSERT INTO `umbitems_respuestas` VALUES ('112', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '1', '2015-02-04 12:07:53', '2', '14');
INSERT INTO `umbitems_respuestas` VALUES ('113', 0x614ED96CBA1A2FEEC3CA740888ADF3CF, 0x614ED96CBA1A2FEEC3CA740888ADF3CF, '1', '2015-02-23 10:39:24', '2', '15');
INSERT INTO `umbitems_respuestas` VALUES ('114', 0xDB569E2CF45C2D77558D572ED426A19D, 0xDB569E2CF45C2D77558D572ED426A19D, '1', '2015-02-23 10:39:24', '2', '15');
INSERT INTO `umbitems_respuestas` VALUES ('115', 0x8DE7192D84E97C922DFB1767AA82BD8E, 0x8DE7192D84E97C922DFB1767AA82BD8E, '1', '2015-02-23 10:39:24', '2', '15');
INSERT INTO `umbitems_respuestas` VALUES ('116', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '1', '2015-02-23 10:39:24', '2', '15');
INSERT INTO `umbitems_respuestas` VALUES ('117', 0x614ED96CBA1A2FEEC3CA740888ADF3CF, 0x614ED96CBA1A2FEEC3CA740888ADF3CF, '1', '2015-02-23 10:40:16', '2', '16');
INSERT INTO `umbitems_respuestas` VALUES ('118', 0xDB569E2CF45C2D77558D572ED426A19D, 0xDB569E2CF45C2D77558D572ED426A19D, '1', '2015-02-23 10:40:16', '2', '16');
INSERT INTO `umbitems_respuestas` VALUES ('119', 0x8DE7192D84E97C922DFB1767AA82BD8E, 0x8DE7192D84E97C922DFB1767AA82BD8E, '1', '2015-02-23 10:40:16', '2', '16');
INSERT INTO `umbitems_respuestas` VALUES ('120', 0xC1A5B0E894591206C16E127A333E7CEE, 0x834A70773D9366250777D1FD0355BB60, '1', '2015-02-23 10:40:16', '2', '16');

-- ----------------------------
-- Table structure for `umbitems_respuesta_modificacion`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_respuesta_modificacion`;
CREATE TABLE `umbitems_respuesta_modificacion` (
  `RESPUESTA_MODIFICACION_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DE LA MODIFICACION DE LA RESPUESTA',
  `RESPUESTA_MODIFICACION_ENUNCIADO` longblob COMMENT 'ENUNCIADO MODIFICADO',
  `RESPUESTA_MODIFICACION_JUSTIFICACION` longblob COMMENT 'JUSTIFICACION MODIFICADO',
  `RESPUESTA_MODIFICACION_FECHA` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE MODIFICACION',
  `RESPUESTA_MODIFICACION_IDUSUARIOCREADOR` int(11) DEFAULT NULL COMMENT 'ID DEL USUARIO MODIFICADOR',
  `RESPUESTA_ID` int(11) NOT NULL COMMENT 'ID DE LA RESPUESTAS',
  PRIMARY KEY (`RESPUESTA_MODIFICACION_ID`),
  KEY `RESPUESTA_ID` (`RESPUESTA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='RESPUESTAS MODIFICADAS';

-- ----------------------------
-- Records of umbitems_respuesta_modificacion
-- ----------------------------
INSERT INTO `umbitems_respuesta_modificacion` VALUES ('13', 0x2253ACD8BADAFC2554E466283E791F1C, 0x2253ACD8BADAFC2554E466283E791F1C, '2015-02-19 17:12:41', '3', '109');
INSERT INTO `umbitems_respuesta_modificacion` VALUES ('14', 0x5390716A7D148475B33A8FC6A56043EB, 0x614ED96CBA1A2FEEC3CA740888ADF3CF, '2015-02-19 17:12:41', '3', '110');
INSERT INTO `umbitems_respuesta_modificacion` VALUES ('15', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '2015-02-19 17:12:41', '3', '111');
INSERT INTO `umbitems_respuesta_modificacion` VALUES ('16', 0x834A70773D9366250777D1FD0355BB60, 0x834A70773D9366250777D1FD0355BB60, '2015-02-19 17:12:41', '3', '112');

-- ----------------------------
-- Table structure for `umbitems_session`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_session`;
CREATE TABLE `umbitems_session` (
  `session_id` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of umbitems_session
-- ----------------------------
INSERT INTO `umbitems_session` VALUES ('1054a75feb073d8ad1d1827cf4cd38be', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1422287293', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"4\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"654789\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA V2\";s:17:\"USUARIO_APELLIDOS\";s:20:\"P VALIDACION SUF UBI\";s:14:\"USUARIO_CORREO\";s:16:\"654789@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"4\";s:12:\"NOM_TIPO_USU\";s:19:\"Validadar SUF Y UBI\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('11337157ba9b8213a006d3d0a98b5587', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2278.0 Safari/537.36', '1421503657', '');
INSERT INTO `umbitems_session` VALUES ('17ee47ffef5a1282e590744595684847', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1424125083', '');
INSERT INTO `umbitems_session` VALUES ('219f7abebd9bb7f8489216245484ce9d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421874423', 'a:3:{s:9:\"user_data\";s:0:\"\";s:17:\"flash:new:message\";s:47:\"<strong>Error</strong> Debe Iniciar una Sesion.\";s:22:\"flash:new:message_type\";s:6:\"danger\";}');
INSERT INTO `umbitems_session` VALUES ('276b7473cffd07b8abbe99cf1b7cc7cb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421874423', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"1\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"112233\";s:15:\"USUARIO_NOMBRES\";s:13:\"ADMINISTRADOR\";s:17:\"USUARIO_APELLIDOS\";s:3:\"UMB\";s:14:\"USUARIO_CORREO\";s:16:\"ADMIN@CORREO.COM\";s:11:\"ID_TIPO_USU\";s:1:\"1\";s:12:\"NOM_TIPO_USU\";s:13:\"Administrador\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('2ad003c231f6aac6042c6a208c34abc8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1422725039', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"6\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"963258\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA SE\";s:17:\"USUARIO_APELLIDOS\";s:10:\"P SELECTOR\";s:14:\"USUARIO_CORREO\";s:16:\"963258@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"6\";s:12:\"NOM_TIPO_USU\";s:17:\"Seleccionar Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('30978b8c7c6f0e797c10db6dbac9113f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', '1422479590', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('3ae2d389544c2cd867a62d9c4bc225a9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1424729498', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('4ef3a16c8c6d0dcc6543b67d7f7aa80b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1423583215', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('642b19d65b85722815a2d6a8ed289faf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', '1420478711', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"3\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"987654\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA V1\";s:17:\"USUARIO_APELLIDOS\";s:20:\"P VALIDACION SIN SEM\";s:14:\"USUARIO_CORREO\";s:16:\"987654@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"3\";s:12:\"NOM_TIPO_USU\";s:19:\"Validadar SIN Y SEM\";s:8:\"HEADER_1\";s:429:\"<div style=\"text-align: center\">\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \n                                    </div>\n                                    <h1>Bienvenido</h1>\n                                    <h4></h4>\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:235:\"<div style=\"text-align: center\">\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \n                                    </div>\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('6e2c9f31ce02b79ceca0caa432fd33b3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', '1421261987', '');
INSERT INTO `umbitems_session` VALUES ('773fbfb72f36315ef26a82b34746b373', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1424386502', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"4\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"654789\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA V2\";s:17:\"USUARIO_APELLIDOS\";s:20:\"P VALIDACION SUF UBI\";s:14:\"USUARIO_CORREO\";s:16:\"654789@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"4\";s:12:\"NOM_TIPO_USU\";s:19:\"Validadar SUF Y UBI\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('784ebf0fa8bc49dde2d51934faf0ff19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2269.0 Safari/537.36', '1421261121', 'a:1:{s:9:\"user_data\";s:0:\"\";}');
INSERT INTO `umbitems_session` VALUES ('7c4c10fc67fb35b1bc9fb32ff2834193', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421874423', 'a:3:{s:9:\"user_data\";s:0:\"\";s:17:\"flash:new:message\";s:47:\"<strong>Error</strong> Debe Iniciar una Sesion.\";s:22:\"flash:new:message_type\";s:6:\"danger\";}');
INSERT INTO `umbitems_session` VALUES ('88f6a9d926c52475a439730bbefaabfc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1422655855', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"1\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"112233\";s:15:\"USUARIO_NOMBRES\";s:13:\"ADMINISTRADOR\";s:17:\"USUARIO_APELLIDOS\";s:3:\"UMB\";s:14:\"USUARIO_CORREO\";s:16:\"ADMIN@CORREO.COM\";s:11:\"ID_TIPO_USU\";s:1:\"1\";s:12:\"NOM_TIPO_USU\";s:13:\"Administrador\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('8a89bfd766cd3b7b37d00641d775269d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421505010', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('9362382697ad7dc1ceb27bf1a230117d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2276.0 Safari/537.36', '1421309136', '');
INSERT INTO `umbitems_session` VALUES ('94cf01b1b06c93d91612c9ba2750b47c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1423844271', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('968016591f7f263d963d938602cbaea8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1424095932', 'a:16:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"4\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"654789\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA V2\";s:17:\"USUARIO_APELLIDOS\";s:20:\"P VALIDACION SUF UBI\";s:14:\"USUARIO_CORREO\";s:16:\"654789@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"4\";s:12:\"NOM_TIPO_USU\";s:19:\"Validadar SUF Y UBI\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;s:17:\"flash:old:message\";s:31:\"Pregunta Actualizada con Exito.\";s:22:\"flash:old:message_type\";s:4:\"info\";}');
INSERT INTO `umbitems_session` VALUES ('983f6ccbcb656d1fa9507f6632d284c0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1424213089', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('abab9880d9969d24b51a305a528bee19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1420219128', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"4\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"654789\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA V2\";s:17:\"USUARIO_APELLIDOS\";s:20:\"P VALIDACION SUF UBI\";s:14:\"USUARIO_CORREO\";s:16:\"654789@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"4\";s:12:\"NOM_TIPO_USU\";s:19:\"Validadar SUF Y UBI\";s:8:\"HEADER_1\";s:429:\"<div style=\"text-align: center\">\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \n                                    </div>\n                                    <h1>Bienvenido</h1>\n                                    <h4></h4>\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:235:\"<div style=\"text-align: center\">\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \n                                    </div>\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('b1df2342123932c848690aed4b6c47a4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421874423', 'a:3:{s:9:\"user_data\";s:0:\"\";s:17:\"flash:new:message\";s:47:\"<strong>Error</strong> Debe Iniciar una Sesion.\";s:22:\"flash:new:message_type\";s:6:\"danger\";}');
INSERT INTO `umbitems_session` VALUES ('b5542b6a0b6556fc52e4a397bba7e6f2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', '1424097342', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('cdd1953c1c8fd547a0974057932cfaa0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2247.1 Safari/537.36', '1419269617', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:429:\"<div style=\"text-align: center\">\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \n                                    </div>\n                                    <h1>Bienvenido</h1>\n                                    <h4></h4>\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:235:\"<div style=\"text-align: center\">\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \n                                    </div>\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('d04aa7215c5cc093d2223efa9e386a9d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', '1422305812', 'a:14:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"2\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"123456\";s:15:\"USUARIO_NOMBRES\";s:8:\"PRUEBA C\";s:17:\"USUARIO_APELLIDOS\";s:14:\"P CONSTRUCCION\";s:14:\"USUARIO_CORREO\";s:16:\"123456@gmail.com\";s:11:\"ID_TIPO_USU\";s:1:\"2\";s:12:\"NOM_TIPO_USU\";s:20:\"Constructor de Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;}');
INSERT INTO `umbitems_session` VALUES ('d44ba8cfc40d6f6ea97b798f87e9ff03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', '1421257279', '');
INSERT INTO `umbitems_session` VALUES ('ea7985eea74356e4b77d21dc839979f9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421874423', 'a:3:{s:9:\"user_data\";s:0:\"\";s:17:\"flash:new:message\";s:47:\"<strong>Error</strong> Debe Iniciar una Sesion.\";s:22:\"flash:new:message_type\";s:6:\"danger\";}');
INSERT INTO `umbitems_session` VALUES ('f6c2cf693ec0ae5314d7aeb6c3512a59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1418916066', 'a:3:{s:9:\"user_data\";s:0:\"\";s:17:\"flash:old:message\";s:47:\"<strong>Error</strong> Debe Iniciar una Sesion.\";s:22:\"flash:old:message_type\";s:6:\"danger\";}');
INSERT INTO `umbitems_session` VALUES ('f8e917047ef2e8054d8e043653c2313d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', '1423241494', 'a:16:{s:9:\"user_data\";s:0:\"\";s:10:\"USUARIO_ID\";s:1:\"6\";s:23:\"USUARIO_NUMERODOCUMENTO\";s:6:\"963258\";s:15:\"USUARIO_NOMBRES\";s:9:\"PRUEBA SE\";s:17:\"USUARIO_APELLIDOS\";s:10:\"P SELECTOR\";s:14:\"USUARIO_CORREO\";s:16:\"963258@GMAIL.COM\";s:11:\"ID_TIPO_USU\";s:1:\"6\";s:12:\"NOM_TIPO_USU\";s:17:\"Seleccionar Items\";s:8:\"HEADER_1\";s:434:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    <h1>Bienvenido</h1>\r\n                                    <h4></h4>\r\n                                    <p>Universidad Manuela Beltr&aacute;n, Sistema de Administraci&oacute;n de &Iacute;tems.</p>\";s:8:\"HEADER_3\";s:238:\"<div style=\"text-align: center\">\r\n                                        <img src=\"http://localhost/umbitems/images/vice/ima1.png\" style=\"width: 600px;\">  \r\n                                    </div>\r\n                                    \";s:8:\"HEADER_2\";s:43:\"<h4>CONVOCATORIA No. 320 de 2014 - DPS</h4>\";s:15:\"rol_permissions\";a:6:{s:3:\"PRE\";a:3:{s:4:\"name\";s:25:\"Construccion de Preguntas\";s:2:\"id\";s:1:\"1\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"CON\";a:3:{s:4:\"name\";s:25:\"Configuracion del Sistema\";s:2:\"id\";s:1:\"2\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"VAL\";a:3:{s:4:\"name\";s:23:\"Validacion de Preguntas\";s:2:\"id\";s:1:\"3\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"1\";s:14:\"permission_add\";s:1:\"1\";s:15:\"permission_edit\";s:1:\"1\";s:17:\"permission_delete\";s:1:\"1\";}}s:3:\"VMO\";a:3:{s:4:\"name\";s:18:\"Modificar Pregunta\";s:2:\"id\";s:1:\"9\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"USU\";a:3:{s:4:\"name\";s:20:\"Usuarios del Sistema\";s:2:\"id\";s:2:\"10\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}s:3:\"COM\";a:3:{s:4:\"name\";s:11:\"Componentes\";s:2:\"id\";s:2:\"11\";s:11:\"permissions\";a:4:{s:15:\"permission_view\";s:1:\"0\";s:14:\"permission_add\";s:1:\"0\";s:15:\"permission_edit\";s:1:\"0\";s:17:\"permission_delete\";s:1:\"0\";}}}s:7:\"KEY_AES\";s:20:\"kjgw&&3%$&887Dvvc600\";s:9:\"logged_in\";b:1;s:17:\"flash:old:message\";s:31:\"Pregunta Actualizada con Exito.\";s:22:\"flash:old:message_type\";s:4:\"info\";}');
INSERT INTO `umbitems_session` VALUES ('f95586aeb27132111a15986657ab7760', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1421874423', 'a:3:{s:9:\"user_data\";s:0:\"\";s:17:\"flash:new:message\";s:47:\"<strong>Error</strong> Debe Iniciar una Sesion.\";s:22:\"flash:new:message_type\";s:6:\"danger\";}');

-- ----------------------------
-- Table structure for `umbitems_tipos_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_tipos_usuario`;
CREATE TABLE `umbitems_tipos_usuario` (
  `ID_TIPO_USU` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL TIPO DE USUARIO',
  `NOM_TIPO_USU` varchar(250) DEFAULT NULL COMMENT 'NOMBRE DEL TIPO DE USUARIO',
  `ACT_TIPO_USU` tinyint(1) DEFAULT NULL COMMENT 'ESTADO DEL TIPO DE USUARIO(1=ACTIVO,0=INACTIVO)',
  PRIMARY KEY (`ID_TIPO_USU`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='TIPOS DE USUARIOS';

-- ----------------------------
-- Records of umbitems_tipos_usuario
-- ----------------------------
INSERT INTO `umbitems_tipos_usuario` VALUES ('1', 'Administrador', '1');
INSERT INTO `umbitems_tipos_usuario` VALUES ('2', 'Constructor de Items', '1');
INSERT INTO `umbitems_tipos_usuario` VALUES ('3', 'Validadar SIN Y SEM', '1');
INSERT INTO `umbitems_tipos_usuario` VALUES ('4', 'Validadar SUF Y UBI', '1');
INSERT INTO `umbitems_tipos_usuario` VALUES ('5', 'Supervidor Pruebas', '1');
INSERT INTO `umbitems_tipos_usuario` VALUES ('6', 'Seleccionar Items', '1');
INSERT INTO `umbitems_tipos_usuario` VALUES ('7', 'Diagramadar', '1');

-- ----------------------------
-- Table structure for `umbitems_usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_usuarios`;
CREATE TABLE `umbitems_usuarios` (
  `USUARIO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID DEL USUARIO',
  `USUARIO_NOMBRES` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NOMBRES DEL USUARIO',
  `USUARIO_APELLIDOS` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'APELLIDOS DEL USUARIO',
  `USUARIO_TIPODOCUMENTO` varchar(2) COLLATE utf8_spanish_ci DEFAULT 'CC' COMMENT 'TIPO DE DOCUMENTO DEL USUARIO',
  `USUARIO_NUMERODOCUMENTO` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NUMERO DE DOCUMENTO DEL USUARIO',
  `USUARIO_CORREO` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CORREO ELECTRONICO DEL USUARIO',
  `USUARIO_CLAVE` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CLAVE DEL USUARIO PARA INGRESO AL SISTEMA',
  `USUARIO_ESTADO` tinyint(1) DEFAULT '1' COMMENT 'ESTADO DEL USUARIO EN EL SISTEMA (1=ACTIVO,2=INACTIVO))',
  `USUARIO_FECHAINGRESO` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FECHA DE INGRESO AL SISTEMA',
  `ID_TIPO_USU` int(1) NOT NULL COMMENT 'ID DEL TIPO DE DOCUMENTO',
  `CONFIGURACION_ID` int(11) DEFAULT '1' COMMENT 'ID DE LA CONFIGURACION',
  PRIMARY KEY (`USUARIO_ID`),
  UNIQUE KEY `USUARIO_NUMERODOCUMENTO` (`USUARIO_NUMERODOCUMENTO`),
  KEY `ID_TIPO_USU` (`ID_TIPO_USU`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='USUARIOS DEL SISTEMA';

-- ----------------------------
-- Records of umbitems_usuarios
-- ----------------------------
INSERT INTO `umbitems_usuarios` VALUES ('1', 'ADMINISTRADOR', 'UMB', 'CC', '112233', 'ADMIN@CORREO.COM', 'c2f26578$2fac2ee102530a92e13183848d66e54595a2d1d5', '1', '2014-12-15 15:23:05', '1', '1');
INSERT INTO `umbitems_usuarios` VALUES ('2', 'PRUEBA C', 'P CONSTRUCCION', 'CC', '123456', '123456@gmail.com', 'c2f26578$2fac2ee102530a92e13183848d66e54595a2d1d5', '1', '2014-12-18 10:13:24', '2', '1');
INSERT INTO `umbitems_usuarios` VALUES ('3', 'PRUEBA V1', 'P VALIDACION SIN SEM', 'CC', '987654', '987654@GMAIL.COM', 'dc49550f$7a8918bd037cd75cb6b133efe769416f79af84c9', '1', '2014-12-18 10:14:05', '3', '1');
INSERT INTO `umbitems_usuarios` VALUES ('4', 'PRUEBA V2', 'P VALIDACION SUF UBI', 'CC', '654789', '654789@GMAIL.COM', '6984a039$6e8cd534a18f677700c7ea1a0096c52147c1815d', '1', '2014-12-18 10:14:41', '4', '1');
INSERT INTO `umbitems_usuarios` VALUES ('5', 'PRUEBA SU', 'P SUPERVISOR', 'CC', '741258', '741258@GMAIL.COM', 'c1b699f3$562b2232279e3e630dab6247bf67d459e9bf64ca', '1', '2014-12-18 10:19:31', '5', '1');
INSERT INTO `umbitems_usuarios` VALUES ('6', 'PRUEBA SE', 'P SELECTOR', 'CC', '963258', '963258@GMAIL.COM', 'a159815f$9a90281a2dedde6523677f1a00340b66443b6d89', '1', '2014-12-18 10:20:01', '6', '1');
INSERT INTO `umbitems_usuarios` VALUES ('7', 'PRUEBA D', 'P DIAGRAMADOR', 'CC', '852147', '852147@GMAIL.COM', 'b7f386fe$34af281bbea76a8dfa523fed30318327b2cd487a', '1', '2014-12-18 10:20:42', '7', '1');

-- ----------------------------
-- Table structure for `umbitems_usuarios_componentes`
-- ----------------------------
DROP TABLE IF EXISTS `umbitems_usuarios_componentes`;
CREATE TABLE `umbitems_usuarios_componentes` (
  `COMPONENTE_ID` int(11) NOT NULL COMMENT 'ID DEL COMPONENTE',
  `USUARIO_ID` int(11) NOT NULL COMMENT 'ID DEL USUARIO',
  PRIMARY KEY (`COMPONENTE_ID`,`USUARIO_ID`),
  KEY `USUARIO_ID` (`USUARIO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='USUARIOS POR COMPONENTES';

-- ----------------------------
-- Records of umbitems_usuarios_componentes
-- ----------------------------
INSERT INTO `umbitems_usuarios_componentes` VALUES ('1', '2');
INSERT INTO `umbitems_usuarios_componentes` VALUES ('1', '3');
INSERT INTO `umbitems_usuarios_componentes` VALUES ('1', '4');
INSERT INTO `umbitems_usuarios_componentes` VALUES ('1', '5');
INSERT INTO `umbitems_usuarios_componentes` VALUES ('1', '6');
INSERT INTO `umbitems_usuarios_componentes` VALUES ('1', '7');

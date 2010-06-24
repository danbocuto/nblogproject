# MySQL-Front 5.0  (Build 1.0)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: nblog
# ------------------------------------------------------
# Server version 4.1.22-community-log

#
# Table structure for table config
#

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `nome` varchar(255) NOT NULL default '',
  `valor` varchar(255) NOT NULL default '',
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `config` VALUES ('posts-por-pg','4','Número de Postagens Por Página');
INSERT INTO `config` VALUES ('formato-data','%A, %d de %B de %Y','Formado da Data, Caso Não Saiba Entre no Site do <a href=\"http://www.php.net/date\">PHP.net Clicando Aqui</a>');
INSERT INTO `config` VALUES ('senha','5f4dcc3b5aa765d61d8327deb882cf99','Senha do Administrador');
INSERT INTO `config` VALUES ('arquivo-index','index.php','Nome do Arquivo Principal do Blog');
INSERT INTO `config` VALUES ('resposta','0','Usuários Podem Responder Postagens? 1 - Sim, 0 - Não');
INSERT INTO `config` VALUES ('titulo-blog','nBlog','Coloque Aqui o Título do Seu Blog');
INSERT INTO `config` VALUES ('desc-blog','Simples e Eficiente','Coloque Aqui a Descrição do Seu Blog');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table postagens
#

DROP TABLE IF EXISTS `postagens`;
CREATE TABLE `postagens` (
  `codigo` int(11) NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL default '',
  `titulo` varchar(255) NOT NULL default '',
  `conteudo` longtext NOT NULL,
  `pagina` int(1) NOT NULL default '0',
  `menu` int(1) NOT NULL default '0',
  `paginaini` int(1) NOT NULL default '0',
  `data` int(20) NOT NULL default '0',
  `publicado` int(1) NOT NULL default '0',
  `link` varchar(20) default '',
  `ordem` char(3) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `postagens` VALUES (1,'pagina_inicial','Inicio','<div class=\\\"script-explain\\\"><img style=\\\"width: 209px; height: 157px;\\\" src=\\\"http://img535.imageshack.us/img535/9305/34313278.jpg\\\"><br>Olá, seja bem vindo ao meu site, no momento nao tenho nada pra escrever, mas esse aí sou eu.<br></div>',1,1,1,1274980232,1,'','0');
INSERT INTO `postagens` VALUES (2,'blog','Blog','asdasfdasfsdf<br>',1,1,0,1276604984,0,'all_posts','1');
INSERT INTO `postagens` VALUES (12,'bem-vindo','Bem Vindo','Seja bem vindo ao nBlog, seu jeito facil, eficiente e simples de postar suas idéias.<br>Para remover este post entre no gerenciador com sua senha de admin, vá em Postagens, clique no botão \\\"excluir\\\".<br>',0,0,0,1277228502,1,'',NULL);
/*!40000 ALTER TABLE `postagens` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table usuarios
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `nivel` varchar(5) NOT NULL default '',
  `senha` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `usuarios` VALUES (1,'admin','Admin','5f4dcc3b5aa765d61d8327deb882cf99');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

<?
/*
 * Este arquivo faz parte do pacote de códigos "Sistema de avaliação de fotos" (github.com/gurideprograma/ilikeyou).
 * E está sob a licença GPLv2, localizada no diretório "licenca" (sem aspas) deste pacote de códigos.
 * Copyright (C) 2012 @_gurideprograma
 */

/**
 * @name Arquivo def.php, onde definimos variáveis para auxiliar em outras partes do programa
 * @package ilikeyou
 * @author @_gurideprograma
 * @license GPLv2
 * @link http://github.com/gurideprograma/ilikeyou
 */

define('DIR','/ilikeyou');
define('TITLE','i like you!');
define('LANG','en');
define('DOMAIN',$_SERVER['HTTP_HOST']);
define('PATH','/opt/lampp/htdocs');

if(DOMAIN == "localhost"){
	define('DB_LOCALHOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','ilikeyou');
}else{
	define('DB_LOCALHOST','bm22.webservidor.net');
	define('DB_USER','ilikeyou_ilikeu');
	define('DB_PASS','123Mudar');
	define('DB_NAME','ilikeyou_ilikeyou');
}

# autenticação com Twitter
define('CONSUMER_KEY', '0EiIplmjQeOekmQmENyu7Q');
define('CONSUMER_SECRET', 'VJ4UNSZptixgaDMoHzYXfsfCZ7v3ftCeJJxWRFLx3s');
define('OAUTH_CALLBACK', 'http://'.DOMAIN.DIR.'/?login');

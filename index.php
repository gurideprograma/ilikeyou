<?
session_start();
/*
 *  Sistema de avaliação de fotos
 *  Copyright (C) 2012 @_gurideprograma
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt-br.txt 
 */
 
include("inc/def.php");
include("inc/lang.php");
include("inc/crislib.php");
include("inc/core.php");
$path = url($_SERVER['REQUEST_URI'],str_replace("/","",DIR)."/");
$core = new core();
$auth = new auth();
$auth->con();
if($path == "pages/logout.php"){
	session_destroy();
	session_start();
}
include_once("inc/twitteroauth.php");
?><html>
	<head>
		<title><?= TITLE ?></title>
		
		<script type="text/javascript" src="<?= DIR ?>/inc/jquery-1.5.1.js"></script>
		<script type="text/javascript" src="<?= DIR ?>/inc/jqueryui/js/jquery-ui-1.8.10.custom.min.js"></script>
		<script type="text/javascript" src="<?= DIR ?>/inc/jqueryui.js"></script>
		<script type="text/javascript" src="<?= DIR ?>/inc/js.js"></script>
		
		<link type="text/css" href="<?= DIR ?>/inc/jqueryui.css" rel="stylesheet" />
		<link type="text/css" href="<?= DIR ?>/inc/css.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<link type="text/css" href="<?= DIR ?>/inc/jqueryui/css/redmond/jquery-ui-1.8.10.custom.css" rel="stylesheet" />
		
		<meta http-equiv="content-language" content="en">
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
		<meta name="description" content="<?= DESCRIPTION ?>" />
		<meta name="keywords" content="<?= KEYWORDS ?>">
		<meta name="author" content="github.com/gurideprograma/ilikeyou" />
		<meta name="reply-to" content="gurideprograma@mail.com">

        </head>
        <body onload="loadPicture()">
        	<div id="title">i-<span>like</span>you<span id="ext"><?= EE ?>net</div></div>
        	<div id="welcome">
        		<?
        		if($auth->isOn() == true){
        			info(MSG_WELCOME." <a href=\"http://twitter.com/".$_SESSION['request_vars']['screen_name']."\" target=\"_blank\">".$_SESSION['request_vars']['screen_name']."</a>! <a href=\"?logout\">".MENU_LOGOUT."</a>?",300);
        		}else{
        			$auth->twitterButton();
        		}
        		?>
        	</div>
        	<div style="clear:both"></div>
        	<? if($path == "pages/home.php"){ ?><div id="cont"></div><? } ?>
        	<div id="conteudo"><? include($path) ?></div>
        	
        	<div id="copy">
        		<a href="<?= DIR ?>/"><?= MENU_HOME ?></a>
        		<? $core->menuLogin(); ?>
        		<a href="<?= DIR ?>/?privacy"><?= MENU_PRIVACY ?></a>
        		<? /*<a href="<?= DIR ?>/?use"><?= MENU_TERMSUSE ?></a> */ ?>
        		<? $core->menuLogout(); ?><br>
        		&copy; <?= date("Y") ?> - <?= TITLE ?>
        	</div>
        </body>
</html>

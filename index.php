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
?><!DOCTYPE HTML>
<!--
/*
 * jQuery File Upload Plugin Demo 6.13
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->
<html lang="en">
<head>
	<!-- Force latest IE rendering engine or ChromeFrame if installed -->
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<meta charset="utf-8">
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
	<meta name="description" content="<?= DESCRIPTION ?>" />
	<meta name="keywords" content="<?= KEYWORDS ?>">
	<meta name="author" content="github.com/gurideprograma/ilikeyou" />
	<meta name="reply-to" content="gurideprograma@mail.com">
	<meta name="viewport" content="width=device-width">
	<!-- Bootstrap CSS Toolkit styles -->
	<link rel="stylesheet" href="inc/bootstrap.min.css">
	<!-- Generic page styles -->
	<link rel="stylesheet" href="scr/jfu/css/style.css">
	<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
	<link rel="stylesheet" href="inc/bootstrap-responsive.min.css">
	<!-- Bootstrap CSS fixes for IE6 -->
	<!--[if lt IE 7]><link rel="stylesheet" href="inc/bootstrap-ie6.min.css"><![endif]-->
	<!-- Bootstrap Image Gallery styles -->
	<link rel="stylesheet" href="scr/jfu/inc/bootstrap-image-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="scr/jfu/css/jquery.fileupload-ui.css">
	<!-- CSS adjustments for browsers with JavaScript disabled -->
	<noscript><link rel="stylesheet" href="scr/jfu/css/jquery.fileupload-ui-noscript.css"></noscript>
	<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
	<!--[if lt IE 9]><script src="inc/html5.js"></script><![endif]-->
</head>
<body onload="loadPicture()">
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a class="brand" href="<?= DIR ?>/" id="title">i-<span>like</span>you<span id="ext"><?= EE ?>net</a></li>
                    <li><a href="<?= DIR ?>/"><?= MENU_HOME ?></a></li>
                    <? $core->menuLogin(); ?>
                    <li><a href="<?= DIR ?>/?privacy"><?= MENU_PRIVACY ?></a></li>
                    <? $core->menuLogout(); ?><br>
                </ul>
            </div>
        	<div id="welcome">
        		<?
        		if($auth->isOn() == true){
        			info(MSG_WELCOME." <a href=\"http://twitter.com/".$_SESSION['request_vars']['screen_name']."\" target=\"_blank\">".$_SESSION['request_vars']['screen_name']."</a>! <a href=\"?logout\">".MENU_LOGOUT."</a>?",300);
        		}else{
        			$auth->twitterButton();
        		}
        		?>
        	</div>
        </div>
    </div>
</div>
        	

        	<div style="clear:both"></div>
        	<? if($path == "pages/home.php"){ ?><div id="cont"></div>
        	<div style="clear:both"></div><? } ?>
        	<div id="conteudo"><? include($path) ?></div>
        </body>
</html>

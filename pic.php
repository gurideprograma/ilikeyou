<?
/*
 * Este arquivo faz parte do pacote de códigos "Sistema de avaliação de fotos" (github.com/gurideprograma/ilikeyou).
 * E está sob a licença GPLv2, localizada no diretório "licenca" (sem aspas) deste pacote de códigos.
 * Copyright (C) 2012 @_gurideprograma
 */

/**
 * @name Arquivo pic.php, que exibe as fotos na capa do site
 * @package ilikeyou
 * @author @_gurideprograma
 * @license GPLv2
 * @link http://github.com/gurideprograma/ilikeyou
 */
include("inc/def.php");
include("inc/lang.php");
include("inc/crislib.php");
include("inc/core.php");
$core = new core();
$core->connect();
$home = new homePic();
$home->showPicture();
$core->close();

<?
/*
 * Este arquivo faz parte do pacote de códigos "Sistema de avaliação de fotos" (github.com/gurideprograma/ilikeyou).
 * E está sob a licença GPLv2, localizada no diretório "licenca" (sem aspas) deste pacote de códigos.
 * Copyright (C) 2012 @_gurideprograma
 */

/**
 * @name Arquivo core.php, guarda todas as classes do site
 * @package ilikeyou
 * @author @_gurideprograma
 * @license GPLv2
 * @link http://github.com/gurideprograma/ilikeyou
 */

/**
 * Trata a exibição de imagens na capa do site
 * @name homePic
 * @author @_gurideprograma
 */
class homePic(){
	/**
	 * @name showPicture()
	 * @author @_gurideprograma
	 * @example $homePic->showPicture();
	 */
	 public function showPicture(){
	 	$core = new core();
	 	$sel = sel("pictures","status > 0","RAND()",1);
	 	$r = fetch($sel);
	 	e("<div id=\"rate\">");
	 	aUI("i like you!","","heart");
	 	e(" ");
	 	aUI("bye! next!","","arrowthick-1-e");
	 	e("</div>");
	 	e("<div id=\"pic\"><img src=\"".DIR_PICTURES."/".$r["pkey"]."/".$r["pic"]."\"></div>");
	 	e("<div id=\"info\">");
	 	e("<span id=\"author\">".UPLOADEDBY.$core->user($r["usr"],"login")."</span>");
	 	e("<span id=\"date\">".$this->since($r["since"])."</span>");
	 	e("<span id=\"votesY\">".$r["yes"]."</span>");
	 	e("<span id=\"votesN\">".$r["no"]."</span>");
	 	e("</div>");
	 }
	/**
	 * @name since()
	 * @author @_gurideprograma
 	 * @param date $date
	 * @example $homePic->since("2012-12-12 12:12:12"); // ;-p
	 * return string
	 */
	 public function since($date){
	 	$date = explode(" ",$date);
	 	return $date[0];
	 }
}

/**
 * Trata funções específicas do sistema ou requisições do banco
 * @name core
 * @author @gurideprograma
 */
class core(){
	/**
	 * @name since()
	 * @author @_gurideprograma
	 * @param string $chave | string $campo
	 * @example $core->user($key,"nome");
	 * return string
	 */
	public function user($chave,$campo){
		$sel = sel("usr","ukey = '$chave'");
		$r = fetch($sel);
		return $r[$campo];
	}
}

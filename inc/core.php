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
class homePic {
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
	 	aUI("i like you!","ilikeyou('".$r["pkey"]."','".LOADING."')","heart");
	 	e(" ");
	 	aUI("bye! next!","","arrowthick-1-e"); 
	 	e("</div>");
	 	e("<div id=\"ratemsg\" style=\"display: none\"></div>");
	 	e("<div id=\"pic\"><img src=\"".DIR_PICTURES."/".$r["pkey"]."/".$r["pic"]."\"></div>");
	 	e("<div id=\"info\">");
	 	e("<span id=\"author\">".UPLOADEDBY.$core->user($r["usr"],"login")."</span>");
	 	e("<span id=\"date\"> in ".$this->since($r["since"])."</span>");
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
	 private function since($date){
	 	$date = explode(" ",$date);
	 	return $date[0];
	 }
}

/**
 * Trata as avaliações
 * @name rate
 * @author @_gurideprograma
 */
class rate {
	/**
	 * @name rating()
	 * @author @_gurideprograma
	 * @param string $pkey
	 * @example $rate->rating($pkey);
	 * @return bool
	 */
	public function rating($pkey){
		info(RATE_SUCESS_LOGIN);
	}
}

/**
 * Trata funções específicas do sistema ou requisições do banco
 * @name core
 * @author @_gurideprograma
 */
class core {
	/**
	 * @name connect()
	 * @author @_gurideprograma
	 * @param array $vars
	 * @example $core->connect();
	 * return bool
	 */
	public function connect(){
		con(DB_USER,DB_PASS,DB_LOCALHOST);
		db(DB_NAME);
	}
	/**
	 * @name close()
	 * @author @_gurideprograma
	 * @example $core->close();
	 * return bool
	 */
	public function close(){
		mysql_close();
	}
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
	/**
	 * Se o usuário está logado, exibe o link Meu painel, se não, exibe os links Cadastrar e Entrar
	 * @name menuLogin()
	 * @author @_gurideprograma
	 * @example $core->menuLogin();
	 * return string
	 */
	public function menuLogin(){
		
	}
}

/**
 * Relacionado a opções de privacidade dos usuários e imagens
 * @name privacy
 * @author @_gurideprograma
 */
class privacy {
	/**
	 * O usuário pode optar se quer que haja um link em seu login, abaixo de suas imagens, para que outros usuários possam ver outras imagens dele, ou não.
	 * @name linkUser()
	 * @author @_gurideprograma
	 * @param int $ukey
	 * @example $privacy->linkUser();
	 * return bool
	 */
	public function linkUser($ukey){
		
	}
}

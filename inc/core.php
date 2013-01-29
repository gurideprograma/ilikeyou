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
	 public function showPicture($prev=false){
	 	$core = new core();
	 	if($prev == true){
	 		$this->insView($prev);
	 	}
	 	$sel = sel("pictures","status > 0","RAND()",1);
	 	$r = fetch($sel);
	 	if($this->noRepeatPicture($r["pkey"]) == true){
		 	e("<div id=\"rate\">");
		 	aUI("i like you!","ilikeyou('".$r["pkey"]."','".LOADING."')","heart");
		 	e(" ");
		 	aUI("bye! next!","loadPicture('".$r["pkey"]."')","arrowthick-1-e"); 
		 	e("</div>");
		 	e("<div id=\"ratemsg\" style=\"display: none\"></div>");
		 	e("<div id=\"pic\"><img src=\"".str_replace(PATH,"",$r["pic"])."\">");
		 	info("
		 	<span id=\"author\">".UPLOADEDBY.$core->user($r["usr"],"login")."</span>
		 	<span id=\"date\"> in ".$this->since($r["since"])."</span>
		 	<span id=\"votesY\">".$r["yes"]."</span>
		 	<span id=\"votesN\">".$r["no"]."</span>
		 	",450);
		 }else{
		 	$this->showPicture();
		 }
	 }
	 
	 /**
	  * Faz uma verificação, se o usuário estiver online, para não exibir uma mesma imagem que já foi visualizada, mais de uma vez
	  * @name noRepeatPicture
	  * @author @_gurideprograma
	  * @param string $pkey
	  * @exeample $homePic->noRepeat
	  */
	 public function noRepeatPicture($pkey){
	 	$auth = new auth();
	 	if($auth->isOn() == true){
		 	$sel = mysql_query("SELECT SQL_CACHE pic,usr FROM views WHERE pic = '$pkey' and usr = '".$_SESSION["ukey"]."'") or die(mysql_error());
		 	if(total($sel) > 0){
		 		return false;
		 	}else{
		 		return true;
		 	}
		 }else{
		 	return true;
		 }
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
	 
	 /**
	  * Insere uma visualização de imagem na tabela
	  * @name insView()
	  * @author @_gurideprograma
	  * @param string $pkey
	  * @example $homePic->insView($pkey);
	  */
	 public function insView($pkey){
	 	$insview = ins("views","pic,usr,datehour","'$pkey', '".$_SESSION["ukey"]."', '".date("Y-m-d H:i:s")."'");
	 }
}

/**
 * Trata as avaliações
 * @name rate
 * @author @_gurideprograma
 */
class rate {
	/**
	 * Registra as avaliações
	 * @name rating()
	 * @author @_gurideprograma
	 * @param string $pkey
	 * @example $rate->rating($pkey);
	 * @return bool
	 */
	public function rating($pkey){
		$auth = new auth();
		//verifica se está logado
		if($auth->isOn() == true){ //se estiver, verifica se já votou nesta imagem
			$sel = mysql_query("SELECT SQL_CACHE pic,usr FROM vote_usr WHERE pic = '$pkey' and usr = '".$_SESSION["ukey"]."'") or die(mysql_error());
			if(total($sel) > 0){ //se votou, mostra erro
				error(RATE_ERROR_1);
			}else{ //se não votou, vota e mostra msg de sucesso
				$ins = ins("vote_usr","pic, usr, datehour","'$pkey', '".$_SESSION["ukey"]."', '".date("Y-m-d H:i:s")."'");
				$upd = mysql_query("UPDATE pictures SET yes=yes+1, total=total+1 WHERE pic = '$pkey'") or die(mysql_error());
				$hp = new homePic();
				$hp->insView($pkey);
				info(RATE_SUCESS_LOGIN);
			}
		}else{ //se não tiver logado, verifica se o ip já votou
			$sel = mysql_query("SELECT SQL_CACHE pic,ip FROM vote_an WHERE pic = '$pkey' and ip = '".$_SERVER["REMOTE_ADDR"]."'") or die(mysql_error());
			if(total($sel) > 0){ //se votou, mostra erro
				error(RATE_ERROR_2);
			}else{ //se não votou, deixa votar e mostra msg de sucesso
				$ins = ins("vote_an","pic, ip, datehour","'$pkey', '".$_SESSION["REMOTE_ADDR"]."', '".date("Y-m-d H:i:s")."'");
				$upd = mysql_query("UPDATE pictures SET yes_an=yes_an+1, total=total+1 WHERE pic = '$pkey'") or die(mysql_error());
				$hp = new homePic();
				$hp->insView($pkey);
				info(RATE_SUCESS_LOGOUT);
			}
		}
	}
}

/**
 * Trata a autenticação
 * @name auth
 * @author @_gurideprograma
 */
class auth {
	/**
	 * @name con()
	 * @author @_gurideprograma
	 * @example $auth->con();
	 */
	public function con(){
		con(DB_USER,DB_PASS,DB_LOCALHOST);
		db(DB_NAME);
	}
	/**
	 * @name con()
	 * @author @_gurideprograma
	 * @example $auth->isOn();
	 */
	public function isOn(){
		if(isset($_SESSION['status']) && $_SESSION['status']=='verified'){ return true; }else{ return false; }
	}
	/**
	 * @name doSignup()
	 * @author @_gurideprograma
	 * @example $auth->doSignup();
	 */
	public function doSignup(){
    		$twitterid = $_SESSION['request_vars']['user_id'];
		$screenname = $_SESSION['request_vars']['screen_name'];
		$sel = mysql_query("SELECT SQL_CACHE ukey,twitterid,login FROM usr WHERE twitterid = '$twitterid' and login = '$screenname'") or die(mysql_error());
		if(total($sel) == 0){
			$ukey = hash('sha512',date("YmdHis")."_$twitterid");
			$ins = ins("usr","ukey, twitterid, login, since, status","'$ukey', '$twitterid', '$screenname', '".date("Y-m-d H:i:s")."', '1'");
			$_SESSION["ukey"] = $ukey;
		}else{
			$r = fetch($sel);
			$_SESSION["ukey"] = $r["ukey"];
		}
	}
	/**
	 * @name twitterButton()
	 * @author @_gurideprograma
	 * @example $auth->twitterButton();
	 * @return string
	 */
	public function twitterButton(){
		e("<a href=\"?login\"><img src=\"img/bt/".LANG."/sign-twitter.png\" width=\"151\" height=\"24\" border=\"0\" id=\"twitterButton\" /></a>");
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
		$auth = new auth();
		if($auth->isOn() == true){
			e("<li><a href=\"".DIR."/?me\">".MENU_MYPAGE."</a></li>");
		}else{
			e("<li><a href=\"".DIR."/?login\">".MENU_SIGNUP."</a></li>");
		}
	}
	/**
	 * Se o usuário está logado, exibe botão sair
	 * @name menuLogout()
	 * @author @_gurideprograma
	 * @example $core->menuLogout();
	 * return string
	 */
	public function menuLogout(){
		$auth = new auth();
		if($auth->isOn() == true){
			e("<li><a href=\"".DIR."/?logout\">".MENU_LOGOUT."</a></li>");
		}
	}
}
/**
 * Funções relacionadas ao usuário
 * @name user
 * @author @_gurideprograma
 */
class user {
	/**
	 * Exibe e lista imagens enviadas pelo usuário || desenvolvimento pausado. Este ítem seria usado na página /?me mas no momento está sendo usado o script de thumbs do próprio script de upload. Esta função poderia ser usada também uma página /?gallery
	 * @name myPictures()
	 * @author @_gurideprograma
	 * @example $user->myPictures();
	 * return string
	 */
	public function myPictures(){
		$sel = mysql_query("SELECT SQL_CACHE pkey,pic,usr,yes,no,total,yes_an,no_an FROM pictures WHERE usr = '".$_SESSION["ukey"]."'") or die(mysql_error());
		if(total($sel) == 0){
			info(ERROR_NOUPLOADPICTURES);
		}else{
			include_once("inc/easyphpthumbnail.class.php");
			$thumb = new easyphpthumbnail();
			$thumb->Thumbsize = 200;
			$thumb->Backgroundcolor = '#D0DEEE';
			$thumb->Shadow = true;
			while($r = fetch($sel)){
				e("<div class=\"shade1\">
					<div class=\"shade2\">
						<div class=\"shade3\">
						   	<div class=\"clipout\">
						   		<div class=\"clipin\">
		    							<img src=\"".$thumb->Createthumb(str_replace("/opt/lampp/htdocs","",$r["pic"]),"file")."\" class=\"thumb\">
		    						</div>
		    					</div>
    						</div>
    					</div>
    				</div>");
			}
		}
	}
}

/**
 * Relacionado a opções de privacidade dos usuários e imagens
 * @name privacy
 * @author @_gurideprograma
 */
class privacy {
	/**
	 * O usuário pode optar se quer que seu login seja exibido abaixo das imagens ou não
	 * @name showUser()
	 * @author @_gurideprograma
	 * @param int $ukey
	 * @example $privacy->showUser();
	 * return bool
	 */
	public function showUser($ukey){
		
	}
	/**
	 * O usuário pode optar se quer que haja um link em seu login, abaixo de suas imagens, para que outros usuários possam ver outras imagens dele, ou não
	 * @name linkUser()
	 * @author @_gurideprograma
	 * @param int $ukey
	 * @example $privacy->linkUser();
	 * return bool
	 */
	public function linkUser($ukey){
		
	}
	/**
	 * O usuário pode optar se quer que haja uma página com suas publicações ou não
	 * @name showPage()
	 * @author @_gurideprograma
	 * @param int $ukey
	 * @example $privacy->showPage();
	 * return bool
	 */
	public function showPage($ukey){
		
	}
}

<?
$auth = new auth();
if($auth->isOn() == true){
	?>
	<div class="container">
	    <div class="page-header">
		<h1><?= TITLE_ME ?></h1>
	    </div>
	<? 
	include("scr/jfu/upload.php");
	#$user = new user();
	#$user->myPictures();
}else{
	//informa q não está logado e mostra botão de login
	error(ERROR_NOTLOGGED);
	$auth->twitterButton();
}
?>

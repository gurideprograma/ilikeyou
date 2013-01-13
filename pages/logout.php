<h3><?= TITLE_LOGOUT ?></h3>
<?
e(MSG_LOGOUT);
$auth = new auth();
e("<br>");
$auth->twitterButton();

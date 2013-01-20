<div class="container">
    <div class="page-header">
        <h1><?= TITLE_LOGOUT ?></h1>
    </div>
<?
e(MSG_LOGOUT);
$auth = new auth();
e("<br>");
$auth->twitterButton();

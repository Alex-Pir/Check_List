<?php
include_once __DIR__ . '/vendor/autoload.php';
include 'lang/main.php';

use classes\user\SessionHelper;

session_start();

?>
<?
$user = SessionHelper::getDataFromSession();
if (!$user) {
    classes\auth\Authorization::redirect("/");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <title><?= $MESS["MAIN_TITLE"]; ?></title>
</head>
<body>
<div class="info-link">
    <div class="user-info">
        <?
        if ($user instanceof classes\user\User) {
            echo implode(' ', [$user->getFirstName(), $user->getLastName()]);
        }
        ?>
    </div>
    <div class="link">
        <a href="main">Главная</a>
        <span>|</span>
        <p class="exit-link">Выход</p>
    </div>
</div>
<div class="title-page">
    <h1>
        <?= $MESS["TITLE_PAGE"]; ?>
    </h1>
</div>

<div class="wrap">
    <div class="content">
        <ul class="check-list">
            <li class="check-one">
                <div class="check-top">
                    <span><a href=<?= $MESS["TEHNIC_CHECK_PAGE"] ?>><?= $MESS["TITLE_PAGE_TEHNIC"] ?></a></span>
                </div>
                <div class="check-bottom">
                    <p><?= $MESS["TEHNIC_MORE_INFORMATION"] ?></p>
                </div>
            </li>
            <li class="check-one">
                <div class="check-top">
                    <span><a href=<?= $MESS["START_CHECK_PAGE"] ?>><?= $MESS["TITLE_PAGE_START"] ?></a></span>
                </div>
                <div class="check-bottom">
                    <p class="dop-inf"><?= $MESS["START_MORE_INFORMATION"] ?></p>
                </div>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
<?php
include_once __DIR__ . '/vendor/autoload.php';

include 'config/mail/config.php';
include 'config/VK/config.php';


use classes\log as log;
use classes\user\SessionHelper;

session_start();

if (isset($_GET['provider'])) {
    if (!SessionHelper::saveDataToSession($_GET['provider'])) {
        classes\auth\Authorization::redirect("/");
    }
}

if (SessionHelper::getDataFromSession()) {
    classes\auth\Authorization::redirect("main");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/authorization-page.css">
</head>
<body>

<div class="authorization-links">
    <h1><?=$request->getFeedbackString?></h1>
    <?
    echo $link_vk = '<a class="vk-link" href="' . URL_AUTHORIZE_VK . '?' . urldecode(http_build_query(classes\auth\VK::START_CONFIG)) . '"><img src="img/VK.png"></a>';
    echo $link_mail = '<a class="mail-link" href="' . URL_AUTHORIZE_MAIL . '?' . urldecode(http_build_query(classes\auth\Mail::START_CONFIG)) . '"><img src="img/mail.png"></a>';
    ?>
</div>

</body>
</html>
<?php
include_once __DIR__ . '/vendor/autoload.php';

include 'config/mail/config.php';
include 'config/VK/config.php';


use classes\log as log;

session_start();

if (isset($_GET['provider'])) {
    $userAut = classes\auth\Fabric::getAutClass($_GET['provider']);
    if ($userAut instanceof classes\auth\Authorization) {
        if ($userAut->isAuthorized()) {
            try
            {
                $user = new classes\user\User($userAut->getId(), $userAut->getFirstName(), $userAut->getLastName());
                $_SESSION["user"] = $user;
                classes\auth\Authorization::redirect("main");
            }
            catch(classes\exceptions\user\UserAddException $ex)
            {
                unset($_SESSION["user"]);
                log\Log::writeLog($ex->getMessage());
                classes\auth\Authorization::redirect("/");
            }
            catch (classes\exceptions\user\UserGetValueException $ex)
            {
                unset($_SESSION["user"]);
                log\Log::writeLog($ex->getMessage());
                classes\auth\Authorization::redirect("/");
            }
        }
    }

}
?>
<?php
if (!isset($_SESSION["user"]))
{
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/authorization-page.css">
    </head>
    <body>

        <div class="authorization-links">
            <h1>Авторизация через социальные сети</h1>
            <?
            echo $link_vk = '<a class="vk-link" href="' . URL_AUTHORIZE_VK . '?' . urldecode(http_build_query(classes\auth\VK::START_CONFIG)) . '"><img src="img/VK.png"></a>';
            echo $link_mail = '<a class="mail-link" href="' . URL_AUTHORIZE_MAIL . '?' . urldecode(http_build_query(classes\auth\Mail::START_CONFIG)) . '"><img src="img/mail.png"></a>';
            ?>
        </div>

    </body>
    </html>
    <?
}
else
{
    classes\auth\Authorization::redirect("main");
}
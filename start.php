<?php
include_once __DIR__ . '/vendor/autoload.php';
include 'lang/start.php';

session_start();

?>
<? if (isset($_SESSION["user"])) {
$user = $_SESSION["user"];
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="js/jquery-3.0.0.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/start-script.js"></script>
        <title><?=$MESS["MAIN_TITLE"];?></title>
    </head>
    <body>
        <div class="info-link">
            <div class="user-info">
                <?
                if ($user instanceof classes\user\User)
                {
                    echo $user->getFirstName() . ' ' . $user->getLastName();
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
                <?= $MESS["MAIN_TITLE"]; ?>
            </h1>
        </div>

        <div class="wrap">
            <div class="content">
                <form action="main.php" method="post">
                    <ul class="check-list">
                        <li class="check-one">
                            <div class="list-top">
                                <input type="checkbox" name="check1[0]" <?=$user->startCh['check1'][0]?>><span><?= $MESS["CHECK_1"] ?></a></span>
                                <div class="show-more">+</div>
                            </div>
                            <div class="list-bottom">
                                <p class="dop-inf"><?= $MESS["MORE_INFORMATION_1"] ?></p>
                                <ul class="check-list">
                                    <li class="check-two"><input type="checkbox" name="check1[1]" <?=$user->startCh['check1'][1]?>><span><?= $MESS["CHECK_1_1"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check1[2]" <?=$user->startCh['check1'][2]?>><span><?= $MESS["CHECK_1_2"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check1[3]" <?=$user->startCh['check1'][3]?>><span><?= $MESS["CHECK_1_3"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check1[4]" <?=$user->startCh['check1'][4]?>><span><?= $MESS["CHECK_1_4"] ?></span></li>
                                </ul>
                            </div>
                        </li>
                        <li class="check-one">
                            <div class="list-top">
                                <input type="checkbox" name="check2[0]" <?=$user->startCh['check2'][0]?>><span><?= $MESS["CHECK_2"] ?></a></span>
                                <div class="show-more">+</div>
                            </div>
                            <div class="list-bottom">
                                <p class="dop-inf"><?= $MESS["MORE_INFORMATION_2"] ?></p>
                                <ul class="check-list">
                                    <li class="check-two"><input type="checkbox" name="check2[1]" <?=$user->startCh['check2'][1]?>><span><?= $MESS["CHECK_2_1"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check2[2]" <?=$user->startCh['check2'][2]?>><span><?= $MESS["CHECK_2_2"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check2[3]" <?=$user->startCh['check2'][3]?>><span><?= $MESS["CHECK_2_3"] ?></span></li>
                                </ul>
                            </div>
                        </li>
                        <li class="check-one">
                            <div class="list-top">
                                <input type="checkbox" name="check3[0]" <?=$user->startCh['check3'][0]?>><span><?= $MESS["CHECK_3"] ?></a></span>
                                <div class="show-more">+</div>
                            </div>
                            <div class="list-bottom">
                                <p class="dop-inf"><?= $MESS["MORE_INFORMATION_3"] ?></p>
                                <ul class="check-list">
                                    <li class="check-two"><input type="checkbox" name="check3[1]"<?=$user->startCh['check3'][1]?>><span><?= $MESS["CHECK_3_1"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check3[2]"<?=$user->startCh['check3'][2]?>><span><?= $MESS["CHECK_3_2"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check3[3]"<?=$user->startCh['check3'][3]?>><span><?= $MESS["CHECK_3_3"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check3[4]"<?=$user->startCh['check3'][4]?>><span><?= $MESS["CHECK_3_4"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check3[5]"<?=$user->startCh['check3'][5]?>><span><?= $MESS["CHECK_3_5"] ?></span></li>
                                </ul>
                            </div>
                        </li>
                        <li class="check-one">
                            <div class="list-top">
                                <input type="checkbox" name="check4[0]" <?=$user->startCh['check4'][0]?>><span><?= $MESS["CHECK_4"] ?></a></span>
                                <div class="show-more">+</div>
                            </div>
                            <div class="list-bottom">
                                <p class="dop-inf"><?= $MESS["MORE_INFORMATION_4"] ?></p>
                                <ul class="check-list">
                                    <li class="check-two"><input type="checkbox" name="check4[1]"<?=$user->startCh['check4'][1]?>><span><?= $MESS["CHECK_4_1"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check4[2]"<?=$user->startCh['check4'][2]?>><span><?= $MESS["CHECK_4_2"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check4[3]"<?=$user->startCh['check4'][3]?>><span><?= $MESS["CHECK_4_3"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check4[4]"<?=$user->startCh['check4'][4]?>><span><?= $MESS["CHECK_4_4"] ?></span></li>
                                </ul>
                            </div>
                        </li>
                        <li class="check-one">
                            <div class="list-top">
                                <input type="checkbox" name="check5[0]" <?=$user->startCh['check5'][0]?>><span><?= $MESS["CHECK_5"] ?></a></span>
                                <div class="show-more">+</div>
                            </div>
                            <div class="list-bottom">
                                <p class="dop-inf"><?= $MESS["MORE_INFORMATION_5"] ?></p>
                                <ul class="check-list">
                                    <li class="check-two"><input type="checkbox" name="check5[1]"<?=$user->startCh['check5'][1]?>><span><?= $MESS["CHECK_5_1"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check5[2]"<?=$user->startCh['check5'][2]?>><span><?= $MESS["CHECK_5_2"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check5[3]"<?=$user->startCh['check5'][3]?>><span><?= $MESS["CHECK_5_3"] ?></span></li>
                                </ul>
                            </div>
                        </li>
                        <li class="check-one">
                            <div class="list-top">
                                <input type="checkbox" name="check6[0]" <?=$user->startCh['check6'][0]?>><span><?= $MESS["CHECK_6"] ?></a></span>
                                <div class="show-more">+</div>
                            </div>
                            <div class="list-bottom">
                                <p class="dop-inf"><?= $MESS["MORE_INFORMATION_6"] ?></p>
                                <ul class="check-list">
                                    <li class="check-two"><input type="checkbox" name="check6[1]" <?=$user->startCh['check6'][1]?>><span><?= $MESS["CHECK_6_1"] ?></span></li>
                                    <li class="check-two"><input type="checkbox" name="check6[2]" <?=$user->startCh['check6'][2]?>><span><?= $MESS["CHECK_6_2"] ?></span></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>

    </body>
    </html>
    <?
}
else
{
    classes\auth\Authorization::redirect("/");
}
?>
<?php
use classes\user\SessionHelper;

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
    <script type="text/javascript" src="js/tehn-script.js"></script>
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
        <?= $MESS["TITLE_PAGE_TEHNIC"]; ?>
    </h1>
</div>

<div class="wrap">
    <div class="content">
        <form action="main.php" method="post">
            <ul class="check-list">
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check1[0]" <?= $user->tehnCh['check1'][0] ?>><span><?= $MESS["CHECK_1"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_1"] ?></p>
                        <ul class="check-list">
                            <li class="check-two"><input type="checkbox"
                                                         name="check1[1]" <?= $user->tehnCh['check1'][1] ?>><span><?= $MESS["CHECK_1_1"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check1[2]" <?= $user->tehnCh['check1'][2] ?>><span><?= $MESS["CHECK_1_2"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check1[3]" <?= $user->tehnCh['check1'][3] ?>><span><?= $MESS["CHECK_1_3"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check1[4]" <?= $user->tehnCh['check1'][4] ?>><span><?= $MESS["CHECK_1_4"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check1[5]" <?= $user->tehnCh['check1'][5] ?>><span><?= $MESS["CHECK_1_5"] ?></span>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check2[0]" <?= $user->tehnCh['check2'][0] ?>><span><?= $MESS["CHECK_2"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_2"] ?></p>
                        <ul class="check-list">
                            <li class="check-two"><input type="checkbox"
                                                         name="check2[1]" <?= $user->tehnCh['check2'][1] ?>><span><?= $MESS["CHECK_2_1"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check2[2]" <?= $user->tehnCh['check2'][2] ?>><span><?= $MESS["CHECK_2_2"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check2[3]" <?= $user->tehnCh['check2'][3] ?>><span><?= $MESS["CHECK_2_3"] ?></span>
                            </li>
                            <li class="check-two"><input type="checkbox"
                                                         name="check2[4]" <?= $user->tehnCh['check2'][4] ?>><span><?= $MESS["CHECK_2_4"] ?></span>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check3[0]" <?= $user->tehnCh['check3'][0] ?>><span><?= $MESS["CHECK_3"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_3"] ?></p>
                        <ul class="check-list">
                            <li class="check-two"><input type="checkbox"
                                                         name="check3[1]"<?= $user->tehnCh['check3'][1] ?>><span><?= $MESS["CHECK_3_1"] ?></span>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check4[0]" <?= $user->tehnCh['check4'][0] ?>><span><?= $MESS["CHECK_4"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_4"] ?></p>
                    </div>
                </li>
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check5[0]" <?= $user->tehnCh['check5'][0] ?>><span><?= $MESS["CHECK_5"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_5"] ?></p>
                    </div>
                </li>
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check6[0]" <?= $user->tehnCh['check6'][0] ?>><span><?= $MESS["CHECK_6"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_6"] ?></p>
                        <ul class="check-list">
                            <li class="check-two"><input type="checkbox"
                                                         name="check6[1]" <?= $user->tehnCh['check6'][1] ?>><span><?= $MESS["CHECK_6_1"] ?></span>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="check-one">
                    <div class="list-top">
                        <input type="checkbox"
                               name="check7[0]" <?= $user->tehnCh['check7'][0] ?>><span><?= $MESS["CHECK_7"] ?></span>
                        <div class="show-more">+</div>
                    </div>
                    <div class="list-bottom">
                        <p class="dop-inf"><?= $MESS["MORE_INFORMATION_7"] ?></p>
                        <ul class="check-list">
                            <li class="check-two"><input type="checkbox"
                                                         name="check7[1]" <?= $user->tehnCh['check7'][1] ?>><span><?= $MESS["CHECK_7_1"] ?></span>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>

</body>
</html>
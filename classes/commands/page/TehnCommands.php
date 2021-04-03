<?php

namespace classes\commands\page;

use classes\auth\Authorization;
use classes\commands\Command;
use classes\application\Request;
use classes\user\SessionHelper;
use classes\user\User;

class TehnCommands extends Command {

    public function doExecute(Request $request)
    {

        $user = SessionHelper::getDataFromSession();

        if (!($user instanceof User)) {
            Authorization::redirect("/");
        }

        $langFile = $_SERVER['DOCUMENT_ROOT'] . '/lang/tehn.php';
        $pageFile = $_SERVER['DOCUMENT_ROOT'] . '/tehnic.php';

        if (file_exists($langFile)) {
            include $langFile;
        }

        if (file_exists($pageFile)) {
            include $pageFile;
        }
    }
}
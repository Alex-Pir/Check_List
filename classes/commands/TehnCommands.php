<?php

namespace classes\commands;

use classes\application\Request;

class TehnCommands extends Command {

    public function doExecute(Request $request)
    {
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
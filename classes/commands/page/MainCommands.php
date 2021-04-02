<?php

namespace classes\commands\page;

use classes\commands\Command;
use classes\application\Request;

class MainCommands extends Command {
    public function doExecute(Request $request)
    {
        $langFile = $_SERVER['DOCUMENT_ROOT'] . '/lang/main.php';
        $pageFile = $_SERVER['DOCUMENT_ROOT'] . '/main.php';

        if (file_exists($langFile)) {
            include $langFile;
        }

        if (file_exists($pageFile)) {
            include $pageFile;
        }
    }
}
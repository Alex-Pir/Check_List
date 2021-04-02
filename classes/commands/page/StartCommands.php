<?php

namespace classes\commands\page;

use classes\commands\Command;
use classes\application\Request;

class StartCommands extends Command {
    public function doExecute(Request $request)
    {
        $langFile = $_SERVER['DOCUMENT_ROOT'] . '/lang/start.php';
        $pageFile = $_SERVER['DOCUMENT_ROOT'] . '/start.php';

        if (file_exists($langFile)) {
            include $langFile;
        }

        if (file_exists($pageFile)) {
            include $pageFile;
        }
    }
}
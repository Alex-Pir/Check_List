<?php

namespace classes\commands;

use classes\application\Request;

class DefaultComands extends Command {
    public function doExecute(Request $request)
    {
        $request->addFeedback('Пожалуйста, авторизуйтесь');
        include $_SERVER['DOCUMENT_ROOT'] . '/main_application.php';
    }
}
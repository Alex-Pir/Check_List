<?php

namespace classes\commands;

use classes\application\Request;

class DefaultComands extends Command {
    public function doExecute(Request $request)
    {
        $request->addFeedback('Пожалуйста, авторизуйтесь');
        include '/index.php';
    }
}
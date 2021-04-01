<?php

namespace classes\commands;

use classes\application\Request;
use classes\application\Registry;

class DefaultComands extends Command {

    /** @var string Параметр для определения класса авторизации */
    const PROPERTY_URL_PROVIDER = 'provider';

    public function doExecute(Request $request)
    {
        $request->addFeedback('Пожалуйста, авторизуйтесь');
        $request = Registry::getInstance()->getRequest();
        $provider = $request->getProperty(self::PROPERTY_URL_PROVIDER);

        include $_SERVER['DOCUMENT_ROOT'] . '/main_application.php';
    }
}
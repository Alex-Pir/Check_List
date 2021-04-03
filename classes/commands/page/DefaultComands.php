<?php

namespace classes\commands\page;

use classes\auth\Authorization;
use classes\commands\Command;
use classes\application\Request;
use classes\application\Registry;
use classes\user\SessionHelper;

class DefaultComands extends Command {

    /** @var string Параметр для определения класса авторизации */
    const PROPERTY_URL_PROVIDER = 'provider';

    public function doExecute(Request $request)
    {
        $request->clearFeedback();
        $request->addFeedback('Пожалуйста, авторизуйтесь');
        $request = Registry::getInstance()->getRequest();
        $provider = $request->getProperty(self::PROPERTY_URL_PROVIDER);

        if ($provider) {
            if (SessionHelper::saveDataToSession($provider)) {
                Authorization::redirect("/main");
            }
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/main_application.php';
    }
}
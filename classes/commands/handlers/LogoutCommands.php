<?php

namespace classes\commands\handlers;

use classes\commands\Command;
use classes\application\Request;
use classes\log\Log;
use classes\user as users;
use Exception;

/**
 * Обработчик запроса на выход
 *
 * Class LogoutCommands
 * @package classes\commands
 */
class LogoutCommands extends Command
{
    const PROPERTY_LOGOUT_VALUE = 'logout';
    const PROPERTY_LOGOUT = 'action';

    public function doExecute(Request $request)
    {
        if ($request->getProperty(self::PROPERTY_LOGOUT) === self::PROPERTY_LOGOUT_VALUE) {
            users\SessionHelper::destroyUserInSession();
            return true;
        }
    }
}
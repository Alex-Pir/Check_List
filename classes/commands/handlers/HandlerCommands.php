<?php

namespace classes\commands\handlers;

use classes\commands\Command;
use classes\application\Request;
use classes\log\Log;
use classes\user as users;
use Exception;

/**
 * Обработчик запроса на сохранение чеклистов пользователя
 *
 * Class HandlerCommands
 * @package classes\commands
 */
class HandlerCommands extends Command
{
    /** @var string состояние отмеченных чекбоксов. Нужно для правильной записи в шаблоне */
    const CHECKLIST_ITEM_CHECKED = 'checked';

    public function doExecute(Request $request)
    {
        try {
            $tehnCheck = $request->getProperty(users\User::TEHN_COLUMN);
            $startCheck = $request->getProperty(users\User::START_COLUMN);

            $user = users\SessionHelper::getDataFromSession();

            if (!($user instanceof users\User)) {
                throw new Exception('Попытка сохранения данных неавторизованным пользователем');
            }

            if ($tehnCheck) {
                $this->saveValuesCheck($tehnCheck, $user->tehnCh);

                $user->saveValuesTehnCheck();
                users\SessionHelper::saveUserToSession($user);
            }

            if ($startCheck) {
                $this->saveValuesCheck($startCheck, $user->startCh);

                $user->saveValuesStartCheck();
                users\SessionHelper::saveUserToSession($user);

            }
        } catch (Exception $ex) {
            Log::writeLog($ex->getMessage());
        }

    }

    private function saveValuesCheck($inputArray, &$userArray)
    {
        parse_str($inputArray, $input);

        $userArray = array();
        $userArray = $this->setCheckedInArr($input, $userArray);

    }

    private function setCheckedInArr($arrFrom, $arrTo)
    {
        foreach ($arrFrom as $key1=>$arrOne)
        {
            foreach ($arrOne as $key2=>$arrTwo)
            {
                $arrTo[$key1][$key2] = self::CHECKLIST_ITEM_CHECKED;
            }
        }
        return $arrTo;
    }
}
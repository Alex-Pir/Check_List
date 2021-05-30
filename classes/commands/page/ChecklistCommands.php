<?php

namespace classes\commands\page;

use classes\auth\Authorization;
use classes\commands\Command;
use classes\application\Request;
use classes\log\Log;
use classes\user\SessionHelper;
use classes\user\User;
use Exception;

class ChecklistCommands extends Command
{

    /** @var string параметр, определяющий страница с каким чеклистом будет подключена */
    const PROPERTY_KEY_CHECKLIST = "checkList";

    /**
     * Обработчик для пути вида /checklists/#checkList#
     *
     * @param Request $request
     */
    public function doExecute(Request $request) {

        $user = SessionHelper::getDataFromSession();

        if (!($user instanceof User)) {
            Authorization::redirect("/");
        }

        $checkList = $request->getProperty(self::PROPERTY_KEY_CHECKLIST);

        $langFile = $_SERVER['DOCUMENT_ROOT'] . "/lang/checklists/{$checkList}.php";
        $pageFile = $_SERVER['DOCUMENT_ROOT'] . "/templates/checklists/{$checkList}.php";

        try {
            if (!file_exists($langFile) || !file_exists($pageFile)) {
                throw new Exception("Не удается подключить файлы для шаблона /templates/checklists/{$checkList}.php");
            }

            include $langFile;
            include $pageFile;

        } catch (Exception $ex) {
            Log::writeLog($ex->getMessage());
            Authorization::redirect("/");
        }
    }
}
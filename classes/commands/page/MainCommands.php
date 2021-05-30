<?php

namespace classes\commands\page;

use classes\application\LangHelper;
use classes\auth\Authorization;
use classes\commands\Command;
use classes\application\Request;
use classes\user\SessionHelper;
use classes\user\User;
use Twig_Environment;
use Twig_Loader_Filesystem;

class MainCommands extends Command
{
    public function doExecute(Request $request)
    {

        $user = SessionHelper::getDataFromSession();

        if (!($user instanceof User)) {
            Authorization::redirect("/");
        }

        LangHelper::loadMessages($_SERVER["DOCUMENT_ROOT"] . "/lang/main.php");

        echo $this->twig->render('main.html.twig', array(
            'title' => LangHelper::getMessage("MAIN_TITLE"),
            'name' => implode(' ', [$user->getFirstName(), $user->getLastName()]),
            'checkLists' => LangHelper::getMessage("CHECK_PAGE")
        ));
    }
}
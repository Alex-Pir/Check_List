<?php

namespace classes\commands;

use classes\application\Registry;
use ReflectionClass;

class CommandResolver {

    private static $refCmd = null;
    private static $defaultCmd = DefaultComands::class;

    public function __construct() {
        self::$refCmd = new ReflectionClass(Command::class);
    }

    public function getCommand(Request $request): Command {
        $reg = Registry::getInstance();
    }
}
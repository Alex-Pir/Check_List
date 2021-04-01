<?php

namespace classes\commands;

use classes\application\Registry;
use classes\application\Request;
use ReflectionClass;
use ReflectionException;

class CommandResolver {

    private static $refCmd = null;
    private static $defaultCmd = DefaultComands::class;

    public function __construct() {
        self::$refCmd = new ReflectionClass(Command::class);
    }

    public function getCommand(Request $request): Command {
        try {
            $reg = Registry::getInstance();
            $path = $request->getPath();
            $class = $reg->getCommand($path);

            if (is_null($class)) {
                $request->addFeedback("Запрашиваемый путь $path не найден");
                return new self::$defaultCmd;
            }

            if (!class_exists($class)) {
                $request->addFeedback("Класс $class не найден");
                return new self::$defaultCmd;
            }

            $refClass = new ReflectionClass($class);

            if (!$refClass->isSubclassOf(self::$refCmd)) {
                $request->addFeedback("Команда $refClass не относится к классу Command");
                return new self::$defaultCmd;
            }

            return $refClass->newInstance();
        } catch(ReflectionException $ex) {
            $request->addFeedback("Не перейти на запрашиваемую страницу");
            return new self::$defaultCmd;
        }
    }
}
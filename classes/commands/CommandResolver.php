<?php

namespace classes\commands;

use classes\application\Registry;
use classes\application\Request;
use classes\commands\page\DefaultCommands;
use Exception;
use ReflectionClass;
use ReflectionException;

class CommandResolver {

    private static $refCmd = null;
    private static $defaultCmd = DefaultCommands::class;

    public function __construct() {
        self::$refCmd = new ReflectionClass(Command::class);
    }

    public function getCommand(Request $request): Command {
        try {
            $reg = Registry::getInstance();
            $path = $request->getPath();
            $class = $reg->getCommand($path);

            if (is_null($class)) {
                throw new Exception("Запрашиваемый путь $path не найден");
            }

            if (!class_exists($class)) {
                throw new Exception("Класс $class не найден");
            }

            $refClass = new ReflectionClass($class);

            if (!$refClass->isSubclassOf(self::$refCmd)) {
                throw new Exception("Команда $refClass не относится к классу Command");
            }

            return $refClass->newInstance();
        } catch(ReflectionException $ex) {
            $request->addFeedback("Не перейти на запрашиваемую страницу");
            return new self::$defaultCmd;
        } catch(Exception $ex) {
            $request->addFeedback($ex->getMessage());
            return new self::$defaultCmd;
        }
    }
}
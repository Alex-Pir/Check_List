<?php

namespace classes\controllers;

use classes\application\Registry;
use classes\commands\CommandResolver;

class Controller {
    private $reg;

    private function __construct() {
        $this->reg = Registry::getInstance();
    }

    /**
     * Запуск приложения
     */
    public static function run() {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    /**
     * Получение необходимых настроек приложения (для роутинга)
     */
    private function init() {
        $this->reg->getApplicationHelper()->init();
    }

    /**
     * Обработка запроса
     *
     * @throws \Exception
     */
    private function handleRequest() {
        $request = $this->reg->getRequest();
        $resolver = new CommandResolver();
        $cmd = $resolver->getCommand($request);
        $cmd->execute($request);
    }
}
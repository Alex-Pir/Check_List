<?php

namespace classes\application;

use Exception;

/**
 * Класс для хранения данных, используемых во всем приложении
 *
 * Class Registry
 * @package classes\application
 */
class Registry {

    /** @var Экземпляр класса */
    private static $registry;

    /** @var array Команды */
    private $commands;

    /** @var null Запросы */
    private $request;

    /** @var Экземпляр класса ApplicationHelper */
    private $applicationHelper;

    private function __construct() {
        $this->commands = [];
        $this->request = null;
    }

    /**
     * Получение экземпляра класса Registry
     *
     * @return static
     */
    public static function getInstance(): self {
        if (is_null(self::$registry)) {
            self::$registry = new self();
        }

        return self::$registry;
    }

    /**
     * Запись команды в хранилище
     *
     * @param $key
     * @param $command
     */
    public function setCommand($key, $command) {
        $this->commands[$key] = $command;
    }

    /**
     * Получение команды из хранилища по ключу
     *
     * @param $key
     * @return false|mixed
     */
    public function getCommand($key) {
        if (!array_key_exists($key, $this->commands)) {
            return false;
        }

        return $this->commands[$key];
    }

    /**
     * Добавление объекта запроса в хранилище
     *
     * @param Request $request
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }

    /**
     * Получение объекта запроса
     *
     * @return Request
     * @throws Exception
     */
    public function getRequest(): Request {
        if (is_null($this->request)) {
            throw new Exception('Объект типа Request не задан');
        }

        return $this->request;
    }

    /**
     * Получение экземпляра класса ApplicationHelper
     *
     * @return ApplicationHelper
     */
    public function getApplicationHelper(): ApplicationHelper {
        if (is_null($this->applicationHelper)) {
            $this->applicationHelper = new ApplicationHelper();
        }

        return $this->applicationHelper;
    }
}
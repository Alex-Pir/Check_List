<?php

namespace classes\application;

use Exception;

class Registry {

    private static $registry;
    private $commands;
    private $request;
    private $applicationHelper;

    private function __construct() {
        $this->commands = [];
        $this->request = null;
    }

    public static function getInstance(): self {
        if (is_null(self::$registry)) {
            self::$registry = new self();
        }

        return self::$registry;
    }

    public function setCommand($key, $command) {
        $this->commands[$key] = $command;
    }

    public function getCommand($key) {
        if (!array_key_exists($key, $this->commands)) {
            return false;
        }

        return $this->commands[$key];
    }

    public function setRequest(Request $request) {
        $this->request = $request;
    }

    public function getRequest(): Request {
        if (is_null($this->request)) {
            throw new Exception('Объект типа Request не задан');
        }
    }

    public function getApplicationHelper(): ApplicationHelper {
        if (is_null($this->applicationHelper)) {
            $this->applicationHelper = new ApplicationHelper();
        }

        return $this->applicationHelper;
    }
}
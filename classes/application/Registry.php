<?php

namespace classes\application;

class Registry {

    private static $registry;
    private $commands;

    private function __construct() {
        $this->commands = [];
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
}
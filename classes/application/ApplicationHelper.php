<?php

namespace classes\application;

class ApplicationHelper {

    private $reg;

    public function __construct() {
        $this->reg = Registry::getInstance();
    }

    public function init() {
        $this->setupOptions();
        $this->reg->setRequest(new HttpRequest());
    }

    private function setupOptions() {
        $this->reg->setCommand($this->getConfig());
    }

    private function getConfig(): array {
        return [
            "/main" => "\\classes\\commands\\MainCommands",
            "/start" => "\\classes\\commands\\StartCommands",
            "/tehn" => "\\classes\\commands\\TehnCommands"
        ];
    }
}
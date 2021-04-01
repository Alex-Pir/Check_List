<?php

namespace classes\application;

/**
 * Класс, производящий первоначальные настройки приложения,
 * относящиеся к роутингу
 *
 * Class ApplicationHelper
 * @package classes\application
 */
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
        $arConfig = $this->getConfig();

        foreach ($arConfig as $key => $config) {
            $this->reg->setCommand($key, $config);
        }
    }

    private function getConfig(): array {
        return [
            "/main" => "\\classes\\commands\\MainCommands",
            "/start" => "\\classes\\commands\\StartCommands",
            "/tehnic" => "\\classes\\commands\\TehnCommands"
        ];
    }
}
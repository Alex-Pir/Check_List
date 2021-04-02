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

    /**
     * Выполнение необходимых настроек приложения
     */
    public function init() {
        $this->setupOptions();
        $this->reg->setRequest(new HttpRequest());
    }

    /**
     * Настройки роутинга
     */
    private function setupOptions() {
        $arConfig = $this->getConfig();

        foreach ($arConfig as $key => $config) {
            $this->reg->setCommand($key, $config);
        }
    }

    /**
     * Получение массива путей
     *
     * @return string[]
     */
    private function getConfig(): array {
        return [
            "/main" => "\\classes\\commands\\page\\MainCommands",
            "/start" => "\\classes\\commands\\page\\StartCommands",
            "/tehnic" => "\\classes\\commands\\page\\TehnCommands",
            "/handler/" => "\\classes\\commands\\handlers\\HandlerCommands",
            "/logout/" => "\\classes\\commands\\handlers\\LogoutCommands"
        ];
    }
}
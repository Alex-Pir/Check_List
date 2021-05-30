<?php

namespace classes\application;

use classes\application\configuration\CommandsConf;
use classes\exceptions\application\AppException;

/**
 * Класс, производящий первоначальные настройки приложения,
 * относящиеся к роутингу
 *
 * Class ApplicationHelper
 * @package classes\application
 */
class ApplicationHelper {

    private $config;
    private $reg;

    public function __construct() {

        $this->config = $_SERVER["DOCUMENT_ROOT"] . "/config/route/route.ini";

        if (!file_exists($this->config)) {
            throw new AppException("Файл конфигурации не найден!");
        }


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
        $options = parse_ini_file($this->config, true);
        $conf = new CommandsConf($options["commands"] ?? [], $options["complex_commands"] ?? []);
        $this->reg->setCommand($conf);
    }
}
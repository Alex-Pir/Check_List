<?php

namespace classes\application;

use classes\application\configuration\CommandsConf;
use classes\log\Log;
use Exception;
use PDO;

/**
 * Класс для хранения данных, используемых во всем приложении
 *
 * Class Registry
 * @package classes\application
 */
class Registry {

    /** @var self Экземпляр класса */
    private static $registry;

    /** @var array Команды */
    private $commands;

    /** @var array Сложные команды */
    private $complexCommands;

    /** @var null Запросы */
    private $request;

    /** @var ApplicationHelper Экземпляр класса ApplicationHelper */
    private $applicationHelper;

    /** @var PDO Экземпляр класса PDOStatement*/
    private $pdo;

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
     * Запись команд в хранилище
     *
     * @param CommandsConf $commandsConf
     */
    public function setCommand(CommandsConf $commandsConf) {
        $this->commands = $commandsConf->getCommands();
        $this->complexCommands = $commandsConf->getComplexCommands();
    }

    /**
     * Получение команды из хранилища по ключу
     *
     * @param $key
     * @return false|mixed
     * @throws Exception
     */
    public function getCommand($key) {
        if (array_key_exists($key, $this->commands)) {
            return  $this->commands[$key];
        }

        return $this->getComplexCommand($key);
    }

    /**
     * Получение класса команды из сложного пути
     *
     * @param $key
     * @return false|mixed
     * @throws Exception
     */
    private function getComplexCommand($key) {

        $arDefaultKeys = explode('/', $key);

        $complexFlag = true;

        foreach ($this->complexCommands as $commandKey => $command) {

            if (!array_key_exists("PARAMETERS", $command) || !array_key_exists("CLASS", $command)) {
                continue;
            }

            $arCommandKeys = explode('/', $commandKey);

            $arDif = array_diff($arCommandKeys, $arDefaultKeys);

            /**
             * проверяем, подходит ли нам путь. Если все сходится, кроме ? для параметров, то подходит
             */
            foreach ($arDif as $dif) {
                if ($dif !== '?') {
                    $complexFlag = false;
                }
            }

            if (!$complexFlag) {
                continue;
            }

            $paramIndex = 0;

            /**
             * сопоставляем сзапрос с шаблоном и сохраняем параметры в запросе
             */
            foreach ($arCommandKeys as $k => $cKeys) {
                if ($cKeys !== '?') {
                    continue;
                }

                $param = $this->complexCommands[$commandKey]["PARAMETERS"][$paramIndex++];
                $this->getRequest()->setProperty($param, $arDefaultKeys[$k]);
            }

            return $this->complexCommands[$commandKey]["CLASS"];
        }

        return false;
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

    /**
     * Получение соединения с базой данных
     *
     * @return PDO|null
     */
    public function getPdo(): ?PDO {
        try {
            if (!is_null($this->pdo)) {
                $dbConfigFile = $_SERVER["DOCUMENT_ROOT"] . "/config/db/db.ini";

                if (!file_exists($dbConfigFile)) {
                    throw new Exception("Отсутствует файл с настройками подключения к базе данных");
                }

                $options = parse_ini_file($dbConfigFile);

                if (!isset($options["database"]) || !is_array($options["database"])) {
                    throw new Exception("В файле отсутствуют настройки для подключения к базе данных");
                }

                $this->pdo = new PDO("mysql:host={$this->getValueFromArray($options["database"], 'HOST')};dbname={$this->getValueFromArray($options["database"], 'DB')}", $this->getValueFromArray($options["database"], 'USER'), $this->getValueFromArray($options["database"], 'PASS'), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }

            return $this->pdo;
        } catch(Exception $ex) {
            Log::writeLog($ex->getMessage());
            return null;
        }
    }

    /**
     * Получение значения из массива по ключу
     *
     * @param array $array
     * @param string $key
     * @return mixed|null
     */
    protected function getValueFromArray(array $array, string $key) {
        if (isset($array[$key])) {
            return $array[$key];
        }

        return null;
    }
}
<?php
namespace classes\application\configuration;

class CommandsConf {

    /** @var array массив с командами */
    private $commands;

    /** @var array массив со сложными командами
     * Примеры сложных команд находятся в /config/route/route.ini
     * под ключом [complex_commands] и нужны для построения динамических путей к страницам чеклистов
     */
    private $complexCommands;

    public function __construct(array $commands, array $complexCommands) {
        $this->commands = $commands;
        $this->complexCommands = $this->parseComplexCommands($complexCommands);
    }

    /**
     * Разбирает массив со сложными командами и преобразует его к виду
     * ["CLASS" => ..., "PARAMETERS" => []]
     *
     * @param array $complexCommands
     * @return array
     */
    private function parseComplexCommands(array $complexCommands): array {

        $arComplexCommands = [];

        foreach ($complexCommands as $key => $commands) {
            $commandPath = explode('/', $key);

            $resultPath = [];
            $parameters = [];

            foreach ($commandPath as $path) {
               if (preg_match("/^[#]{1}([\w\-]{1,})[#]{1}$/", $path, $matches)) {
                    $parameters[] = $matches[1];
                    $resultPath[] = '?';
                } else {
                    $resultPath[] = $path;
                }
            }

            $path = implode('/', $resultPath);

            $arComplexCommands[$path]["CLASS"] = $commands;
            $arComplexCommands[$path]["PARAMETERS"] = $parameters;
        }

        return $arComplexCommands;
    }

    public function getCommands(): array {
        return $this->commands;
    }

    public function getComplexCommands(): array {
        return $this->complexCommands;
    }
}
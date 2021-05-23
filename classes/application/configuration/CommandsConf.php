<?php
namespace classes\application\configuration;

class CommandsConf {

    private $commands;
    private $complexCommands;

    public function __construct(array $commands, array $complexCommands) {
        $this->commands = $commands;
        $this->complexCommands = $this->parseComplexCommands($complexCommands);
    }

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
<?php
namespace classes\application\configuration;

class Conf {
    private $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function getConfig() {
        return $this->config;
    }
}
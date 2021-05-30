<?php

namespace classes\commands;

use classes\application\Request;
use Twig_Environment;
use Twig_Loader_Filesystem;

abstract class Command {

    protected $twig;

    final public function __construct() {
        $loader = new Twig_Loader_Filesystem($_SERVER["DOCUMENT_ROOT"] . "/templates/");

        $this->twig = new Twig_Environment($loader, ['cache' => $_SERVER["DOCUMENT_ROOT"] . '/templates/views/cache/']);
    }

    public function execute(Request $request) {
        $this->doExecute($request);
    }

    abstract public function doExecute(Request $request);
}
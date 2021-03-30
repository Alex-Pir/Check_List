<?php

namespace classes\commands;

use classes\application\Request;

abstract class Command {
    final public function __construct() {}

    public function execute(Request $request) {
        $this->doExecute($request);
    }

    abstract public function doExecute(Request $request);
}
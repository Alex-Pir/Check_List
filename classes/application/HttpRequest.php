<?php

namespace classes\application;

class HttpRequest extends Request {
    public function init() {
        $this->properties = $_REQUEST;
        $this->path = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
    }
}
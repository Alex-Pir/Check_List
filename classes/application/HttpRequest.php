<?php

namespace classes\application;

/**
 * Класс-прослойка для $_REQUEST
 * В нем нужно производить всю обработку запросов
 *
 * TODO нужно разделить на GET и POST
 * Class HttpRequest
 * @package classes\application
 */
class HttpRequest extends Request {

    /**
     * Сохранение состояния $_REQUEST и URL
     */
    public function init() {
        $this->properties = $_REQUEST;
        $this->path = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    }
}
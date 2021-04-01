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

    private function getUrlQuery($url, $key = null)
    {
        $parts = parse_url($url);
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);

            if (is_null($key)) {
                return $query;
            } elseif (isset($query[$key])) {
                return $query[$key];
            }

        }

        return false;
    }
}
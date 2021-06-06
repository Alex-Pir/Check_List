<?php

namespace classes\orm;

use classes\objects\DomainObject;

class ObjectWatcher {
    private $all = [];
    private static $instance = null;

    private function __construct(){}

    public static function instance(): self {
        if (is_null(self::$instance)) {
            self::$instance = new ObjectWatcher();
        }

        return self::$instance;
    }

    public function globalKey(DomainObject $object): string {
        return get_class($object . "." . $object->getId());
    }

    public static function add(DomainObject $object) {
        $inst = self::instance();
        $inst->all[$inst->globalKey()] = $object;
    }

    public static function exists($classname, $id) {
        $inst = self::instance();
        $key = "{$classname}.{$id}";

        if (isset($inst->all[$key])) {
            return $inst->all[$key];
        }

        return null;
    }
}
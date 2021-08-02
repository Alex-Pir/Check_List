<?php

namespace classes\orm;

use classes\objects\DomainObject;

class ObjectWatcher
{
    private $all = [];
    private $dirty = [];
    private $new = [];
    private $delete = [];
    private static $instance = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new ObjectWatcher();
        }

        return self::$instance;
    }

    public function globalKey(DomainObject $object): string
    {
        return get_class($object) . "." . $object->getId();
    }

    public static function add(DomainObject $object)
    {
        $inst = self::instance();
        $inst->all[$inst->globalKey($object)] = $object;
    }

    public static function exists($classname, $id)
    {
        $inst = self::instance();
        $key = "{$classname}.{$id}";

        if (isset($inst->all[$key])) {
            return $inst->all[$key];
        }

        return null;
    }

    public static function addDelete(DomainObject $object)
    {
        $inst = self::instance();
        $inst->delete[$inst->globalKey($object)] = $object;
    }

    public static function addDirty(DomainObject $object)
    {
        $inst = self::instance();

        if (!in_array($object, $inst->new, true)) {
            $inst->dirty[$inst->globalKey($object)] = $object;
        }
    }

    public static function addNew(DomainObject $object)
    {
        $inst = self::instance();
        $inst->new[] = $object;
    }

    public static function addClean(DomainObject $object)
    {
        $inst = self::instance();
        unset($inst->dirty[$inst->globalKey($object)]);
        unset($inst->delete[$inst->globalKey($object)]);

        $inst->new = array_filter(
            $inst->new,
            function ($value) use ($object) {
                return $value !== $object;
            }
        );
    }

    public function performOperations() {
        foreach ($this->dirty as $object) {
            $object->getFinder()->update($object);
        }

        foreach ($this->dirty as $object) {
            $object->getFinder()->insert($object);
        }

        $this->dirty = [];
        $this->new = [];
    }
}
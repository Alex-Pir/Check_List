<?php
namespace classes\objects\collections;

use classes\exceptions\application\AppException;
use classes\objects\DomainObject;
use classes\orm\Mapper;
use Iterator;

abstract class Collection implements Iterator {
    protected $mapper;
    protected $total = 0;
    protected $raw = [];

    private $pointer = 0;
    private $objects = [];

    public function __construct(array $raw = [], Mapper $mapper = null) {
        $this->raw = $raw;
        $this->total = count($raw);

        if (count($raw) && is_null($mapper)) {
            throw new AppException("Нужен объект типа Mapper для создания объектов");
        }

        $this->mapper = $mapper;
    }

    public function add(DomainObject $object) {
        $class = $this->targetClass();
        
        if (!($object instanceof $class)) {
            throw new AppException("Это коллекция {$class}");
        }

        $this->notifyAccess();
        $this->objects[$this->total++] = $object;
    }

    abstract public function targetClass(): string;

    protected function notifyAccess() {
        //оставлен пустым
    }

    private function getRow($num) {
        $this->notifyAccess();

        if ($num >= $this->total || $num < 0) {
            return null;
        }

        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }

        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
            return $this->objects[$num];
        }
    }

    public function rewind() {
        $this->pointer = 0;
    }

    public function current() {
        return $this->getRow($this->pointer);
    }

    public function key() {
        return $this->pointer;
    }

    public function next() {
        $row = $this->getRow($this->pointer);

        if (!is_null($row)) {
            $this->pointer++;
        }
    }

    public function valid() {
        return (!is_null($this->current()));
    }
}
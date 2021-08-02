<?php
namespace classes\objects;

use classes\objects\collections\Collection;
use classes\orm\Mapper;
use classes\orm\ObjectWatcher;

abstract class DomainObject {

    private $id;

    public function __construct(int $id) {
        $this->id = $id;
    }

    public function setId(int $id) {
        $this->id = $id;

        if ($id < 0) {
            $this->markNew();
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function markNew() {
        ObjectWatcher::addNew($this);
    }

    public function markDirty() {
        ObjectWatcher::addDirty($this);
    }

    public function markDelete() {
        ObjectWatcher::addDelete($this);
    }

    public function markClean() {
        ObjectWatcher::addClean($this);
    }

    public static function getCollection(string $type): Collection {
        return Collection::getCollection($type);
    }

    abstract public function getFinder(): Mapper;
}
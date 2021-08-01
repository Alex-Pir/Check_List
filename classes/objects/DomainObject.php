<?php
namespace classes\objects;

use classes\objects\collections\Collection;

abstract class DomainObject {

    private $id;

    public function __construct(int $id) {
        $this->id = $id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public static function getCollection(string $type): Collection {
        return Collection::getCollection($type);
    }

    public function markDirty(){}
}
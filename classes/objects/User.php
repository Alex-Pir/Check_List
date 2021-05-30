<?php
namespace classes\objects;

class User extends DomainObject {

    private $name;

    private $startCheck;
    private $tehnCheck;

    public function __construct(int $id, string $name) {
        $this->startCheck = self::getCollection(Start::class);
        $this->tehnCheck = self::getCollection(Tehn::class);
        $this->name = $name;
        parent::__construct($id);
    }

    public function setStartCheck(StartCollection $start) {
        $this->startCheck = $start;
    }

    public function setTehnCheck(TehnCollection $tehn) {
        $this->startCheck = $tehn;
    }

    public function getStartCheck(): StartCollection {
        return $this->startCheck;
    }

    public function getTehnCheck(): TehnCollection {
        return $this->tehnCheck;
    }

    public function setName(string $name) {
        $this->name = $name;
        $this->markDirty();
    }

    public function getName(): string {
        return $this->name;
    }
}
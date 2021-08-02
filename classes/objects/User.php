<?php
namespace classes\objects;

use classes\orm\Mapper;
use classes\orm\UserMapper;

class User extends DomainObject {

    private $name;

    private $startCheck;
    private $tehnCheck;

    public function __construct(int $id, string $name) {
        $this->startCheck = [];
        $this->tehnCheck = [];
        $this->name = $name;
        parent::__construct($id);
    }

    public function setStartCheck(array $start) {
        $this->startCheck = $start;
        $this->markDirty();
    }

    public function setTehnCheck(array $tehn) {
        $this->startCheck = $tehn;
        $this->markDirty();
    }

    public function getStartCheck(): array {
        return $this->startCheck;
    }

    public function getTehnCheck(): array {
        return $this->tehnCheck;
    }

    public function setName(string $name) {
        $this->name = $name;
        $this->markDirty();
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFinder(): Mapper
    {
       return new UserMapper();
    }
}
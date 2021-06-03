<?php
namespace classes\orm;

use classes\application\Registry;
use classes\objects\collections\Collection;
use classes\objects\DomainObject;
use PDOStatement;

abstract class Mapper {

    protected $pdo;

    public function __construct() {
        $this->pdo = Registry::getInstance()->getPdo();
    }

    public function find(int $id): ?DomainObject {
        $this->selectStmt()->execute([$id]);
        $row = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor();

        if (!is_array($row)) {
            return null;
        }

        if (!isset($row['ID'])) {
            return null;
        }

        return $this->createObject($row);
    }

    public function findAll(): Collection {
        $this->selectAllStmt()->execute([]);
        return $this->getCollection($this->selectAllStmt()->fetchAll());
    }

    public function createObject(array $raw): DomainObject {
        return $this->doCreateObject($raw);
    }

    public function insert(DomainObject $obj) {
        $this->doInsert($obj);
    }

    abstract public function update(DomainObject $object);
    abstract protected function doCreateObject(array $raw): DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStmt(): PDOStatement;
    abstract protected function targetClass(): string;
    abstract protected function selectAllStmt(): PDOStatement;
    abstract protected function getCollection(array $raw): Collection;
}
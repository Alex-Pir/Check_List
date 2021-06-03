<?php
namespace classes\orm;

use classes\objects\collections\Collection;
use classes\objects\collections\UserCollection;
use classes\objects\DomainObject;
use classes\objects\User;
use Exception;
use PDOStatement;

class UserMapper extends Mapper {

    private $selectAllStmt;
    private $selectStmt;
    private $updateStmt;
    private $insertStmt;

    public function __construct() {
        parent::__construct();

        $this->selectAllStmt = $this->pdo->prepare("SELECT * FROM CHECKOUT");
        $this->selectStmt = $this->pdo->prepare("SELECT * FROM CHECKOUT where USER_ID=?");
        $this->updateStmt = $this->pdo->prepare("UPDATE CHECKOUT SET START_CHECK=?, TEHN_CHECK=? WHERE USER_ID=?");
        $this->insertStmt = $this->pdo->prepare("INSERT INTO CHECKOUT (START_CHECK, TEHN_CHECK) VALUES (?, ?)");
    }

    public function update(DomainObject $object) {

        if (!($object instanceof User)) {
            throw new Exception("Передан неверный объект для данной таблицы");
        }

        $values = [
            serialize($object->getStartCheck()),
            serialize($object->getTehnCheck()),
            $object->getId()
        ];

        $this->updateStmt->execute($values);
    }

    protected function doCreateObject(array $raw): DomainObject {
        $obj = new User((int) $raw["ID"], $raw["NAME"]);
        $obj->setStartCheck(unserialize($raw["START_CHECK"]));
        $obj->setStartCheck(unserialize($raw["TEHN_CHECK"]));
        return $obj;
    }

    protected function doInsert(DomainObject $object) {

        $class = $this->targetClass();
        
        if (!($object instanceof $class)) {
            throw new Exception("Передан неверный объект для данной таблицы. Нужен объект типа {$class}");
        }

        $values = [
            serialize($object->getStartCheck()),
            serialize($object->getTehnCheck()),
        ];

        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $object->setId($id);
    }

    protected function selectStmt(): PDOStatement {
        return $this->selectStmt;
    }

    protected function selectAllStmt(): PDOStatement {
        return $this->selectAllStmt;
    }

    protected function targetClass(): string {
        return User::class;
    }

    public function getCollection(array $raw): Collection {
        return new UserCollection($raw, $this);
    }
}
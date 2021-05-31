<?php
namespace classes\objects\factory;

use classes\objects\collections\Collection;
use classes\objects\collections\UserCollection;
use classes\orm\Mapper;
use classes\orm\UserMapper;

class UserFactory implements ObjectFactory {

    public function getMapper(): Mapper {
        return new UserMapper();
    }

    public function getCollection(): Collection {
        return new UserCollection();
    }
}
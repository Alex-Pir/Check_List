<?php

namespace classes\objects\factory;

use classes\objects\collections\Collection;
use classes\orm\Mapper;

interface ObjectFactory {
    public function getMapper(): Mapper;
    public function getCollection(): Collection;
}
<?php

namespace classes\objects\collections;

use classes\objects\User;

class UserCollection extends Collection {

    public function targetClass(): string {
        return User::class;
    }

}
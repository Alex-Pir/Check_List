<?php

namespace classes\user;

use classes\orm\UserMapper;
use Exception;
use classes\log\Log;
use classes\auth\Fabric;
use classes\auth\Authorization;
use classes\exceptions\user\UserAddException;
use classes\exceptions\user\UserGetValueException;
use classes\user\User;

/**
 * Класс для хранения данных о пользователе в сессии
 *
 * Class SessionHelper
 * @package classes\user
 */
class SessionHelper
{

    /**
     * Ключ с данными о пользователе в сессии
     */
    const USER_SESSION_KEY = 'user';

    /**
     * Сохранение данных о пользоавтеле в сессию при авторизации
     *
     * @param string $provider
     * @return bool
     */
    public static function saveDataToSession(string $provider): bool
    {

        $userAut = Fabric::getAutClass($provider);
        try {

            if (!($userAut instanceof Authorization)) {
                throw new UserAddException('Не удается найти нужный обработчик для авторизации пользователя');
            }

            if (!$userAut->isAuthorized()) {
                throw new UserAddException('Не удается авторизовать пользователя!');
            }
            $userMapper = new UserMapper();
            $user = $userMapper->find($userAut->getId());

            if (!$user->getId()) {
                $user = new \classes\objects\User($userAut->getId(), implode(' ', [$userAut->getFirstName(), $userAut->getLastName()]));
                $userMapper->insert($user);
            }

            $user = new User($userAut->getId(), $userAut->getFirstName(), $userAut->getLastName());
            $_SESSION[self::USER_SESSION_KEY] = $user;
            return true;


        } catch (Exception $ex) {
            unset($_SESSION[self::USER_SESSION_KEY]);
            Log::writeLog($ex->getMessage());
            return false;
        }
    }

    /**
     * Сохранение данных о пользователе в сессию
     *
     * @param \classes\user\User $user
     */
    public static function saveUserToSession(User $user) {
        $_SESSION[self::USER_SESSION_KEY] = $user;
    }

    /**
     * Получение данных пользователя из сессии
     *
     * @return \classes\user\User|null
     */
    public static function getDataFromSession(): ?User
    {
        $user = $_SESSION[self::USER_SESSION_KEY];

        try {
            if (!($user instanceof User)) {
                throw new UserGetValueException('Не удается получить объект пользователя из сессии');
            }
        } catch (Exception $ex) {
            Log::writeLog($ex->getMessage());
            return null;
        }

        return $user;
    }

    /**
     * Удаление данных о пользователе из сессии
     */
    public static function destroyUserInSession() {
        unset($_SESSION[self::USER_SESSION_KEY]);
    }
}

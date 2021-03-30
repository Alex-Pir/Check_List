<?
namespace classes\auth;

use classes\exceptions\auth\AuthorizedException;

abstract class Authorization
{
    protected $userInfo;
    protected $ID;
    protected $firstName;
    protected $lastName;

    /**
     * @return string - id пользователя в соц. сети
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * @return string - имя пользователя
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string - фамилия пользователя
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $url - адрес нужной страницы
     */
    public static function redirect($url)
    {
        @header("HTTP/1.1 301 Moved Permanently");
        @header("Location:" . $url);
        exit();
    }

    /**
     * Возвращает информацию о пользователе
     *
     * @param $code
     * @return mixed
     * @throws AuthorizedException
     */
    protected function getUserInfo($code) {

        if (!$code) {
            throw new AuthorizedException('Не передан код в запросе');
        }

        $token = $this->getToken($code);

        if (!isset($token['access_token'])) {
            throw new AuthorizedException('Отсутствует токен');
        }

        return $this->getUserInformation($token);
    }

    public abstract function isAuthorized();
    protected abstract function getToken($code);
    protected abstract function getUserInformation($token);
}
?>
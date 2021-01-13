<?
namespace classes\auth;

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

    public abstract function isAuthorized();
}
?>
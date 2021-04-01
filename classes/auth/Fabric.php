<?
namespace classes\auth;

class Fabric
{
    /** @var string Параметр, который возвращает приложение VK */
    const VK_PROVIDER = 'vk';

    /** @var string Параметр, который возвращает приложение Mail */
    const MAIL_PROVIDER = 'mail';

    /** По переданному параметру соц. сети создает соответствующий класс для последующей авторизации
     * @param $provider
     * @return Mail|VK|null - экземпляр класса Authorization или null
     */
    public static function getAutClass($provider): ?Authorization
    {
        switch ($provider)
        {
            case self::VK_PROVIDER:
                $result = new VK();
                break;
            case self::MAIL_PROVIDER:
                $result = new Mail();
                break;
            default:
                $result = null;
                break;
        }
        return $result;
    }
}
?>
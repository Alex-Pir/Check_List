<?
namespace classes\auth;

class Fabric
{
    /** По переданному параметру соц. сети создает соответствующий класс для последующей авторизации
     * @param $provider
     * @return Mail|VK|null - экземпляр класса Authorization или null
     */
    public static function getAutClass($provider)
    {
        $result = null;
        switch ($provider)
        {
            case 'vk':
                $result = new VK();
                break;
            case 'mail':
                $result = new Mail();
        }
        return $result;
    }
}
?>
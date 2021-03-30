<?
namespace classes\auth;
use classes\exceptions\auth\AuthorizedException;
use classes\log\Log;

include  'config/VK/config.php';


class VK extends Authorization
{
    const START_CONFIG = array(
      'client_id'     => ID_VK,
      'redirect_uri'  => URL_VK,
      'response_type' => 'code'
    );

    /**
     * Проверка существования пользователя в сети Вконтакте
     * @return bool - true, если пользователь зарегистрирован в сети Вконтакте, false - если нет.
     */
    public function isAuthorized()
    {
        try {

            $userInfo = $this->getUserInfo($_GET['code']);

            if (!isset($userInfo['id']))
            {
                throw new AuthorizedException('Не найден ID пользователя');
            }

            $this->ID = $userInfo['id'];
            $this->firstName = $userInfo['first_name'];
            $this->lastName = $userInfo['last_name'];

            return true;

        } catch (AuthorizedException $ex) {
            Log::writeLog($ex->getMessage());
            return false;
        }
    }

    protected function getToken($code)
    {
        $params = array(
            'client_id'     => ID_VK,
            'redirect_uri'  => URL_VK,
            'client_secret' => SECRET_VK,
            'code'          => $code
        );

        return json_decode(file_get_contents(URL_TOKEN_VK . '?' . urldecode(http_build_query($params))), true);
    }

    protected function getUserInformation($token)
    {
        $params = array(
            'uids'         => $token['uids'],
            'fields'       => 'id,first_name,last_name',
            'access_token' => $token['access_token'],
            'v'            => VERSION_VK
        );
        $userInfo = json_decode(file_get_contents(URL_ABOUT_USER_VK . '?' . urldecode(http_build_query($params))), true);

        if (isset($userInfo['response'][0]['id']))
        {
            $userInfo = $userInfo['response'][0];
        }

        return $userInfo;
    }

}
?>
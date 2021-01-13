<?
namespace classes\auth;
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
        $result = false;
        if (isset($_GET['code']))
        {
            $result = false;

            $token = $this->getToken();

            if (isset($token['access_token']))
            {
                $userInfo = $this->getUserInformation($token);

                if (isset($userInfo['id']))
                {
                    $this->ID = $userInfo['id'];
                    $this->firstName = $userInfo['first_name'];
                    $this->lastName = $userInfo['last_name'];
                    $result = true;
                }
            }

        }

        return $result;
    }
    private function getToken()
    {
        $params = array(
            'client_id'     => ID_VK,
            'redirect_uri'  => URL_VK,
            'client_secret' => SECRET_VK,
            'code'          => $_GET['code']
        );
        $token = json_decode(file_get_contents(URL_TOKEN_VK . '?' . urldecode(http_build_query($params))), true);

        return $token;
    }

    private function getUserInformation($token)
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
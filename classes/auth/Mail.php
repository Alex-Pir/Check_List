<?
namespace classes\auth;
include  'config/mail/config.php';


class Mail extends Authorization
{

    const START_CONFIG = array(
        'client_id'     => ID_MAIL,
        'response_type' => 'code',
        'redirect_uri'  => URL_MAIL
    );

    /**
     * Проверка существования пользователя в сети Mail.ru
     * @return bool - true, если пользователь зарегистрирован в сети Mail.ru, false - если нет.
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

                if (isset($userInfo['uid']))
                {
                    $this->ID = $userInfo['uid'];
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
            'client_id'     => ID_MAIL,
            'redirect_uri'  => URL_MAIL,
            'client_secret' => SECRET_MAIL,
            'code'          => $_GET['code'],
            'grant_type'    => 'authorization_code'
        );

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL, URL_TOKEN_MAIL);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $token = json_decode($result, true);

        return $token;
    }

    private function getUserInformation($token)
    {
        $client_id = ID_MAIL;
        $client_secret = SECRET_MAIL;
        $sign = md5("app_id={$client_id}method=users.getInfosecure=1session_key={$token['access_token']}{$client_secret}");
        $params = array(
            'method'      => 'users.getInfo',
            'secure'      => '1',
            'app_id'      => ID_MAIL,
            'session_key' => $token['access_token'],
            'sig'         => $sign
        );
        $userInfo = json_decode(file_get_contents(URL_ABOUT_USER_MAIL . '?' . urldecode(http_build_query($params))), true);

        if (isset($userInfo[0]['uid']))
        {
            $userInfo = array_shift($userInfo);
        }
        return $userInfo;
    }
}
?>
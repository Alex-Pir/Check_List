<?

namespace classes\auth;

use classes\exceptions\auth\AuthorizedException;
use classes\log\Log;
use Exception;

include 'config/mail/config.php';


class Mail extends Authorization
{

    const START_CONFIG = array(
        'client_id' => ID_MAIL,
        'response_type' => 'code',
        'redirect_uri' => URL_MAIL
    );

    /**
     * Проверка существования пользователя в сети Mail.ru
     * @return bool - true, если пользователь зарегистрирован в сети Mail.ru, false - если нет.
     */
    public function isAuthorized()
    {
        try {
            $userInfo = $this->getUserInfo($_GET['code']);

            if (isset($userInfo['uid'])) {
                throw new AuthorizedException('Не найден ID пользователя');
            }

            $this->ID = $userInfo['uid'];
            $this->firstName = $userInfo['first_name'];
            $this->lastName = $userInfo['last_name'];
            return true;

        } catch (Exception $ex) {
            Log::writeLog($ex->getMessage());
            return false;
        }
    }

    protected function getToken($code)
    {
        $params = array(
            'client_id' => ID_MAIL,
            'redirect_uri' => URL_MAIL,
            'client_secret' => SECRET_MAIL,
            'code' => $code,
            'grant_type' => 'authorization_code'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, URL_TOKEN_MAIL);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);

        return json_decode($result, true);
    }

    protected function getUserInformation($token)
    {
        $client_id = ID_MAIL;
        $client_secret = SECRET_MAIL;
        $sign = md5("app_id={$client_id}method=users.getInfosecure=1session_key={$token['access_token']}{$client_secret}");
        $params = array(
            'method' => 'users.getInfo',
            'secure' => '1',
            'app_id' => ID_MAIL,
            'session_key' => $token['access_token'],
            'sig' => $sign
        );
        $userInfo = json_decode(file_get_contents(URL_ABOUT_USER_MAIL . '?' . urldecode(http_build_query($params))), true);

        if (isset($userInfo[0]['uid'])) {
            $userInfo = array_shift($userInfo);
        }
        return $userInfo;
    }
}

?>
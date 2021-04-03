<?
namespace classes\db;

use PDO;
use PDOException;

use classes\log\Log;

class DBConnection
{
    private $host;
    private $user;
    private $pass;
    private $db;

    function __construct()
    {
        include 'config/db/config.php';
        $this->host = HOST;
        $this->user = USER;
        $this->pass = PASS;
        $this->db = DB;

    }

    /**
     * Обновление состояния чекбоксов в колонке TEHN_CHECK
     *
     * @param $id - ID пользователя
     * @param $input - строка, которую необходимо записать в базу
     * @return bool - true, если запись успешна, false - если нет.
     */
    public function updateTehn(string $id, string $input): bool
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("UPDATE CHECKOUT SET TEHN_CHECK = :tehnCheck WHERE USER_ID = :userID");
            $stmt->execute(['tehnCheck' => $input, 'userID' => $id]);

            return true;
        }
        catch(PDOException $ex)
        {
            Log::writeLog('Не удалось записать значения в базу');
            return false;
        }
    }

    /**
     * Обновление состояния чекбоксов в колонке START_CHECK
     *
     * @param $id - ID пользователя
     * @param $input - строка, которую необходимо записать в базу
     * @return bool - true, если запись успешна, false - если нет.
     */
    public function updateStart(string $id, string $input): bool
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("UPDATE CHECKOUT SET START_CHECK = :startCheck WHERE USER_ID = :userID");
            $stmt->execute(['startCheck' => $input, 'userID' => $id]);

            return true;
        }
        catch (PDOException $ex)
        {
            Log::writeLog('Не удалось записать значения в базу');
            return false;
        }
    }

    /**
     * Создания строки для пользователя с таким ID в таблице
     *
     * @param $id - ID пользователя
     * @param $input - строка, которую необходимо записать в базу
     * @return bool - true, если запись успешна, false - если нет.
     */
    public function add(string $id): bool
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("INSERT INTO CHECKOUT (USER_ID, TEHN_CHECK, START_CHECK) VALUES (:userID, '', '')");
            $stmt->execute(['userID' => $id]);

            return true;
        }
        catch (PDOException $ex)
        {
            Log::writeLog('Не удалось добавить значения в базу');
            return false;
        }
    }

    /**
     * Проверка наличия данных с таким ID пользователя в базе
     *
     * @param $id - ID пользователя
     * @return bool - true, если данные существуют, false - если нет.
     */
    public function getUserByUserId(string $id): bool
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("SELECT COUNT(*) FROM CHECKOUT WHERE USER_ID = :userID");
            $stmt->execute(['userID' => $id]);
            $arResult = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($arResult) && array_pop($arResult) > 0)
            {
                return true;
            }

            return false;
        }
        catch (PDOException $ex)
        {
            Log::writeLog('Не удалось получить данные о пользователе');
            return false;
        }
    }

    /**
     * Получение состояния чекбоксов по ID пользователя
     *
     * @param $id - ID пользователя
     * @return array|int - ассоциативный массив с данными или -1 в случае неудачи
     */
    public function getCheckboxByUserId(string $id)
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("SELECT * FROM CHECKOUT WHERE USER_ID = :userID");
            $stmt->execute(['userID' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex)
        {
            Log::writeLog('Не удалось получить состояние чеклистов');
            return -1;
        }

    }
}
<?
namespace classes\db;

use PDO;
use PDOException;

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
    public function updateTehn($id, $input)
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("UPDATE CHECKOUT SET TEHN_CHECK = :tehnCheck WHERE USER_ID = :userID");
            $stmt->execute(['tehnCheck' => $input, 'userID' => $id]);

            return true;
        }
        catch(PDOException $ex)
        {
            echo 'Не удалось записать значения в базу';
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
    public function updateStart($id, $input)
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/citrus001.log", print_r(["UPDATE_START" => $id], true), FILE_APPEND);
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("UPDATE CHECKOUT SET START_CHECK = :startCheck WHERE USER_ID = :userID");
            $stmt->execute(['startCheck' => $input, 'userID' => $id]);

            return true;
        }
        catch (PDOException $ex)
        {
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
    public function add($id)
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/citrus001.log", print_r(["ADD" => $id], true), FILE_APPEND);
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("INSERT INTO CHECKOUT (USER_ID, TEHN_CHECK, START_CHECK) VALUES (:userID, '', '')");
            $stmt->execute(['userID' => $id]);

            return true;
        }
        catch (PDOException $ex)
        {
            return false;
        }
    }

    /**
     * Проверка наличия данных с таким ID пользователя в базе
     *
     * @param $id - ID пользователя
     * @return bool - true, если данные существуют, false - если нет.
     */
    public function getUserByUserId($id)
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("SELECT COUNT(*) FROM CHECKOUT WHERE USER_ID = :userID");
            $stmt->execute(['userID' => $id]);

            if ($stmt->fetch(PDO::FETCH_ASSOC))
            {
                return true;
            }

            return false;
        }
        catch (PDOException $ex)
        {
            return false;
        }
    }

    /**
     * Получение состояния чекбоксов по ID пользователя
     *
     * @param $id - ID пользователя
     * @return array - ассоциативный массив с данными
     */
    public function getCheckboxByUserId($id)
    {
        try {
            $dbConnect = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $stmt = $dbConnect->prepare("SELECT * FROM CHECKOUT WHERE USER_ID = :userID");
            $stmt->execute(['userID' => $id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            file_put_contents($_SERVER['DOCUMENT_ROOT']."/citrus001.log", print_r(['FETCH' => $result], true), FILE_APPEND);

            return $result;
        }
        catch (PDOException $ex)
        {
            return -1;
        }

    }
}
?>
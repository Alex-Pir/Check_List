<?

namespace classes\user;

use classes\exceptions\user as userException;

class User
{
    const TEHN_COLUMN = 'TEHN_CHECK';
    const START_COLUMN = 'START_CHECK';

    private $id;
    private $firstName;
    private $lastName;
    private $db;

    public $tehnCh;
    public $startCh;

    public function __construct($id, $firstName, $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->db = new \classes\db\DBConnection();

        if (!$this->isUser())
        {
            if (!$this->addValues())
            {
                throw new userException\UserAddException("Невозможно создать новую запись по заданным данным!");
            }
        }
        else
        {

            if (!$this->getValues())
            {
                throw new userException\UserGetValueException("Невозможно получить данные из базы!");
            }
        }
    }

    /**
     * @return bool - true в случае успеха
     * @throws userException\UserUpdateException - если невозможно сохранить данные
     */
    public function saveValuesTehnCheck(): bool
    {
        $str = serialize($this->tehnCh);
        $result = $this->db->updateTehn($this->id, $str);
        if (!$result)
        {
            throw new userException\UserUpdateException("Невозможно сохранить данные в базу");
        }
        return $result;
    }

    /**
     * @return bool - true в случае успеха
     * @throws userException\UserUpdateException - если невозможно сохранить данные
     */
    public function saveValuesStartCheck(): bool
    {
        $str = serialize($this->startCh);
        $result = $this->db->updateStart($this->id, $str);
        if (!$result)
        {
            throw new userException\UserUpdateException("Невозможно сохранить данные в базу");
        }
        return true;
    }


    private function addValues(): bool
    {
        return $this->db->add($this->id);
    }


    private function isUser(): bool
    {
        return $this->db->getUserByUserId($this->id);
    }

    /**
     * Получение состояния чекбоксов из базы
     * @return bool - true в случае успеха
     */
    public function getValues(): bool
    {
        $response = $this->db->getCheckboxByUserId($this->id);
        if ($response == -1)
        {
            return false;
        }

        $this->tehnCh = unserialize($response[self::TEHN_COLUMN]);
        $this->startCh = unserialize($response[self::START_COLUMN]);


        return true;
    }
    /**
     * Получение ID пользователя
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получение имени пользователя
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Получение фамилии пользователя
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}
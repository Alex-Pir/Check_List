<?
include '../lib/classes/autoload.php';
session_start();
use classes\user as users;
use classes\log as log;

if (isset($_POST["tehnCheck"]))
{
    parse_str($_POST["tehnCheck"], $input);
    $user = $_SESSION["user"];
    if ($user instanceof users\User)
    {
        $user->tehnCh = array();
        $user->tehnCh =setCheckedInArr($input, $user->tehnCh);
    }
    try
    {
        $user->saveValuesTehnCheck();
        $_SESSION["user"] = $user;
    }
    catch (classes\exceptions\user\UserUpdateException $ex)
    {
        log\Log::writeLog($ex->getMessage());
    }
}

if (isset($_POST["startCheck"]))
{
    parse_str($_POST["startCheck"], $input);
    $user = $_SESSION["user"];
    if ($user instanceof users\User)
    {
        $user->startCh = array();
        $user->startCh = setCheckedInArr($input, $user->startCh);
    }
    try
    {
        $user->saveValuesStartCheck();
        $_SESSION["user"] = $user;
    }
    catch (classes\exceptions\user\UserUpdateException $ex)
    {
        log\Log::writeLog($ex->getMessage());
    }
}

function setCheckedInArr($arrFrom, $arrTo)
{
    foreach ($arrFrom as $key1=>$arrOne)
    {
        foreach ($arrOne as $key2=>$arrTwo)
        {
            $arrTo[$key1][$key2] = 'checked';
        }
    }
    return $arrTo;
}
?>
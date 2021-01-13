<?
include '../lib/classes/autoload.php';
session_start();
use classes\user as users;

if (isset($_POST['action']))
{
    if (strcmp($_POST['action'], 'logout') == 0)
    {
        unset($_SESSION["user"]);
    }
}
?>
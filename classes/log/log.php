<?

namespace classes\log;

class Log
{
    public static function writeLog($message)
    {
        $log = date('Y-m-d H:i:s') . ' ' . $message;
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', $log . PHP_EOL, FILE_APPEND);
    }
}
?>
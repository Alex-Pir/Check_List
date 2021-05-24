<?php

namespace classes\application;

use Exception;

final class LangHelper {

    private static $langFilePath;
    private static $MESS;

    public static function loadMessages(string $langFilePath) {
        self::$langFilePath = $langFilePath;

        if (!file_exists($langFilePath)) {
            throw new Exception("Не удается загрузить файл с языковыми фразами");
        }

        include self::$langFilePath;

        if (!isset($MESS)) {
            throw new Exception("Не существует массив MESS с языковыми фразами в файле {$langFilePath}");
        }

        self::$MESS = $MESS;
    }

    public static function getMessage(string $code) {

        if (isset(self::$MESS[$code])) {
            return self::$MESS[$code];
        }

        return '';
    }
}
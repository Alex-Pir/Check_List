<?php
spl_autoload_register('autoload');

function autoload($aClassName) {
    $dir = array(
        'auth',
        'db',
        'user',
        'exceptions',
        'log'
    );

    foreach ($dir as $d)
    {

        $position = strpos($aClassName, $d);

        if ($position > 0)
        {
            $aClassFilePath = $_SERVER['DOCUMENT_ROOT']  . DIRECTORY_SEPARATOR . $aClassName . '.php';
        }
        else
        {
            $aClassFilePath = $_SERVER['DOCUMENT_ROOT']  . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $d . DIRECTORY_SEPARATOR . $aClassName . '.php';
        }

        if (file_exists($aClassFilePath))
        {
            require_once $aClassFilePath;
            return true;
        }
    }
    return false;
}

/*function autoload($class)
{
    require_once str_replace('\\', '/', $class . '.php');
}*/
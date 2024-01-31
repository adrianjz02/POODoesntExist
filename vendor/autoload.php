<?php

// autoload.php @généré par Composer

if (PHP_VERSION_ID < 50600) {
    if (!headers_sent()) {
        header('HTTP/1.1 500 Internal Server Error');
    }
    $err = 'Composer 2.3.0 a abandonné la prise en charge du chargement automatique sur PHP <5.6 et vous utilisez '.PHP_VERSION.', veuillez mettre à jour PHP ou utiliser Composer 2.2 LTS via "composer self-update --2.2". Abandon.'.PHP_EOL;
    if (!ini_get('display_errors')) {
        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            fwrite(STDERR, $err);
        } elseif (!headers_sent()) {
            echo $err;
        }
    }
    trigger_error(
        $err,
        E_USER_ERROR
    );
}

require_once __DIR__ . '/composer/autoload_real.php';

return ComposerAutoloaderInitc533e3fd2a8090bb7cc901e60287918f::getLoader();

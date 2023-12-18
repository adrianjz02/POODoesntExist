<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitea491577ffef7880b4ee6223b2fe8c3a
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Adrji\\PooDoesntExist\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Adrji\\PooDoesntExist\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitea491577ffef7880b4ee6223b2fe8c3a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitea491577ffef7880b4ee6223b2fe8c3a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitea491577ffef7880b4ee6223b2fe8c3a::$classMap;

        }, null, ClassLoader::class);
    }
}

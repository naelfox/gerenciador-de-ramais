<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f8e8094f91530e34da17dd2bbccd363
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lib\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Database' => __DIR__ . '/../..' . '/lib/database.php',
        'Environment' => __DIR__ . '/../..' . '/lib/environment.php',
        'Informacoes' => __DIR__ . '/../..' . '/lib/informacoes.php',
        'Ramais' => __DIR__ . '/../..' . '/lib/ramais.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1f8e8094f91530e34da17dd2bbccd363::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1f8e8094f91530e34da17dd2bbccd363::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1f8e8094f91530e34da17dd2bbccd363::$classMap;

        }, null, ClassLoader::class);
    }
}

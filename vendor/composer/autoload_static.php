<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0ed9d9362df2e0240ddea9796a0b5687
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0ed9d9362df2e0240ddea9796a0b5687::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0ed9d9362df2e0240ddea9796a0b5687::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

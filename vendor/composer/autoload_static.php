<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a6a62e1de094bb55e5510ab45ca3c2d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monopoly\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monopoly\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7a6a62e1de094bb55e5510ab45ca3c2d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7a6a62e1de094bb55e5510ab45ca3c2d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
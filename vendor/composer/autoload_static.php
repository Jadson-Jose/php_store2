<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita6225174a5501418a22a88a5cecd5aff
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita6225174a5501418a22a88a5cecd5aff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita6225174a5501418a22a88a5cecd5aff::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita6225174a5501418a22a88a5cecd5aff::$classMap;

        }, null, ClassLoader::class);
    }
}
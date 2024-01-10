<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2c433a93e6d283ea2263036a0063d3b
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'traits\\' => 7,
        ),
        'f' => 
        array (
            'fl\\' => 3,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'traits\\' => 
        array (
            0 => __DIR__ . '/..' . '/fl/traits',
        ),
        'fl\\' => 
        array (
            0 => __DIR__ . '/..' . '/fl',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2c433a93e6d283ea2263036a0063d3b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2c433a93e6d283ea2263036a0063d3b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2c433a93e6d283ea2263036a0063d3b::$classMap;

        }, null, ClassLoader::class);
    }
}

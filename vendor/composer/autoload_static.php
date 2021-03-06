<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3098b49fd9e70981e952403291d870f1
{
    public static $prefixLengthsPsr4 = array (
        'd' => 
        array (
            'douggonsouza\\request\\' => 21,
            'douggonsouza\\regexed\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'douggonsouza\\request\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'douggonsouza\\regexed\\' => 
        array (
            0 => __DIR__ . '/..' . '/douggonsouza/regexed/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'douggonsouza\\regexed\\dicionary' => __DIR__ . '/..' . '/douggonsouza/regexed/src/dicionary.php',
        'douggonsouza\\regexed\\dicionaryInterface' => __DIR__ . '/..' . '/douggonsouza/regexed/src/dicionaryInterface.php',
        'douggonsouza\\regexed\\regexed' => __DIR__ . '/..' . '/douggonsouza/regexed/src/regexed.php',
        'douggonsouza\\request\\dicionary' => __DIR__ . '/../..' . '/src/dicionary.php',
        'douggonsouza\\request\\requested' => __DIR__ . '/../..' . '/src/requested.php',
        'douggonsouza\\request\\routings' => __DIR__ . '/../..' . '/src/routings.php',
        'douggonsouza\\request\\routingsInterface' => __DIR__ . '/../..' . '/src/routingsInterface.php',
        'douggonsouza\\request\\usages' => __DIR__ . '/../..' . '/src/usages.php',
        'douggonsouza\\request\\usagesInterface' => __DIR__ . '/../..' . '/src/usagesInterface.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3098b49fd9e70981e952403291d870f1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3098b49fd9e70981e952403291d870f1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3098b49fd9e70981e952403291d870f1::$classMap;

        }, null, ClassLoader::class);
    }
}

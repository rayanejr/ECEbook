<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc0b177375f2da645a96ff1dc24d36c92
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc0b177375f2da645a96ff1dc24d36c92::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc0b177375f2da645a96ff1dc24d36c92::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc0b177375f2da645a96ff1dc24d36c92::$classMap;

        }, null, ClassLoader::class);
    }
}

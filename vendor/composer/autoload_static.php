<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit48cbf91b7d5e2b4916f504bc866c49d4
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit48cbf91b7d5e2b4916f504bc866c49d4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit48cbf91b7d5e2b4916f504bc866c49d4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit48cbf91b7d5e2b4916f504bc866c49d4::$classMap;

        }, null, ClassLoader::class);
    }
}

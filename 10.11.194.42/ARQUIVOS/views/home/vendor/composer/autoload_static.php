<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitffdfdd78c25b3829f6b53173574c7936
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
            0 => __DIR__ . '/../../../../../..'.'/views/home/vendor' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitffdfdd78c25b3829f6b53173574c7936::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitffdfdd78c25b3829f6b53173574c7936::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
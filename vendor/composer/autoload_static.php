<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae543f315435802f37f97788e88bdacf
{
    public static $files = array (
        '8f96edc1d49f28ba88a88a7404f3349b' => __DIR__ . '/../..' . '/src/Config/fixos.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Svg\\' => 4,
            'Src\\' => 4,
            'Sabberworm\\CSS\\' => 15,
        ),
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
        'F' => 
        array (
            'FontLib\\' => 8,
        ),
        'D' => 
        array (
            'Dompdf\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Svg\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-svg-lib/src/Svg',
        ),
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Sabberworm\\CSS\\' => 
        array (
            0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/src',
        ),
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'FontLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-font-lib/src/FontLib',
        ),
        'Dompdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/dompdf/dompdf/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Dompdf\\Cpdf' => __DIR__ . '/..' . '/dompdf/dompdf/lib/Cpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae543f315435802f37f97788e88bdacf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae543f315435802f37f97788e88bdacf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae543f315435802f37f97788e88bdacf::$classMap;

        }, null, ClassLoader::class);
    }
}

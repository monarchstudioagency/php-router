<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RootController
{
    private $env;

    public function render($view, $variables) {
        $this->env = getenv('ENV');
        if($this->env === 'production'){
            $cacheDir = ROOT . '/tmp/twig';
        } else {
            $cacheDir = false;
        }
        $loader = new FilesystemLoader(ROOT . '/views');
        $twig = new Environment($loader, [
            'cache' => $cacheDir
        ]);
        try {
            $seconds_to_cache = 3600;
            $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
            header("Expires: $ts");
            header("Pragma: cache");
            header("Cache-Control: max-age=$seconds_to_cache");
            echo $twig->render($view, $variables);
            return;
        } catch (\Exception $e) {
            echo 'Twig error : ',  $e->getMessage(), "\n";
            return;
        }
    }

}
<?php

namespace app\core;
require_once('../app/functions/functions.php');
class controller{
    
    protected function load(string $view, $params= []){
        $twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader('../app/view/')
        );
        $twig->addGlobal('BASE', BASE);
       echo $twig->render($view.'.twig.php',$params); 

    }
    
}
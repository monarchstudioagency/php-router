<?php

namespace App\Controller;

class ExampleController extends RootController
{

    public function show()
    {
        $view = ROOT . "/views/example.html";
        readfile($view);
    }

    public function showTwig()
    {
        $view = new RootController();
        $variables = [
            "key" => "value"
        ];
        $view->render('twig-example.twig', $variables);
    }

}
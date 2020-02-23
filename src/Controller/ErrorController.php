<?php

namespace App\Controller;

class ErrorController extends RootController
{
    public function notFound()
    {
        $view = new RootController();

        $variables = [
            "class" => "404"
        ];
        http_response_code(404);
        $view->render('404.twig', $variables);

    }

    public function forbidden()
    {
        $view = new RootController();

        $variables = [
            "class" => "403"
        ];
        http_response_code(403);
        $view->render('403.twig', $variables);

    }
}
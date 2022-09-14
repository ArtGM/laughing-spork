<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ViewResponder
{
    public function __construct(private readonly Environment $templating)
    {
    }

    public function __invoke(string $template, array $paramsTemplate = []): Response
    {
        try {
            return new Response($this->templating->render($template, $paramsTemplate));
        } catch (LoaderError|RuntimeError|SyntaxError $errorException) {
            return new Response($errorException->getMessage());
        }
    }

}

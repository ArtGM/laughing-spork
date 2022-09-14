<?php

namespace App\Action;

use App\Responder\ViewResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'index')]
class IndexAction
{
    public function __invoke( Request $request, ViewResponder $viewResponder ): Response {
        return $viewResponder( 'core/index.html.twig', [
            'Hello' => 'World'
        ] );
    }

}
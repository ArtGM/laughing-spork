<?php

namespace App\Action;

use App\Repository\PageRepository;
use App\Responder\ViewResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{slug}', name: 'show_page')]
class ShowPageAction
{
    public function __construct(private readonly PageRepository $pageRepository)
    {
    }

    public function __invoke(string $slug, ViewResponder $viewResponder): Response
    {
        $page = $this->pageRepository->findOneBy(['slug' => $slug]);

        return $viewResponder('core/page.html.twig', [
            'page' => $page,
        ]);
    }
}
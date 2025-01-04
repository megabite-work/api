<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/')]
class HomeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(): RedirectResponse
    {
        return new RedirectResponse('https://mcrm.uz', Response::HTTP_MOVED_PERMANENTLY);
    }

    // #[Route(path: '/dd', methods: ['POST'])]
    public function dd(Request $request): Response
    {
        dd(
            $request->headers->all(),
            $request->attributes->all(),
            $request->query->all(),
            $request->request->all(),
            $request->files->all(),
            $request->cookies->all(),
            $request->server->all(),
            $request->getContent(),
            $request->getPayload(),
            $request->getClientIp(),
            $request->getClientIps(),
        );
    }
}

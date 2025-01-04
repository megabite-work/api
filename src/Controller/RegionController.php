<?php

namespace App\Controller;

use App\Action\Region\IndexAction;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/regions', format: 'json')]
#[OA\Tag(name: 'Region')]
class RegionController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action, #[MapQueryParameter] ?int $parentId = null): JsonResponse
    {
        return $this->json($action($parentId), context: ['groups' => ['region:index']]);
    }
}

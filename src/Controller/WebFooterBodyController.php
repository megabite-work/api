<?php

namespace App\Controller;

use App\Action\WebFooterBody\CreateAction;
use App\Action\WebFooterBody\DeleteAction;
use App\Action\WebFooterBody\IndexAction;
use App\Action\WebFooterBody\ShowAction;
use App\Action\WebFooterBody\UpdateAction;
use App\Dto\WebFooterBody\RequestDto;
use App\Dto\WebFooterBody\RequestQueryDto;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-footer-bodys', format: 'json')]
#[OA\Tag(name: 'WebFooterBody')]
class WebFooterBodyController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_footer_body:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_footer_body:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['web_footer_body:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_footer_body:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_footer_body:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_footer_body:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['web_footer_body:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}

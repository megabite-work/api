<?php

namespace App\Controller;

use App\Action\PaymentType\CreateAction;
use App\Action\PaymentType\DeleteAction;
use App\Action\PaymentType\IndexAction;
use App\Action\PaymentType\ShowAction;
use App\Action\PaymentType\UpdateAction;
use App\Dto\PaymentType\RequestDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/payment-types', format: 'json')]
#[OA\Tag(name: 'PaymentType')]
class PaymentTypeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action): JsonResponse
    {
        return $this->json($action(), context: ['groups' => ['payment_type:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['payment_type:show']]);
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['payment_type:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['payment_type:create']]);
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['payment_type:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['payment_type:update']]);
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}

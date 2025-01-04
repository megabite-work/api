<?php

namespace App\Controller;

use App\Action\WebBanner\CreateAction;
use App\Action\WebBanner\DeleteAction;
use App\Action\WebBanner\IndexAction;
use App\Action\WebBanner\ShowAction;
use App\Action\WebBanner\UpdateAction;
use App\Action\WebBanner\WebBannerMetrikaUpsertAction;
use App\Action\WebBanner\WebBannerSettingIndexAction;
use App\Action\WebBanner\WebBannerSettingUpsertAction;
use App\Dto\WebBanner\RequestDto;
use App\Dto\WebBanner\RequestQueryDto;
use App\Dto\WebBanner\WebBannerMetrikaUpsertDto;
use App\Dto\WebBanner\WebBannerSettingUpsertDto;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-banners', format: 'json')]
#[OA\Tag(name: 'WebBanner')]
class WebBannerController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_banner:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_banner:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['web_banner:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_banner:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_banner:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_banner:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['web_banner:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }

    #[Route('/{id<\d+>}/metrics', methods: ['POST'])]
    public function metrics(int $id, #[MapRequestPayload] WebBannerMetrikaUpsertDto $dto, WebBannerMetrikaUpsertAction $action): JsonResponse
    {
        return $this->json($action($id, $dto));
    }

    #[Route('/settings', methods: ['POST'])]
    public function settings(#[MapRequestPayload] WebBannerSettingUpsertDto $dto, WebBannerSettingUpsertAction $action): JsonResponse
    {
        return $this->json($action($dto));
    }

    #[Route('/settings', methods: ['GET'])]
    public function getSettings(WebBannerSettingIndexAction $action, #[MapQueryParameter] ?int $id = null): JsonResponse
    {
        return $this->json($action($id));
    }
}

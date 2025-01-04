<?php

namespace App\Controller;

use App\Action\WebNomenclature\ArticleAttributeAction;
use App\Action\WebNomenclature\AssignAction;
use App\Action\WebNomenclature\ClientArticleAttributeCreateAction;
use App\Action\WebNomenclature\ClientArticleAttributeDeleteAction;
use App\Action\WebNomenclature\ClientArticleAttributeIndexAction;
use App\Action\WebNomenclature\ClientArticleAttributeUpdateAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueCreateAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueDeleteAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueIndexAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueUpdateAction;
use App\Action\WebNomenclature\CreateAction;
use App\Action\WebNomenclature\DeleteAction;
use App\Action\WebNomenclature\IndexAction;
use App\Action\WebNomenclature\ShowAction;
use App\Action\WebNomenclature\UpdateAction;
use App\Dto\WebNomenclature\RequestDto;
use App\Dto\WebNomenclature\RequestQueryDto;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-nomenclatures', format: 'json')]
#[OA\Tag(name: 'WebNomenclature')]
class WebNomenclatureController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_nomenclature:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['web_nomenclature:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_nomenclature:create']]);
    }

    #[Route(path: '/assign', methods: ['POST'])]
    public function assign(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:assign']])] RequestDto $dto, AssignAction $action): JsonResponse
    {
        return $this->json(['success' => $action($dto)]);
    }

    #[Route(path: '/article-attributes', methods: ['GET'])]
    public function article(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:article_attributes']])] RequestDto $dto, ArticleAttributeAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_nomenclature:article_attributes']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['web_nomenclature:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }

    #[Route(path: '/{multiStoreId<\d+>}/client-article/{article}', methods: ['GET'])]
    public function clientArticleAttributeIndex(
        int $multiStoreId,
        string $article,
        ClientArticleAttributeIndexAction $action
    ): JsonResponse {
        return $this->json($action($multiStoreId, $article), context: ['groups' => ['web_nomenclature:client_article']]);
    }

    #[Route(path: '/{multiStoreId<\d+>}/client-article/{article}', methods: ['POST'])]
    public function clientArticleAttributeCreate(
        int $multiStoreId,
        string $article,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article']])] RequestDto $dto,
        ClientArticleAttributeCreateAction $action
    ): JsonResponse {
        return $this->json($action($multiStoreId, $article, $dto), context: ['groups' => ['web_nomenclature:client_article']]);
    }

    #[Route(path: '/{multiStoreId<\d+>}/client-article/{article}/attribute/{attributeId<\d+>}', methods: ['PATCH'])]
    public function clientArticleAttributeUpdate(
        int $multiStoreId,
        string $article,
        int $attributeId,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article']])] RequestDto $dto,
        ClientArticleAttributeUpdateAction $action
    ): JsonResponse {
        return $this->json($action($multiStoreId, $article, $attributeId, $dto), context: ['groups' => ['web_nomenclature:client_article']]);
    }

    #[Route(path: '/{multiStoreId<\d+>}/client-article/{article}/attribute/{attributeId<\d+>}', methods: ['DELETE'])]
    public function clientArticleAttributeDelete(
        int $multiStoreId,
        string $article,
        int $attributeId,
        ClientArticleAttributeDeleteAction $action
    ): JsonResponse {
        return $this->json(['success' => $action($multiStoreId, $article, $attributeId)]);
    }

    #[Route(path: '/{id<\d+>}/client-article-value', methods: ['GET'])]
    public function clientArticleAttributeValueIndex(
        int $id,
        ClientArticleAttributeValueIndexAction $action
    ): JsonResponse {
        return $this->json($action($id), context: ['groups' => ['web_nomenclature:client_article_value_index']]);
    }

    #[Route(path: '/{id<\d+>}/client-article-value', methods: ['POST'])]
    public function clientArticleAttributeValueCreate(
        int $id,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article_value_create']])] RequestDto $dto,
        ClientArticleAttributeValueCreateAction $action
    ): JsonResponse {
        return $this->json($action($id, $dto), context: ['groups' => ['web_nomenclature:client_article_value']]);
    }

    #[Route(path: '/{id<\d+>}/client-article-value/{valueId<\d+>}', methods: ['PATCH'])]
    public function clientArticleAttributeValueUpdate(
        int $id,
        int $valueId,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article_value_update']])] RequestDto $dto,
        ClientArticleAttributeValueUpdateAction $action
    ): JsonResponse {
        return $this->json($action($id, $valueId, $dto), context: ['groups' => ['web_nomenclature:client_article_value']]);
    }

    #[Route(path: '/{id<\d+>}/client-article-value/{valueId<\d+>}', methods: ['DELETE'])]
    public function clientArticleAttributeValueDelete(
        int $id,
        int $valueId,
        ClientArticleAttributeValueDeleteAction $action
    ): JsonResponse {
        return $this->json(['success' => $action($id, $valueId)]);
    }
}

<?php

namespace App\Controller;

use App\Action\MediaObject\UploadAction;
use App\Action\MediaObject\UploadsAction;
use App\Dto\MediaObject\IndexDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route(path: '/api/media-objects', format: 'json')]
#[OA\Tag(name: 'MediaObject')]
class MediaObjectController extends AbstractController
{
    #[Route(path: '', methods: ['POST'])]
    #[OA\Post(
        summary: 'Upload a file',
        requestBody: new OA\RequestBody(
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'file',
                            type: 'string',
                            format: 'binary',
                            description: 'The file to upload'
                        ),
                    ]
                )
            ),
            required: true
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'File successfully uploaded.',
                content: new Model(type: IndexDto::class)
            ),
            new OA\Response(
                response: 400,
                description: 'File upload failed.',
                content: new OA\JsonContent(
                    type: 'string',
                    example: 'File upload failed.'
                )
            ),
        ]
    )]
    public function upload(
        #[MapUploadedFile(constraints: [
            new Assert\NotBlank(),
            new Assert\File(
                maxSize: '10M',
                extensions: ['png', 'jpg', 'jpeg', 'webp', 'pdf', 'xlsx', 'docx', 'doc', 'xls']
            ),
        ])] UploadedFile $file,
        UploadAction $action
    ): JsonResponse {
        return $this->successResponse($action($file), Response::HTTP_CREATED);
    }

    #[Route(path: '/uploads', methods: ['POST'])]
    #[OA\Post(
        summary: 'Upload a files',
        requestBody: new OA\RequestBody(
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'files[]',
                            type: 'array',
                            items: new OA\Items(
                                type: 'string',
                                format: 'binary'
                            ),
                            description: 'Multiple files'
                        ),
                    ],
                    required: ['files[]']
                )
            ),
            required: true
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'File successfully uploaded.',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: new Model(type: IndexDto::class))
                )
            ),
            new OA\Response(
                response: 400,
                description: 'File upload failed.',
                content: new OA\JsonContent(
                    type: 'string',
                    example: 'File upload failed.'
                )
            ),
        ]
    )]
    public function uploads(Request $request, UploadsAction $action): JsonResponse
    {
        return $this->successResponse($action($request->files->get('files', [])), Response::HTTP_CREATED);
    }
}

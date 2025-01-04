<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Base\ListResponseDtoInterface;
use App\Validator\Exists;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private SerializerInterface $serializer;

    public function __construct(private ValidatorInterface $validator)
    {
        $this->serializer = new Serializer([new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())], [new JsonEncoder()]);
    }

    public function successResponse(object|array|null $content, int $status = Response::HTTP_OK): JsonResponse
    {
        $data = [
            'data' => $content ?? [],
        ];

        return $this->serializeAndSend($data, $status);
    }

    public function emptyResponse(int $status = Response::HTTP_NO_CONTENT): JsonResponse
    {
        return new JsonResponse(data: '{}', status: $status, json: true);
    }

    public function indexResponse(ListResponseDtoInterface $data, int $status = Response::HTTP_OK): JsonResponse
    {
        return $this->serializeAndSend($data, $status);
    }

    public function errorResponse(array $errors = [], int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $data = [
            'error' => $errors,
        ];

        return $this->serializeAndSend($data, $status);
    }

    private function serializeAndSend(mixed $data, int $status): JsonResponse
    {
        return new JsonResponse(data: $this->serializer->serialize($data, 'json'), status: $status, json: true);
    }

    public function validate(mixed $payload, Constraint|array|null $constraints = null): void
    {
        $fields = is_array($payload) ? $payload : [$payload];
        $constraints = is_array($constraints) ? $constraints : [$constraints];

        foreach ($fields as $key => $field) {
            $violations = $this->validator->validate($field, $constraints[$key] ?? null);
            
            if ($violations->count()) {
                throw new ValidationFailedException($field, $violations);
            }
        }
    }

    public function existsValidate(mixed $payload, array|string $entities): void
    {
        $fields = is_array($payload) ? $payload : [$payload];
        $entities = is_array($entities) ? $entities : [$entities];

        foreach ($fields as $key => $field) {
            $violations = $this->validator->validate($field, new Exists($entities[$key]));
            
            if ($violations->count()) {
                throw new ValidationFailedException($field, $violations);
            }
        }
    }
}

<?php

namespace App\Action\CashboxPayment;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\CashboxPayment\IndexDto;
use App\Dto\CashboxPayment\RequestQueryDto;
use App\Entity\CashboxPayment;
use App\Exception\ErrorException;
use App\Repository\CashboxPaymentRepository;

class IndexAction
{
    public function __construct(
        private CashboxPaymentRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = match (true) {
            $dto->cashboxDetailId && $dto->paymentTypeId => $this->repo->findAllCashboxPaymentsWithJoined($dto),
            $dto->cashboxId && $dto->paymentTypeId => $this->repo->findAllCashboxPaymentsByPaymentType($dto),
            is_int($dto->cashboxDetailId) => $this->repo->findAllCashboxPaymentsByCashboxDetail($dto),
            default => throw new ErrorException('CashboxPayment', 'not found')
        };

        $data = $paginator->getData();

        array_walk_recursive($data, function (CashboxPayment &$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto(
            data: $data,
            pagination: $paginator->getPagination(),
        );
    }
}

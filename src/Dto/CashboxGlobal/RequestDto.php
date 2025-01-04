<?php

namespace App\Dto\CashboxGlobal;

use App\Dto\CashboxGlobal\UpdateRequestDto;
use App\Entity\CashboxDetail;
use App\Exception\ErrorException;
use App\Validator\Exists;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    /**
     * @param UpdateRequestDto[] $items
     */
    public function __construct(
        #[Groups(['cashbox_global:create'])]
        #[Assert\NotBlank(groups: ['cashbox_global:create'])]
        #[Exists(CashboxDetail::class)]
        public ?int $cashboxDetailId,
        #[Groups(['cashbox_global:create'])]
        #[Assert\Valid()]
        #[Assert\All(constraints: [new Assert\Type(type: UpdateRequestDto::class)])]
        private array $items
    ) {}
    
    public function getItems(): ?array
    {
        return $this->mapItems($this->items);
    }

    private function mapItems(array $items): array
    {
        try {
            return array_map(function ($item) {
                return new UpdateRequestDto(
                    $item['nomenclatureId'],
                    $item['qty'],
                    $item['oldPrice'],
                    $item['price'],
                    $item['oldPriceCourse'],
                    $item['priceCourse'],
                    $item['nds'],
                    $item['ndsSum'],
                    $item['discount'],
                    $item['discountSum'],
                );
            }, $items);
        } catch (\Throwable $th) {
            throw new ErrorException(path: 'Nomenclature', message: 'Id should be int, null given', code: Response::HTTP_BAD_REQUEST);
        }
    }
}

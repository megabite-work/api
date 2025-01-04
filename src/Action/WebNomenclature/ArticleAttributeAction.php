<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ArticleAttribute;
use App\Repository\ArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAttributeAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ArticleAttributeRepository $articleAttributeRepository
    ) {
    }

    public function __invoke(RequestDto $dto): ArticleAttribute
    {
        $entity = $this->articleAttributeRepository->findByMultiStoreAndArticle($dto);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}

<?php

namespace App\Action\Favorite;

use App\Entity\User;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $webNomenclatureId, User $user): void
    {
        $webNomenclature = $this->em->getReference(WebNomenclature::class, $webNomenclatureId);
        $user->addFavorite($webNomenclature);
        $this->em->flush();
    }
}

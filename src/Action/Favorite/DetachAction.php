<?php

namespace App\Action\Favorite;

use App\Entity\User;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DetachAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $webNomenclatureId, User $user): void
    {
        $webNomenclature = $this->em->getReference(WebNomenclature::class, $webNomenclatureId);
        $user->removeFavorite($webNomenclature);
        $this->em->flush();
    }
}

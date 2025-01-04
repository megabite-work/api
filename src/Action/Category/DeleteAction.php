<?php

namespace App\Action\Category;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(int $id): void
    {
        $category = $this->em->find(Category::class, $id);
        $this->em->remove($category);
        $this->em->flush();
    }
}

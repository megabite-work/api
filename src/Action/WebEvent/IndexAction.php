<?php

namespace App\Action\WebEvent;

use App\Component\Paginator;
use App\Dto\WebEvent\RequestQueryDto;
use App\Repository\WebEventRepository;

class IndexAction
{
    public function __construct(private WebEventRepository $repo)
    {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebEventsByMultiStore($dto);
    }
}

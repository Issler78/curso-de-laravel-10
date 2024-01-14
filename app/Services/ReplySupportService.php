<?php

namespace App\Services;

use App\DTO\Replies\CreateReplyDTO;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class ReplySupportService
{
    public function __construct(
        protected ReplyRepositoryInterface $repository
    ){}

    public function getAllBySupport(string $supportId): array
    {
        return $this->repository->getAllBySupport($supportId);
    }

    public function createNew(CreateReplyDTO $dto): stdClass
    {
        
        return $this->repository->createNew($dto);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
<?php

namespace App\Repositories\Eloquent;

use App\DTO\Replies\CreateReplyDTO;
use App\Models\ReplySupport;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use stdClass;

class ReplySupportRepository implements ReplyRepositoryInterface
{
    public function __construct(
        protected ReplySupport $model
    ){}

    public function getAllBySupport(string $supportId): array
    {
        $replies = $this->model
                        ->with(['support', 'user'])
                        ->where('support_id', $supportId)->get();

        return $replies->toArray();
    }
    public function createNew(CreateReplyDTO $dto): stdClass
    {
        $NewReply = $this->model->with('user', 'support')->create([
            'content' => $dto->content,
            'support_id' => $dto->supportId,
            'user_id' => Auth::user()->id,
        ]);

        $reply = $this->model->where('id' ,$NewReply->id)->with('user', 'support')->first();

        return (object) $reply->toArray();
    }

    public function delete(string $id): bool
    {
        if (!$reply = $this->model->find($id))
        {
            return false;
        }

        if (Gate::denies('owner', $reply->user->id))
        {
            abort(403, 'Not Authorized');
        }

        return $reply->delete();
    }
}

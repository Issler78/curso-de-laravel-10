<?php

namespace App\Http\Controllers\Api;

use App\DTO\Replies\CreateReplyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $Supportservice,
        protected ReplySupportService $replyService
    ) {}

    public function getRepliesFromSupport(string $support_id)
    {
        if(!$this->Supportservice->findOne($support_id))
        {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $replies = $this->replyService->getAllBySupport($support_id);
        
        return ReplySupportResource::collection($replies);
    }

    public function createNewReply(StoreReplySupportRequest $request)
    {
        $reply = $this->replyService->createNew(
            CreateReplyDTO::makeFromRequest($request)
        );

        return new ReplySupportResource($reply);
    }
}

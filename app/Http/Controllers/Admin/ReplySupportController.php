<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Replies\CreateReplyDTO;
use App\Http\Controllers\Controller;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $Supportservice,
        protected ReplySupportService $replyService
    ) {}

    public function index(string $id)
    {
        if(!$support = $this->Supportservice->findOne($id))
        {
            return redirect()->back();
        }

        $replies = $this->replyService->getAllBySupport($id);
        
        return view('admin.supports.replies.replies', compact('support', 'replies'));
    }

    public function store(Request $request)
    {
        $this->replyService->createNew(
            CreateReplyDTO::makeFromRequest($request)
        );

        return redirect()->route('replies.index', $request->support_id)->with('message', 'Mensagem Enviada!');
    }

    public function destroy(string $supportId ,string $id)
    {
        $this->replyService->delete($id);

        return redirect()->route('replies.index', $supportId)->with('message', 'Resposta Deletada com Sucesso!');
    }
}

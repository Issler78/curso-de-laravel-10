<?php

namespace App\Http\Controllers\Admin;

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
        dd($replies);
        
        return view('admin.supports.replies.replies', compact('support', 'replies'));
    }
}

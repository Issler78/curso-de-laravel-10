<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin.supports.index', compact('supports'));
    }



    public function show(string|int $id)
    {

        //Support::where('id', '=', $id)->first();

        if(!$support = Support::find($id))
        {
            return redirect()->back();
        }

        return view('admin.supports.show', compact('support'));
    }



    public function create()
    {
        return view('admin.supports.create');
    }



    public function store(StoreUpdateSupportRequest $request, Support $support)
    {
        $data = $request->validated();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }



    public function edit(Support $support ,string|int $id)
    {
        if(!$support = $support->where('id' ,$id)->first())
        {
            return redirect()->back();
        }

        return view('admin.supports.edit', compact('support'));
    }



    public function update(StoreUpdateSupportRequest $request, Support $support, string|int $id)
    {
        if(!$support = $support->find($id))
        {
            return redirect()->back();
        }

        $support->update($request->validated());

        return redirect()->route('supports.index');
    }



    public function destroy(Support $support ,string|int $id)
    {
        if(!$support = $support->find($id)->first())
        {
            return redirect()->back();
        }

        $support->delete();

        return redirect()->route('supports.index');
    }
}

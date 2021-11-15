<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;

class ContractsController extends Controller
{
    public function index()
    {
        $contracts = Contract::all();
        return view('admin.contracts.index', compact('contracts'));
    }

    public function create()
    {
        return view('admin.contracts.create');
    }

    public function store(StoreContractRequest $request)
    {
        Contract::create($request->all());
        return redirect(route('contracts.index'));
    }

    public function show(Contract $contract)
    {
        return view('admin.contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        return view('admin.contracts.edit', compact('contract'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());
        return redirect(route('contracts.show',$contract));
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect(route('contracts.index'));
    }
}

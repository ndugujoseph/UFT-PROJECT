<?php

namespace App\Http\Controllers\Admin;

use App\AgentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgentPaymentRequest;
use App\Http\Requests\Admin\UpdateAgentPaymentRequest;

class AgentPaymentController extends Controller
{
    /**
     * Display a listing of AgentPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('agent_payments_access')) {
            return abort(401);
        }


                $agent_payments = AgentPayment::all();

        return view('admin.agent_payments.index', compact('agent_payments'));
    }

    /**
     * Show the form for creating new AgentPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('agent_payments_create')) {
            return abort(401);
        }
        return view('admin.agent_payments.create');
    }

    /**
     * Store a newly created AgentPayment in storage.
     *
     * @param  \App\Http\Requests\StoreAgentPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgentPaymentRequest $request)
    {
        if (! Gate::allows('agent_payments_create')) {
            return abort(401);
        }
        $agent_payments = AgentPayment::create($request->all());



        return redirect()->route('admin.agent_payments.index');
    }


    /**
     * Show the form for editing AgentPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('agent_payments_edit')) {
            return abort(401);
        }
        $agent_payments = AgentPayment::findOrFail($id);

        return view('admin.agent_payments.edit', compact('agent_payments'));
    }

    /**
     * Update AgentPayment in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentPaymentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentPaymentRequest $request, $id)
    {
        if (! Gate::allows('agent_payments_edit')) {
            return abort(401);
        }
        $agent_payments = AgentPayment::findOrFail($id);
        $agent_payments->update($request->all());



        return redirect()->route('admin.agent_payments.index');
    }


    /**
     * Display AgentPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('agent_payments_view')) {
            return abort(401);
        }
        $agent_payments = AgentPayment::findOrFail($id);

        return view('admin.agent_payments.show', compact('agent_payments'));
    }


    /**
     * Remove AgentPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('agent_payments_delete')) {
            return abort(401);
        }
        $agent_payments = AgentPayment::findOrFail($id);
        $agent_payments->delete();

        return redirect()->route('admin.agent_payments.index');
    }

    /**
     * Delete all selected AgentPayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('agent_payments_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AgentPayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}

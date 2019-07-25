<?php

namespace App\Http\Controllers\Admin;

use App\AgentHeadPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgentHeadPaymentRequest;
use App\Http\Requests\Admin\UpdateAgentHeadPaymentRequest;

class AgentHeadPaymentController extends Controller
{
    /**
     * Display a listing of AgentHeadPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('agent_head_payment_access')) {
            return abort(401);
        }


                $agent_head_payment = AgentHeadPayment::all();

        return view('admin.agent_head_payment.index', compact('agent_head_payment'));
    }

    /**
     * Show the form for creating new AgentHeadPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('agent_head_payment_create')) {
            return abort(401);
        }
        return view('admin.agent_head_payment.create');
    }

    /**
     * Store a newly created AgentHeadPayment in storage.
     *
     * @param  \App\Http\Requests\StoreAgentHeadPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgentHeadPaymentRequest $request)
    {
        if (! Gate::allows('agent_head_payment_create')) {
            return abort(401);
        }
        $agent_head_payment = AgentHeadPayment::create($request->all());



        return redirect()->route('admin.agent_head_payment.index');
    }


    /**
     * Show the form for editing AgentHeadPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('agent_head_payment_edit')) {
            return abort(401);
        }
        $agent_head_payment = AgentHeadPayment::findOrFail($id);

        return view('admin.agent_head_payment.edit', compact('agent_head_payment'));
    }

    /**
     * Update AgentHeadPayment in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentHeadPaymentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentHeadPaymentRequest $request, $id)
    {
        if (! Gate::allows('agent_head_payment_edit')) {
            return abort(401);
        }
        $agent_head_payment = AgentHeadPayment::findOrFail($id);
        $agent_head_payment->update($request->all());



        return redirect()->route('admin.agent_head_payment.index');
    }


    /**
     * Display AgentHeadPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('agent_head_payment_view')) {
            return abort(401);
        }
        $agent_head_payment = AgentHeadPayment::findOrFail($id);

        return view('admin.agent_head_payment.show', compact('agent_head_payment'));
    }


    /**
     * Remove AgentHeadPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('agent_head_payment_delete')) {
            return abort(401);
        }
        $agent_head_payment = AgentHeadPayment::findOrFail($id);
        $agent_head_payment->delete();

        return redirect()->route('admin.agent_head_payment.index');
    }

    /**
     * Delete all selected AgentHeadPayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('agent_head_payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AgentHeadPayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}

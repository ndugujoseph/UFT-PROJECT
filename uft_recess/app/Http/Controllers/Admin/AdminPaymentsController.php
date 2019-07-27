<?php

namespace App\Http\Controllers\Admin;

use App\AdminPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminPaymentsRequest;
use App\Http\Requests\Admin\UpdateAdminPaymentsRequest;

class AdminPaymentsController extends Controller
{
    /**
     * Display a listing of AdminPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('admin_payment_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('admin_payment_delete')) {
                return abort(401);
            }
            $admin_payments = AdminPayment::onlyTrashed()->get();
        } else {
            $admin_payments = AdminPayment::all();
        }

        return view('admin.admin_payments.index', compact('admin_payments'));
    }

    /**
     * Show the form for creating new AdminPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('admin_payment_create')) {
            return abort(401);
        }
        return view('admin.admin_payments.create');
    }

    /**
     * Store a newly created AdminPayment in storage.
     *
     * @param  \App\Http\Requests\StoreAdminPaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminPaymentsRequest $request)
    {
        if (! Gate::allows('admin_payment_create')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::create($request->all());



        return redirect()->route('admin.admin_payments.index');
    }


    /**
     * Show the form for editing AdminPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('admin_payment_edit')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::findOrFail($id);

        return view('admin.admin_payments.edit', compact('admin_payment'));
    }

    /**
     * Update AdminPayment in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminPaymentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminPaymentsRequest $request, $id)
    {
        if (! Gate::allows('admin_payment_edit')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::findOrFail($id);
        $admin_payment->update($request->all());



        return redirect()->route('admin.admin_payments.index');
    }


    /**
     * Display AdminPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('admin_payment_view')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::findOrFail($id);

        return view('admin.admin_payments.show', compact('admin_payment'));
    }


    /**
     * Remove AdminPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('admin_payment_delete')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::findOrFail($id);
        $admin_payment->delete();

        return redirect()->route('admin.admin_payments.index');
    }

    /**
     * Delete all selected AdminPayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('admin_payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AdminPayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore AdminPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('admin_payment_delete')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::onlyTrashed()->findOrFail($id);
        $admin_payment->restore();

        return redirect()->route('admin.admin_payments.index');
    }

    /**
     * Permanently delete AdminPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('admin_payment_delete')) {
            return abort(401);
        }
        $admin_payment = AdminPayment::onlyTrashed()->findOrFail($id);
        $admin_payment->forceDelete();

        return redirect()->route('admin.admin_payments.index');
    }
}

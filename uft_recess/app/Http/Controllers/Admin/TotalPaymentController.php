<?php

namespace App\Http\Controllers\Admin;

use App\TotalPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTotalPaymentRequest;
use App\Http\Requests\Admin\UpdateTotalPaymentRequest;

class TotalPaymentController extends Controller
{
    /**
     * Display a listing of TotalPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('total_payment_access')) {
            return abort(401);
        }


                $total_payment = TotalPayment::all();

        return view('admin.total_payment.index', compact('total_payment'));
    }

    /**
     * Show the form for creating new TotalPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('total_payment_create')) {
            return abort(401);
        }
        return view('admin.total_payment.create');
    }

    /**
     * Store a newly created TotalPayment in storage.
     *
     * @param  \App\Http\Requests\StoreTotalPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTotalPaymentRequest $request)
    {
        if (! Gate::allows('total_payment_create')) {
            return abort(401);
        }
        $total_payment = TotalPayment::create($request->all());



        return redirect()->route('admin.total_payment.index');
    }


    /**
     * Show the form for editing TotalPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('total_payment_edit')) {
            return abort(401);
        }
        $total_payment = TotalPayment::findOrFail($id);

        return view('admin.total_payment.edit', compact('total_payment'));
    }

    /**
     * Update TotalPayment in storage.
     *
     * @param  \App\Http\Requests\UpdateTotalPaymentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTotalPaymentRequest $request, $id)
    {
        if (! Gate::allows('total_payment_edit')) {
            return abort(401);
        }
        $total_payment = TotalPayment::findOrFail($id);
        $total_payment->update($request->all());



        return redirect()->route('admin.total_payment.index');
    }


    /**
     * Display TotalPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('total_payment_view')) {
            return abort(401);
        }
        $total_payment = TotalPayment::findOrFail($id);

        return view('admin.total_payment.show', compact('total_payment'));
    }


    /**
     * Remove TotalPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('total_payment_delete')) {
            return abort(401);
        }
        $total_payment = TotalPayment::findOrFail($id);
        $total_payment->delete();

        return redirect()->route('admin.total_payment.index');
    }

    /**
     * Delete all selected TotalPayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('total_payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TotalPayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}

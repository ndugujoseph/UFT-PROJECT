<?php

namespace App\Http\Controllers\Admin;

use App\WellWishers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWellWishersRequest;
use App\Http\Requests\Admin\UpdateWellWishersRequest;
use Illuminate\Support\Facades\DB;

class WellWishersController extends Controller
{
    /**
     * Display a listing of WellWishers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('well_wishers_access')) {
            return abort(401);
        }


                $well_wishers = WellWishers::all();

        return view('admin.well_wishers.index', compact('well_wishers'));
    }

    /**
     * Show the form for creating new WellWishers.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('well_wishers_create')) {
            return abort(401);
        }
        
        $districts = \App\Districts::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.well_wishers.create', compact('districts'));
    }

    /**
     * Store a newly created WellWishers in storage.
     *
     * @param  \App\Http\Requests\StoreWellWishersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWellWishersRequest $request)
    {
        if (! Gate::allows('well_wishers_create')) {
            return abort(401);
        }
        $well_wishers = WellWishers::create($request->all());
        
        
        return redirect()->route('admin.well_wishers.index');
    }


    /**
     * Show the form for editing WellWishers.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('well_wishers_edit')) {
            return abort(401);
        }
        
        $districts = \App\Districts::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $well_wishers = WellWishers::findOrFail($id);

        return view('admin.well_wishers.edit', compact('well_wishers', 'districts'));
    }

    /**
     * Update WellWishers in storage.
     *
     * @param  \App\Http\Requests\UpdateWellWishersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWellWishersRequest $request, $id)
    {
        if (! Gate::allows('well_wishers_edit')) {
            return abort(401);
        }
        $well_wishers = WellWishers::findOrFail($id);
        $well_wishers->update($request->all());

          

        return redirect()->route('admin.well_wishers.index');
    }


    /**
     * Display WellWishers.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('well_wishers_view')) {
            return abort(401);
        }
        
        
        $well_wishers = WellWishers::findOrFail($id);

        return view('admin.well_wishers.show', compact('well_wishers'));
    }


    /**
     * Remove WellWishers from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('well_wishers_delete')) {
            return abort(401);
        }
        $well_wishers = WellWishers::findOrFail($id);
        $well_wishers->delete();

        return redirect()->route('admin.well_wishers.index');
    }

    /**
     * Delete all selected WellWishers at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('well_wishers_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = WellWishers::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}

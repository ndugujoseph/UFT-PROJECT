<?php

namespace App\Http\Controllers\Admin;

use App\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDistrictsRequest;
use App\Http\Requests\Admin\UpdateDistrictsRequest;



class DistrictsController extends Controller
{
    /**
     * Display a listing of Districts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('districts_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('districts_delete')) {
                return abort(401);
            }
            $districts = Districts::onlyTrashed()->get();
        } else {
            $districts = Districts::all();
        }

        return view('admin.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating new Districts.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('districts_create')) {
            return abort(401);
        }
        return view('admin.districts.create');
    }

    /**
     * Store a newly created Districts in storage.
     *
     * @param  \App\Http\Requests\StoreDistrictsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistrictsRequest $request)
    {
        if (! Gate::allows('districts_create')) {
            return abort(401);
        }
        $districts = Districts::create($request->all());

       


        return redirect()->route('admin.districts.index');
    }


    /**
     * Show the form for editing Districts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('districts_edit')) {
            return abort(401);
        }
        $districts = Districts::findOrFail($id);

        

        return view('admin.districts.edit', compact('districts'));
    }

    /**
     * Update Districts in storage.
     *
     * @param  \App\Http\Requests\UpdateDistrictsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistrictsRequest $request, $id)
    {
        if (! Gate::allows('districts_edit')) {
            return abort(401);
        }
        $districts = Districts::findOrFail($id);
        $districts->update($request->all());

    
        return redirect()->route('admin.districts.index');
    }


    /**
     * Display Districts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('districts_view')) {
            return abort(401);
        }
        $districts = Districts::findOrFail($id);

        return view('admin.districts.show', compact('districts'));
    }


    /**
     * Remove Districts from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('districts_delete')) {
            return abort(401);
        }
        $districts = Districts::findOrFail($id);
        $districts->delete();

        return redirect()->route('admin.districts.index');
    }

    /**
     * Delete all selected Districts at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('districts_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Districts::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Districts from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('districts_delete')) {
            return abort(401);
        }
        $districts = Districts::onlyTrashed()->findOrFail($id);
        $districts->restore();

        return redirect()->route('admin.districts.index');
    }

    /**
     * Permanently delete Districts from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('districts_delete')) {
            return abort(401);
        }
        $districts = Districts::onlyTrashed()->findOrFail($id);
        $districts->forceDelete();

        return redirect()->route('admin.districts.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Tresuary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTresuariesRequest;
use App\Http\Requests\Admin\UpdateTresuariesRequest;

class TresuariesController extends Controller
{
    /**
     * Display a listing of Tresuary.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         $tresuaries = DB::select('select date,amount from crm_customers');
         return view('index',['tresuaries'=>$tresuaries]);*/

     
        if (! Gate::allows('tresuary_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('tresuary_delete')) {
                return abort(401);
            }
            $tresuaries = Tresuary::onlyTrashed()->get();
        } else {
            $tresuaries = Tresuary::all();
        }

        return view('admin.tresuaries.index', compact('tresuaries')); 
    }

    /**
     * Show the form for creating new Tresuary.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('tresuary_create')) {
            return abort(401);
        }
        return view('admin.tresuaries.create');
    }

    /**
     * Store a newly created Tresuary in storage.
     *
     * @param  \App\Http\Requests\StoreTresuariesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTresuariesRequest $request)
    {
        if (! Gate::allows('tresuary_create')) {
            return abort(401);
        }
        $tresuary = Tresuary::create($request->all());



        return redirect()->route('admin.tresuaries.index');
    }


    /**
     * Show the form for editing Tresuary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('tresuary_edit')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);

        return view('admin.tresuaries.edit', compact('tresuary'));
    }

    /**
     * Update Tresuary in storage.
     *
     * @param  \App\Http\Requests\UpdateTresuariesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTresuariesRequest $request, $id)
    {
        if (! Gate::allows('tresuary_edit')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);
        $tresuary->update($request->all());



        return redirect()->route('admin.tresuaries.index');
    }


    /**
     * Display Tresuary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('tresuary_view')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);

        return view('admin.tresuaries.show', compact('tresuary'));
    }


    /**
     * Remove Tresuary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);
        $tresuary->delete();

        return redirect()->route('admin.tresuaries.index');
    }

    /**
     * Delete all selected Tresuary at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Tresuary::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Tresuary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        $tresuary = Tresuary::onlyTrashed()->findOrFail($id);
        $tresuary->restore();

        return redirect()->route('admin.tresuaries.index');
    }

    /**
     * Permanently delete Tresuary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        $tresuary = Tresuary::onlyTrashed()->findOrFail($id);
        $tresuary->forceDelete();

        return redirect()->route('admin.tresuaries.index');
    }
}

/*<script>
namespace App\Http\Controllers\Admin;

use App\Tresuary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTresuariesRequest;
use App\Http\Requests\Admin\UpdateTresuariesRequest;

class TresuariesController extends Controller
{
    /**
     * Display a listing of Tresuary.
     *
     * @return \Illuminate\Http\Response
     *//*
    public function index()
    {
        if (! Gate::allows('tresuary_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('tresuary_delete')) {
                return abort(401);
            }
            $tresuaries = Tresuary::onlyTrashed()->get();
        } else {
            $tresuaries = Tresuary::all();
        }

        return view('admin.tresuaries.index', compact('tresuaries'));
    }

    /**
     * Show the form for creating new Tresuary.
     *
     * @return \Illuminate\Http\Response
     *//*
    public function create()
    {
        if (! Gate::allows('tresuary_create')) {
            return abort(401);
        }
        
        $amounts = \App\WellWishers::get()->pluck('amount', 'id');


        return view('admin.tresuaries.create', compact('amounts'));
    }

    /**
     * Store a newly created Tresuary in storage.
     *//*
     * @param  \App\Http\Requests\StoreTresuariesRequest  $request
     * @return \Illuminate\Http\Response
     *//*
    public function store(StoreTresuariesRequest $request)
    {
        if (! Gate::allows('tresuary_create')) {
            return abort(401);
        }
        $tresuary = Tresuary::create($request->all());
        $tresuary->amount()->sync(array_filter((array)$request->input('amount')));



        return redirect()->route('admin.tresuaries.index');
    }


    /**
     * Show the form for editing Tresuary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function edit($id)
    {
        if (! Gate::allows('tresuary_edit')) {
            return abort(401);
        }
        
        $amounts = \App\WellWishers::get()->pluck('amount', 'id');


        $tresuary = Tresuary::findOrFail($id);

        return view('admin.tresuaries.edit', compact('tresuary', 'amounts'));
    }

    /**
     * Update Tresuary in storage.
     *
     * @param  \App\Http\Requests\UpdateTresuariesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function update(UpdateTresuariesRequest $request, $id)
    {
        if (! Gate::allows('tresuary_edit')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);
        $tresuary->update($request->all());
        $tresuary->amount()->sync(array_filter((array)$request->input('amount')));



        return redirect()->route('admin.tresuaries.index');
    }


    /**
     * Display Tresuary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function show($id)
    {
        if (! Gate::allows('tresuary_view')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);

        return view('admin.tresuaries.show', compact('tresuary'));
    }


    /**
     * Remove Tresuary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function destroy($id)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        $tresuary = Tresuary::findOrFail($id);
        $tresuary->delete();

        return redirect()->route('admin.tresuaries.index');
    }

    /**
     * Delete all selected Tresuary at once.
     *
     * @param Request $request
     *//*
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Tresuary::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Tresuary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function restore($id)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        $tresuary = Tresuary::onlyTrashed()->findOrFail($id);
        $tresuary->restore();

        return redirect()->route('admin.tresuaries.index');
    }

    /**
     * Permanently delete Tresuary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function perma_del($id)
    {
        if (! Gate::allows('tresuary_delete')) {
            return abort(401);
        }
        $tresuary = Tresuary::onlyTrashed()->findOrFail($id);
        $tresuary->forceDelete();

        return redirect()->route('admin.tresuaries.index');
    }
}</script>*/

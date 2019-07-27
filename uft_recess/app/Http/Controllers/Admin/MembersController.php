<?php

namespace App\Http\Controllers\Admin;

use App\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMembersRequest;
use App\Http\Requests\Admin\UpdateMembersRequest;

class MembersController extends Controller
{
    /**
     * Display a listing of Members.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('members_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('members_delete')) {
                return abort(401);
            }
            $members = Members::onlyTrashed()->get();
        } else {
            $members = Members::all();
        }

        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating new Members.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('members_create')) {
            return abort(401);
        }
        return view('admin.members.create');
    }

    /**
     * Store a newly created Members in storage.
     *
     * @param  \App\Http\Requests\StoreMembersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembersRequest $request)
    {
        if (! Gate::allows('members_create')) {
            return abort(401);
        }
        $members = Members::create($request->all());



        return redirect()->route('admin.members.index');
    }


    /**
     * Show the form for editing Members.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('members_edit')) {
            return abort(401);
        }
        $members = Members::findOrFail($id);

        return view('admin.members.edit', compact('members'));
    }

    /**
     * Update Members in storage.
     *
     * @param  \App\Http\Requests\UpdateMembersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembersRequest $request, $id)
    {
        if (! Gate::allows('members_edit')) {
            return abort(401);
        }
        $members = Members::findOrFail($id);
        $members->update($request->all());



        return redirect()->route('admin.members.index');
    }


    /**
     * Display Members.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('members_view')) {
            return abort(401);
        }
        $members = Members::findOrFail($id);

        return view('admin.members.show', compact('members'));
    }


    /**
     * Remove Members from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('members_delete')) {
            return abort(401);
        }
        $members = Members::findOrFail($id);
        $members->delete();

        return redirect()->route('admin.members.index');
    }

    /**
     * Delete all selected Members at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('members_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Members::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Members from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('members_delete')) {
            return abort(401);
        }
        $members = Members::onlyTrashed()->findOrFail($id);
        $members->restore();

        return redirect()->route('admin.members.index');
    }

    /**
     * Permanently delete Members from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('members_delete')) {
            return abort(401);
        }
        $members = Members::onlyTrashed()->findOrFail($id);
        $members->forceDelete();

        return redirect()->route('admin.members.index');
    }
}

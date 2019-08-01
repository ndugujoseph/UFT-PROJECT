<?php

namespace App\Http\Controllers\Admin;

use App\Agents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAgentRequest;
use App\Http\Requests\Admin\StoreAgentsRequest;
use App\Http\Requests\Admin\UpdateAgentsRequest;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Arr;

class AgentsController extends Controller
{
    
 
    /**
     * Display a listing of Agents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('agents_access')) {
            return abort(401);
        }


                $agents = Agents::all();

        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating new Agents.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('agents_create')) {
            return abort(401);
        }

        return view('admin.agents.create');
    }

    /**
     * Store a newly created Agents in storage.
     *
     * @param  \App\Http\Requests\CraeteAgentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAgentRequest $request)
    {
        if (! Gate::allows('agents_create')) {
            return abort(401);
        }

        $input = $request->all();
        
        $min = DB::table('districts')->min('agents');
        $minDistrict = DB::table('districts')
            ->where('agents',$min)
            ->pluck('id')
            ->first();
           
        if($min == 0){
            $minDistrict = ['district_id'=>$minDistrict,'role_id'=>3];
        }
        else{
            $minDistrict = ['district_id'=>$minDistrict,'role_id'=>2];

        }
        
        $input = array_merge($input,$minDistrict);
        $input = Arr::except($input,['_token','date_of_birth']);
        DB::table('agents')->UpdateorInsert($input);
         
       
        return redirect()->route('admin.agents.index');
    }


    /**
     * Show the form for editing Agents.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('agents_edit')) {
            return abort(401);
        }
        
       
        $agents = Agents::findOrFail($id);

        return view('admin.agents.edit', compact('agents'));
    }

    /**
     * Update Agents in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentsRequest $request, $id)
    {
        if (! Gate::allows('agents_edit')) {
            return abort(401);
        }
        $agents = Agents::findOrFail($id);
        $agents->update($request->all());



        return redirect()->route('admin.agents.index');
    }


    /**
     * Display Agents.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('agents_view')) {
            return abort(401);
        }
        $agents = Agents::findOrFail($id);

        return view('admin.agents.show', compact('agents'));
    }


    /**
     * Remove Agents from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('agents_delete')) {
            return abort(401);
        }
        $agents = Agents::findOrFail($id);
        $agents->delete();

        return redirect()->route('admin.agents.index');
    }

    /**
     * Delete all selected Agents at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('agents_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Agents::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
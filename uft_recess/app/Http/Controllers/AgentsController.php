<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgentsRequest;
use App\Agents;
use App\Http\Requests\CreateAgentRequest;
use App\Http\Requests\UpdateAgentsRequest;
use App\Repositories\AgentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Flash;
use Response;

class AgentsController extends Controller
{
    /** @var  AgentRepository */
    private $agentRepository;

    public function __construct(AgentRepository $agentRepo)
    {
        $this->agentRepository = $agentRepo;
    }

    /**
     * Display a listing of the Agent.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $agents = $this->agentRepository->all();

        return view('admin.agents.index')
            ->with('agents', $agents);
    }

    /**
     * Show the form for creating a new Agent.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created Agent in storage.
     *
     * @param CreateAgentRequest $request
     *
     * @return Response
     */
    public function store(CreateAgentRequest $request)
    {
        $input = $request->all();
        $min = DB::table('districts')->min('agents');
        $minDistrict = DB::table('districts')
            ->where('agents',$min)
            ->pluck('name')
            ->first();
        if($min == 0){
            $minDistrict = ['district'=>$minDistrict,'role'=>'Agent Head'];
        }
        else{
            $minDistrict = ['district'=>$minDistrict,'role'=>'Agent'];

        }

        $input = array_merge($input,$minDistrict);
        $agent = $this->agentRepository->create($input);

    

        return redirect(route('admin.agents.index'));
    }

    /**
     * Display the specified Agent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            // Flash::error('Agent not found');

            return redirect(route('admin.agents.index'));
        }

        return view('admin.agents.show')->with('agent', $agent);
    }

    /**
     * Show the form for editing the specified Agent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            // Flash::error('Agent not found');

            return redirect(route('agents.index'));
        }

        return view('admin.agents.edit')->with('agent', $agent);
    }

    /**
     * Update the specified Agent in storage.
     *
     * @param int $id
     * @param UpdateAgentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAgentRequest $request)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            // Flash::error('Agent not found');

            return redirect(route('admin.agents.index'));
        }

        $agent = $this->agentRepository->update($request->all(), $id);

        // Flash::success('Agent updated successfully.');

        return redirect(route('admin.agents.index'));
    }

    /**
     * Remove the specified Agent from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            // Flash::error('Agent not found');

            return redirect(route('admin.agents.index'));
        }

        $this->agentRepository->delete($id);

        // Flash::success('Agent deleted successfully.');

        return redirect(route('admin.agents.index'));
    }

}


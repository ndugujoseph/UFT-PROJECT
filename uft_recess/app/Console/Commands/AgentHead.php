<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AgentHead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agent-head';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $disID = DB::table('agents')->where('role_id',3)->distinct('district_id')->pluck('district_id');
        
        $agenthead = DB::table('agents')->where('role_id',3)->distinct('district_id')->pluck('full_name');
        
        DB::table('districts')->where('id',$disID)->update(['agent_head'=>$agenthead]);

    }

}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AgentRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agent:role';

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
        $min = DB::table('districts')->min('agents');
        $minDistrict = DB::table('districts')
        ->where('agents',$min)
        ->pluck('id')
        ->first();
        if($min == 0){
         $minDistrict = ['district_id'=>$minDistrict,'role'=>'Agent Head'];
                     }
      else{
         $minDistrict = ['district_id'=>$minDistrict,'role'=>'Agent'];

         }
    }
}



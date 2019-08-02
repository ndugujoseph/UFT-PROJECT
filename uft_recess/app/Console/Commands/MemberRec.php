<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MemberRec extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rec:number';

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
        $members = DB::table('members')->pluck('member_id');
        foreach($members as $member){
                $count = DB::table('members')
                    ->where('recommender_member',$member)
                    ->count();
                DB::table('members')
                    ->where('member_id',$member)
                    ->update(['recommendees'=>$count]);
        
    

        }
    }
}

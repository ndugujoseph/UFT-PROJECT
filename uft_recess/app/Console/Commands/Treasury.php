<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Treasury extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'treasury:update';

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
        $date = DB::table('well_wishers')->pluck('date');
        $amount = DB::table('well_wishers')->pluck('amount');
        $total = DB::table('well_wishers')->sum('amount');
        DB::table('tresuaries')->update(['date'=>$date,'amount'=>$amount,'total'=>$total]);
    }

}
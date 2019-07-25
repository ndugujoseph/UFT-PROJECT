<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MemberUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:upload';

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
    { /*
        \Log::info("Cron is working fine!");

        $this->info('');
        */
       $districts = DB::table('districts')->pluck('name');

       foreach($districts as $district){
            $rec = DB::table('members')->where('district',$district)->pluck('name');
            Storage::delete('recommender/'.$district.'.txt');
            foreach($rec as $recommender){
                Storage::append('recommender/'.$district.'.txt',$recommender);
            }

       }

                $files = Storage::files('/enrollments');
                foreach($files as $district){

                    $content = Storage::get($district);

                    $contents = explode("\n",$content);
                        foreach($contents as $arrays){
                            $name = explode(" ",$arrays);
                            if(!isset($name[1])){
                                continue;
                            }
                            if(!isset($name[4])){
                                DB::table('members')->updateOrInsert(
                                    ['id'=>$name[0],'name'=>$name[1],'district'=>$name[2],'agent'=>$name[3]]
                                );

                            }
                            else{
                                DB::table('members')->updateOrInsert(
                                    ['id'=>$name[0],'district'=>$name[2],'recommender'=>$name[4],'agent'=>$name[3],'name'=>$name[1]]
                                );
                        }

                        }

            }


    }

}
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



        $files = Storage::files('/enrollments');
        foreach($files as $district){

            $content = Storage::get($district);

            $contents = explode("\n",$content);
                foreach($contents as $arrays){
                    $name = explode(",",$arrays);
                    if(!isset($name[1])){
                        continue;
                    }
                    $cdate=date('Y-m-d H:i:s');
                    if(!isset($name[4])){
                        continue;
                    }
                    
                        DB::table('members')->updateOrInsert(
                            ['name'=>$name[0],'gender'=>$name[1],'recommender_agent'=>$name[2],'date'=>$name[3],'district'=>$name[4],'created_at'=>$cdate]
                        
                        );
                        Storage::delete('/enrollments');
                        $dist = DB::table('districts')->pluck('name');
                        foreach($dist as $distric){

                        Storage::put('/enrollments/'.$distric.'.txt','');
                        }


            
                }

    }

    foreach($districts as $district){
        $rec = DB::table('members')->where('district',$district)->pluck('name');
        Storage::delete('recommender/'.$district.'.txt');
        foreach($rec as $recommender){
            Storage::append('recommender/'.$district.'.txt',$recommender);
        }

   }


}


}
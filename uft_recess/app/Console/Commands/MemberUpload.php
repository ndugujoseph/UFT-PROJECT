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


        $files = Storage::files('/enrollments');

       foreach($files as $district){
           $signblast =explode(".",$district);

           if(Str::is('sign',$signblast[1])){

              $signtext = Storage::get($district);
              $district = explode("/",$signblast[0]);
              $wrongsigns=[];
              $allsigns  = [];
              $outer =0;
              $inner =0;
              $dbsigns = DB::table('agents')->where('district',$district[1])->pluck('signature','username');
              $arraydb = $dbsigns->toArray();
              $split = Arr::divide($arraydb);
              $signs = explode("\n",$signtext);
              foreach($signs as $signx){
                  $signx = explode(":",$signx);

                //if no explode possible skip execution
                  if(!isset($signx[1])){
                      continue;
                  }
                  //store all the client socket numnbers for identification
                  $allsigns = Arr::add($allsigns,$signx[0],$signx[1]);
                }
               foreach($split[0] as $key){
                    if(Arr::has($allsigns,$key)){
                        if(Str::is($allsigns[$key],$arraydb[$key])){
                              $inner++;

                        }
                        else{
                            $wrongsigns = Arr::prepend($wrongsigns,$key.":".$allsigns[$key]);
                        }
                        $outer++;
                    }

                  }
               //check if signature verification was successfull
              if($outer==$inner){
                   //puts the message in the district status
                   $content = Storage::get($signblast[0] .".txt");
                   $contents = explode("\n",$content);

                   foreach($contents as $arrays){
                       $name = explode(",",$arrays);
                       if(!isset($name[1])){
                           continue;
                       }
                       if(!isset($name[5])){
                           $count =DB::table('members')->where('district',$name[4])->count();
                           $count +=1;
                           $Id = DB::table('districts')->where('name',$name[4])->pluck('code')->toArray();
                           $memberId = $Id[0] .$count;
                           $cdate=date('Y-m-d H:i:s');
                           DB::table('members')->updateOrInsert(
                            ['name'=>$name[0],'gender'=>$name[1],'recommender_agent'=>$name[2],'date'=>$name[3],'district'=>$name[4],'created_at'=>$cdate]);

                       }
                       

                   }
                  //move records to search location
                  $records= Storage::get($signblast[0] .".txt");
                  Storage::prepend("/search/".$signblast[0] .".txt",$records);

                  //delete former
                  Storage::delete($signblast[0] .".sign");
                  Storage::delete($signblast[0] .".txt");
                  Storage::delete("/status/".$district[1] .".txt");

              }
              else{
              //if any of the signatures is not complete and valid
               Storage::delete("/status/".$district[1] .".txt");
                  foreach($wrongsigns as $sign){

                    Storage::append("/status/".$district[1] .".txt",$sign);

                  }
              }
           }

       }

       $districts = DB::table('districts')->pluck('name');

       foreach($districts as $district){
            $rec = DB::table('members')->where('district',$district)->pluck('name');
            Storage::delete('recommender/'.$district.'.txt');
            foreach($rec as $recommender){
                Storage::append('recommender/'.$district .'.txt',$recommender);
            }

       }


    }

//         $districts = DB::table('districts')->pluck('name');



//         $files = Storage::files('/enrollments');
//         foreach($files as $district){

//             $content = Storage::get($district);

//             $contents = explode("\n",$content);
//                 foreach($contents as $arrays){
//                     $name = explode(",",$arrays);
//                     if(!isset($name[1])){
//                         continue;
//                     }
//                     $cdate=date('Y-m-d H:i:s');
//                     if(!isset($name[4])){
//                         continue;
//                     }
                    
//                         DB::table('members')->updateOrInsert(
//                             ['name'=>$name[0],'gender'=>$name[1],'recommender_agent'=>$name[2],'date'=>$name[3],'district'=>$name[4],'created_at'=>$cdate]
                        
//                         );
//                         Storage::delete('/enrollments');
//                         $dist = DB::table('districts')->pluck('name');
//                         foreach($dist as $distric){

//                         Storage::put('/enrollments/'.$distric.'.txt','');
//                         }


            
//                 }

//     }

//     foreach($districts as $district){
//         $rec = DB::table('members')->where('district',$district)->pluck('name');
//         Storage::delete('recommender/'.$district.'.txt');
//         foreach($rec as $recommender){
//             Storage::append('recommender/'.$district.'.txt',$recommender);
//         }

//    }


// }


}
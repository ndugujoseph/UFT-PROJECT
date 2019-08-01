<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload()
    { 

        $districts = DB::table('districts')->pluck('name','id');
        $arraydb = $districts->toArray();
        $split = Arr::divide($arraydb);
        
            dd($districts,$split);
        foreach($districts as $district){
            $rec = DB::table('agents')->pluck('username');
            Storage::delete('recommender/'.$district.'.txt');
            foreach($rec as $recommender){
                Storage::append('recommender/'.$district.'.txt',$recommender);
            }
    
       
    //     $txtmemberId = DB::table('members')->pluck('member_id');
    //     // $mem = $txtmemberId->toArray();

    //     // $dis = DB::table('districts')->pluck('name');
    //     // $dst = $dis->toArray();
    //     // $districts = DB::table('districts')->pluck('name');

    //     // $pay = DB::table('agents')->pluck('salary','name');

    //     $count = $txtmemberId->count();
    //      dd($count);
    //     // $pay = Arr::divide($pay->toArray());


    //     foreach($txtmemberId as $memberId){
    //         $names = DB::table('agents')->where('district',$memberId)->pluck('name');
    //         foreach($names as $name){
    //             $i = 0;
    //             while($i != $count){
    //                 if(Str::is($name,$pay[0][$i])){
    //                     Storage::append('payments/'.$district.'.txt',$pay[0][$i]."    ".$pay[1][$i]);

    //                 }
    //                 $i +=1;
    //             }
    //         }

    //     }
    //     // dd($txtmemberId,$dis,$dst,$mem);
    // //     foreach($txtmemberId as $memb){
    // //         $rept = DB::table('members')->where('member_id',$memb)->pluck('member_id');
            
    // //     foreach($dis as $diss){
    // //         $pass = DB::table('districts')->where('name',$diss)->pluck('name');           
    // //     }

    // //     Storage::prepend('/recommender/'.$pass.'.txt',$rept);
    // // }
        
        
    //     $recommenders = DB::table('members')->distinct('recommender_member')->pluck('recommender_member');
    //     $array = "";
    //     $names = [];
    //     $check = "fail";
    //     foreach($recommenders as $recommender){
    //         $count = DB::table('members')->where('recommender_member',$recommender)->count();
    //         if($count >40){
    //             $check = "ok";
    //             $names = Arr::prepend($names,$recommender);
    //             $array = $array." ".$recommender;

    //         }

    //     }
    //     if(Str::is('ok',$check)){
    //         Flash::success($array." have clocked 40 recommendations");
        
        
    //     $files = Storage::files('/enrollments');
       
    //    foreach($files as $district){
    //        $signblast =explode(".",$district);
           
    //        if(Str::is('sign',$signblast[1])){


    //           $signtext = Storage::get($district);
              
    //           $district = explode("/",$signblast[0]);
              
    //           $wrongsigns=[];
    //           $allsigns  = [];
    //           $outer =0;
    //           $inner =0;
    //           $dis = DB::table('districts')->where('name',$district[1])->pluck('id');
              
    //           $dbsigns = DB::table('agents')->where('district_id',$dis)->pluck('signature','full_name');
    //           //coverting to a normal array
    //           $arraydb = $dbsigns->toArray();
              
    //           $split = Arr::divide($arraydb);

              
    //           $signs = explode("\n",$signtext);
              
    //           foreach($signs as $signx){
    //               $signx = explode(":",$signx);
                  
    //             //if no explode possible skip execution
    //               if(!isset($signx[1])){
    //                   continue;
    //               }
                  
    //               //store all the client socket numnbers for identification
    //               $allsigns = Arr::add($allsigns,$signx[0],$signx[1]);
                
    //             }
    //            foreach($split[0] as $key){
                 
    //                 if(Arr::has($allsigns,$key)){
    //                     if(Str::is($allsigns[$key],$arraydb[$key])){
                            
    //                           $inner++;

    //                     }
    //                     else{
    //                         $wrongsigns = Arr::prepend($wrongsigns,$key.":".$allsigns[$key]);
                            
    //                     }
    //                     $outer++;
    //                 }
    //                 // dd($allsigns,$arraydb);
    //               }
    //            //check if signature verification was successfull
    //           if($outer==$inner){
    //                //puts the message in the district status
    //                $content = Storage::get($signblast[0] .".txt");
                   
    //                $contents = explode("\n",$content);

    //                foreach($contents as $arrays){
    //                    $name = explode(",",$arrays);
    //                    if(!isset($name[1])){
    //                        continue;
    //                    }
    //                    if(!isset($name[5])){
    //                        $count =DB::table('members')->where('district',$name[4])->count();
    //                        $count +=1;
    //                        $Id = DB::table('districts')->where('name',$name[4])->pluck('code')->toArray();
    //                        $memberId = $Id[0] .$count;
    //                        DB::table('members')->updateOrInsert(
    //                            ['id'=>$memberId,'district'=>$name[4],'agent'=>$name[2],'name'=>$name[0],'gender'=>$name[1],'DateOfEnroll'=>$name[3],'created_at'=>$name[3]]
    //                        );

    //                    }
    //                    else{
    //                        $count =DB::table('members')->where('district',$name[5])->count();
    //                        $count +=1;
    //                        $Id = DB::table('districts')->where('name',$name[5])->pluck('code')->toArray();
    //                        $memberId = $Id[0] .$count;
    //                        DB::table('members')->updateOrInsert(
    //                            ['id'=>$memberId,'district'=>$name[5],'recommender'=>$name[2],'agent'=>$name[3],'name'=>$name[0],'gender'=>$name[1],'DateOfEnroll'=>$name[4],'created_at'=>$name[4]]
    //                        );
    //                        }

    //                }
    //               //move records to search location
    //               $records= Storage::get($signblast[0] .".txt");
    //               Storage::prepend("/search/".$signblast[0] .".txt",$records);

    //               //delete former
    //               Storage::delete($signblast[0] .".sign");
    //               Storage::delete($signblast[0] .".txt");
    //               Storage::delete("/status/".$district[1] .".txt");

    //           }
    //           else{
    //           //if any of the signatures is not complete and valid
    //            Storage::delete("/status/".$district[1] .".txt");
    //               foreach($wrongsigns as $sign){

    //                 Storage::append("/status/".$district[1] .".txt",$sign);

    //               }
    //           }
    //        }

    //    }

    //    $districts = DB::table('districts')->pluck('name');

    //    foreach($districts as $district){
    //         $rec = DB::table('members')->where('district',$district)->pluck('name');
    //         Storage::delete('recommender/'.$district.'.txt');
    //         foreach($rec as $recommender){
    //             Storage::append('recommender/'.$district .'.txt',$recommender);
    //         }

       }


    

        
        /*
        \Log::info("Cron is working fine!");

        $this->info('');
        */
    //    $districts = DB::table('districts')->pluck('name');

    // $disID = DB::table('agents')->where('role_id',3)->pluck('district_id');
        
    // $agenthead = DB::table('agents')->where('role_id',3)->pluck('full_name');
    // // dd($disID,$agenthead);
    // DB::table('districts')->where('id',$disID)->UpdateorInsert(['agent_head'=>$agenthead]);


    //             $files = Storage::files('/enrollments');
    //             foreach($files as $district){

    //                 $content = Storage::get($district);

    //                 $contents = explode("\n",$content);
    //                     foreach($contents as $arrays){
    //                         $name = explode(",",$arrays);
    //                         if(!isset($name[1])){
    //                             continue;
    //                         }
                               
    //                         if(!isset($name[4])){
    //                             continue;
    //                         }
                            
    //                             DB::table('members')->updateOrInsert(
    //                                 ['name'=>$name[0],'gender'=>$name[1],'recommender_agent'=>$name[2],'date'=>$name[3],'district'=>$name[4]]
                                
    //                             );
                    
    //                     }

    //         }

    //         foreach($districts as $district){
    //             $rec = DB::table('members')->where('district',$district)->pluck('name');
    //             Storage::delete('recommender/'.$district.'.txt');
    //             foreach($rec as $recommender){
    //                 Storage::append('recommender/'.$district.'.txt',$recommender);
    //             }
    
    //        }


    }

}

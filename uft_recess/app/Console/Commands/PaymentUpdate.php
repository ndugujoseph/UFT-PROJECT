<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PaymentUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:update';

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
        $sumOfTreasury = DB::table('tresuaries')->sum('amount');
        $sumPayable = $sumOfTreasury - 2000000;
        if($sumPayable > 0){
            //total number of districts with  agents in the system
            $numDistrict = DB::table('agents')->distinct('district')->count('district');
            $numAgent  = DB::table('agents')->count();

            //district(s) with the highest number of enrollments
            $maxEnrol = DB::table('districts')->max('members');
            $highDistrict = DB::table('districts')->where('members',$maxEnrol)
                                                  ->pluck('name');

            $highnumDistrict = $highDistrict->count('name');
            $highnum = 0;
            foreach($highDistrict as $district){
                $highAgent = DB::table('agents')->where('district',$district)->count('name');

                //compute the sum of agents with high enrollment
                $highnum += $highAgent;
            }

            //check if all districts have equal enrollments
            if($numDistrict != $highnumDistrict){
            //standard agent salary per month
            $stdAgentSalary = $sumPayable/(1/2+(7/4*$numDistrict)+(1.75*$highnumDistrict)+$numAgent+$highnum);

            //payment description

            $adminPay = 1/2*$stdAgentSalary;
            $stdAgentH = 7/4*$stdAgentSalary;
            $highAgentH = 2*$stdAgentH;
            $highAgent = 2*$stdAgentSalary;
            //inserts into the payment table... hell yeah

            DB::table('payments')->updateOrInsert(['Role'=>'Administrator'],['Salary'=>$adminPay,'Total'=>$adminPay]);
            DB::table('payments')->updateOrInsert(['Role'=>'High-Agent-Head'],['Salary'=>$highAgentH, 'Total'=>$highnumDistrict*$highAgentH]);
            DB::table('payments')->updateOrInsert(['Role'=>'Agent-Head'],['Salary'=>$stdAgentH,'Total'=>($numDistrict-$highnumDistrict)*$stdAgentH]);
            DB::table('payments')->updateOrInsert(['Role'=>'High-Agent'],['Salary'=>$highAgent,'Total'=>$highAgent*$highnum]);
            DB::table('payments')->updateOrInsert(['Role'=>'Agent'],['Salary'=>$stdAgentSalary,'Total'=>$stdAgentSalary*($numAgent-$highnum)]);

            }
            else{
                $stdAgentSalary = $sumPayable/(1/2+(7/4*$numDistrict)+$numAgent);
                $adminPay = 1/2*$stdAgentSalary;
                $stdAgentH = 7/4*$stdAgentSalary;

                 //remove previous records
                 DB::table('payments')->truncate();

                //insert into payment tables
                DB::table('payments')->updateOrInsert(['Role'=>'Administrator'],['Salary'=>$adminPay,'Total'=>$adminPay]);
                DB::table('payments')->updateOrInsert(['Role'=>'Agent-Head'],['Salary'=>$stdAgentH,'Total'=>$numDistrict*$stdAgentH]);
                DB::table('payments')->updateOrInsert(['Role'=>'Agent'],['Salary'=>$stdAgentSalary,'Total'=>$stdAgentSalary*$numAgent]);





            }



        }
        else{
            DB::table('payments')->truncate();
        }
    }
}

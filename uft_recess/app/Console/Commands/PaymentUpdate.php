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
        $sumOfTreasury = DB::table('well_wishers')->sum('amount');
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
                $highAgent = DB::table('agents')->where([['district',$district],['role','Agent']])->count('full_name');

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
            $cdate=date('Y-m-d H:i:s');
            //inserts into the payment table... hell yeah
            
            DB::table('admin_payments')->updateOrInsert(['date'=>$cdate,'amount'=>$adminPay]);
            DB::table('agent_head_payments')->updateOrInsert(['date'=>$cdate,'highest_erollment'=>$highAgentH,'lowest_erollment'=>$stdAgentH]);
            DB::table('agent_payments')->updateOrInsert(['date'=>$cdate,'highest_erollment'=>$highAgent,'other_erollments'=>$stdAgentSalary]);
           
            //total payment
            DB::table('total_payments')->updateOrInsert([
            'date'=>$cdate,
            'admin'=>$adminPay,
            'agent_low'=>$stdAgentSalary*($numAgent-$highnum),
            'agent_high'=>$highAgent*$highnum,
            'agent_head_low'=>($numDistrict-$highnumDistrict)*$stdAgentH,
            'agent_head_high'=>$highnumDistrict*$highAgentH]);
            
        }

            else{
                $stdAgentSalary = $sumPayable/(1/2+(7/4*$numDistrict)+$numAgent);
                $adminPay = 1/2*$stdAgentSalary;
                $stdAgentH = 7/4*$stdAgentSalary;
                $cdate=date('Y-m-d H:i:s');
               
                //insert into payment tables
                DB::table('admin_payments')->updateOrInsert(['date'=>$cdate,'amount'=>$adminPay]);
                DB::table('agent_head_payments')->updateOrInsert(['date'=>$cdate,'lowest_erollment'=>$stdAgentH]);
                DB::table('agent_payments')->updateOrInsert(['date'=>$cdate,'other_erollments'=>$stdAgentSalary]);
                //total payment
                DB::table('total_payments')->updateOrInsert([
                'date'=>$cdate,
                'admin'=>$adminPay,
                'agent_low'=>$numDistrict*$stdAgentH,
                'agent_high'=>$numDistrict*$stdAgentH,
                'agent_head_low'=>$numDistrict*$stdAgentH,
                'agent_head_high'=>$numDistrict*$stdAgentH]);

            }

        }
       
    }
}

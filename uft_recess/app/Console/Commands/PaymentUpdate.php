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
            $numDistrict = DB::table('agents')->distinct('district_id')->count('district_id');
            $numAgent  = DB::table('agents')->count();

            //district(s) with the highest number of enrollments
            $maxEnrol = DB::table('districts')->max('members');
            $highDistrict = DB::table('districts')->where('members',$maxEnrol)
                                                  ->pluck('name');

            $highnumDistrict = $highDistrict->count('name');
            $highnum = 0;
            foreach($highDistrict as $district){
                $highAgent = DB::table('agents')->where([['district_id',$district],['role','Agent']])->count('name');

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

            DB::table('admin_payment')->updateOrInsert(['amount'=>$adminPay]);
            DB::table('agent_head_payments')->updateOrInsert(['highest_erollment'=>$highAgentH]);
            DB::table('agent_head_payments')->updateOrInsert(['lowest_erollment'=>$stdAgentH]);
            DB::table('agent_payments')->updateOrInsert(['highest_erollment'=>$highAgent]);
            DB::table('agent_payments')->updateOrInsert(['other_erollments'=>$stdAgentSalary]);
            //total payment
            DB::table('total_payments')->updateOrInsert(['admin'=>$adminPay]);
            DB::table('total_payments')->updateOrInsert(['agent_low'=>$stdAgentSalary*($numAgent-$highnum)]);
            DB::table('total_payments')->updateOrInsert(['agent_high'=>$highAgent*$highnum]);
            DB::table('total_payments')->updateOrInsert(['agent_head_low'=>($numDistrict-$highnumDistrict)*$stdAgentH]);
            DB::table('total_payments')->updateOrInsert(['agent_head_high'=>$highnumDistrict*$highAgentH]);
        }

            else{
                $stdAgentSalary = $sumPayable/(1/2+(7/4*$numDistrict)+$numAgent);
                $adminPay = 1/2*$stdAgentSalary;
                $stdAgentH = 7/4*$stdAgentSalary;

                 //remove previous records
                 DB::table('admin_payment')->truncate();
                 DB::table('agent_head_payments')->truncate();
                 DB::table('agent_payments')->truncate();
                 DB::table('total_payments')->truncate();

                //insert into payment tables
                DB::table('admin_payment')->updateOrInsert(['amount'=>$adminPay]);
                DB::table('agent_head_payments')->updateOrInsert(['lowest_erollment'=>$stdAgentH]);
                DB::table('agent_payments')->updateOrInsert(['other_erollments'=>$stdAgentSalary]);

                //total payment
            DB::table('total_payments')->updateOrInsert(['admin'=>$adminPay]);
            DB::table('total_payments')->updateOrInsert(['agent_low'=>$numDistrict*$stdAgentH]);
            DB::table('total_payments')->updateOrInsert(['agent_high'=>$numDistrict*$stdAgentH]);
            DB::table('total_payments')->updateOrInsert(['agent_head_low'=>$numDistrict*$stdAgentH]);
            DB::table('total_payments')->updateOrInsert(['agent_head_high'=>$numDistrict*$stdAgentH]);

            }

        }
        else{
            DB::table('admin_payment')->truncate();
            DB::table('agent_head_payments')->truncate();
            DB::table('agent_payments')->truncate();
            DB::table('total_payments')->truncate();
        }
    }
}

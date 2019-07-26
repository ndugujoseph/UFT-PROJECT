<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Charts;

use App\User;

use App\WellWishers;

use App\Tresuary;

use DB;


class ChartController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function makeChart($uft)

    {

        switch ($uft) {

            case 'bar':
                $WellWishers = WellWishers::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
                $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
                $Tresuary = Tresuary::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
                $chart = Charts::database($users, 'bar', 'highcharts') 

                            ->title("UFT Users") 

                            ->elementLabel("No.Of Users") 

                            ->dimensions(1000, 500) 

                            ->responsive(true) 

                            ->groupByMonth(date('Y'), true);

                $chart1 = Charts::database($WellWishers, 'bar', 'highcharts')

                            ->title('WellWishers')

                            ->elementLabel('No. Of Well Wishers')

                            ->dimensions(1000, 500) 

                            ->responsive(true) 

                            ->groupByMonth(date('Y'), true);

             $chart2 = Charts::database($Tresuary, 'bar', 'highcharts') 

                            ->title("UFT Monthly Enrollment") 

                            ->elementLabel("Enrollments") 

                            ->dimensions(1000, 500) 

                            ->responsive(true) 

                            ->groupByMonth(date('Y'), true);

                            

                break;

            default:

                # code...

                break;

        }

        return view('chart', compact('chart','chart1','chart2'));

    }

}
/*
public function index (){

    $users=Tresuaries::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
            
        $chart=charts::database($users,'bar','highcharts')
            ->groupByMonth(date('Y'),true);
    
    
            return view('charts',compact('chart'));
    
        }*/
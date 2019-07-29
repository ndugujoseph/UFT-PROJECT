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

    public function index()

    {

        $fund = Tresuary::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
                $chart = Charts::database($fund, 'bar', 'highcharts') 

                            ->title("Variation Of Funding Per Month") 

                            ->elementLabel("No. Of Fundings Per Month") 

                            ->dimensions(1000, 500) 

                            ->responsive(true) 

                            ->groupByMonth(date('Y'), true);


        $WellWishers = WellWishers::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
         $chart1 = Charts::database($WellWishers, 'bar', 'highcharts')

                            ->title('Well Wishers')

                            ->elementLabel('No. Of Well Wishers Per Month')

                            ->dimensions(1000, 500) 

                            ->responsive(true)
                             
                            ->groupByMonth(date('Y'), true);

                          
    $perc = DB::select(DB::raw("SELECT DATE_FORMAT(created_at,'%M %Y') as month,COUNT(*) as total from members GROUP BY month"));
    
              
                            $value=array();
                            $updatedvalue=array();
                            $month=array();
                             foreach($perc as $i)
                                                       {
                            array_push($value,$i->total);
                            array_push($month,$i->month);
                                }
                            for($i=0;$i<count($value)-1;$i++){
                            array_push($updatedvalue,(($value[$i+1]-$value[$i])/$value[$i]));
                                    }
                           
                           
            
                            $chart2 = Charts::database($updatedvalue,'bar', 'highcharts') 

                            ->title("Monthly Percentage Change In Enrollment") 

                            ->elementLabel("% Change In Enrollment Per Month") 
                           
                            ->values($updatedvalue)
                            ->labels($month)
                            ->dimensions(1000, 500) 
                            ->responsive(true); 

                                                 
        return view('chart', compact('chart','chart1','chart2'));

    }

}

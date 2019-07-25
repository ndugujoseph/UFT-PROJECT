<?php

/*
namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Charts;

use App\User;

use DB;


class ChartController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     *//*

    public function makeChart($type)

    {

        switch ($type) {

            case 'bar':

                $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y')) 

                        ->get();

                $chart = Charts::database($users, 'bar', 'highcharts') 

                            ->title("Monthly new Register Users") 

                            ->elementLabel("Total Users") 

                            ->dimensions(1000, 500) 

                            ->responsive(true) 

                            ->groupByMonth(date('Y'), true);

                break;


            case 'pie':

                $chart = Charts::create('pie', 'highcharts')

                            ->title('HDTuto.com Laravel Pie Chart')

                            ->labels(['Codeigniter', 'Laravel', 'PHP'])

                            ->values([5,10,20])

                            ->dimensions(1000,500)

                            ->responsive(true);

                break;


            case 'donut':

                $chart = Charts::create('donut', 'highcharts')

                            ->title('HDTuto.com Laravel Donut Chart')

                            ->labels(['First', 'Second', 'Third'])

                            ->values([5,10,20])

                            ->dimensions(1000,500)

                            ->responsive(true);

                break;


            case 'line':

                $chart = Charts::create('line', 'highcharts')

                            ->title('HDTuto.com Laravel Line Chart')

                            ->elementLabel('HDTuto.com Laravel Line Chart Lable')

                            ->labels(['First', 'Second', 'Third'])

                            ->values([5,10,20])

                            ->dimensions(1000,500)

                            ->responsive(true);

                break;


            case 'area':

                $chart = Charts::create('area', 'highcharts')

                            ->title('HDTuto.com Laravel Area Chart')

                            ->elementLabel('HDTuto.com Laravel Line Chart label')

                            ->labels(['First', 'Second', 'Third'])

                            ->values([5,10,20])

                            ->dimensions(1000,500)

                            ->responsive(true);

                break;


            case 'geo':

                $chart = Charts::create('geo', 'highcharts')

                            ->title('HDTuto.com Laravel GEO Chart')

                            ->elementLabel('HDTuto.com Laravel GEO Chart label')

                            ->labels(['ES', 'FR', 'RU'])

                            ->colors(['#3D3D3D', '#985689'])

                            ->values([5,10,20])

                            ->dimensions(1000,500)

                            ->responsive(true);

                break;


            default:

                # code...

                break;

        }

        return view('chart', compact('chart'));

    }

}
*/

namespace App\Http\Controllers\Admin;

use App\UftChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUftChartsRequest;
use App\Http\Requests\Admin\UpdateUftChartsRequest;
//use Charts;

class UftChartsController extends Controller
{
    /**
     * Display a listing of UftChart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
       if (! Gate::allows('uft_chart_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('uft_chart_delete')) {
                return abort(401);
            }
            $uft_charts = UftChart::onlyTrashed()->get();
        } else {
            $uft_charts = UftChart::all();
        }

        return view('admin.uft_charts.index', compact('uft_charts'));
    }

    /**
     * Show the form for creating new UftChart.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('uft_chart_create')) {
            return abort(401);
        }
        return view('admin.uft_charts.create');
    }

    /**
     * Store a newly created UftChart in storage.
     *
     * @param  \App\Http\Requests\StoreUftChartsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUftChartsRequest $request)
    {
        if (! Gate::allows('uft_chart_create')) {
            return abort(401);
        }
        $uft_chart = UftChart::create($request->all());



        return redirect()->route('admin.uft_charts.index');
    }


    /**
     * Show the form for editing UftChart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('uft_chart_edit')) {
            return abort(401);
        }
        $uft_chart = UftChart::findOrFail($id);

        return view('admin.uft_charts.edit', compact('uft_chart'));
    }

    /**
     * Update UftChart in storage.
     *
     * @param  \App\Http\Requests\UpdateUftChartsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUftChartsRequest $request, $id)
    {
        if (! Gate::allows('uft_chart_edit')) {
            return abort(401);
        }
        $uft_chart = UftChart::findOrFail($id);
        $uft_chart->update($request->all());



        return redirect()->route('admin.uft_charts.index');
    }


    /**
     * Display UftChart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('uft_chart_view')) {
            return abort(401);
        }
        $uft_chart = UftChart::findOrFail($id);

        return view('admin.uft_charts.show', compact('uft_chart'));
    }


    /**
     * Remove UftChart from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('uft_chart_delete')) {
            return abort(401);
        }
        $uft_chart = UftChart::findOrFail($id);
        $uft_chart->delete();

        return redirect()->route('admin.uft_charts.index');
    }

    /**
     * Delete all selected UftChart at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('uft_chart_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = UftChart::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore UftChart from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('uft_chart_delete')) {
            return abort(401);
        }
        $uft_chart = UftChart::onlyTrashed()->findOrFail($id);
        $uft_chart->restore();

        return redirect()->route('admin.uft_charts.index');
    }

    /**
     * Permanently delete UftChart from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('uft_chart_delete')) {
            return abort(401);
        }
        $uft_chart = UftChart::onlyTrashed()->findOrFail($id);
        $uft_chart->forceDelete();

        return redirect()->route('admin.uft_charts.index');
    }
}

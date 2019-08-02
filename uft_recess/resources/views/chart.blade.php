@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.uft-charts.title')</h3>
<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>My Charts</title>


        {!! Charts::styles() !!}


    </head>

    <body>

        <!-- Main Application (Can be VueJS or other JS framework) -->

        <div class="app">       
                {!! $chart->html() !!}
               
                {!! $chart2->html() !!}
        </div>

        <!-- End Of Main Application -->

        {!! Charts::scripts() !!}

        {!! $chart->script() !!}
      
        {!! $chart2->script() !!}
        
    </body>
    <footer class="main-footer" >
  
  <div class="pull-right hidden-xs">
    <b>UFT</b> 
  </div>
  <strong>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved @unitedfrontfortransformation.</strong> 
</footer>

</html>
@stop

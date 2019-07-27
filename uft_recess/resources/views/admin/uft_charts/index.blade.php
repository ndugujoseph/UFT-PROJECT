@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.uft-charts.title')</h3>
    @can('uft_chart_create')
    
    @endcan

    @can('uft_chart_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.uft_charts.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.uft_charts.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($uft_charts) > 0 ? 'datatable' : '' }} @can('uft_chart_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    
                </thead>
                
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
@stop

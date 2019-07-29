@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.well-wishers.title')</h3>
    @can('well_wishers_create')
    <p>
        <a href="{{ route('admin.well_wishers.create') }}" class="btn btn-success">Add Well Wisher</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($well_wishers) > 0 ? 'datatable' : '' }} @can('well_wishers_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('well_wishers_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.well-wishers.fields.first-name')</th>
                        <th>@lang('quickadmin.well-wishers.fields.date')</th>
                        <th>@lang('quickadmin.well-wishers.fields.amount')</th>
                        <th>@lang('quickadmin.well-wishers.fields.district')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($well_wishers) > 0)
                        @foreach ($well_wishers as $well_wishers)
                            <tr data-entry-id="{{ $well_wishers->id }}">
                                @can('well_wishers_delete')
                                    <td></td>
                                @endcan

                                <td field-key='first_name'>{{ $well_wishers->first_name }}</td>
                                <td field-key='date'>{{ $well_wishers->date }}</td>
                                <td field-key='amount'>{{ $well_wishers->amount }}</td>
                                <td field-key='district'>{{ $well_wishers->district->name ?? '' }}</td>
                                                                <td>
                                    @can('well_wishers_view')
                                    <a href="{{ route('admin.well_wishers.show',[$well_wishers->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('well_wishers_edit')
                                    <a href="{{ route('admin.well_wishers.edit',[$well_wishers->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                  
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop


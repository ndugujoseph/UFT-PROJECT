@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.agents.title')</h3>
    @can('agents_create')
    <p>
        <a href="{{ route('admin.agents.create') }}" class="btn btn-success">Add Agent</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($agents) > 0 ? 'datatable' : '' }} @can('agents_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('agents_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.agents.fields.full-name')</th>
                        <th>@lang('quickadmin.agents.fields.username')</th>
                        <th>@lang('quickadmin.agents.fields.date-of-birth')</th>
                        <th>@lang('quickadmin.agents.fields.email')</th>
                        <th>@lang('quickadmin.agents.fields.gender')</th>
                        <th>@lang('quickadmin.agents.fields.role')</th>
                        <th>@lang('quickadmin.agents.fields.district')</th>
                        <th>@lang('quickadmin.agents.fields.signature')</th>
                        <th>@lang('quickadmin.agents.fields.password')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($agents) > 0)
                        @foreach ($agents as $agents)
                            <tr data-entry-id="{{ $agents->id }}">
                                @can('agents_delete')
                                    <td></td>
                                @endcan

                                <td field-key='full_name'>{{ $agents->full_name }}</td>
                                <td field-key='username'>{{ $agents->username }}</td>
                                <td field-key='date_of_birth'>{{ $agents->date_of_birth }}</td>
                                <td field-key='email'>{{ $agents->email }}</td>
                                <td field-key='gender'>{{ $agents->gender }}</td>
                                <td field-key='role'>{{ $agents->role->title ?? '' }}</td>
                                <td field-key='district'>{{ $agents->district->name ?? '' }}</td>
                                <td field-key='signature'>{{ $agents->signature }}</td>
                                <td>---</td>
                                                                <td>
                                    @can('agents_view')
                                    <a href="{{ route('admin.agents.show',[$agents->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('agents_edit')
                                    <a href="{{ route('admin.agents.edit',[$agents->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                 
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="14">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop


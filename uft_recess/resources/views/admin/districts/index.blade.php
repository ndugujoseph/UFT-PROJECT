@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.districts.title')</h3>
    @can('districts_create')
    <p>
        <a href="{{ route('admin.districts.create') }}" class="btn btn-success">Add District</a>
        
    </p>
    @endcan

    @can('districts_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.districts.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.districts.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($districts) > 0 ? 'datatable' : '' }} @can('districts_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('districts_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.districts.fields.name')</th>
                        <th>@lang('quickadmin.districts.fields.initials')</th>
                        <th>@lang('quickadmin.districts.fields.region')</th>
                        <th>@lang('quickadmin.districts.fields.agent-head')</th>
                        <th>@lang('quickadmin.districts.fields.agents')</th>
                        <th>@lang('quickadmin.districts.fields.members')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($districts) > 0)
                        @foreach ($districts as $districts)
                            <tr data-entry-id="{{ $districts->id }}">
                                @can('districts_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $districts->name }}</td>
                                <td field-key='initials'>{{ $districts->initials }}</td>
                                <td field-key='region'>{{ $districts->region }}</td>
                                <td field-key='agent_head'>{{ $districts->agent_head }}</td>
                                <td field-key='agents'>{{ $districts->agents }}</td>
                                <td field-key='members'>{{ $districts->members }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('districts_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.districts.restore', $districts->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('districts_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.districts.perma_del', $districts->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('districts_view')
                                    <a href="{{ route('admin.districts.show',[$districts->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('districts_edit')
                                    <a href="{{ route('admin.districts.edit',[$districts->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                  <!--  @can('districts_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.districts.destroy', $districts->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan-->
                                </td>
                                @endif
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


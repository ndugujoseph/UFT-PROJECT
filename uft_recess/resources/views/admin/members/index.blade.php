@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.members.title')</h3>
    @can('members_create')
    <p>
       <!-- <a href="{{ route('admin.members.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>-->
        
    </p>
    @endcan

    @can('members_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.members.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.members.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($members) > 0 ? 'datatable' : '' }} @can('members_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('members_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.members.fields.name')</th>
                        <th>@lang('quickadmin.members.fields.district')</th>
                        <th>@lang('quickadmin.members.fields.recommender-agent')</th>
                        <th>@lang('quickadmin.members.fields.recommender-member')</th>
                        <th>@lang('quickadmin.members.fields.date')</th>
                        <th>@lang('quickadmin.members.fields.member-id')</th>
                        <th>@lang('quickadmin.members.fields.gender')</th>
                        <th>@lang('quickadmin.members.fields.recommendees')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($members) > 0)
                        @foreach ($members as $members)
                            <tr data-entry-id="{{ $members->id }}">
                                @can('members_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $members->name }}</td>
                                <td field-key='district'>{{ $members->district }}</td>
                                <td field-key='recommender_agent'>{{ $members->recommender_agent }}</td>
                                <td field-key='recommender_member'>{{ $members->recommender_member }}</td>
                                <td field-key='date'>{{ $members->date }}</td>
                                <td field-key='member_id'>{{ $members->member_id }}</td>
                                <td field-key='gender'>{{ $members->gender }}</td>
                                <td field-key='recommendees'>{{ $members->recommendees }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('members_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.members.restore', $members->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('members_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.members.perma_del', $members->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('members_view')
                                    <a href="{{ route('admin.members.show',[$members->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="13">@lang('quickadmin.qa_no_entries_in_table') </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop


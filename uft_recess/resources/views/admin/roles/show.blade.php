@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.roles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.roles.fields.title')</th>
                            <td field-key='title'>{{ $role->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
<li role="presentation" class=""><a href="#agents" aria-controls="agents" role="tab" data-toggle="tab">Agents</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="users">
<table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.users.fields.name')</th>
                        <th>@lang('quickadmin.users.fields.email')</th>
                        <th>@lang('quickadmin.users.fields.role')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td field-key='name'>{{ $user->name }}</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='role'>{{ $user->role->title ?? '' }}</td>
                                                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="agents">
<table class="table table-bordered table-striped {{ count($agents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.agents.fields.full-name')</th>
                        <th>@lang('quickadmin.agents.fields.username')</th>
                        <th>@lang('quickadmin.agents.fields.date-of-birth')</th>
                        <th>@lang('quickadmin.agents.fields.email')</th>
                        <th>@lang('quickadmin.agents.fields.gender')</th>
                        <th>@lang('quickadmin.agents.fields.signature')</th>
                        <th>@lang('quickadmin.agents.fields.password')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($agents) > 0)
            @foreach ($agents as $agents)
                <tr data-entry-id="{{ $agents->id }}">
                    <td field-key='full_name'>{{ $agents->full_name }}</td>
                                <td field-key='username'>{{ $agents->username }}</td>
                                <td field-key='date_of_birth'>{{ $agents->date_of_birth }}</td>
                                <td field-key='email'>{{ $agents->email }}</td>
                                <td field-key='gender'>{{ $agents->gender }}</td>
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.roles.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop



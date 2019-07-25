@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.districts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.districts.fields.name')</th>
                            <td field-key='name'>{{ $districts->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.districts.fields.initials')</th>
                            <td field-key='initials'>{{ $districts->initials }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.districts.fields.region')</th>
                            <td field-key='region'>{{ $districts->region }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.districts.fields.agent-head')</th>
                            <td field-key='agent_head'>{{ $districts->agent_head }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.districts.fields.agents')</th>
                            <td field-key='agents'>{{ $districts->agents }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.districts.fields.members')</th>
                            <td field-key='members'>{{ $districts->members }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->


<!-- Tab panes -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.districts.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop



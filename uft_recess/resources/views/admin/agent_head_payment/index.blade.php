@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Agent Heads Payments</h3>
    @can('agent_head_payment_create')
    <p>
      <!--  <a href="{{ route('admin.agent_head_payment.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>-->
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($agent_head_payment) > 0 ? 'datatable' : '' }} @can('agent_head_payment_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('agent_head_payment_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.agent-head-payment.fields.date')</th>
                        <th>@lang('quickadmin.agent-head-payment.fields.highest-erollment')</th>
                        <th>@lang('quickadmin.agent-head-payment.fields.lowest-erollment')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($agent_head_payment) > 0)
                        @foreach ($agent_head_payment as $agent_head_payment)
                            <tr data-entry-id="{{ $agent_head_payment->id }}">
                                @can('agent_head_payment_delete')
                                    <td></td>
                                @endcan

                                <td field-key='date'>{{ $agent_head_payment->date }}</td>
                                <td field-key='highest_erollment'>{{ $agent_head_payment->highest_erollment }}</td>
                                <td field-key='lowest_erollment'>{{ $agent_head_payment->lowest_erollment }}</td>
                                                                <td>
                                    @can('agent_head_payment_view')
                                    <a href="{{ route('admin.agent_head_payment.show',[$agent_head_payment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                   
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop


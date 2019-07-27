@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Agents Payments</h3>
    @can('agent_payments_create')
    <p>
      <!--  <a href="{{ route('admin.agent_payments.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>-->
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($agent_payments) > 0 ? 'datatable' : '' }} @can('agent_payments_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('agent_payments_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.agent-payment.fields.date')</th>
                        <th>@lang('quickadmin.agent-payment.fields.highest-erollment')</th>
                        <th>@lang('quickadmin.agent-payment.fields.other-erollments')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($agent_payments) > 0)
                        @foreach ($agent_payments as $agent_payments)
                            <tr data-entry-id="{{ $agent_payments->id }}">
                                @can('agent_payments_delete')
                                    <td></td>
                                @endcan

                                <td field-key='date'>{{ $agent_payments->date }}</td>
                                <td field-key='highest_erollment'>{{ $agent_payments->highest_erollment }}</td>
                                <td field-key='other_erollments'>{{ $agent_payments->other_erollments }}</td>
                                                                <td>
                                    @can('agent_payments_view')
                                    <a href="{{ route('admin.agent_payments.show',[$agent_payments->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
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


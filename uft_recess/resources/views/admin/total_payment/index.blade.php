@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Total Payments</h3>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($total_payment) > 0 ? 'datatable' : '' }} @can('total_payment_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('total_payment_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.total-payment.fields.date')</th>
                        <th>@lang('quickadmin.total-payment.fields.admin')</th>
                        <th>@lang('quickadmin.total-payment.fields.agent-low')</th>
                        <th>@lang('quickadmin.total-payment.fields.agent-high')</th>
                        <th>@lang('quickadmin.total-payment.fields.agent-head-low')</th>
                        <th>@lang('quickadmin.total-payment.fields.agent-head-high')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($total_payment) > 0)
                        @foreach ($total_payment as $total_payment)
                            <tr data-entry-id="{{ $total_payment->id }}">
                                @can('total_payment_delete')
                                    <td></td>
                                @endcan

                                <td field-key='date'>{{ $total_payment->date }}</td>
                                <td field-key='admin'>{{ $total_payment->admin }}</td>
                                <td field-key='agent_low'>{{ $total_payment->agent_low }}</td>
                                <td field-key='agent_high'>{{ $total_payment->agent_high }}</td>
                                <td field-key='agent_head_low'>{{ $total_payment->agent_head_low }}</td>
                                <td field-key='agent_head_high'>{{ $total_payment->agent_head_high }}</td>
                                                                <td>
                                    @can('total_payment_view')
                                    <a href="{{ route('admin.total_payment.show',[$total_payment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
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


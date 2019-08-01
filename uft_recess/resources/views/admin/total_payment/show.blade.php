@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.total-payment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.total-payment.fields.date')</th>
                            <td field-key='date'>{{ $total_payment->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.total-payment.fields.agent-low')</th>
                            <td field-key='highest_erollment'>{{ $total_payment->agent_low }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.total-payment.fields.agent-high')</th>
                            <td field-key='other_erollments'>{{ $total_payment->agent_low }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.total-payment.fields.agent-head-low')</th>
                            <td field-key='other_erollments'>{{ $total_payment->agent_head_low }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.total-payment.fields.agent-head-high')</th>
                            <td field-key='other_erollments'>{{ $total_payment->agent_head_low }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.total_payment.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop

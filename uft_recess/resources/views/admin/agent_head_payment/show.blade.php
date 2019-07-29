@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.agent-head-payment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.agent-head-payment.fields.date')</th>
                            <td field-key='date'>{{ $agent_head_payment->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agent-head-payment.fields.highest-erollment')</th>
                            <td field-key='highest_erollment'>{{ $agent_head_payment->highest_erollment }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agent-head-payment.fields.lowest-erollment')</th>
                            <td field-key='lowest_erollment'>{{ $agent_head_payment->lowest_erollment }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.agent_head_payment.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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

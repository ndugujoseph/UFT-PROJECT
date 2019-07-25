@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.agents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.agents.fields.full-name')</th>
                            <td field-key='full_name'>{{ agents->full_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agents.fields.username')</th>
                            <td field-key='username'>{{ agents->username }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agents.fields.date-of-birth')</th>
                            <td field-key='date_of_birth'>{{ agents->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agents.fields.email')</th>
                            <td field-key='email'>{{ agents->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agents.fields.gender')</th>
                            <td field-key='gender'>{{ agents->gender }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agents.fields.signature')</th>
                            <td field-key='signature'>{{ agents->signature }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.agents.fields.password')</th>
                            <td>---</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.agentsses.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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

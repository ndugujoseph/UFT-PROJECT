@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.well-wishers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.well-wishers.fields.first-name')</th>
                            <td field-key='first_name'>{{ $well_wishers->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.well-wishers.fields.date')</th>
                            <td field-key='date'>{{ $well_wishers->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.well-wishers.fields.amount')</th>
                            <td field-key='amount'>{{ $well_wishers->amount }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->




            <p>&nbsp;</p>

            <a href="{{ route('admin.well_wishers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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

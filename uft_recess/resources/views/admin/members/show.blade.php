@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.members.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.members.fields.name')</th>
                            <td field-key='name'>{{ $members->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.district')</th>
                            <td field-key='district'>{{ $members->district }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.recommender-agent')</th>
                            <td field-key='recommender_agent'>{{ $members->recommender_agent }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.recommender-member')</th>
                            <td field-key='recommender_member'>{{ $members->recommender_member }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.date')</th>
                            <td field-key='date'>{{ $members->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.member-id')</th>
                            <td field-key='member_id'>{{ $members->member_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.gender')</th>
                            <td field-key='gender'>{{ $members->gender }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.members.fields.recommendees')</th>
                            <td field-key='recommendees'>{{ $members->recommendees }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.members.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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

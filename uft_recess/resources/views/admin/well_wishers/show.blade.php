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
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#tresuary" aria-controls="tresuary" role="tab" data-toggle="tab">Treasury</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="tresuary">
<table class="table table-bordered table-striped {{ count($tresuaries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.tresuary.fields.date')</th>
                        <th>@lang('quickadmin.tresuary.fields.amount')</th>
                        <th>@lang('quickadmin.tresuary.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($tresuaries) > 0)
            @foreach ($tresuaries as $tresuary)
                <tr data-entry-id="{{ $tresuary->id }}">
                    <td field-key='date'>{{ $tresuary->date }}</td>
                                <td field-key='amount'>
                                    @foreach ($tresuary->amount as $singleAmount)
                                        <span class="label label-info label-many">{{ $singleAmount->amount }}</span>
                                    @endforeach
                                </td>
                                <td field-key='total'>{{ $tresuary->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('tresuary_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tresuaries.restore', $tresuary->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('tresuary_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tresuaries.perma_del', $tresuary->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('tresuary_view')
                                    <a href="{{ route('admin.tresuaries.show',[$tresuary->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('tresuary_edit')
                                    <a href="{{ route('admin.tresuaries.edit',[$tresuary->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('tresuary_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tresuaries.destroy', $tresuary->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.well_wisherss.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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

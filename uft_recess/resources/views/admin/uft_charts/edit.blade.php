@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.uft-charts.title')</h3>
    
    {!! Form::model($uft_chart, ['method' => 'PUT', 'route' => ['admin.uft_charts.update', $uft_chart->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('reports', trans('quickadmin.uft-charts.fields.reports').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('reports', old('reports'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('reports'))
                        <p class="help-block">
                            {{ $errors->first('reports') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


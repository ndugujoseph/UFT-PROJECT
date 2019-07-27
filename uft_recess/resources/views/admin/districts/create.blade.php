@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.districts.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.districts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.districts.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('initials', trans('quickadmin.districts.fields.initials').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('initials', old('initials'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('initials'))
                        <p class="help-block">
                            {{ $errors->first('initials') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('region', trans('quickadmin.districts.fields.region').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('region', old('region'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('region'))
                        <p class="help-block">
                            {{ $errors->first('region') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('agent_head', trans('quickadmin.districts.fields.agent-head').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('agent_head', old('agent_head'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('agent_head'))
                        <p class="help-block">
                            {{ $errors->first('agent_head') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('agents', trans('quickadmin.districts.fields.agents').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('agents', old('agents'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('agents'))
                        <p class="help-block">
                            {{ $errors->first('agents') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('members', trans('quickadmin.districts.fields.members').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('members', old('members'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('members'))
                        <p class="help-block">
                            {{ $errors->first('members') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="well-wishers-template">
        @include('admin.districts.well_wishers_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="agents-template">
        @include('admin.districts.agents_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
@stop
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.agents.title')</h3>
    
    {!! Form::model($agents, ['method' => 'PUT', 'route' => ['admin.agents.update', $agents->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.agents.fields.name').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('initials', trans('quickadmin.agents.fields.initials').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('region', trans('quickadmin.agents.fields.region').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('agent_head', trans('quickadmin.agents.fields.agent-head').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('agent_head', old('agent_head'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                    {!! Form::label('agents', trans('quickadmin.agents.fields.agents').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('members', trans('quickadmin.agents.fields.members').'*', ['class' => 'control-label']) !!}
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
    <div class="panel panel-default">
        <div class="panel-heading">
            Well wishers
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('quickadmin.well-wishers.fields.first-name')</th>
                        <th>@lang('quickadmin.well-wishers.fields.amount')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="well-wishers">
                    @forelse(old('well_wishers', []) as $index => $data)
                        @include('admin.agents.well_wishers_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($agents->well_wishers as $item)
                            @include('admin.agents.well_wishers_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Agents
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('quickadmin.agents.fields.full-name')</th>
                        <th>@lang('quickadmin.agents.fields.username')</th>
                        <th>@lang('quickadmin.agents.fields.email')</th>
                        <th>@lang('quickadmin.agents.fields.gender')</th>
                        <th>@lang('quickadmin.agents.fields.signature')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="agents">
                    @forelse(old('agents', []) as $index => $data)
                        @include('admin.agents.agents_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($agents->agents as $item)
                            @include('admin.agents.agents_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="well-wishers-template">
        @include('admin.agents.well_wishers_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="agents-template">
        @include('admin.agents.agents_row',
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
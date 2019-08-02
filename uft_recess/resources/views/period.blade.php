@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                

                    {!! $cha->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}

{!! $cha->script() !!}
@endsection

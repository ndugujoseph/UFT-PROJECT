@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<form  method="POST" action="{{url('/period')}}">
    @csrf
                  <select name="period" class="btn btn-primary">
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="6">6</option>
                  </select>
                  <button class="btn btn-primary">View</button>
@endsection

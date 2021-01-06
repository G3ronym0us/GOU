
@extends('layouts.app')

@section('content')
    <div id="app">
        <driver-component v-bind:base_url="'{{ url('') }}'"></driver-component>    

    </div>
@endsection
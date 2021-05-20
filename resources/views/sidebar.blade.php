@extends('layouts.master')
@section('sidebar')
    @parent
    <div class="container">This is appended to the master sidebar via parent.</div>
@endsection

@section('content')
    <p>This is Content here.</p>
@endsection

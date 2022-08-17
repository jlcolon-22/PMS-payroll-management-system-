@extends('layouts.app')

@section('content')
    <Dashboard :user="{{ Auth::check() ? Auth::user() : ''  }}"></Dashboard> 
@endsection
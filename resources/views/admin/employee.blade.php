@extends('layouts.app')

@section('content')
    <Employee :user="{{ Auth::check() ? Auth::user() : ''  }}"></Employee> 
@endsection
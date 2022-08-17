@extends('layouts.app')

@section('content')
    <Scan :user="{{ Auth::check() ? Auth::user() : ''  }}"></Scan> 
@endsection
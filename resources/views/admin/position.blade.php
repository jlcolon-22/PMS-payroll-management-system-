@extends('layouts.app')

@section('content')
    <Position :user="{{ Auth::check() ? Auth::user() : ''  }}"></Position> 
@endsection
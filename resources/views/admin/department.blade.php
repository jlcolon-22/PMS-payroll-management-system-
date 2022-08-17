@extends('layouts.app')

@section('content')
    <Department :user="{{ Auth::check() ? Auth::user() : ''  }}"></Department> 
@endsection
@extends('layouts.app')

@section('content')
    <Attendance :user="{{ Auth::check() ? Auth::user() : ''  }}"></Attendance> 
@endsection
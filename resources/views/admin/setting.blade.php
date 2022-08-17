@extends('layouts.app')

@section('content')
    <Setting :user="{{ Auth::check() ? Auth::user() : ''  }}"></Setting> 
@endsection
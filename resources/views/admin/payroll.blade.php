@extends('layouts.app')

@section('content')
    <Payroll :user="{{ Auth::check() ? Auth::user() : ''  }}"></Payroll> 
@endsection
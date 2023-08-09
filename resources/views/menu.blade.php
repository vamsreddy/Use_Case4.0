@extends('layout')

@section('content')
    <h1>Menu:</h1>
    <ul>
        <a href="{{ route('process', ['choice' => 'i']) }}">Need answer</a><br>
        <a href="{{ route('process', ['choice' => 'ii']) }}">Need code</a><br>
        <a href="{{ route('process', ['choice' => 'iii']) }}">Need suggestion</a>
    </ul>
@endsection
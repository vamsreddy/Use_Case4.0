@extends('layout')

@section('content')
    <h1>Enter your {{ $type }} prompt:</h1>
    <form method="post" action="{{ route('generate-response') }}">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        <textarea name="prompt" rows="5" cols="50"></textarea>
        <button type="submit">Get Response</button>
    </form>
@endsection
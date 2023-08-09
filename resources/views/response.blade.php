@extends('layout')

@section('content')
    <h1>Chatbot Response:</h1>
    <p>{{ $response }}</p>
    <form method="post" action="{{ route('send-email') }}">
        @csrf
        <input type="hidden" name="response" value="{{ $response }}">
        <label for="email">Send response via email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Email</button>
    </form>
@endsection
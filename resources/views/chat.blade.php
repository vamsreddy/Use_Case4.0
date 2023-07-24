@extends('layout')
@section('content')
<div class="chat-container">
    <h1>Chatbot Response</h1>

    @if(isset($messages))
        @foreach($messages as $message)
            <div class="message-container {{ $message['role'] }}">
                <div class="message">{{ $message['content'] }}</div>
            </div>
        @endforeach
    @endif

    @if(isset($answer))
        <div class="message-container bot">
            <div class="message">
                <span class="answer">{{ $answer }}</span>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('chat.post') }}">
        @csrf
        <div class="input-container">
            <input type="text" name="message" id="message" placeholder="Type your message...">
            <button type="submit" class="submit-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</div>
@endsection